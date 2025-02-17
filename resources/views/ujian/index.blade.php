<h1>Daftar Ujian</h1>
<ul>
    @foreach ($ujian as $u)
    <li><a href="{{ route('ujian.show', $u->id) }}">{{ $u->judul }}</a></li>
    @endforeach
</ul>