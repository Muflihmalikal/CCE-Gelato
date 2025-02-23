<div class="modal fade" id="soal-add" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="exampleModalLabel" style="color: white">Tambah Data Soal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('soal.store') }}" method="POST">
                    @csrf
            
                    <!-- Pilih Topik -->
                    <div class="mb-3">
                        <label for="topik_id" class="form-label">Topik</label>
                        <select class="form-control" name="topik_id" id="topik" value="" required>
                            <option value="">-- Pilih Topik --</option>
                            @foreach ($topik as $t)
                            <option value="{{ $t->id }}">{{ $t->nama_topik }}</option>
                            @endforeach
                        </select>
                    </div>
            
                    <!-- Pilih Tipe Soal -->
                    <div class="mb-3">
                        <label for="tipe" class="form-label">Tipe Soal</label>
                        <select class="form-control" name="tipe" id="tipe" required>
                            <option value="">-- Pilih Tipe Soal --</option>
                            <option value="pilihan_ganda">Pilihan Ganda</option>
                            <option value="jawaban_singkat">Jawaban Singkat</option>
                            <option value="essay">Essay</option>
                        </select>
                    </div>
            
                    <!-- Pertanyaan -->
                    <div class="mb-3">
                        <label for="teks_soal" class="form-label">Pertanyaan</label>
                        <input type="text" class="form-control" name="teks_soal" required>
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
        </div>
    </div>
</div>
 
@push('script')
    <script>
        // Jalankan saat modal dibuka
        $('#soal-add').on('shown.bs.modal', function () {
            let tipeSelect = document.getElementById('tipe');
            let pilihanGandaFields = document.getElementById('pilihanGandaFields');
            let jawabanBenarField = document.getElementById('jawabanBenarField');

            // Fungsi untuk menampilkan/menyembunyikan field berdasarkan tipe soal
            function updateFormFields() {
                if (tipeSelect.value === 'pilihan_ganda') {
                    pilihanGandaFields.style.display = 'block';
                    jawabanBenarField.style.display = 'none';
                } else {
                    pilihanGandaFields.style.display = 'none';
                    jawabanBenarField.style.display = 'block';
                }
            }

            // Panggil fungsi saat modal dibuka untuk mengatur tampilan awal
            updateFormFields();

            // Tambahkan event listener untuk mendeteksi perubahan select tipe soal
            tipeSelect.addEventListener('change', updateFormFields);

            let filterTopik = document.getElementById("topik_id");
            let modalTopik = document.getElementById("topik");
            let openModal = document.getElementById("open-modal");

            // **Ambil ID topik dari URL**
            function getTopikIdFromUrl() {
                let url = window.location.href;
                let match = url.match(/soal\/topik\/(\d+)/);
                return match ? match[1] : null; // Ambil ID jika ada
            }

            let topikId = getTopikIdFromUrl();

            if (topikId) {
                modalTopik.value = topikId; // Set nilai di select modal
            }

            // **Ketika tombol open-modal diklik**
            openModal.addEventListener("click", function () {
                let selectedOption = filterTopik.options[filterTopik.selectedIndex];

                if (selectedOption.index > 0) { 
                    modalTopik.value = selectedOption.value; 
                } else {
                    modalTopik.value = ""; 
                }
            });
        });
    </script>
@endpush
