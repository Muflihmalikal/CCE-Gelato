@foreach ($topik as $topik)
<div class="modal fade" id="topik-ubah-{{ $topik->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Edit Data topik {{ $topik->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form di dalam modal -->
                <form action="{{ route('topik.update', $topik->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="nama_topik" class="form-label">Nama topik</label>
                            <input type="text" class="@error('nama_topik') is-invalid @enderror form-control border-tosca" id="nama_topik" name="nama_topik" required value="{{ old('nama_topik', $topik->nama_topik ?? '') }}">
                            @error('nama_topik')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <input type="hidden" name="acak_soal" value="0">
                            <input class="form-check-input" type="checkbox" id="acak_soal" name="acak_soal" value="1" {{ $item->acak_soal ? 'checked' : '' }}>
                            <label class="form-check-label" for="acak_soal">Detail Hasil</label>

                        </div>

                        <div class="col-sm-6">
                            <label for="batas_waktu" class="form-label">batas_waktu topik</label>
                            <textarea class="form-control @error('batas_waktu') is-invalid @enderror" id="batas_waktu" name="batas_waktu" required>{{ old('batas_waktu', $topik->batas_waktu ?? '') }}</textarea>
                            @error('batas_waktu')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror

                            <input type="hidden" name="acak_jawaban" value="0">
                            <input class="form-check-input" type="checkbox" id="acak_jawaban" name="acak_jawaban" value="1" {{ $topik->acak_jawaban ? 'checked' : '' }}>
                            <label class="form-check-label" for="acak_jawaban">Detail Hasil</label>

                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn" style="background-color: #FF5900; color: white;">Update</button>
                <button type="button" class="btn btn-outline-orange" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach