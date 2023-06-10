@extends('layout')

@section('content')
<h1>Regisztráció</h1>
<div class="col-sm-6">
    <form method="post" action="">
    @csrf
        <div class="form-group">
            <label for="formGroupExampleInput">felhasználó név</label>
            <input type="text" class="form-control" id="név" name="név">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">jelszó</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">kategória</label>
            <input type="text" class="form-control" id="cat" name="cat">
        </div>
        <button type="submit" class="btn btn-primary">Regisztráció</button>
    </form>
</div>
@stop