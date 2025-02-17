<!-- ujian/show.blade.php -->
@extends('admin.layout.app')

@section('content')
<div class="container">
    <h1>Detail Ujian: {{ $ujian->judul }}</h1>
    @foreach ($ujian->topik as $topik)
    <p>Topik: {{ $topik->nama_topik }}</p>
    @endforeach

    <!-- Tampilkan data lainnya sesuai kebutuhan -->
</div>
@endsection