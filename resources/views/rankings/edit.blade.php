@extends('layouts.app')

@section('content')

    <h1>{{ $ranking->name }} のランキング編集</h1>

    {!! Form::model($ranking, ['route' => ['rankings.update', $ranking->id], 'method' => 'put']) !!}
    
        <table class="table table-bordered">
            <tr>
                <th>カテゴリ名</th>
                <td>{{ $ranking->category->name2 }}（{{ $ranking->category->name1 }}）</td>
            </tr>
            <tr>
                <th>1位</th>
                <td>{!! Form::text('code1', $ranking->item1->code, ['class' => 'form-control']) !!}</td>
            </tr>
            <tr>
                <th>2位</th>
                <td>
                    @if ($ranking->rank2 > 0)
                        {!! Form::text('code2', $ranking->item2->code, ['class' => 'form-control']) !!}
                    @else
                        {!! Form::text('code2', null, ['class' => 'form-control']) !!}
                    @endif
                </td>
             </tr>
            <tr>
                <th>3位</th>
                <td>
                    @if ($ranking->rank3 > 0)
                        {!! Form::text('code3', $ranking->item3->code, ['class' => 'form-control']) !!}
                    @else
                        {!! Form::text('code3', null, ['class' => 'form-control']) !!}
                    @endif
                </td>
             </tr>
            <tr>
                <th>4位</th>
                <td>
                    @if ($ranking->rank4 > 0)
                        {!! Form::text('code4', $ranking->item4->code, ['class' => 'form-control']) !!}
                    @else
                        {!! Form::text('code4', null, ['class' => 'form-control']) !!}
                    @endif
                </td>
             </tr>
            <tr>
                <th>5位</th>
                <td>
                    @if ($ranking->rank5 > 0)
                        {!! Form::text('code5', $ranking->item5->code, ['class' => 'form-control']) !!}
                    @else
                        {!! Form::text('code5', null, ['class' => 'form-control']) !!}
                    @endif
                </td>
             </tr>
         </table>
     
        {!! Form::submit('更新', ['class' => 'btn btn-primary']) !!}
        
    {!! Form::close() !!}

@endsection