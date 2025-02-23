    @extends('admin.layout.App')

    @section('title', 'Soal')

    @section('content')
    <div class="row" style="margin: 20px; box-shadow: 0 0 30px rgba(0, 0, 0, 0.2); border-radius: 10px;">
        <div class="mb-3 mb-sm-0 bg-primary" style="padding: 20px; border-radius: 10px 10px 0 0; display: flex; justify-content:space-between;">
            <h3 class="fw-semibold" style="color: white;">Daftar Soal</h3>
            <button data-bs-toggle="modal" id="open-modal" data-bs-target="#soal-add" class="btn btn-success" style="margin-right: 5px;">
                <i class="fas fa-plus" style="margin-right: 5px; border-radius: 10px;"></i>Tambah Data</button>
        </div>

        <div class="col-lg-12" style="max-width: 100%;">
            <div class="row" style="padding: 20px; border-radius: 0 0 10px 10px;">
                <div class="col-lg-12">

                    <!-- Dropdown Pilih Topik -->
                    <label for="topik_id" class="form-label">Pilih Topik:</label>
                    <select name="topik_id" id="topik_id" class="form-control mb-3" onchange="location = this.value;">
                        <option value="{{ route('soal.index') }}">-- Pilih Topik --</option>
                        @foreach ($topik as $t)
                        <option value="{{ route('soal.filter', $t->id) }}" id="{{ $t->id }}">{{ $t->nama_topik }}</option>
                        @endforeach
                    </select>

                    <!-- Tabel -->
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Pertanyaan</th>
                                <th>Tipe Soal</th>
                                <th>Jawaban Benar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($soal as $index => $s)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $s->teks_soal }}</td>
                                <td>{{ ucfirst(str_replace('_', ' ', $s->tipe)) }}</td>
                                <td>{{ $s->jawaban_benar }}</td>
                                <td>
                                    <form action="{{ route('soal.destroy', $s->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @include('admin.soal.create')

    @endsection