<div class="modal fade" id="topik-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Edit Data ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form di dalam modal -->
                <form action="{{ route('topik.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">

                            <label for="nama_topik" class="form-label">Nama Topik</label>
                            <input type="text" class="form-control" id="nama_topik" name="nama_topik" required>

                            <input type="hidden" name="acak_soal" value="0">
                            <input class="form-check-input" type="checkbox" id="acak_soal" name="acak_soal" value="1">
                            <label class="form-check-label" for="acak_soal">Acak Soal</label>

                        </div>

                        <div class="col-sm-6">

                            <label for="batas_waktu" class="form-label">Batas Waktu</label>
                            <input type="number" class="form-control" id="batas_waktu" name="batas_waktu" required>

                            <input type="hidden" name="acak_jawaban" value="0">
                            <input class="form-check-input" type="checkbox" id="acak_jawaban" name="acak_jawaban" value="1">
                            <label class="form-check-label" for="acak_jawaban">Acak Jawaban</label>

                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button type="submit" class="btn" style="background-color: #FF5900; color: white;">Tambah</button>
                <button type="button" class="btn btn-outline-orange" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>