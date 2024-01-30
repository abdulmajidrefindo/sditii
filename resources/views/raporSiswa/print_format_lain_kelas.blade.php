<html>

<head>
    <title>Rapor {{ $array_print['data_siswa']['0']['sub_kelas']['kelas']['nama_kelas'] . ' ' . $array_print['data_siswa']['0']['sub_kelas']['nama_sub_kelas']}}</title>
    {{-- asset from resources/css/print.css --}}
    <link href="{{ asset('/css/print.css') }}" rel="stylesheet">
    {{-- Bootstrap grid --}}
    <link href="{{ asset('/css/bootstrap-grid.min.css') }}" rel="stylesheet">
    {{-- Bootstrap Reboot --}}
    <link href="{{ asset('/css/bootstrap-reboot.min.css') }}" rel="stylesheet">
    {{-- Bootstrap --}}
    
    <style type="text/css" media="print">
        @page {
            size: auto;   /* auto is the initial value */
            margin: 0;  /* this affects the margin in the printer settings */
        }
        #common {
            page-break-before: always;
        }
    </style>
    
</head>
@php



function formatDate($date) {
    $hari = date('l', strtotime($date));
    $tgl = date('d', strtotime($date));
    $bulan = date('F', strtotime($date));
    $tahun = date('Y', strtotime($date));
    $jam = date('H:i:s', strtotime($date));
    $nama_hari = "";
    if ($hari == "Sunday") {
        $nama_hari = "Minggu";
    } else if ($hari == "Monday") {
        $nama_hari = "Senin";
    } else if ($hari == "Tuesday") {
        $nama_hari = "Selasa";
    } else if ($hari == "Wednesday") {
        $nama_hari = "Rabu";
    } else if ($hari == "Thursday") {
        $nama_hari = "Kamis";
    } else if ($hari == "Friday") {
        $nama_hari = "Jumat";
    } else if ($hari == "Saturday") {
        $nama_hari = "Sabtu";
    }
    if ($bulan == "January") {
        $bulan = "Januari";
    } else if ($bulan == "February") {
        $bulan = "Februari";
    } else if ($bulan == "March") {
        $bulan = "Maret";
    } else if ($bulan == "April") {
        $bulan = "April";
    } else if ($bulan == "May") {
        $bulan = "Mei";
    } else if ($bulan == "June") {
        $bulan = "Juni";
    } else if ($bulan == "July") {
        $bulan = "Juli";
    } else if ($bulan == "August") {
        $bulan = "Agustus";
    } else if ($bulan == "September") {
        $bulan = "September";
    } else if ($bulan == "October") {
        $bulan = "Oktober";
    } else if ($bulan == "November") {
        $bulan = "November";
    } else if ($bulan == "December") {
        $bulan = "Desember";
    }
    return $nama_hari . ', ' . $tgl . ' ' . $bulan . ' ' . $tahun;
}

