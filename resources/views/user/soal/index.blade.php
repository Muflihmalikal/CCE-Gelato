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
        <!-- HEADER DETAIL UJIAN -->
        <div class="ujian-header text-center">
            <h2 class="text-start">{{ $ujian->judul }}</h2>
            <h4 class="text-start">Topik: {{ $topik->nama_topik }}</h4>
            <h5 class="text-end"> {{ $siswa->kelas->nama_kelas }} - {{ $siswa->kelas->asal_sekolah }}</h5>
        </div>
        
        <div class="row">
            <!-- KOTAK SOAL -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <span>Soal <span id="nomor-soal"></span> dari {{ count($topik->soal) }}</span>
                        <span id="timer" class="timer-badge">{{ $topik->batas_waktu * 60 }} detik</span>
                    </div>
                    <div class="card-body">
                        <p id="teks-soal"></p>
                        <form id="form-jawaban">
                            @csrf
                            <div id="jawaban-container"></div>
                            <input type="hidden" name="jawaban" id="jawabanInput">
                        </form>
                    </div>
                    <div class="card-footer d-flex justify-content-between">
                        <button id="prev-soal" class="btn btn-secondary">Sebelumnya</button>
                        <button id="next-soal" class="btn btn-primary">Selanjutnya</button>
                    </div>
                </div>
            </div>
            
            <!-- KOTAK NOMOR SOAL -->
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
        let waktuSisa = {{ $topik->batas_waktu * 60 }};
        let soalData = @json($topik->soal);
        let jawabanPengguna = {};
    
        // Tampilkan soal sesuai index
        function tampilkanSoal(index) {
            let soal = soalData[index];
            $("#nomor-soal").text(index + 1);
            $("#teks-soal").text(soal.teks_soal);
            $("#jawaban-container").html("");
    
            // Tampilkan pilihan jawaban
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
    
            // Disable tombol jika di soal pertama/terakhir
            $("#prev-soal").prop("disabled", index === 0);
            $("#next-soal").prop("disabled", index === soalData.length - 1);
        }
    
        // Simpan jawaban ke object
        $(document).on("change", ".jawaban-input", function() {
            let soalId = $(this).data("soal");
            let jawaban = $(this).val();
            jawabanPengguna[soalId] = jawaban;
            $(`#nomor-${soalId}`).removeClass("btn-secondary").addClass("btn-primary");
        });
    
        // Navigasi soal
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
    
        // Tampilkan nomor soal di sidebar
        soalData.forEach((soal, index) => {
            $("#nomor-soal-container").append(`
                <button id="nomor-${soal.id}" class="btn btn-secondary m-1 nomor-soal-btn"
                data-index="${index}">${index + 1}</button>
            `);
        });
    
        // Navigasi dengan klik nomor soal
        $(document).on("click", ".nomor-soal-btn", function() {
            soalIndex = $(this).data("index");
            tampilkanSoal(soalIndex);
        });
    
        // Selesai ujian
        $("#selesai-ujian").click(() => {
            $("#jawabanInput").val(JSON.stringify(jawabanPengguna));
    
            $.post("{{ route('soal.selesai') }}", {
                _token: "{{ csrf_token() }}",
                jawaban: JSON.stringify(jawabanPengguna)
            });
        });

        function formatWaktu(seconds) {
            let jam = Math.floor(seconds / 3600);
            let menit = Math.floor((seconds % 3600) / 60);
            let detik = seconds % 60;

            if (jam > 0) {
                return `${jam.toString().padStart(2, '0')} : ${menit.toString().padStart(2, '0')} : ${detik.toString().padStart(2, '0')}`;
            } else {
                return `${menit.toString().padStart(2, '0')} : ${detik.toString().padStart(2, '0')}`;
            }
        }

        function updateTimer() {
            waktuSisa--;
            $("#timer").text(formatWaktu(waktuSisa));

            if (waktuSisa <= 0) {
                $("#selesai-ujian").click();
            }
        }
    
        // Load soal pertama
        $(document).ready(() => {
            tampilkanSoal(soalIndex);
            $("#timer").text(formatWaktu(waktuSisa));
            setInterval(updateTimer, 1000);
        });
    </script>
    
</body>
</html>
