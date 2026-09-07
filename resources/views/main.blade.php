@extends('template')
@section('content')

<h3>PKB World</h3>




<div class="container">
    <form action="" method="get">
        <lable>Kraj</label>
            <select class="form-control" name="country">
                <option value="">-</option>
                @foreach ($country AS $c)
                <option value="{{$c}}" @if ($c==$code) selected @endif>{{$c}}</option>
                @endforeach
            </select>
            <lable>Rok</label>
                <select class="form-control" name="year">
                    <option value="">-</option>
                    @foreach ($years AS $y)
                    <option value="{{$y}}" @if ($y==$year) selected @endif>{{$y}}</option>
                    @endforeach
                </select>
                <br />
                <a class="btn btn-danger" href="/">Reset</a>
                <input type="submit" value="Szukaj" class="btn bt-info" />
    </form>
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