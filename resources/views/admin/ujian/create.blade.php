<div class="modal fade" id="ujian-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Tambah Data ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ujian.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <label for="judul" class="form-label">Nama ujian</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>

                        <label for="deskripsi" class="form-label">Deskripsi ujian</label>
                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea>

                        <label for="waktu_mulai" class="form-label">Mulai ujian</label>
                        <input type="datetime-local" class="form-control" name="waktu_mulai" id="waktu_mulai">

                        <label for="waktu_selesai" class="form-label">Waktu Selesai ujian</label>
                        <input type="datetime-local" class="form-control" id="waktu_selesai" name="waktu_selesai" required>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn" style="background-color: #FF5900; color: white;">Simpan</button>
                        <button type="button" class="btn btn-outline-orange" data-bs-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>