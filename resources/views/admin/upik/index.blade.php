@extends('admin.layout.App')

@section('title', 'Detail ujian')

@section('content')
<p>Detail Ujian : {{ $ujian->judul }}</p>
<p>Tenggat Ujian : {{ \Carbon\Carbon::parse($ujian->waktu_mulai)->format('H:i d-m-Y')  }} - {{\Carbon\Carbon::parse($ujian->waktu_selesai)->format('H:i d-m-Y')}}</p>
@if (session('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    {{ session('error') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@if(session('success'))
<div class="alert alert-success" style="max-width: 30%; display: flex; justify-content:space-between; text-align:center; margin: 20px;">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row" style="margin: 20px; box-shadow: 0 0 30px rgba(0, 0, 0, 0.2); border-radius: 10px;">
    <div class="mb-3 mb-sm-0 bg-primary" style="padding: 20px; border-radius: 10px 10px 0 0; display: flex; justify-content:space-between;">
        <h3 class="fw-semibold" style="color: white;">{{ $ujian->judul }}</h3>
        <button data-bs-toggle="modal" data-bs-target="#upik-add" class="btn btn-success" style="margin-right: 5px;">
            <i class="fas fa-plus" style="margin-right: 5px; border-radius: 10px;"></i>Tambah Topik</button>
    </div>
    <div class="col-lg-12" style="max-width: 100%;">
        <div class="row" style="padding: 20px; border-radius: 0 0 10px 10px;">
            <div class="col-lg-12">
                <table style="text-align: center;" id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Topik</th>
                            <th>Batas Waktu</th>
                            <th>Soal Acak</th>
                            <th>Jawaban Acak</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ujian->topik as $topik)
                        @php
                        $acak_soal = $topik->acak_soal == 1 ? 'iya' : 'Tidak';
                        $acak_jawaban = $topik->acak_jawaban == 1 ? 'iya' : 'Tidak';
                        @endphp
                        <tr>
                            <td>{{ $topik->id }}</td>
                            <td>{{ $topik->nama_topik }}</td>
                            <td>{{ $topik->batas_waktu }} Menit</td>
                            <td>{{ $acak_soal}}</td>
                            <td>{{ $acak_jawaban }}</td>

                            <td>
                                <form action="{{ route('ujian.hapusTopik', ['ujian_id' => $ujian->id, 'topik_id' => $topik->id]) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus topik ini dari ujian?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash" style="margin-right: 5px;"></i>Hapus
                                    </button>
                                </form>
                                @endforeach
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@include('admin.upik.create')
@endsection