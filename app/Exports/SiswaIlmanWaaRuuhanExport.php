<?php

namespace App\Exports;

use App\Models\IlmanWaaRuuhan;
use App\Models\SiswaIlmanWaaRuuhan;
use App\Models\Periode;
use App\Models\SubKelas;



use Maatwebsite\Excel\Concerns\WithMultipleSheets;

use App\Exports\Sheets\SiswaIlmanWaaRuuhanSheet;

class SiswaIlmanWaaRuuhanExport implements WithMultipleSheets
{
    /**
    * @return \Illuminate\Support\View
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

    public function __construct($sub_kelas_id, $informasi)
    {
        $this->sub_kelas_id = $sub_kelas_id;
        $this->judul = $informasi['judul'];
        $this->nama_kelas = $informasi['nama_kelas'];
        $this->wali_kelas = $informasi['wali_kelas'];
        $this->tahun_ajaran = $informasi['tahun_ajaran'];
        $this->semester = $informasi['semester'];
        $this->tanggal = $informasi['tanggal'];
        $this->file_identifier = $informasi['file_identifier'];
        $this->nama_mapel = "Ilman Waa Ruuhan";
    }

    public function sheets(): array
    {

        $periode = Periode::where('status','aktif')->first();
        $sub_kelas_id = $this->sub_kelas_id;
        $kelas_id = SubKelas::where('id', $sub_kelas_id)->first()->kelas_id;
        $data_mapel = IlmanWaaRuuhan::where('kelas_id', $kelas_id)->where('periode_id', $periode->id)->get();

        $informasi = [
            'judul' => $this->judul,
            'nama_kelas' => $this->nama_kelas,
            'wali_kelas' => $this->wali_kelas,
            'tahun_ajaran' => $this->tahun_ajaran,
            'semester' => $this->semester,
            'tanggal' => $this->tanggal,
            'file_identifier' => $this->file_identifier,
        ];

        $sheets = [];
        foreach ($data_mapel as $mapel) {
            $informasi['nama_mapel'] = $mapel->pencapaian;
            $sheets[] = new SiswaIlmanWaaRuuhanSheet($sub_kelas_id, $informasi, $mapel->id);
        }

        return $sheets;
    }
}
