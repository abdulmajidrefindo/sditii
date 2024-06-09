<?php

namespace App\Imports;

use App\Http\Controllers\KelasController;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Guru;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\Periode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class KelasImport implements ToCollection
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
        $kode_file = $row[5][1];
        // dd(decrypt($kode_file));
        // $tes = $this->getData($row);
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
        $objek = new KelasController();
        $objek->storeViaExcel($new_data);
    }
    
    public function update(array $old_data)
    {
        $periode_aktive = Periode::where('status','aktif')->value('id');
        foreach ($old_data as $key => $value) {
            $model = SubKelas::where('periode_id',$periode_aktive)->where('id',$value[0])->first();

            $kelas_id = kelas::where('nama_kelas',"$value[1]")->value('id');
            $user_id = User::where('user_name',"$value[3]")->value('id');
            $guru_id = Guru::where('user_id',$user_id)->value('id');
            
            $model->kelas_id = $kelas_id;
            $model->nama_sub_kelas = "$value[2]";
            $model->guru_id = $guru_id;
            // dump($model);
            $model->save();
        }
        // dd('selesai');
        return $model;
    }
}
