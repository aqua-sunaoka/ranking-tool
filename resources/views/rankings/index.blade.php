@extends('layouts.app')

@section('content')

    <h1>ランキング一覧</h1>

    @if (count($rankings) > 0)
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>category_id</th>
                    <th>name</th>
                    <th>rank1</th>
                    <th>rank2</th>
                    <th>rank3</th>
                    <th>rank4</th>
                    <th>rank5</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rankings as $ranking)
                <tr>
                    <td>{{ $ranking->id }}</td>
                    <td>{{ $ranking->cname2 }}<br>（{{ $ranking->cname1 }}）</td>
                    <td>{{ $ranking->name }}</td>
                    <td>{{ $ranking->code1 }}<br>{{ $ranking->comment1 }}</td>
                    <td>
                        @if ($ranking->rank2 > 0)
                            {{ $ranking->code2 }}<br>{{ $ranking->comment2 }}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @if ($ranking->rank3 > 0)
                            {{ $ranking->code3 }}<br>{{ $ranking->comment3 }}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @if ($ranking->rank4 > 0)
                            {{ $ranking->code4 }}<br>{{ $ranking->comment4 }}
                        @else
                            --
                        @endif
                    </td>
                    <td>
                        @if ($ranking->rank5 > 0)
                            {{ $ranking->code5 }}<br>{{ $ranking->comment5 }}
                        @else
                            --
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

@endsection