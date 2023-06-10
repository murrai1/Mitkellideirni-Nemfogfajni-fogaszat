@extends('layout')

@section('content')
<h1>Bejelentkezés</h1>
<div class="col-sm-6">
    <form method="post" action="">
    @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">Felhasználó név</label>
            <input type="text" class="form-control" id="név" name="név">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Jelszó</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <button type="submit" class="btn btn-primary">Bejelentkezés</button>
    </form>
</div>
@stop


