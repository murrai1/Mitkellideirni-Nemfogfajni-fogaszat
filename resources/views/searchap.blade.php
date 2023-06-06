@extends('layout')

@section('content')
<h2>Időpont keresése</h2>
<div class="col-sm-6">
    <form>
        <div class="form-group">
            <label for="formGroupExampleInput">Example label</label>
            <input type="date" class="form-control" id="formGroupExampleInput" placeholder="Example input">
        </div>
        <button type="submit" class="btn btn-primary">Keresés</button>
    </form>
</div>
<h2>Időpont vizsgálata</h2>
<div class="col-sm-6">
    <form>
        <div class="form-group col-md-4">
            <label for="inputState">Vizsgálandó időpont</label>
            <select id="inputState" class="form-control">
                <option selected>Choose...</option>
                <option>...</option>
                <option>....</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Kiválaszt</button>
    </form>
</div>
<h2>Időpontok</h2>
<table border="1">
<tr>
        <td>Dátum</td>
        <td>Páciens id</td>
    </tr>

    @foreach($data as $d)
    <tr>
        <td>{{$d['date']}}</td>
        <td>{{$d['patientid']}}</td>
    </tr>
    @endforeach
</table>
@stop