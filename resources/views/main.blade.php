@extends('template')
@section('content')

<h3>PKB World</h3>




<div class="container">
    <table class="table">
        <tr>
            <th></th>
            <th>Kraj</th>
            <th>Kod</th>
            <th>Value</th>
            <th>Year</th>
        </tr>
        @foreach ($data AS $record)
        <tr>
            <th>{{$loop->iteration}}</th>
            <th>{{$record['country']}}</th>
            <th>{{$record['code']}}</th>
            <th>{{ Illuminate\Support\Number::format($record['value'], locale: 'pl') }}</th>
            <th>{{$record['year']}}</th>
        </tr>
        @endforeach
    </table>


</div>

<div class="container">
    <a href="/import" class="btn btn-info">Import Csv</a>
</div>

@endsection('content')