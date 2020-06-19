<ul class="nav nav-tabs nav-justified mb-3 tabs-menu">
    @foreach ($cname1s as $cname1)
        <li><a href="{{ route('rankings.show', ['cname1' => $cname1->name1]) }}" class="nav-link">{{ $cname1->name1 }}</a></li>
    @endforeach
</ul>
