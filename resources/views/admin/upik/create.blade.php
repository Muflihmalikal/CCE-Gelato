<div class="modal fade" id="upik-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Edit Data ujian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form di dalam modal -->
                <form action="{{ route('upik.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="hidden" name="ujian_id" id="ujian_id" value="{{ old('id', $ujian->id ?? '') }}">
                            <label for="judul" class="form-label">judul ujian</label>
                            <input type="text" class="@error('judul') is-invalid @enderror form-control border-tosca" id="judul" name="judul" disabled value="{{ old('judul', $ujian->judul ?? '') }}">
                        </div>

                        <div class="col-sm-6">
                            <label for="topik_id" class="form-label">Pilih Tes</label>
                            <select class="form-control @error('topik_id') is-invalid @enderror" id="topik_id" name="topik_id">
                                <option value="">-- Pilih Topik --</option>
                                @foreach ($topiks as $topik)
                                <option value="{{ $topik->id }}">{{ $topik->nama_topik }}</option>
                                @endforeach
                            </select>
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