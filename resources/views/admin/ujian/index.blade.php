@extends('admin.layout.App')

@section('title', 'ujian')

@section('content')
<div class="row" style="margin: 20px; box-shadow: 0 0 30px rgba(0, 0, 0, 0.2); border-radius: 10px;">
    <div class="mb-3 mb-sm-0 bg-primary" style="padding: 20px; border-radius: 10px 10px 0 0; display: flex; justify-content:space-between;">
        <h3 class="fw-semibold" style="color: white;">Daftar ujian</h3>
        <button data-bs-toggle="modal" data-bs-target="#ujian-add" class="btn btn-success" style="margin-right: 5px;">
            <i class="fas fa-plus" style="margin-right: 5px; border-radius: 10px;"></i>Tambah Data</button>
    </div>
    <div class="col-lg-12" style="max-width: 100%;">
        <div class="row" style="padding: 20px; border-radius: 0 0 10px 10px;">
            <div class="col-lg-12">
                <table style="text-align: center;" id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama ujian</th>
                            <th>Deskripsi ujian</th>
                            <th>Waktu Mulai ujian</th>
                            <th>Waktu Selesai ujian</th>
                            <th>Token ujian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ujian as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ $item->deskripsi}}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktu_mulai)->format('d-m-Y H:i:s') }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->waktu_selesai)->format('d-m-Y H:i:s') }}</td>
                            <td>{{ $item->token }}</td>
                            <td>
                                {{--
                                <button data-bs-toggle="modal" data-bs-target="#ujian-tambah-{{ $item->id }}" class="btn btn-outline-success" style="margin: 5px;">
                                <i style="margin-right: 5px;"></i>Topik
                                </button> --}}
                                <a href="{{ route('ujian.show', $item->id) }}" class="btn btn-outline-success" style="margin: 5px;">Topik</a>
                                <button data-bs-toggle="modal" data-bs-target="#ujian-ubah-{{ $item->id }}" class="btn btn-outline-warning" style="margin: 5px;">
                                    <i class="fas fa-edit" style="margin-right: 5px;"></i>Edit
                                </button>
                                <form action="{{ route('ujian.destroy', $item->id) }}" method="POST" style="display:inline;">
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
@if(session('success'))
<div class="alert alert-success" style="max-width: 30%; display: flex; justify-content:space-between; text-align:center; margin: 20px;">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif
@include('admin.ujian.create')
@include('admin.ujian.edit')
@endsection