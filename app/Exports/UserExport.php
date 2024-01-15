<?php

namespace App\Exports;

use App\Models\User;
use App\Models\UserRoles;
use App\Models\Roles;

use Illuminate\Contracts\View\View;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithStyles;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Cell\DataValidation;

class UserExport implements FromView, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    private $row_lenght;
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
        $user_d = User::with('role')->get();
        
        $nilai_id = [];
        $modified_user_d = $user_d->groupBy(['id'])->map(function ($item) use (&$nilai_id) {
            $result = [];
            $result['id'] = $item[0]->id;
            $result['name'] = $item[0]->name;
            $result['user_name'] = $item[0]->user_name; 
            $result['email'] = $item[0]->email;
            $result['password'] = $item[0]->password;
            $result['role'] = UserRoles::where('user_id', $item[0]->id)->value('role_id');
            return $result;
        });
        
        $this->row_lenght = count($modified_user_d) + 51;
        
        return view('dataUser.export_excel', [
            'user_d' => $modified_user_d,
            'judul' => $this->judul,
            'tanggal' => $this->tanggal,
            'file_identifier' => $this->file_identifier,
        ]);
    }
    
    //style overflow column
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getStyle('E7:'. $this->getColumnIndex(5) . $this->row_lenght + 6)->getAlignment()->setHorizontal('fill');
        $sheet->getStyle('A6:F6')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A6:F6')->getAlignment()->setVertical('center');
        // $sheet->getStyle('E6:'. $this->getColumnIndex(7) . $this->row_lenght + 6)->getAlignment()->setShrinkToFit(true);
        $sheet->getStyle('A6:F6')->getFont()->setBold(true);
        // Add border to range
        $sheet->getStyle('A6:' . $this->getColumnIndex(6) . $this->row_lenght + 6)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        //Unprotect nilai cell
        $sheet->getStyle('B7:' . $this->getColumnIndex(6) . $this->row_lenght + 6)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
        
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
        
        // Validation rule for email format in the cell
        $startRow = 7; // Starting row for validation
        $startCell = 'C' . $startRow; // Starting cell for validation
        $endCell = $this->getColumnIndex(3) . ($this->row_lenght + 6); // Ending cell for validation
        $validationRangeC = $startCell . ':' . $endCell;
        $validationC = $sheet->getCell($startCell)->getDataValidation();
        $validationC->setType(DataValidation::TYPE_CUSTOM);
        $validationC->setAllowBlank(false);
        $validationC->setShowInputMessage(true);
        $validationC->setShowErrorMessage(true);
        $validationC->setShowDropDown(true);
        $validationC->setErrorTitle('Format Email tidak valid');
        $validationC->setError('Masukkan alamat email yang valid');
        $validationC->setPromptTitle('Alamat email');
        $validationC->setPrompt('Masukkan alamat email yang valid');
        $validationC->setFormula1('ISNUMBER(SEARCH("@",C' . $startRow . '))');
        $sheet->setDataValidation($validationRangeC, $validationC);
        
        //validation rule for nilai cell as integer between 0-100 and not empty only
        $startCell = 'F7'; // Starting cell for validation
        $endCell = $this->getColumnIndex(6) . ($this->row_lenght + 6); // Ending cell for validation
        $validationRange = $startCell . ':' . $endCell;
        $validation = $sheet->getCell($startCell)->getDataValidation();
        $validation->setType(DataValidation::TYPE_LIST);
        $validation->setAllowBlank(false);
        $validation->setShowInputMessage(true);
        $validation->setShowErrorMessage(true);
        $validation->setShowDropDown(true);
        $validation->setErrorTitle('Peran tidak valid');
        $validation->setError('Peran harus Administrator atau Guru');
        $validation->setPromptTitle('Pilih peran');
        $validation->setPrompt('Pilih peran dari daftar:'.PHP_EOL.'Administrator'.PHP_EOL.'Guru');
        $validation->setFormula1('"Administrator,Guru"');
        $sheet->setDataValidation($validationRange, $validation);
    }
    
    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }
    
    
}
