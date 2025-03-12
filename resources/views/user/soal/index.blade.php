<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian - {{ $topik->nama_topik }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .ujian-header {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            text-align: center;
        }

        .timer-badge {
            background-color: rgb(255, 0, 0);
            color: white;
            padding: 8px 15px;
            border-radius: 10px;
            font-weight: bold;
        }

        .btn-success {
            background-color: #28a745;
        }
    </style>
</head>

<body>

    <div class="container mt-4">
        <div class="ujian-header text-center">
            <h2 class="text-start">{{ $ujian->judul }}</h2>
            <h4 class="text-start">Topik: {{ $topik->nama_topik }}</h4>
            <h5 class="text-end"> {{ $siswa->kelas->nama_kelas }} - {{ $siswa->kelas->asal_sekolah }}</h5>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Soal <span id="nomor-soal"></span> dari {{ count($topik->soal) }}</span>
                        <span id="timer" class="timer-badge"></span>
                    </div>
                    <div class="card-body">
                        <p id="teks-soal"></p>
                        <form id="form-jawaban">
                            @csrf
                            <input type="hidden" name="topik_id" value="{{ $topik->id }}">
                            <div id="jawaban-container"></div>
                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button id="prev-soal" class="btn btn-secondary">Sebelumnya</button>
                        <button id="next-soal" class="btn btn-primary">Selanjutnya</button>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header text-center">Nomor Soal</div>
                    <div class="card-body text-center" id="nomor-soal-container"></div>
                    <div class="card-footer text-center">
                        <button id="selesai-ujian" class="btn btn-success">Selesai Ujian</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let soalIndex = 0;
        let soalData = @json($topik->soal) || [];  // Pastikan data soal tidak null
        let jawabanPengguna = JSON.parse(localStorage.getItem("jawabanPengguna_{{ $topik->id }}")) || {};
        let waktuMulaiKey = "waktuMulai_{{ $topik->id }}";
        let waktuSisaKey = "waktuSisa_{{ $topik->id }}";
        
        // Cek apakah waktu mulai sudah tersimpan di localStorage
        let waktuMulai = localStorage.getItem(waktuMulaiKey);
        if (!waktuMulai) {
            // Jika belum ada, simpan waktu mulai sekarang (dalam timestamp)
            waktuMulai = Date.now();
            localStorage.setItem(waktuMulaiKey, waktuMulai);
        } else {
            waktuMulai = parseInt(waktuMulai);
        }
    
        // Hitung sisa waktu berdasarkan waktu awal
        let batasWaktu = {{ $topik->batas_waktu }} * 60 * 1000; // dalam milidetik
        let waktuSekarang = Date.now();
        let waktuSisa = Math.max(0, (waktuMulai + batasWaktu - waktuSekarang) / 1000); // Waktu dalam detik
        waktuSisa = parseInt(waktuSisa);
    
        console.log("Data Soal:", soalData); // Debugging
    
        if (soalData.length === 0) {
            alert("Tidak ada soal tersedia untuk ujian ini.");
        }
    
        function tampilkanSoal(index) {
            if (soalData.length === 0) return; // Jangan jalankan jika tidak ada soal
            
            let soal = soalData[index];
    
            $("#nomor-soal").text(index + 1);
            $("#teks-soal").text(soal.teks_soal);
            $("#jawaban-container").html("");
    
            if (soal.tipe === "pilihan_ganda") {
                soal.pilihan_jawaban.forEach(pilihan => {
                    let checked = jawabanPengguna[soal.id] === pilihan.teks_pilihan ? "checked" : "";
                    $("#jawaban-container").append(`
                        <div>
                            <input type="radio" name="jawaban[${soal.id}]" value="${pilihan.teks_pilihan}"
                            class="jawaban-input" data-soal="${soal.id}" ${checked}>
                            ${pilihan.teks_pilihan}
                        </div>
                    `);
                });
            } else {
                let jawaban = jawabanPengguna[soal.id] || "";
                $("#jawaban-container").html(`
                    <input type="text" class="form-control jawaban-input" data-soal="${soal.id}" value="${jawaban}">
                `);
            }
    
            $("#prev-soal").prop("disabled", index === 0);
            $("#next-soal").prop("disabled", index === soalData.length - 1);
        }
    
        $(document).on("change", ".jawaban-input", function() {
            let soalId = $(this).data("soal");
            let jawaban = $(this).val();
            jawabanPengguna[soalId] = jawaban;
    
            localStorage.setItem("jawabanPengguna_{{ $topik->id }}", JSON.stringify(jawabanPengguna));
            $(`#nomor-${soalId}`).removeClass("btn-secondary").addClass("btn-primary");
        });
    
        $("#prev-soal").click(() => {
            if (soalIndex > 0) {
                soalIndex--;
                tampilkanSoal(soalIndex);
            }
        });
    
        $("#next-soal").click(() => {
            if (soalIndex < soalData.length - 1) {
                soalIndex++;
                tampilkanSoal(soalIndex);
            }
        });
    
        if (soalData.length > 0) {
            soalData.forEach((soal, index) => {
                $("#nomor-soal-container").append(`
                    <button id="nomor-${soal.id}" class="btn btn-secondary m-1 nomor-soal-btn"
                    data-index="${index}">${index + 1}</button>
                `);
            });
    
            $(document).on("click", ".nomor-soal-btn", function() {
                soalIndex = $(this).data("index");
                tampilkanSoal(soalIndex);
            });
    
            tampilkanSoal(soalIndex);
        }
    
        $("#selesai-ujian").click((e) => {
            e.preventDefault();
            $("#jawabanInput").val(JSON.stringify(jawabanPengguna));
    
            $.ajax({
                url: "{{ route('soal.selesai') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    topik_id: "{{ $topik->id }}",
                    jawaban: JSON.stringify(jawabanPengguna)
                },
                success: function(response) {
                    localStorage.removeItem("jawabanPengguna_{{ $topik->id }}");
                    localStorage.removeItem("waktuSisa_{{ $topik->id }}");
                    localStorage.removeItem(waktuMulaiKey); // Hapus waktu mulai setelah ujian selesai
                    alert("Ujian selesai! Hasil akan diproses.");
                    window.location.href = response.redirect;
                }
            });
        });
    
        function formatWaktu(seconds) {
            let menit = Math.floor(seconds / 60);
            let detik = seconds % 60;
            return `${menit.toString().padStart(2, '0')} : ${detik.toString().padStart(2, '0')}`;
        }
    
        function updateTimer() {
            let waktuSekarang = Date.now();
            let waktuSisa = Math.max(0, (waktuMulai + batasWaktu - waktuSekarang) / 1000); // Hitung sisa waktu
    
            localStorage.setItem(waktuSisaKey, waktuSisa); // Simpan sisa waktu ke localStorage
            $("#timer").text(formatWaktu(Math.floor(waktuSisa)));
    
            if (waktuSisa <= 0) {
                alert("Waktu habis! Ujian akan dikumpulkan otomatis.");
                $("#selesai-ujian").click();
            }
        }
    
        $(document).ready(() => {
            updateTimer(); // Setel timer saat halaman dimuat
            setInterval(updateTimer, 1000); // Perbarui setiap detik
        });
    </script>
    
</body>

</html>