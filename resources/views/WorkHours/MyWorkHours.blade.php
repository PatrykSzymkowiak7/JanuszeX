@extends('layouts.app')

@section('content')
    @if(session()->has('message'))
    <div class="flex justify-center pt-8 sm:justify-start sm:pt-0" style="text-align:center;font-size:16px;width:800px;margin:0px auto;font-weight:bolder;">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session()->get('message')}}</strong>
        </div>
    </div>
    @endif
    <table class="table table-striped" style="width:800px;margin:0px auto;text-align:center;">

        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id pracownika</th>
                <th scope="col">Data</th>
                <th scope="col">Przepracowane godziny</th>
                @if(Auth::user()->privilege_level > 1)
                <div style="margin:0px auto;text-align:center;">
                    <th scope="col">Akcja</th>
                </div>
                @endif
            </tr>
        </thead>

        <tbody>
            @if($workHours->count())
                @php $index=1 @endphp
                @foreach($workHours as $workHour)
                    <tr>
                        <th scope="row">{{$index++}}</th>
                        <td>{{$workHour->employee_id}}<a href=""></a></td>
                        <td>{{$workHour->date}}</td>
                        <td>{{$workHour->work_hours}}</td>
                        @if(Auth::user()->privilege_level > 1)
                        <div style="margin:0px auto;text-align:center;">
                            <td>
                                <a href="/ChangeWorkHour/{{$workHour->id}}"><button type="button" class="btn btn-info m-1">Edytuj</button></a>
                                <a href="/DeleteWorkHour/{{$workHour->id}}"><button type="button" class="btn btn-danger m-1">Usuń</button></a>
                            </td>
                        </div>
                        @endif
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
    @if($workHours->count() == 0)
    <div style="text-align:center;font-size:16px;background-color:gray;width:800px;margin:0px auto;font-weight:bolder;">
        Brak godzin pracy
    </div>
    @endif
    @if(Auth::user()->privilege_level > 1)
    <div style="margin:0px auto;text-align:center;">
        <br/>
        <a href="/AddWorkHour/{{Request::route('id')}}"><button type="button" class="btn btn-success m-1" style="width:250px">Dodaj</button></a>
    </div>
    @endif
@endsection
