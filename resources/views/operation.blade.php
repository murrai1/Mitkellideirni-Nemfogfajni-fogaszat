@extends('layout')

@section('content')
<h2>Beavatkozások</h2>
@if(Session::get('Állapot'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  {{Session::get('Állapot')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<table class="table">
<thead>
    <tr>
        <th scope="col">Név</td>
        <th scope="col">Időtartam</td>
        <th scope="col">Ár</td>
        <th>Módosítások</td>
    </tr>
</thead>
<tbody>
    @foreach($data as $d)
    <tr>
        <th scope="col">{{$d->name}}</th>
        <td>{{$d->duration}}</td>
        <td>{{$d->price}}</td>
        <td>
            <a href="/delop/{{$d->id}}"><i class="fa fa-trash"></i></a>
            <a href="/edop/{{$d->id}}"><i class="fa fa-edit"></i></a>
        </td>
    </tr>
    @endforeach
</tbody>
</table>

@stop