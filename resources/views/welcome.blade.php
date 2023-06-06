<h1>Patients</h1>
<table border="1">
<tr>
        <td>Id</td>
        <td>Name</td>
        <td>Birthplace</td>
        <td>Birthdate</td>
        <td>adress</td>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{$d['id']}}</td>
        <td>{{$d['name']}}</td>
        <td>{{$d['birthplace']}}</td>
        <td>{{$d['birthdate']}}</td>
        <td>{{$d['address']}}</td>
    </tr>
    @endforeach
</table>