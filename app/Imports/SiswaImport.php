<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

use App\Models\Siswa;
use App\Models\PenilaianDeskripsi;
use App\Models\Periode;
use App\Models\SubKelas;
use App\Http\Controllers\SiswaController;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithUpserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;

class SiswaImport implements ToCollection
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
    
    // function debug_to_console($data) {
        //     $output = $data;
        //     if (is_array($output))
        //         $output = implode(',', $output);
        
        //     echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
        // }
        
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
                $pesan = $this->getKodeFile($rows);
                $this->errorFlag = true;
                $this->message = $pesan;
            }
            
            if (!$this->errorFlag) {
                try {
                    $this->getData($rows);
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
            return $firstRow+1; // Lompati baris pertama yang berisi merged row 'ID' header.
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
        
        // public function getNilaiId($rows)
        // {
            //     $lastRow = $this->getLastRowIndex($rows)+1; // Tambah 1 baris, kode nilai ada di akhir tabel data.
            
            //     $nilai_id = $rows[$lastRow]->toArray(); // Nilai ID ada di baris terakhir dari table data
            //     $nilai_id = array_slice($nilai_id, 3); // Potong 3 kolom pertama (ID, Nama, NISN)
            
            //     return $nilai_id;
            // }
            
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
                $firstRow = $this->getFirstRowIndex($rows); // Kurang 2 baris, kode file ada di baris tersebut.
                $kode_file = $rows[$firstRow][5];
                return $kode_file;
            }
            
            public function getKelas($rows)
            {
                // $firstRow = $this->getFirstRowIndex($rows)-7; // Kurang 2 baris, kode file ada di baris tersebut.
                $nama_sub_kelas = $rows[4][1]; // Kode file ada di kolom kedua.
                $sub_kelas_id = SubKelas::where('nama_sub_kelas',$nama_sub_kelas)->get();
                return  $sub_kelas_id;
            }
            
            public function updateOrCreate(array $condition, array $data, $rows)
            {
                $sub_kelas_id = $this->getKelas($rows)->id;
                $periode = Periode::where('status','aktif')->first();
                DB::table('siswas')->updateOrInsert(
                    ['id' => $data['id']],
                    ['nisn' => $data['nisn'],
                    'nama_siswa' => $data['nama_siswa'],
                    'orangtua_wali' => $data['orangtua_wali']->nullable(),
                    'created_at' => now(),
                    'updated_at' => now(),
                    'sub_kelas_id' => $sub_kelas_id,
                    'periode_id' => $periode,
                    'rapor_siswa_id' => 1,]
                );
            }
            
            // public function saveData($rows){
                //     $nilai_id = $this->getNilaiId($rows);
                //     $data = $this->getData($rows);
                
                //     foreach ($data as $key => $value) {
                    //         $siswa_id = $value[0];
                    //         foreach ($nilai_id as $key => $id) {
                        
                        //         }
                        //     }
                        // }
                        
                        // public function PenilaianDeskripsiId($value)
                        // {
                            //     try {
                                //         $penilaian_deskripsi_id = PenilaianDeskripsi::where('deskripsi', $value)->first()->id;
                                //         return $penilaian_deskripsi_id;
                                //     } catch (\Throwable $th) {
                                    //         return 5;
                                    //     }
                                    // }
                                }
                                