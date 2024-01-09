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
    
    private $row_lenght, $column_length;
    private $sub_kelas_id;
    private $judul;
    private $nama_kelas;
    private $wali_kelas;
    private $tahun_ajaran;
    private $semester;
    private $tanggal;
    private $file_identifier;
    
    
    public function __construct($informasi)
    {
        $this->judul = $informasi['judul'];
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
            'file_identifier' => $this->file_identifier,
        ]);
    }
    
    //style overflow column
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getStyle('E4:'. $this->getColumnIndex(5) . $this->row_lenght + 3)->getAlignment()->setHorizontal('fill');
        $sheet->getStyle('A3:F3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:F3')->getAlignment()->setVertical('center');
        // $sheet->getStyle('E4:'. $this->getColumnIndex(5) . $this->row_lenght + 3)->getAlignment()->setShrinkToFit(true);
        $sheet->getStyle('A3:F3')->getFont()->setBold(true);
        // Add border to range
        $sheet->getStyle('A3:' . $this->getColumnIndex(6) . $this->row_lenght + 3)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        //Unprotect nilai cell
        $sheet->getStyle('B4:' . $this->getColumnIndex(6) . $this->row_lenght + 3)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
        
        //Set D11 to getColumnIndex($this->column_length + 3) . ($this->row_lenght + 10) as dropdown list
        
        
        //validation rule for nilai cell as integer between 0-100 and not empty only
        $startCell = 'F4'; // Starting cell for validation
        $endCell = $this->getColumnIndex(6) . ($this->row_lenght + 3); // Ending cell for validation
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
        
        //A2-A6 Auto width cell
        // $sheet->getColumnDimension('A')->setAutoSize(true);
        
    }
    
    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }
    
    
}
