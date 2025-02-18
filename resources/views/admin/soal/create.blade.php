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
            <select class="form-control" name="tipe" id="tipe" required>
                <option value="pilihan_ganda">Pilihan Ganda</option>
                <option value="jawaban_singkat">Jawaban Singkat</option>
                <option value="essay">Essay</option>
            </select>
        </div>

        <!-- Pilihan Ganda -->
        <div id="pilihanGandaFields" style="display: none;">
            <label class="form-label">Pilihan Jawaban</label>
            <div class="mb-3">
                @foreach (['A', 'B', 'C', 'D'] as $index => $label)
                <div class="input-group mb-2">
                    <div class="input-group-text">
                        <input type="radio" name="jawaban_benar_index" value="{{ $index }}">
                    </div>
                    <input type="text" class="form-control" name="pilihan[]" placeholder="Pilihan {{ $label }}">
                </div>
                @endforeach
            </div>
        </div>

        <!-- Jawaban Benar (untuk Essay & Jawaban Singkat) -->
        <div id="jawabanBenarField">
            <div class="mb-3">
                <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                <input type="text" class="form-control" name="jawaban_benar">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<!-- JavaScript untuk Menampilkan Form Pilihan Ganda -->
<script>
    document.getElementById('tipe').addEventListener('change', function() {
        var pilihanGandaFields = document.getElementById('pilihanGandaFields');
        var jawabanBenarField = document.getElementById('jawabanBenarField');

        if (this.value === 'pilihan_ganda') {
            pilihanGandaFields.style.display = 'block';
            jawabanBenarField.style.display = 'none';
        } else {
            pilihanGandaFields.style.display = 'none';
            jawabanBenarField.style.display = 'block';
        }
    });
</script>
@endsection