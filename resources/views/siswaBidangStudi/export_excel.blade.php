<table>
    <tr>
        <td colspan="{{ $column_length + 3 }}" style="text-align: center; font-size: 18px; font-weight: bold;">{{ $judul }}</td>
    </tr>

    <tr>
        <td></td>
    </tr>
    <tr>
        <td style="width: 100px;">Kelas</td>
        <td colspan="{{ $column_length + 2 }}" style="text-align: left;">: {{ $nama_kelas }}</td>
    </tr>
    <tr>
        <td>Wali kelas</td>
        <td colspan="{{ $column_length + 2 }}" style="text-align: left;">: {{ $wali_kelas }}</td>
    </tr>
    <tr>
        <td>Semester</td>
        <td colspan="{{ $column_length + 2 }}" style="text-align: left;">: {{ $semester }}</td>
    </tr>
    <tr>
        <td>Tahun Ajaran</td>
        <td colspan="{{ $column_length + 2 }}" style="text-align: left;">: {{ $tahun_ajaran }}</td>
    </tr>
    <tr>
        <td>Tanggal</td>
        <td colspan="{{ $column_length + 2 }}" style="text-align: left;">: {{ $tanggal}}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <thead style="background-color: #b7d8dc; border: 2px solid black;">
        <tr>
            <th rowspan="2" style="width: 50px; text-align: center; vertical-align: middle;">ID</th>
            <th rowspan="2" style="width: 150px; text-align: center; vertical-align: middle;">Nama Siswa</th>
            <th rowspan="2" style="width: 100px; text-align: center; vertical-align: middle;">NISN</th>
            <th colspan="{{ $column_length }}" style="text-align: center; width: 100px; vertical-align: middle;">{{$nama_mapel}}</th>
        </tr>
        <tr>
            <th style="width: 100px;">Ulangan Harian 1</th>
            <th style="width: 100px;">Ulangan Harian 2</th>
            <th style="width: 100px;">Ulangan Harian 3</th>
            <th style="width: 100px;">Ulangan Harian 4</th>
            <th style="width: 100px;">Tugas 1</th>
            <th style="width: 100px;">Tugas 2</th>
            <th style="width: 100px;">UTS</th>
            <th style="width: 100px;">PAS</th>
    </tr>
</thead>
<tbody style="border: 2px solid black;">
    @foreach ($siswa_bs as $siswa)
        <tr>
            <td style="text-align: center;"> {{ $siswa->siswa->id}} </td>
            <td>{{ $siswa->siswa->nama_siswa }}</td>
            <td>{{ $siswa->siswa->nisn }}</td>
            <td style="text-align: center;"> 
                @if ($siswa->uh_1->nilai_angka == null)
                    0
                @else
                    {{ $siswa->uh_1->nilai_angka }}
                @endif
            </td>
            <td style="text-align: center;">
                @if ($siswa->uh_2->nilai_angka == null)
                    0
                @else
                    {{ $siswa->uh_2->nilai_angka }}
                @endif
            </td>
            <td style="text-align: center;">
                @if ($siswa->uh_3->nilai_angka == null)
                    0
                @else
                    {{ $siswa->uh_3->nilai_angka }}
                @endif
            </td>
            <td style="text-align: center;">
                @if ($siswa->uh_4->nilai_angka == null)
                    0
                @else
                    {{ $siswa->uh_4->nilai_angka }}
                @endif
            </td>
            <td style="text-align: center;">
                @if ($siswa->tugas_1->nilai_angka == null)
                    0
                @else
                    {{ $siswa->tugas_1->nilai_angka }}
                @endif
            </td>
            <td style="text-align: center;">
                @if ($siswa->tugas_2->nilai_angka == null)
                    0
                @else
                    {{ $siswa->tugas_2->nilai_angka }}
                @endif
            </td>
            <td style="text-align: center;">
                @if ($siswa->uts->nilai_angka == null)
                    0
                @else
                    {{ $siswa->uts->nilai_angka }}
                @endif
            </td>
            <td style="text-align: center;">
                @if ($siswa->pas->nilai_angka == null)
                    0
                @else
                    {{ $siswa->pas->nilai_angka }}
                @endif
            </td>
        </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th colspan = "3" style="text-align: center;">ID Nilai</th>
            <th colspan={{ $column_length }} style="text-align: center;">
                {{ $nilai_id }}
            </th>
    </tr>
    <tr>
        <th></th>
    </tr>
    <tr>
        <th>Kode file:</th>
        <th colspan="1" style="text-align: left;">{{ $file_identifier }}</th>
    </tr>
</tfoot>
</table>
