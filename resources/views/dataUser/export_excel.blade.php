<table>
    <tr>
        <td colspan="6" style="text-align: center; font-size: 18px; font-weight: bold;">{{ $judul }}</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td>Tanggal :</td>
        <td colspan="5" style="text-align: left;">{{ $tanggal}}</td>
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
            <th style="width: 150px; text-align: center; vertical-align: middle;">Name</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Email</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Username</th>
            <th style="width: 250px; text-align: center; vertical-align: middle;">Password</th>
            <th style="width: 150px; text-align: center; vertical-align: middle;">Peran</th>
        </tr>
    </thead>
    <tbody style="border: 2px solid black;">
        @foreach ($user_d as $user)
        @if ($user !== null)
        <tr>
            <td style="text-align: center;"> {{ $user['id'] }}</td>
            <td>{{ $user['name'] }}</td>
            <td>{{ $user['email'] }}</td>
            <td>{{ $user['user_name'] }}</td>
            <td>--password disembunyikan oleh sistem--</td>
            @foreach ($user as $key => $value)
                @if ($key == 'role')
                    <td>   
                        @if ($value == 1)
                            Administrator
                        @elseif ($value == 2)
                            Wali Kelas
                        @elseif ($value == 3)
                            Guru
                        @else
                        
                        @endif
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
            <td></td>
            <td></td>
        </tr>
        @endfor
    </tbody>
</table>