@endphp
<body>
    @foreach ($array_print['data_siswa'] as $data)
    <div id="common" style="margin-top: 7%">
        <div id="page-khs">
            <table class="header-khs" width="100%" border="0">
                <tr>
                    <td align="center" width="100">
                        <h3>SEKOLAH DASAR ISLAM TERPADU (SDIT)</h3>
                    </td>
                </tr>
                <tr>
                    <td align="center" width="100">
                        <h1>{{$data['0']['profil_sekolah']['nama_sekolah']}}</h1>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                        <span align="center"><span style="font-weight: normal;">{{$data['0']['profil_sekolah']['alamat_sekolah']}}</span>
                    </td>
                </table>
                <hr style="border-width: 2px; border-color: black; font-weight: bold;" />
                
                
                <table class="table-keterangan">
                    <tr>
                        <td width="150">Nama Siswa</td>
                        <td>:</td>
                        <td width="200">{{ $data['nama_siswa'] }}</td>
                        <td width="50"></td>
                        <td width="150"> Tahun Ajaran</td>
                        <td>:</td>
                        <td>{{ $data['0']['periode']['tahun_ajaran'] }}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>:</td>
                        <td>{{ $data['sub_kelas']['kelas']['nama_kelas'] . ' ' . $data['sub_kelas']['nama_sub_kelas'] }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td>Semester</td>
                        <td>:</td>
                        <td>{{ $data['0']['periode']['semester'] }} ({{ $data['0']['periode']['semester'] == 1 ? 'Ganjil' : 'Genap' }})</td>
                        <td></td>
                        <td>NISN</td>
                        <td>:</td>
                        <td>{{ $data['nisn'] }}</td>
                    </tr>
                </table>
                
                <table width="100%" class="table-khs">
                    
                    <thead>
                        <tr>
                            <tr colspan="9" style="text-align: left; border-top: none;"> <b>A. ILMAN WAA RUUHAN</b></tr>
                        </tr>
                        <tr>
                            <th>Pencapaian</th>
                            <th>Jilid/Surah</th>
                            <th>Halaman/Ayat</th>
                            <th>Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data['0']['data_iwr'] as $n)
                        <tr>
                            <td>{{ $n->ilman_waa_ruuhan->pencapaian }}</td>
                            @if ($n->jilid == 101)
                            <td>0</td>
                            @else
                            <td>{{ $n->jilid }}</td>
                            @endif
                            @if ($n->halaman == 101)
                            <td>0</td>
                            @else
                            <td>{{ $n->halaman }}</td>
                            @endif
                            <td>{{ $n->penilaian_huruf_angka->nilai_angka }} ({{ $n->penilaian_huruf_angka->nilai_huruf }})</td>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <br />
            
            
            <table style="border: none;" width="100%">
                <tr>
                    {{-- Ibadah Harian, tahfidz Left Half --}}
                    <td width="50%" style="vertical-align: top;">
                        <table class="table-khs" width="100%" style="border: none;">
                            <thead>
                                <tr>
                                    <tr colspan="3" style="text-align: left; border-top: none;"> <span style="font-size: 11px; font-weight: bold;">B. IBADAH HARIAN</span></tr>
                                </tr>
                                <tr>
                                    <th>No</th>
                                    <th>Kriteria</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['0']['data_ih'] as $n)
                                <tr>
                                    <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                    <td>{{ $n->ibadah_harian_1->nama_kriteria }}</td>
                                    <td class="text-center">{{ $n->penilaian_deskripsi->deskripsi }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        <br />
                        
                        <table class="table-khs" style="border: none;" width="100%">
                            <thead>
                                <tr>
                                    <tr colspan="4" style="text-align: left; border-top: none;"> <span style="font-size: 11px; font-weight: bold;">C. TAHFIDZ</span></tr>
                                </tr>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Surat</th>
                                    <th colspan="2">Nilai</th>
                                </tr>
                                <tr>
                                    <th>Angka</th>
                                    <th>Huruf</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data['0']['data_t'] as $n)
                                <tr>
                                    <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                    <td>{{ $n->tahfidz_1->nama_nilai }}</td>
                                    <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_angka }}</td>
                                    <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_huruf }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                        
                    </td>
                    {{-- Ibadah Hadist, Doa Right Half --}}
                    <td width="50%" style="vertical-align: top;">
                        <table class="table-khs" style="border: none;" width="100%">
                            <thead>
                                <tr>
                                    <tr colspan="3" style="text-align: left; border-top: none;"> <span style="font-size: 11px; font-weight: bold;">D. HADIST</span></tr>
                                </th>
                            </tr>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Hadist</th>
                                <th colspan="2">Nilai</th>
                            </tr>
                            <tr>
                                <th>Angka</th>
                                <th>Huruf</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['0']['data_h'] as $n)
                            <tr>
                                <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                <td>{{ $n->hadist_1->nama_nilai }}</td>
                                <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_angka }}</td>
                                <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_huruf }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    
                    <br />
                    
                    <table class="table-khs" style="border: none;" width="100%">
                        <thead>
                            <tr>
                                <tr colspan="3" style="text-align: left; border-top: none;"> <span style="font-size: 11px; font-weight: bold;">E. DOA</span></tr>
                            </tr>
                            <tr>
                                <th rowspan="2">No</th>
                                <th rowspan="2">Nama</th>
                                <th colspan="2">Nilai</th>
                            </tr>
                            <tr>
                                <th>Angka</th>
                                <th>Huruf</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data['0']['data_d'] as $n)
                            <tr>
                                <td class="text-center pr-4">{{ $loop->iteration }}</td>
                                <td>{{ $n->doa_1->nama_nilai }}</td>
                                <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_angka }}</td>
                                <td class="text-center">{{ $n->penilaian_huruf_angka->nilai_huruf }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
        </table>
        
        <table style="border: none;" width="100%">
            <tr>
                <td width="50%" style="vertical-align: top;">
                    <table class="table-keterangan" width="100%" style="vertical-align: top;">
                        <tr>
                            <td width="10%" rowspan="6" style="vertical-align: top;">Ket:</td>
                            <td width="10%">A+</td>
                            <td width="30%">(91-100)</td>
                            <td width="5%"></td>
                            <td width="5%">BT</td>
                            <td width="40%">: Belum Terlihat</td>
                        </tr>
                        <tr>
                            <td>A</td>
                            <td>(86-90)</td>
                            <td></td>
                            <td>MT</td>
                            <td>: Mulai Terlihat</td>
                        </tr>
                        <tr>
                            <td>B+</td>
                            <td>(81-85)</td>
                            <td></td>
                            <td>MB</td>
                            <td>: Mulai Berkembang</td>
                        </tr>
                        <tr>
                            <td>B</td>
                            <td>(76-80)</td>
                            <td></td>
                            <td>MK</td>
                            <td>: Menjadi Kebiasaan</td>
                        </tr>
                        <tr>
                            <td>C+</td>
                            <td>(66-70)</td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                <td width="50%" style="vertical-align: top;">
                    <table class="table-keterangan" width="100%">
                        <tr>
                            <td width="30%" style="vertical-align: top;">Diberikan di</td>
                            <td width="70%">: {{$data['rapor_siswa']['tempat']}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td>: {{formatDate($data['rapor_siswa']['tanggal'])}}</td>
                            {{-- <td>: {{formatDate(now('Asia/Jakarta'))}}</td> --}}
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        
        
        <div align="right" class="signature" style="position: relative; right: 50%; transform: translateX(125%);">
            <p><br/></p>
            <p>Guru Kelas,</p>
        </p>
        <br />
        <br />
        <br />
        <br />
        <p></p>
        <p><strong><u>{{ $data['0']['data_guru']['0']['nama_guru'] }}</u></strong></p>
        {{-- <p>NIY. {{ $data_siswa->sub_kelas->guru->nip }}</p> --}}
    </div>
    
    <div align="left" class="signature" style="position: relative; left: 50%; transform: translateX(-275%);">
        <p>Mengetahui,</p>
        <p>
            Orang Tua/Wali<br />
        </p>
        <br />
        <br />
        <br />
        <br />
        <p></p>
        <p>----------------------------</p>
        <p> </p>
    </div>
    
    
</div>
</div>
@endforeach
</body>

<script>
    //print, without url and page title
    window.print();
</script>

</html>
