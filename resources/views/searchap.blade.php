@extends('layout')

@section('content')
<h2>Időpont keresése</h2>
<div class="col-sm-6">
    <form method="post" action="">
        @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Example label</label>
            <input type="date" class="form-control" id="date" name="date">
        </div>
        <button type="submit" class="btn btn-primary">Keresés</button>
    </form>
</div>
<h2>Időpontok</h2>
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
            <td>Dátum</td>
            <td>Páciens id</td>
            <td>Időpont részletei</td>
        </tr>
        
    </thead>
    <tbody>
        @foreach($data as $d)
        <tr>
            <td>{{$d['date']}}</td>
            <td>{{$d['patientid']}}</td>
            <td>
            <a href="/infap/{{$d->id}}"><i class="fa fa-arrow-right"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>    
</table>
@stop