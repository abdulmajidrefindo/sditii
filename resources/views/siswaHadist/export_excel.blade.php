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
            <th colspan="{{ $column_length }}" style="text-align: center; width: 100px; vertical-align: middle;">Hadist</th>
        </tr>
        <tr>
            @foreach ($siswa_d as $siswa)
                @foreach ($siswa as $key => $value)
                    @if ($key !== 'siswa_id' && $key !== 'nama_siswa' && $key !== 'kelas' && $key !== 'nisn')
                        <th style="width: 100px;">{{ $key }}</th>
                    @endif
                @endforeach
            @break
        @endforeach
    </tr>
</thead>
<tbody style="border: 2px solid black;">
    @foreach ($siswa_d as $siswa)
        <tr>
            <td style="text-align: center;"> {{ $siswa['siswa_id'] }}</td>
            <td>{{ $siswa['nama_siswa'] }}</td>
            <td>{{ $siswa['nisn'] }}</td>
            @foreach ($siswa as $key => $value)
                @if ($key !== 'siswa_id' && $key !== 'nama_siswa' && $key !== 'kelas' && $key !== 'nisn')
                    <td>
                        @if ($value == null)
                            0
                        @else
                            {{ $value }}
                        @endif
                    </td>
                @endif
            @endforeach
        </tr>
    @endforeach
</tbody>
<tfoot>
    <tr>
        <th colspan = "3" style="text-align: center;">ID Nilai</th>
        @foreach ($nilai_id as $id)
            <th style="text-align: center;">{{ $id }}</th>
        @endforeach
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
