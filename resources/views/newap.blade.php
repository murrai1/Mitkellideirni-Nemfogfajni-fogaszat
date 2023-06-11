@extends('layout')

@section('content')
<h1>Új időpont felvétele</h1>
@if(Session::get('Állapot'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{Session::get('Állapot')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
<div class = "col-sm-6">
  <form method="post" action = "">
    @csrf
    <div class="form-row">
      <div class="form-group col-md-6">
        <label for="inputEmail4">Időpont</label>
        <input type="datetime-local" class="form-control" id="idő" name="idő">
      </div>
    </div>
    <div class="form-row">
      <div class="form-group col-md-6">
        <input type="hidden" class="form-control" id="dent" name ="dent" value ="{{$userId}}">
      </div>
    </div>
    <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Páciens Tajszáma</label>
      <select id="taj" name ="taj" class="form-control">
        <option selected></option>
        @foreach($pid as $p)
        <option>{{$p['id']}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Eljárás</label>
      <select id="op" name="op" class="form-control">
        <option selected></option>
        @foreach($oname as $o)
        <option>{{$o['name']}}</option>
        @endforeach
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Rögzítés</button>
</form>
</div>
@stop