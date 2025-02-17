@extends('admin.layout.App')

@section('title', 'topik')

@section('content')
@if(session('success'))
<div class="alert alert-success" style="max-width: 30%; display: flex; justify-content:space-between; text-align:center; margin: 20px;">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
<div class="row" style="margin: 20px; box-shadow: 0 0 30px rgba(0, 0, 0, 0.2); border-radius: 10px;">
    <div class="mb-3 mb-sm-0 bg-primary" style="padding: 20px; border-radius: 10px 10px 0 0; display: flex; justify-content:space-between;">
        <h3 class="fw-semibold" style="color: white;">Daftar topik</h3>
        <button data-bs-toggle="modal" data-bs-target="#topik-add" class="btn btn-success" style="margin-right: 5px;">
            <i class="fas fa-plus" style="margin-right: 5px; border-radius: 10px;"></i>Tambah Data</button>
    </div>
    <div class="col-lg-12" style="max-width: 100%;">
        <div class="row" style="padding: 20px; border-radius: 0 0 10px 10px;">
            <div class="col-lg-12">
                <table style="text-align: center;" id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama topik</th>
                            <th>Batas Waktu</th>
                            <th>Acak Soal</th>
                            <th>Acak Jawaban</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topik as $item)
                        @php
                        $acak_soal = $item->acak_soal == 1 ? 'iya' : 'Tidak';
                        $acak_jawaban = $item->acak_jawaban == 1 ? 'iya' : 'Tidak';
                        @endphp
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->nama_topik }}</td>
                            <td>{{ $item->batas_waktu }} Menit</td>
                            <td>{{ $acak_soal}}</td>
                            <td>{{ $acak_jawaban }}</td>
                            <td>
                                <button data-bs-toggle="modal" data-bs-target="#topik-ubah-{{ $item->id }}" class="btn btn-outline-warning" style="margin: 5px;">
                                    <i class="fas fa-edit" style="margin-right: 5px;"></i>Edit
                                </button>
                                <form action="{{ route('topik.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-trash" style="margin-right: 5px;"></i>Hapus
                                    </button>
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
@include('admin.topik.create')
@include('admin.topik.edit')
@endsection