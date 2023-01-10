@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
    <div class="alert alert-@if(session('type')){{session()->get('type')}}@else{{'success'}}@endif alert-dismissible fade show" role="alert">
        <strong>{{session()->get('message')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <table class="table table-striped" style="width:500px;margin:0px auto;text-align:center;">

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id pracownika</th>
                <th scope="col">Imię i nazwisko</th>
            </tr>
        </thead>

        <tbody>
            @if($employees->count())
                @php $index=1 @endphp
                @foreach($employees as $employee)
                    <tr>
                        <th scope="row">{{$index++}}</th>
                        <td>{{$employee->id}}</td>
                        <td><a href="/ManageWorkHours/{{$employee->id}}">{{$employee->name}}</a></td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @if($employees->count() == 0)
        <div style="text-align:center;font-size:16px;background-color:gray;width:500px;margin:0px auto;font-weight:bolder;">
            Brak pracowników do wyświetlenia
        </div>
    @endif
@endsection
