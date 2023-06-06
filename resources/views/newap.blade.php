@extends('layout')

@section('content')
<h1>Új időpont felvétele</h1>
<form method="post" action = "">
@csrf
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Időpont</label>
      <input type="datetime-local" class="form-control" id="inputEmail4" placeholder="Dátum">
    </div>
    <!--
      lehet nem autoincrement az appointment id
      <div class="form-group col-md-6">
        <label for="inputPassword4">Beavatkozás id</label>
        <input type="text" class="form-control" id="inputPassword4" placeholder="Password">
      </div>
    -->
  </div>
  <div class="form-row">
    <div class="form-group col-md-4">
      <label for="inputState">Eljárás</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
        <option>....</option>
      </select>
    </div>
    <div class="form-group col-md-4">
      <label for="inputState">Páciens Tajszáma</label>
      <select id="inputState" class="form-control">
        <option selected>Choose...</option>
        <option>...</option>
        <option>....</option>
      </select>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Rögzítés</button>
</form>
@stop