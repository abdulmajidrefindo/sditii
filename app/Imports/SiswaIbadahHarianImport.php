<?php

namespace App\Imports;

use Illuminate\Support\Collection;

use App\Models\SiswaIbadahHarian;
use App\Models\PenilaianDeskripsi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class SiswaIbadahHarianImport implements ToCollection
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

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
            if ($value != null) {
                $lastRow = $key;
            }
        }
        return $lastRow-3; // Potong 2 baris terakhir, 1 baris kosong, 1 baris kode_file.
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
        return $firstRow+2; // Lompati baris pertama yang berisi merged row 'ID' header.
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

    public function getNilaiId($rows)
    {
        $lastRow = $this->getLastRowIndex($rows)+1; // Tambah 1 baris, kode nilai ada di akhir tabel data.
        
        $nilai_id = $rows[$lastRow]->toArray(); // Nilai ID ada di baris terakhir dari table data
        $nilai_id = array_slice($nilai_id, 3); // Potong 3 kolom pertama (ID, Nama, NISN)

        return $nilai_id;
    }

    public function getData($rows)
    {
        $firstRow = $this->getFirstRowIndex($rows);
        $lastRow = $this->getLastRowIndex($rows);
        $lastColumn = $this->getLastColumnIndex($rows);

        $data = [];
        for ($i=$firstRow; $i <= $lastRow; $i++) { 
            $data[$i] = $rows[$i]->toArray();
        }

        return $data;
    }

    public function getKodeFile($rows)
    {
        $lastRow = $this->getLastRowIndex($rows)+3; // Tambah 3 baris, kode file ada di baris terakhir dari table data.
        $kode_file = $rows[$lastRow][1]; // Kode file ada di baris terakhir dari table data, kolom kedua.
        return decrypt($kode_file);
    }

    public function updateOrCreate(array $condition, array $data)
    {
        $model = SiswaIbadahHarian::where($condition)->first();
        if (!$model) {
            //$model = new SiswaIbadahHarian();
            return;
        }
        $nilai = $this->PenilaianDeskripsiId($data['penilaian_deskripsi_id']); // Ambil ID penilaian_deskripsi berdasar keterangan.
        $model->penilaian_deskripsi_id = $nilai;
        $model->save();
        return $model;
    }

    public function saveData($rows){
        $nilai_id = $this->getNilaiId($rows);
        $data = $this->getData($rows);

        foreach ($data as $key => $value) {
            $siswa_id = $value[0];
            foreach ($nilai_id as $key => $id) {
                $this->updateOrCreate([
                    'siswa_id' => $siswa_id,
                    'ibadah_harian_1_id' => $id,
                ], [
                    'penilaian_deskripsi_id' => $value[$key+3], // Lompati 3 kolom pertama (ID, Nama, NISN) lalu ambil nilai berdasar index nilai_id.
                ]);
            }
        }
    }

    public function PenilaianDeskripsiId($value)
    {
        try {
            $penilaian_deskripsi_id = PenilaianDeskripsi::where('deskripsi', $value)->first()->id;
            return $penilaian_deskripsi_id;
        } catch (\Throwable $th) {
            return 5;
        }
    }
}
