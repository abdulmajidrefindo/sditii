<?php

namespace App\Exports;

use App\Models\Kelas;
use App\Models\SubKelas;
use App\Models\User;
use App\Models\UserRoles;
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

class CatatanExport implements FromView, WithStyles
{
    private $row_lenght, $column_length;
    private $judul;
    private $tahun_ajaran;
    private $semester;
    private $tanggal;
    private $file_identifier;
    
    
    public function __construct($informasi)
    {
        $this->judul = $informasi['judul'];
        $this->tahun_ajaran = $informasi['tahun_ajaran'];
        $this->semester = $informasi['semester'];
        $this->tanggal = $informasi['tanggal'];
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
            $result['catatan_sub_kelas'] = $item[0]->catatan_sub_kelas;
            $result['tingkat_kelas'] = Kelas::where('id', $item[0]->kelas_id)->value('nama_kelas');
            // $user_id = Guru::where('id', $item[0]->guru_id)->value('user_id');
            // $result['guru'] = User::where('id', $user_id)->value('user_name');
            return $result;
        });
        
        $this->row_lenght = count($modified_kelas_d);
        
        return view('dataKelas.export_catatan', [
            'kelas_d' => $modified_kelas_d,
            'judul' => $this->judul,
            'tahun_ajaran' => $this->tahun_ajaran,
            'semester' => $this->semester,
            'tanggal' => $this->tanggal,
            'file_identifier' => $this->file_identifier,
        ]);
    }
    
    //style overflow column
    public function styles(Worksheet $sheet)
    {
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getStyle('A8:B8')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A8:B8')->getAlignment()->setVertical('center');
        $sheet->getStyle('B6')->getAlignment()->setWrapText(true);
        $sheet->getStyle('A8:B8')->getFont()->setBold(true);
        // Add border to range
        $sheet->getStyle('A8:' . $this->getColumnIndex(2) . $this->row_lenght + 8)->getBorders()->getAllBorders()->setBorderStyle('thin');
        
        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);
        //Unprotect nilai cell
        $sheet->getStyle('B9:' . $this->getColumnIndex(2) . $this->row_lenght + 8)->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);
        
    }
    
    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }
    
    
}
