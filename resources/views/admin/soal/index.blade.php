@extends('admin.layout.App')

@section('title', 'Soal')

@section('content')
<div class="row" style="margin: 20px; box-shadow: 0 0 30px rgba(0, 0, 0, 0.2); border-radius: 10px;">
    <div class="mb-3 mb-sm-0 bg-primary" style="padding: 20px; border-radius: 10px 10px 0 0; display: flex; justify-content:space-between;">
        <h3 class="fw-semibold" style="color: white;">Daftar Soal</h3>
        <button data-bs-toggle="modal" data-bs-target="#modalTambahSoal" class="btn btn-success" style="margin-right: 5px;">
            <i class="fas fa-plus" style="margin-right: 5px; border-radius: 10px;"></i>Tambah Soal</button>
    </div>

    <div class="col-lg-12" style="max-width: 100%;">
        <div class="row" style="padding: 20px; border-radius: 0 0 10px 10px;">
            <div class="col-lg-12">

                <!-- Dropdown Pilih Topik -->
                <label for="topik_id" class="form-label">Pilih Topik:</label>
                <select name="topik_id" id="topik_id" class="form-control mb-3">
                    <option value="">-- Pilih Topik --</option>
                    @foreach ($topik as $t)
                    <option value="{{ $t->id }}">{{ $t->nama_topik }}</option>
                    @endforeach
                </select>

                <!-- Tabel DataTables -->
                <table id="soalTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>pertanyaan</th>
                            <th>Tipe Soal</th>
                            <th>Jawaban Benar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>


            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Soal -->
<div class="modal fade" id="modalTambahSoal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formTambahSoal">
                    @csrf
                    <input type="hidden" name="topik_id" id="modal_topik_id">

                    <!-- Pertanyaan -->
                    <div class="mb-3">
                        <label for="pertanyaan" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" id="pertanyaan" name="pertanyaan" required>
                    </div>

                    <!-- Pilih Tipe Soal -->
                    <div class="mb-3">
                        <label for="tipe_soal" class="form-label">Tipe Soal</label>
                        <select class="form-control" id="tipe_soal" name="tipe_soal" required>
                            <option value="pilihan_ganda">Pilihan Ganda</option>
                            <option value="jawaban_singkat">Jawaban Singkat</option>
                            <option value="essay">Essay</option>
                        </select>
                    </div>

                    <!-- Jawaban Benar -->
                    <div class="mb-3">
                        <label for="jawaban_benar" class="form-label">Jawaban Benar</label>
                        <input type="text" class="form-control" id="jawaban_benar" name="jawaban_benar" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- DataTables & Ajax -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        let table = $('#soalTable').DataTable({
            processing: true,
            serverSide: false,
            ajax: {
                url: '',
                dataSrc: ''
            },
            language: {
                emptyTable: "Tidak ada soal yang tersedia."
            },
            columns: [{
                    data: null,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Penomoran otomatis
                    }
                },
                {
                    data: 'teks_soal'
                },
                {
                    data: 'tipe'
                },
                {
                    data: 'jawaban_benar'
                },
                {
                    data: null,
                    render: function(data, type, row) {
                        return `
                    <button class="btn btn-warning btn-sm btn-edit" data-id="${row.id}" data-teks_soal="${row.teks_soal}" data-tipe="${row.tipe}" data-jawaban_benar="${row.jawaban_benar}">Edit</button>
                    <button class="btn btn-danger btn-sm btn-delete" data-id="${row.id}">Hapus</button>
                `;
                    }
                }
            ]
        });

        // Load soal berdasarkan topik yang dipilih
        $('#topik_id').change(function() {
            let topikID = $(this).val();
            if (topikID) {
                table.ajax.url(`/soal/data/${topikID}`).load();
                $('#modal_topik_id').val(topikID);
            } else {
                table.clear().draw();
            }
        });

        // Tambah Soal
        $('#formTambahSoal').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('soal.store') }}",
                type: "POST",
                data: $(this).serialize(),
                success: function() {
                    $('#modalTambahSoal').modal('hide');
                    table.ajax.reload();
                }
            });
        });

        // Hapus Soal
        $('#soalTable').on('click', '.btn-delete', function() {
            let id = $(this).data('id');
            if (confirm("Yakin ingin menghapus?")) {
                $.ajax({
                    url: `/soal/${id}/hapus`,
                    type: "DELETE",
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function() {
                        table.ajax.reload();
                    }
                });
            }
        });
    });
</script>
@endsection