<?php

namespace App\Exports;

use App\Models\Siswa;
use App\Models\Periode;
use App\Models\SubKelas;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class SiswaExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $row_lenght, $column_length;
    private $sub_kelas_id;
    private $judul;
    private $tingkat_kelas;
    private $nama_sub_kelas;
    private $wali_kelas;
    private $tahun_ajaran;
    private $semester;
    private $tanggal;
    private $file_identifier;


    public function __construct($sub_kelas_id, $informasi)
    {
        $this->sub_kelas_id = $sub_kelas_id;
        $this->judul = $informasi['judul'];
        $this->tingkat_kelas = $informasi['tingkat_kelas'];
        $this->nama_sub_kelas = $informasi['nama_sub_kelas'];
        $this->wali_kelas = $informasi['wali_kelas'];
        $this->tahun_ajaran = $informasi['tahun_ajaran'];
        $this->semester = $informasi['semester'];
        $this->tanggal = $informasi['tanggal'];
        $this->file_identifier = $informasi['file_identifier'];
    }

    public function view(): View
    {
        $periode = Periode::where('status','aktif')->first();
        $sub_kelas_id = $this->sub_kelas_id;

        $siswa_d = Siswa::with('sub_kelas', 'periode')->where('sub_kelas_id', $sub_kelas_id)->get();
        
        $nilai_id = [];
        $modified_siswa_d = $siswa_d->groupBy(['siswa_id'])->map(function ($item) use (&$nilai_id) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->nama_siswa;
            $result['nisn'] = $item[0]->nisn;
            $result['orangtua_wali'] = $item[0]->orangtua_wali;
        });

        $this->row_lenght = count($siswa_d) + 51;

        return view('dataSiswa.export_excel', [
            'siswa_d' => $siswa_d,
            'siswa_modified' => $modified_siswa_d,
            'judul' => $this->judul,
            'tingkat_kelas' => $this->tingkat_kelas,
            'nama_sub_kelas' => $this->nama_sub_kelas,
            'wali_kelas' => $this->wali_kelas,
            'tahun_ajaran' => $this->tahun_ajaran,
            'semester' => $this->semester,
            'tanggal' => $this->tanggal,
            'file_identifier' => $this->file_identifier,
            'nilai_id' => $nilai_id,
        ]);
    }

    //style overflow column
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getStyle('A11:D11')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A11:D11')->getAlignment()->setVertical('center');
        $sheet->getStyle('A11:D11')->getFont()->setBold(true);
        // Add border to range
        $sheet->getStyle('A11:' . $this->getColumnIndex(4) . $this->row_lenght + 10)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        //Unprotect nilai cell
        $sheet->getStyle('B12:' . $this->getColumnIndex(4) . $this->row_lenght + 11)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);

        // format nisn
        $sheet->getStyle('C')->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_TEXT);

        // prompt id column
        $startCellA = 'A12'; // Starting cell for validation
        $endCellA = $this->getColumnIndex(1) . ($this->row_lenght + 8); // Ending cell for validation
        $validationRangeA = $startCellA . ':' . $endCellA;
        $validationA = $sheet->getCell($startCellA)->getDataValidation();
        $validationA->setType(DataValidation::TYPE_WHOLE);
        $validationA->setShowInputMessage(true);
        $validationA->setPromptTitle('ID Jangan Diubah');
        $validationA->setPrompt('ID akan dibuat otomatis oleh sistem');
        $sheet->setDataValidation($validationRangeA, $validationA);
        // // prompt nama
        // $startCellB = 'B12'; // Starting cell for validation
        // $endCellC = $this->getColumnIndex(2) . ($this->row_lenght + 8); // Ending cell for validation
        // $validationRangeB = $startCellB . ':' . $endCellB;
        // $validationB = $sheet->getCell($startCellB)->getDataValidation();
        // $validationB->setType(DataValidation::TYPE_WHOLE);
        // $validationB->setShowInputMessage(true);
        // $validationB->setPromptTitle('Masukkan Nama Siswa');
        // $validationB->setPrompt('Nama siswa tidak boleh kosong');
        // $sheet->setDataValidation($validationRangeB, $validationB); 
        // // prompt nisn
        // $startCellC = 'C12'; // Starting cell for validation
        // $endCellC = $this->getColumnIndex(3) . ($this->row_lenght + 8); // Ending cell for validation
        // $validationRangeC = $startCellC . ':' . $endCellC;
        // $validationC = $sheet->getCell($startCellC)->getDataValidation();
        // $validationC->setType(DataValidation::TYPE_WHOLE);
        // $validationC->setShowInputMessage(true);
        // $validationC->setPromptTitle('Masukkan NISN');
        // $validationC->setPrompt('NISN harus unik dan tidak boleh kosong');
        // $sheet->setDataValidation($validationRangeC, $validationC); 

    }

    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }


}
