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

class CatatanImport implements ToCollection
{
    private $kode_file, $errorFlag = false, $message = '';
    
    public function __construct($kode_file)
    {
        $this->kode_file = $kode_file;
    }
    
    public function collection(Collection $rows)
    {
        $file_identifier = '';
        // $this->getData($rows);
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
            if ($value[0] !== null) {
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
        // dd($lastColumn);
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
        $kode_file = $row[5][1];
        return decrypt($kode_file);
    }
    
    public function saveData($rows){
        $data = $this->getData($rows);
        
        $this->update($data);
    }
    
    public function update(array $data)
    {
        $periode_aktive = Periode::where('status','aktif')->value('id');
        foreach ($data as $key => $value) {
            $model = SubKelas::where('id',$value[0])->where('periode_id',$periode_aktive)->first();
            $model->catatan_sub_kelas = $value[2];
            // dump($model);
            $model->save();
        }
        // dd('selesai');
        return $model;
    }
}