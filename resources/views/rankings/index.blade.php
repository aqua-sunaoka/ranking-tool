@extends('layouts.app')

@section('content')

    <h1>ランキング一覧</h1>

    @if (count($rankings) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th></th>
                    <th>カテゴリ</th>
                    <th>ランキング名</th>
                    <th>1位</th>
                    <th>2位</th>
                    <th>3位</th>
                    <th>4位</th>
                    <th>5位</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankings as $ranking)
                <tr>
                    <td>
                        {!! link_to_route('rankings.edit', '編集', ['id' => $ranking->id], ['class' => 'btn btn-success']) !!}

                        {!! Form::model($ranking, ['route' => ['rankings.destroy', $ranking->id], 'method' => 'delete']) !!}
                            {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                        {!! Form::close() !!}
                    </td>
                    <td>{{ $ranking->category->name2 }}<br>（{{ $ranking->category->name1 }}）</td>
                    <td>{{ $ranking->name }}</td>
                    <td>{{ $ranking->item1->code }}<br>{{ $ranking->item1->comment }}</td>
                    <td>
                        @if ($ranking->rank2 > 0)
                            {{ $ranking->item2->code }}<br>{{ $ranking->item2->comment }}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @if ($ranking->rank3 > 0)
                            {{ $ranking->item3->code }}<br>{{ $ranking->item3->comment }}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @if ($ranking->rank4 > 0)
                            {{ $ranking->item4->code }}<br>{{ $ranking->item4->comment }}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @if ($ranking->rank5 > 0)
                            {{ $ranking->item5->code }}<br>{{ $ranking->item5->comment }}
                        @else
                            --
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        
    @endif

    {!! link_to_route('rankings.create', '新規ランキングの作成', [], ['class' => 'btn btn-primary']) !!}


@endsection