@extends('layouts.app')

@section('content')
<form method="POST" action="/EditWorkHour/{{$workHour->id}}" style="height:500px;width:400px;margin:0px auto;">
    {{ csrf_field() }}
    @method('PUT')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="form-group">
        <label for="data">Data</label>
        <input type="date" class="form-control" value="{{$workHour->date}}" required="required" id="data" name="data">
      </div>
    <br/>
    <div class="form-group">
      <label for="godziny">Godziny</label>
      <input type="text" class="form-control" value="@if(old('godziny') !== null){{old('godziny')}} @else {{$workHour->work_hours}} @endif" id="godziny" name="godziny" placeholder="Podaj ilość godzin" required>
    </div>
    <br/>
    <br/>
    <div style="text-align:center;">
    <button type="submit" class="btn btn-info">Edytuj czas pracy</button>
    </div>
  </form>
@endsection
