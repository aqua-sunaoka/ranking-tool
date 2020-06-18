@extends('layouts.app')

@section('content')

    <h1>ランキング 新規登録</h1>

    {!! Form::model($ranking, ['route' => 'rankings.store']) !!}
        
        <table class="table table-bordered">
            <tr>
                <th>カテゴリ名</th>
                <td>{!! Form::select('category', $categories->pluck('name2', 'code')->prepend( "選択してください", ""), ['class' => 'form-control']) !!}</td>
            </tr>
            <tr>
                <th>ランキング名</th>
                <td>{!! Form::text('name', null, ['class' => 'form-control']) !!}</td>
            </tr>
            <tr>
                <th>1位</th>
                <td>{!! Form::text('code1', null, ['class' => 'form-control']) !!}</td>
            </tr>
            <tr>
                <th>2位</th>
                <td>{!! Form::text('code2', null, ['class' => 'form-control']) !!}</td>
             </tr>
            <tr>
                <th>3位</th>
                <td>{!! Form::text('code3', null, ['class' => 'form-control']) !!}</td>
             </tr>
            <tr>
                <th>4位</th>
                <td>{!! Form::text('code4', null, ['class' => 'form-control']) !!}</td>
             </tr>
            <tr>
                <th>5位</th>
                <td>{!! Form::text('code5', null, ['class' => 'form-control']) !!}</td>
             </tr>
         </table>

        {!! Form::submit('登録', ['class' => 'btn btn-primary']) !!}
        
    {!! Form::close() !!}

@endsection