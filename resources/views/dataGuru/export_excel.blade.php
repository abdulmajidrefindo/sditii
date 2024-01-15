<table>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 18px; font-weight: bold;">{{ $judul }}</td>
    </tr>
    <tr>
        <td></td>
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
            <th style="width: 150px; text-align: center; vertical-align: middle;">Nama Guru</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">NIP</th>
        </tr>
    </thead>
    <tbody style="border: 2px solid black;">
        @foreach ($guru_d as $guru)
        @if ($guru !== null)
        <tr>
            <td style="text-align: center;"> {{ $guru['id'] }}</td>
            @foreach ($guru as $key => $value)
            @if ($key == 'user')
            <td>   
                {{ $value }}
            </td>
            @endif
            @endforeach
            <td>{{ $guru['nip'] }}</td>
        </tr>
        @endif
        @endforeach
        @for($i = 1; $i <= 50; $i++)
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        @endfor
    </tbody>
</table>
