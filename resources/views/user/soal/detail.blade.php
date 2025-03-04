<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Ujian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row">
            @if(isset($siswa) && isset($ujian))
                <div class="col-md-7">
                    <div class="card shadow-lg border-0" style="border-radius: 10px;">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Detail Ujian</h4>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr><td><p><strong>Nama Ujian </strong></p></td> <td><p> : {{ $ujian->judul }}</p></td></tr>
                                <tr><td><p><strong>Deskripsi </strong></p></td> <td><p> : {{ $ujian->deskripsi }}</p></td></tr>
                                <tr><td><p><strong>Mulai </strong></p></td> <td><p> : {{ $ujian->waktu_mulai }}</p></td></tr>
                                <tr><td><p><strong>Selesai </strong></p></td> <td><p> : {{ $ujian->waktu_selesai }}</p></td></tr>
                                <tr><td><p><strong>Sisa Waktu </strong></p></td> <td><p> : <span id="timer" class="fw-bold text-danger"></span></p></td></tr>
                            </table>
                            <table class="table table-bordered text-center">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Topik</th>
                                        <th>Waktu</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ujian->topik as $topik)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $topik->id }}</td>
                                            <td>{{ $topik->nama_topik }}</td>
                                            <td>{{ $topik->batas_waktu }} Menit</td>
                                            <td>
                                                <a href="{{ route('soal.index', ['topik_id' => $topik->id]) }}" class="btn btn-primary btn-sm">
                                                    <i class="bi bi-pencil-square"></i> Mulai
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card shadow-lg border-0" style="border-radius: 10px;">
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Detail Siswa</h4>
                        </div>
                        <div class="card-body">
                            <table>
                                <tr><td><p><strong>Nama</strong></p></td><td><p> : {{ $siswa->nama }}</p></td></tr>
                                <tr><td><p><strong>Email</strong></p></td><td><p> : {{ $siswa->email }}</p></td></tr>
                                <tr><td><p><strong>Password</strong></p></td><td><p> : {{ $siswa->kata_sandi }}</p></td></tr>
                                <tr><td><p><strong>Kelas</strong></p></td><td><p> : {{ $siswa->kelas->nama_kelas }}</p></td></tr>
                                <tr><td><p><strong>Sekolah</strong></p></td><td><p> : {{ $siswa->kelas->asal_sekolah }}</p></td></tr>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-12 text-center">
                    <div class="alert alert-danger">Data Siswa Hilang atau Terhapus</div>
                </div>
            @endif
        </div>
    </div>

    <script>
        const endDate = new Date("{{ $ujian->waktu_selesai }}").getTime();
        const timer = setInterval(() => {
            const now = new Date().getTime();
            const diff = endDate - now;
            if (diff <= 0) {
                clearInterval(timer);
                document.getElementById('timer').innerHTML = "Waktu habis!";
                return;
            }
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            document.getElementById('timer').innerHTML = `${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;
        }, 1000);
    </script>
</body>
</html>


    {{-- script time berjalan sesuai awal dan akhir waktu tapi gabisa lek jam e sama --}}
    {{-- <script>
        // Mengonversi durasi jam ke milidetik
        let totalHours = {{ $durationInHours }};
        if(totalHours == 0){
            let totalMilliseconds = 1 * 60 * 60 * 1000; // konversi ke milidetik
        }else{
            let totalMilliseconds = totalHours * 60 * 60 * 1000; // konversi ke milidetik
        }

        let countdown = totalMilliseconds;

        const timer = setInterval(function() {
            // Menghitung waktu yang tersisa
            let days = Math.floor(countdown / (1000 * 60 * 60 * 24)); // Menghitung hari
            let hours = Math.floor((countdown % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)); // Menghitung jam
            let minutes = Math.floor((countdown % (1000 * 60 * 60)) / (1000 * 60)); // Menghitung menit
            let seconds = Math.floor((countdown % (1000 * 60)) / 1000); // Menghitung detik

            // Menampilkan hasil di elemen dengan id "timer"
            document.getElementById("timer").innerHTML = hours + " jam " + minutes + " menit " + seconds + " detik ";

            // Mengurangi waktu yang tersisa
            countdown -= 1000;

            // Jika waktu habis, tampilkan pesan dan hentikan timer
            if (countdown < 0) {
                clearInterval(timer);
                document.getElementById("timer").innerHTML = "Waktu habis!";
            }
        }, 1000);
    </script> --}}

    {{-- script time mandek --}}
    {{-- <script>
        // Ambil waktu tenggat ujian dari PHP dan konversi ke format yang dapat digunakan JavaScript
        const endTime = new Date("{{ $ujian->waktu_selesai }}").getTime();
    
        // Update timer setiap detik
        const timer = setInterval(function() {
            // Dapatkan waktu sekarang
            const now = new Date("{{ $ujian->waktu_mulai }}").getTime();
    
            // Hitung selisih waktu antara waktu sekarang dan waktu tenggat
            const distance = endTime - now;
    
            // Hitung waktu dalam jam, menit, dan detik
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
            // Tampilkan hasil di elemen dengan id "timer"
            document.getElementById("timer").innerHTML = hours + " jam " + minutes + " menit " + seconds + " detik ";
    
            // Jika waktu habis, tampilkan pesan dan hentikan timer
            if (distance < 0) {
                clearInterval(timer);
                document.getElementById("timer").innerHTML = "Waktu habis!";
                // Anda bisa menambahkan logika tambahan di sini, seperti mengarahkan pengguna ke halaman lain
            }
        }, 1000);
    </script> --}}
</body>
</html>