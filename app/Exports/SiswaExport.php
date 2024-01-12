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
            // 'column_length' => $this->column_length,
        ]);
    }

    //style overflow column
    public function styles(Worksheet $sheet)
    {
        // $sheet->getStyle('B1')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A11:D11')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A11:D11')->getAlignment()->setVertical('center');
        // $sheet->getStyle('A11:D11')->getAlignment()->setShrinkToFit(true);
        $sheet->getStyle('A11:D11')->getFont()->setBold(true);
        // Add border to range
        $sheet->getStyle('A11:' . $this->getColumnIndex(4) . $this->row_lenght + 10)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        //Unprotect nilai cell
        $sheet->getStyle('B12:' . $this->getColumnIndex(4) . $this->row_lenght + 11)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);

        //validation rule for nilai cell as integer between 0-100 and not empty only
        $startCell = 'A12'; // Starting cell for validation
        $endCell = $this->getColumnIndex(4) . ($this->row_lenght + 11); // Ending cell for validation
        $validationRange = $startCell . ':' . $endCell;
        $validation = $sheet->getCell($startCell)->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setAllowBlank(true);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(false);
        $validation->setErrorTitle('Data tidak valid');
        $validation->setError('Masukkan Data dengan benar');
        $sheet->setDataValidation($validationRange, $validation);

        

        //A2-A6 Auto width cell
        $sheet->getColumnDimension('A')->setAutoSize(true);

    }

    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }


}
