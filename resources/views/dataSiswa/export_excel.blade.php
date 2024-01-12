<table>
    <tr>
        <td colspan="4" style="text-align: center; font-size: 18px; font-weight: bold;">{{ $judul }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td style="width: 100px;">Tingkat Kelas :</td>
        <td colspan="3" style="text-align: left;">{{ $tingkat_kelas }}</td>
    </tr>
    <tr>
        <td style="width: 100px;">Nama Kelas :</td>
        <td colspan="3" style="text-align: left;">{{ $nama_sub_kelas }}</td>
    </tr>
    <tr>
        <td>Wali kelas :</td>
        <td colspan="3" style="text-align: left;">{{ $wali_kelas }}</td>
    </tr>
    <tr>
        <td>Semester :</td>
        <td colspan="3" style="text-align: left;">{{ $semester }}</td>
    </tr>
    <tr>
        <td>Tahun Ajaran :</td>
        <td colspan="3" style="text-align: left;">{{ $tahun_ajaran }}</td>
    </tr>
    <tr>
        <td>Tanggal :</td>
        <td colspan="3" style="text-align: left;">{{ $tanggal}}</td>
    </tr>
    <tr>
        <td>Kode file :</td>
        <td colspan="1" style="text-align: left;">{{ $file_identifier }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <thead style="background-color: #b7d8dc; border: 2px solid black;">
        <tr>
            <th style="width: 50px; text-align: center; vertical-align: middle;">ID</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Nama Siswa</th>
            <th style="width: 100px; text-align: center; vertical-align: middle;">NISN</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Orang Tua/Wali</th>
        </tr>
    </thead>
    <tbody style="border: 2px solid black;">
        @foreach ($siswa_d as $siswa)
        @if ($siswa !== null)
        <tr>
            {{-- <td style="text-align: center;"> {{ $siswa['siswa_id'] }}</td> --}}
            <td>{{ $siswa['id'] }}</td>
            <td>{{ $siswa['nama_siswa'] }}</td>
            <td>{{ $siswa['nisn'] }}</td>
            <td>{{ $siswa['orangtua_wali'] }}</td>
        </tr>
        @endif
        @endforeach
        @for($i = 1; $i <= 50; $i++)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endfor
    </tbody>
</table>
