<?php

namespace App\Exports;

use App\Models\Doa1;
use App\Models\SiswaDoa;
use App\Models\Periode;
use App\Models\SubKelas;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Protection;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SiswaDoaExport implements FromCollection, ShouldAutoSize, WithHeadings, WithStyles
{
    /**
    * @return \Illuminate\Support\Collection
    */

    private $row_lenght, $doa_column_length, $sub_kelas_id = 1;

    public function __construct($sub_kelas_id)
    {
        $this->sub_kelas_id = $sub_kelas_id;
    }

    public function collection()
    {
        // return SiswaDoa::all();
        $periode = Periode::where('status','aktif')->first();
        $sub_kelas_id = $this->sub_kelas_id;

        $siswa_d = SiswaDoa::with('siswa','doa_1','penilaian_huruf_angka')->where('periode_id',$periode->id)->whereHas('siswa', function ($query) use ($sub_kelas_id) {
            $query->where('sub_kelas_id', $sub_kelas_id);
        })->get();

        $this->row_lenght = count($siswa_d);

        $modified_siswa_d = $siswa_d->groupBy(['siswa_id'])->map(function ($item) {
            $result = [];
            $result['siswa_id'] = $item[0]->siswa_id;
            $result['nama_siswa'] = $item[0]->siswa->nama_siswa;
            $result['nisn'] = $item[0]->siswa->nisn;
            foreach ($item as $doa_siswa) {
                $result[$doa_siswa->doa_1->nama_nilai] = $doa_siswa->penilaian_huruf_angka->nilai_angka;
            }
            return $result;
        });

        //column name
        $column_name = [];
        $column_name['siswa_id'] = 'ID data';
        $column_name['nama_siswa'] = 'Nama Siswa';
        $column_name['nisn'] = 'NISN';
        foreach ($siswa_d as $doa_siswa) {
            $column_name[$doa_siswa->doa_1->nama_nilai] = $doa_siswa->doa_1->nama_nilai;
        }

        $collection = collect([$column_name]);
        foreach ($modified_siswa_d as $siswa) {
            $collection->push($siswa);
        }

        return $collection;
    }

    public function headings(): array
    {

        $title = 'Data Siswa Doa';
        $tahun_ajaran = 'Tahun Ajaran 2020/2021';
        $semester = 'Semester 1';
        $tanggal = 'Tanggal '.date('d-m-Y');
        $guru = 'Guru BK';

        $kelas_id = SubKelas::where('id', $this->sub_kelas_id)->first()->kelas_id;

        $header = [
            'ID',
            'Nama Siswa',
            'NISN',
            'DOA',
            '', // Empty column for space for merge
            '', // Empty column for space for merge
            '', // Empty column for space for merge
        ];

        $periode = Periode::where('status','aktif')->first();

        $data_doa = Doa1::where('kelas_id', $kelas_id)->where('periode_id', $periode->id)->get();
        $this->doa_column_length = count($data_doa);

        return [
            [$title, $tahun_ajaran, $semester, $tanggal, $guru],
            $header,
        ];
    }

    public function styles(Worksheet $sheet)
    {

        // Enable worksheet protection
        $sheet->getParent()->getActiveSheet()->getProtection()->setSheet(true);

        // Merge Cells for title
        $sheet->mergeCells('A1:G1');

        // Merge Cells for header
        $sheet->mergeCells('A2:A3'); // siswa_id
        $sheet->mergeCells('B2:B3'); // nama_siswa
        $sheet->mergeCells('C2:C3'); // nisn
        $sheet->mergeCells('D2:'.$this->getColumnIndex($this->doa_column_length + 3).'2'); // Doa

        // Set alignment for title
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getAlignment()->setVertical('center');

        // Set alignment for header
        $sheet->getStyle('A2:'.$this->getColumnIndex($this->doa_column_length + 3).'2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2:'.$this->getColumnIndex($this->doa_column_length + 3).'2')->getAlignment()->setVertical('center');

        // Unprotect a nilai column and rows
        $sheet->getStyle('D4:'.$this->getColumnIndex($this->doa_column_length + 3).($this->row_lenght + 3))->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);


        

    }

    private function getColumnIndex($index)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($index);
    }



}
