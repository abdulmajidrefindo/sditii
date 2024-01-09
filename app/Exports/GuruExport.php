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
        $guru_d = Guru::all();
        
        $nilai_id = [];
        $modified_guru_d = $guru_d->groupBy(['id'])->map(function ($item) use (&$nilai_id) {
            $result = [];
            $result['id'] = $item[0]->id;
            $result['nama_guru'] = $item[0]->nama_guru;
            $result['nip'] = $item[0]->nip;
            $result['user'] = User::where('id', $item[0]->id)->value('name');
            return $result;
        });
        
        $this->row_lenght = count($modified_guru_d) + 51;
        
        return view('dataGuru.export_excel', [
            'guru_d' => $modified_guru_d,
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
        
        //Set D11 to getColumnIndex($this->column_length + 3) . ($this->row_lenght + 10) as dropdown list
        
        
        //validation rule for nilai cell as integer between 0-100 and not empty only
        $startCell = 'D4'; // Starting cell for validation
        $endCell = $this->getColumnIndex(4) . ($this->row_lenght + 3); // Ending cell for validation
        $validationRange = $startCell . ':' . $endCell;
        $validation = $sheet->getCell($startCell)->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Akun user tidak valid');
        $validation->setError('Akun user harus dipilih dari yang sudah ada. Jika belum ada, silakan buat terlebih dahulu di menu Data User!');
        // $validation->setPromptTitle('Pilih akun user');
        $validation->setPrompt('Pilih akun user');
        $names = User::pluck('name')->toArray();
        $validation->setFormula1('"' . implode(',', $names) . '"');
        $sheet->setDataValidation($validationRange, $validation);
        
        //A2-A6 Auto width cell
        // $sheet->getColumnDimension('A')->setAutoSize(true);
        
    }
    
    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }
    
    
}
