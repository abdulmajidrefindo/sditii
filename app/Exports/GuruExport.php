<?php

namespace App\Exports;

use App\Models\Guru;
use App\Models\User;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class GuruExport implements FromView, WithStyles
{   
    private $row_lenght, $column_length;
    private $judul;
    private $tanggal;
    private $file_identifier;
    
    
    public function __construct($informasi)
    {
        $this->judul = $informasi['judul'];
        $this->tanggal = $informasi['tanggal'];
        $this->file_identifier = $informasi['file_identifier'];
    }
    
    public function view(): View
    {
        $guru_d = Guru::all();
        
        $nilai_id = [];
        $modified_guru_d = $guru_d->groupBy(['id'])->map(function ($item) use (&$nilai_id) {
            $result = [];
            $result['id'] = $item[0]->id;
            $result['user'] = User::where('id', $item[0]->id)->value('name');
            $result['nip'] = $item[0]->nip;
            return $result;
        });
        
        $this->row_lenght = count($modified_guru_d) + 51;
        
        return view('dataGuru.export_excel', [
            'guru_d' => $modified_guru_d,
            'judul' => $this->judul,
            'tanggal' => $this->tanggal,
            'file_identifier' => $this->file_identifier,
        ]);
    }
    
    //style overflow column
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getStyle('A6:C6')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A6:C6')->getAlignment()->setVertical('center');
        $sheet->getStyle('A6:C6')->getFont()->setBold(true);
        // Add border to range
        $sheet->getStyle('A6:' . $this->getColumnIndex(3) . $this->row_lenght + 6)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        //Unprotect nilai cell
        $sheet->getStyle('B7:' . $this->getColumnIndex(3) . $this->row_lenght + 6)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
        
        // prompt id column
        $startCellA = 'A7'; // Starting cell for validation
        $endCellA = $this->getColumnIndex(1) . ($this->row_lenght + 6); // Ending cell for validation
        $validationRangeA = $startCellA . ':' . $endCellA;
        $validationA = $sheet->getCell($startCellA)->getDataValidation();
        $validationA->setType(DataValidation::TYPE_WHOLE);
        $validationA->setShowInputMessage(true);
        $validationA->setPromptTitle('ID Jangan Diubah');
        $validationA->setPrompt('ID akan dibuat otomatis oleh sistem');
        $sheet->setDataValidation($validationRangeA, $validationA);
        
        //validation rule for nilai cell as integer between 0-100 and not empty only
        $startCell = 'B7'; // Starting cell for validation
        $endCell = $this->getColumnIndex(2) . ($this->row_lenght + 6); // Ending cell for validation
        $validationRange = $startCell . ':' . $endCell;
        $validation = $sheet->getCell($startCell)->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Nama guru tidak valid');
        $validation->setError('Guru harus dipilih dari User yang sudah ada. Jika belum ada, silakan buat User terlebih dahulu di menu Data User!');
        $validation->setPromptTitle('Nama Guru');
        $validation->setPrompt('Pilih dari User yang ada');
        $names = User::pluck('name')->toArray();
        $validation->setFormula1('"' . implode(',', $names) . '"');
        $sheet->setDataValidation($validationRange, $validation);
    }
    
    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }
    
    
}
