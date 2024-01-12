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
    
    public function getLastRowIndex($row) // Mengembalikan index baris terakhir dari table data.
    {
        $lastRow = 0;
        foreach ($row as $key => $value) {
            if ($value[2] !== null) {
                $lastRow = $key;
            }
        }
        // dd($lastRow,$tes);
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
        // dd($firstRow);
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
        // dd($data);
        return $data;
    }
    
    public function getKodeFile($row)
    {
        $kode_file = $row[8][1];
        // dd(decrypt($kode_file));
        // $tes = $this->getData($row);
        return decrypt($kode_file);
    }
    
    public function getKelas($rows)
    {
        $tingkat_kelas = $rows[2][1];
        $kelas_id = Kelas::where('nama_kelas',$tingkat_kelas)->value('id');
        $nama_sub_kelas = $rows[3][1];
        $sub_kelas_id = SubKelas::where('kelas_id',$kelas_id)->where('nama_sub_kelas',$nama_sub_kelas)->value('id');
        // dd($sub_kelas_id);
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
        $new_data = [];
        
        foreach ($data as $key => $item) {
            if ($key = 11 && $key <= $row_old_data) {
                $old_data[] = $item;
            }
            else {
                $new_data[] = $item;
            }
        }
        // dd($old_data, $new_data, $row_old_data, $data);
        
        $this->update($old_data);

        if ($row_old_data != $lastRow ){
            $this->create($new_data, $sub_kelas_id);
        }
    }
    
    public function create(array $new_data, $sub_kelas_id)
    {
        $objek = new SiswaController();
        $objek->storeViaExcel($new_data, $sub_kelas_id);
    }
    
    public function update(array $old_data)
    {
        foreach ($old_data as $key => $value) {
            $model = Siswa::where('id',$value[0])->first();
            $model->nisn = "$value[2]";
            $model->nama_siswa = $value[1];
            $model->orangtua_wali = $value[3];
        }
        // dd($model);
        $model->save();
        return $model;
    }
}
