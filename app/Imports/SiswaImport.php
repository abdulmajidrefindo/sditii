<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\SubKelas;
use App\Http\Controllers\SiswaController;
use App\Models\Periode;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class SiswaImport implements ToCollection
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
    
    public function getLastRowIndex($row)
    {
        $lastRow = 0;
        foreach ($row as $key => $value) {
            if ($value[1] !== null || $value[0] !== null) {
                $lastRow = $key;
            }
        }
        return $lastRow;
    }
    
    public function getFirstRowIndex($row)
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
        $kode_file = $row[8][1];
        return decrypt($kode_file);
    }
    
    public function getKelas($rows)
    {
        $tingkat_kelas = $rows[2][1];
        $kelas_id = Kelas::where('nama_kelas',$tingkat_kelas)->value('id');
        $nama_sub_kelas = $rows[3][1];
        $periode_aktive = Periode::where('status','aktif')->value('id');
        $sub_kelas_id = SubKelas::where('kelas_id',$kelas_id)->where('nama_sub_kelas',$nama_sub_kelas)->where('periode_id',$periode_aktive)->value('id');
        return  $sub_kelas_id;
    }
    
    public function saveData($rows){
        $lastRow = $this->getLastRowIndex($rows);
        $row_old_data = 0;
        foreach ($rows as $key => $value) {
            if ($value[0] !== null) {
                $row_old_data = $key;
            }
        }
        $sub_kelas_id = $this->getKelas($rows);
        $data = $this->getData($rows);
        $old_data = [];
        $delete_data = [];
        $update_data = [];
        $new_data = [];
        
        foreach ($data as $key => $item) {
            if ($key = 11 && $key <= $row_old_data) {
                $old_data[] = $item;
            }
            else {
                $new_data[] = $item;
            }
        }

        foreach ($old_data as $key => $item) {
            if ($item[1] == null && $item[2] == null && $item[3] == null) {
                $delete_data[] = $item;
            }
            else {
                $update_data[] = $item;
            }
        }
        if($delete_data != null)
        {
            $this->delete($delete_data);
            
        }
        if($update_data != null)
        {
            $this->update($update_data);
        }
        if ($new_data != null){
            $this->create($new_data, $sub_kelas_id);
        }
    }
    
    public function create(array $new_data, $sub_kelas_id)
    {
        $objek = new SiswaController();
        $objek->storeViaExcel($new_data, $sub_kelas_id);
    }
    
    public function update(array $update_data)
    {
        foreach ($update_data as $key => $value) {
            $model = Siswa::where('id',$value[0])->first();
            $model->nisn = "$value[2]";
            $model->nama_siswa = $value[1];
            $model->orangtua_wali = $value[3];
            $model->save();
        }
        return $model;
    }

    public function delete(array $delete_data)
    {
        foreach ($delete_data as $key => $value) {
            $id = $value[0];
            Siswa::destroy($id);
        }
    }
}
