<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\User;
use App\Models\Guru;
use App\Models\Periode;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class KelasExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    private $row_lenght, $column_length;
    private $judul;
    private $file_identifier;
    
    
    public function __construct($informasi)
    {
        $this->judul = $informasi['judul'];
        $this->file_identifier = $informasi['file_identifier'];
    }
    
    public function view(): View
    {
        $periode_id = Periode::where('status','aktif')->value('id');
        $kelas_d = SubKelas::all()->where('periode_id',$periode_id);
        
        $nilai_id = [];
        $modified_kelas_d = $kelas_d->groupBy(['id'])->map(function ($item) use (&$nilai_id) {
            $result = [];
            $result['id'] = $item[0]->id;
            $result['nama_sub_kelas'] = $item[0]->nama_sub_kelas;
            $result['tingkat_kelas'] = Kelas::where('id', $item[0]->kelas_id)->value('nama_kelas');
            $result['guru'] = Guru::where('id', $item[0]->guru_id)->value('nama_guru');
            return $result;
        });
        
        $this->row_lenght = count($modified_kelas_d) + 51;
        
        return view('dataKelas.export_excel', [
            'kelas_d' => $modified_kelas_d,
            'judul' => $this->judul,
            'file_identifier' => $this->file_identifier,
        ]);
    }
    
    //style overflow column
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getStyle('A3:D3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:D3')->getAlignment()->setVertical('center');
        // $sheet->getStyle('E4:'. $this->getColumnIndex(5) . $this->row_lenght + 3)->getAlignment()->setShrinkToFit(true);
        $sheet->getStyle('A3:D3')->getFont()->setBold(true);
        // Add border to range
        $sheet->getStyle('A3:' . $this->getColumnIndex(4) . $this->row_lenght + 3)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        //Unprotect nilai cell
        $sheet->getStyle('B4:' . $this->getColumnIndex(4) . $this->row_lenght + 3)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
        
        // prompt id column
        $startCellA = 'A4'; // Starting cell for validation
        $endCellA = $this->getColumnIndex(1) . ($this->row_lenght + 3); // Ending cell for validation
        $validationRangeA = $startCellA . ':' . $endCellA;
        $validationA = $sheet->getCell($startCellA)->getDataValidation();
        $validationA->setType(DataValidation::TYPE_WHOLE);
        $validationA->setShowInputMessage(true);
        $validationA->setPromptTitle('ID Jangan Diubah');
        $validationA->setPrompt('ID akan dibuat otomatis oleh sistem');
        $sheet->setDataValidation($validationRangeA, $validationA);
        
        // Validation rule for column B
        $startCellB = 'B4'; // Starting cell for validation
        $endCellB = $this->getColumnIndex(2) . ($this->row_lenght + 3); // Ending cell for validation
        $validationRangeB = $startCellB . ':' . $endCellB;
        $validationB = $sheet->getCell($startCellB)->getDataValidation();
        $validationB->setType(DataValidation::TYPE_LIST);
        $validationB->setAllowBlank(false);
        $validationB->setShowInputMessage(true);
        $validationB->setShowErrorMessage(true);
        $validationB->setShowDropDown(true);
        $validationB->setErrorTitle('Tingkat kelas tidak valid');
        $validationB->setError('Tingkat kelas harus dipilih dari yang sudah ada!');
        $validationB->setPrompt('Pilih tingkat kelas');
        $validationB->setFormula1('"Kelas 1,Kelas 2,Kelas 3,Kelas 4,Kelas 5,Kelas 6"');
        $sheet->setDataValidation($validationRangeB, $validationB);
        
        // Validation rule for column D
        $startCellD = 'D4'; // Starting cell for validation
        $endCellD = $this->getColumnIndex(4) . ($this->row_lenght + 3); // Ending cell for validation
        $validationRangeD = $startCellD . ':' . $endCellD;
        $validationD = $sheet->getCell($startCellD)->getDataValidation();
        $validationD->setType(DataValidation::TYPE_LIST);
        $validationD->setAllowBlank(true);
        $validationD->setShowInputMessage(true);
        $validationD->setShowErrorMessage(true);
        $validationD->setShowDropDown(true);
        $validationD->setErrorTitle('Wali Kelas tidak valid');
        $validationD->setError('Wali Kelas harus dipilih dari guru yang sudah ada. Jika belum ada, silakan buat terlebih dahulu di menu Data Guru!');
        $validationD->setPrompt('Pilih wali kelas dari guru-guru berikut');
        $list_guru = Guru::pluck('nama_guru')->toArray();
        $validationD->setFormula1('"' . implode(',', $list_guru) . '"');
        $sheet->setDataValidation($validationRangeD, $validationD);
        
        //A2-A6 Auto width cell
        // $sheet->getColumnDimension('A')->setAutoSize(true);
        
    }
    
    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }
    
    
}
