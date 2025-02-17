@foreach ($ujian as $ujian)
<div class="modal fade" id="ujian-ubah-{{ $ujian->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Edit Data ujian {{ $ujian->id }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form di dalam modal -->
                <form action="{{ route('ujian.update', $ujian->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="col-sm-12">
                        <label for="judul" class="form-label">Nama ujian</label>
                        <input type="text" class="@error('judul') is-invalid @enderror form-control border-tosca" id="judul" name="judul" required value="{{ old('judul', $ujian->judul ?? '') }}">
                        @error('judul')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-sm-12">
                        <label for="deskripsi" class="form-label">Deskripsi ujian</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $ujian->deskripsi ?? '') }}</textarea>
                        @error('deskripsi')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-sm-12">
                        <label for="token" class="form-label">Token ujian</label>
                        <input class="form-control @error('token') is-invalid @enderror" id="token" name="token" required disabled value="{{ old('token', $ujian->token ?? '') }}">
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="waktu_mulai" class="form-label">Mulai ujian</label>
                            <input type="datetime-local" class="form-control" name="waktu_mulai" id="waktu_mulai"
                                value="{{ old('waktu_mulai', $ujian->waktu_mulai ? \Carbon\Carbon::parse($ujian->waktu_mulai)->format('Y-m-d H:i:s') : '') }}">
                        </div>
                        <div class="col-sm-6">
                            <label for="waktu_selesai" class="form-label">Waktu Selesai ujian</label>
                            <input type="datetime-local" class="form-control" name="waktu_selesai" id="waktu_selesai"
                                value="{{ old('waktu_selesai', $ujian->waktu_selesai ? \Carbon\Carbon::parse($ujian->waktu_selesai)->format('Y-m-d H:i:s') : '') }}">
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