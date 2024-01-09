<table>
    <tr>
        <td colspan="4" style="text-align: center; font-size: 18px; font-weight: bold;">{{ $judul }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <thead style="background-color: #b7d8dc; border: 2px solid black;">
        <tr>
            <th style="width: 50px; text-align: center; vertical-align: middle;">ID</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Tingkat Kelas</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Nama Kelas</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Wali Kelas</th>
        </tr>
    </thead>
    <tbody style="border: 2px solid black;">
        @foreach ($kelas_d as $kelas)
        @if ($kelas !== null)
        <tr>
            <td style="text-align: center;"> {{ $kelas['id'] }}</td>
            <td>{{ $kelas['tingkat_kelas'] }}</td>
            <td>{{ $kelas['nama_sub_kelas'] }}</td>
            @foreach ($kelas as $key => $value)
                @if ($key == 'guru')
                    <td>   
                        {{ $value }}
                    </td>
                @endif
            @endforeach
        </tr>
        @endif
        @endforeach
        @for($i = 1; $i <= 50; $i++)
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endfor
        <tr>
            <td></td>
        </tr>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td>Kode file</td>
            <td colspan="1" style="text-align: left;">{{ $file_identifier }}</td>
        </tr>
    </tbody>
</table>
