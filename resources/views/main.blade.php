@extends('layout')

@section('content')
<h1>A mai nap időpontjai</h1>
    <table class="table">
    <thead>
        <tr>
            <th>Páciens</td>
            <th>Időpont</th>
            <th>Információ</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <th scope="col">{{$d['patientid']}}</th>
            <td>{{$d['date']}}</td>
            <td>
            <a href="/infap/{{$d->id}}"><i class="fa fa-arrow-right"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop