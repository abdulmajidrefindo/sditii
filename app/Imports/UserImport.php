<?php

namespace App\Imports;

use App\Http\Controllers\UserController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\User;
use App\Models\Roles;
use App\Models\UserRoles;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class UserImport implements ToCollection
{
    private $kode_file, $errorFlag = false, $message = '';
    
    public function __construct($kode_file)
    {
        $this->kode_file = $kode_file;
    }
    
    public function collection(Collection $rows)
    {
        $file_identifier = '';
        try {
            $this->getData($rows);
            $file_identifier = $this->getKodeFile($rows);
            if ($file_identifier != $this->kode_file) {
                $pesan = 'File tidak sesuai. File yang diharapkan: ' . $this->kode_file . '. 
                File yang diupload: ' . $file_identifier;
                $this->errorFlag = true;
                $this->message = $this->convertCamelCaseToReadable($pesan);
            }
        } catch (\Throwable $th) {
            $pesan = 'Bukan file yang diharapkan. Pastikan file yang diupload sesuai dengan template yang disediakan.';
            $this->errorFlag = true;
            $this->message = $pesan;
        }
        
        if (!$this->errorFlag) {
            try {
                $this->saveData($rows);
                $this->message = 'Data berhasil diimport.';
            } catch (\Throwable $th) {
                $this->message = $th->getMessage();
                $this->errorFlag = true;
            }
        }
    }
    
    function convertCamelCaseToReadable($inputString) {
        $result = preg_replace('/(?<!^)([A-Z])/', ' $1', $inputString);
        return $result;
    }
    
    public function hasError() : bool
    {
        return $this->errorFlag;
    }
    
    public function getMessages() : string
    {
        return $this->message;
    }
    
    public function getLastRowIndex($row) // Mengembalikan index baris terakhir dari table data.
    {
        $lastRow = 0;
        foreach ($row as $key => $value) {
            if ($value[2] !== null) {
                $lastRow = $key;
            }
        }
        return $lastRow;
    }
    
    public function getFirstRowIndex($row) // Mengembalikan index baris pertama dari table data.
    {
        $firstRow = 0;
        foreach ($row as $key => $value) {
            if ($value[0] == 'ID') { 
                $firstRow = $key;
                break;
            }
        }
        return $firstRow; 
    }
    
    public function getLastColumnIndex($row)
    {
        $lastColumn = 0;
        $row_start = $this->getFirstRowIndex($row);
        foreach ($row[$row_start] as $key => $value) {
            if ($value != null) {
                $lastColumn = $key;
            }
        }
        // dd($row_start,$lastColumn);
        return $lastColumn;
    }
    
    public function getData($rows)
    {
        $firstRow = $this->getFirstRowIndex($rows)+1;
        $lastRow = $this->getLastRowIndex($rows);
        
        $data = [];
        for ($i=$firstRow; $i <= $lastRow; $i++) { 
            $data[$i] = $rows[$i]->toArray();
        }
        return $data;
    }
    
    public function getKodeFile($row)
    {
        $kode_file = $row[3][1];
        return decrypt($kode_file);
    }
    
    public function saveData($rows){
        $firstRow = $this->getFirstRowIndex($rows)+1;
        $lastRow = $this->getLastRowIndex($rows);
        $row_old_data = 0;
        foreach ($rows as $key => $value) {
            if ($value[0] !== null) {
                $row_old_data = $key;
            }
        }
        $data = $this->getData($rows);
        $old_data = [];
        $new_data = [];
        
        foreach ($data as $key => $item) {
            if ($key = $firstRow && $key <= $row_old_data) {
                $old_data[] = $item;
            }
            else {
                $new_data[] = $item;
            }
        }
        // dd($old_data, $new_data, $data);
        if($row_old_data-$this->getFirstRowIndex($rows) > 0)
        {
            $this->update($old_data);
        }
        
        if ($row_old_data != $lastRow ){
            $this->create($new_data);
        }
    }
    
    public function create(array $new_data)
    {
        $objek = new UserController();
        $objek->storeViaExcel($new_data);
    }
    
    public function update(array $old_data)
    {
        foreach ($old_data as $key => $value) {
            $model = User::where('id',$value[0])->first();
            $model->name = $value[1];
            $model->user_name = "$value[3]";
            $model->email = "$value[2]";
            
            $password = "$value[4]";
            $panjang_password = strlen($password);
            if($panjang_password <= 30)
            {
                $securep = bcrypt($password);
                $model->password = "$securep";    
            }
            $model->save();
            
            $roleModel=UserRoles::where('user_id',$value[0])->first();
            $role_id = Roles::where('role',"$value[5]")->value('id');
            $roleModel->role_id = $role_id;
            $model->save();
            // dump($model,$roleModel);
        }
        // dd('selesai');
        return $model;
    }
}
