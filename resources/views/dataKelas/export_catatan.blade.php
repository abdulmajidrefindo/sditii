<table>
    <tr>
        <td colspan="3" style="text-align: center; font-size: 18px; font-weight: bold;">{{ $judul }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>Semester :</td>
        <td  colspan="2" style="text-align: left;">{{ $semester }}</td>
    </tr>
    <tr>
        <td>Tahun Ajaran :</td>
        <td colspan="2" style="text-align: left;">{{ $tahun_ajaran }}</td>
    </tr>
    <tr>
        <td>Tanggal :</td>
        <td colspan="2" style="text-align: left;">{{ $tanggal}}</td>
    </tr>
    <tr>
        <td>Kode file :</td>
        <td colspan="2" style="text-align: left; text-align: warp;">{{ $file_identifier }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <thead style="background-color: #b7d8dc; border: 2px solid black;">
        <tr>
            <th style="text-align: center; vertical-align: middle;">ID</th>
            <th style="width: 200px; text-align: center; vertical-align: middle;">Nama Kelas</th>
            <th style="width: 600px; text-align: center; vertical-align: middle;">Catatan Kelas</th>
        </tr>
    </thead>
    <tbody style="border: 2px solid black;">
        @foreach ($kelas_d as $kelas)
        <tr>
            <td style="text-align: center; vertical-align: middle;"> {{ $kelas['id'] }}</td>
            <td style="height: 200px; text-align: center; vertical-align: middle;">{{ $kelas['tingkat_kelas'] }} {{ $kelas['nama_sub_kelas'] }}</td>
            <td style="height: 150px; vertical-align: top;">{{ $kelas['catatan_sub_kelas'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
