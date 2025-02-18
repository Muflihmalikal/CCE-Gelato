@extends('admin.layout.App')

@section('title', 'Tambah Soal')

@section('content')
<div class="container mt-4">
    <h3 class="fw-semibold">Tambah Soal</h3>
    <a href="{{ route('soal.index') }}" class="btn btn-secondary mb-3">Kembali</a>

    <form action="{{ route('soal.store') }}" method="POST">
        @csrf

        <!-- Pilih Topik -->
        <div class="mb-3">
            <label for="topik_id" class="form-label">Topik</label>
            <select class="form-control" name="topik_id" required>
                <option value="">-- Pilih Topik --</option>
                @foreach ($topik as $t)
                <option value="{{ $t->id }}">{{ $t->nama_topik }}</option>
                @endforeach
            </select>
        </div>

        <!-- Pertanyaan -->
        <div class="mb-3">
            <label for="teks_soal" class="form-label">Pertanyaan</label>
            <input type="text" class="form-control" name="teks_soal" required>
        </div>

        <!-- Pilih Tipe Soal -->
        <div class="mb-3">
            <label for="tipe" class="form-label">Tipe Soal</label>
            <select class="form-control" name="tipe" required>
                <option value="pilihan_ganda">Pilihan Ganda</option>
                <option value="jawaban_singkat">Jawaban Singkat</option>
                <option value="essay">Essay</option>
            </select>
        </div>

        <!-- Jawaban Benar -->
        <div class="mb-3">
            <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
            <input type="text" class="form-control" name="jawaban_benar" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection