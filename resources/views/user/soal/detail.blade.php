<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Detail Ujian</title>
</head>
<body>
    <div style="display: flex; justify-content: space-between;">
        @if(isset($siswa) && isset($ujian))
            <div style="width: 60%; border: 1px solid black; padding: 10px;">
                <h2>Detail Ujian</h2>
                    <p>Nama Ujian : {{ $ujian->judul }}</p>
                    <p>Deskripsi Ujian : {{ $ujian->deskripsi }}</p>
                    <p>Tanggal Mulai : {{ $ujian->waktu_mulai }}</p>
                    <p>Tenggat Ujian : {{ $ujian->waktu_selesai }}</p>
                    {{-- @php
                        // Menghitung durasi dalam jam
                        $startTime = \Carbon\Carbon::parse($ujian->waktu_mulai);
                        $endTime = \Carbon\Carbon::parse($ujian->waktu_selesai);
                        $durationInHours = $endTime->diffInHours($startTime);
                    @endphp --}}
                
                    <p>Sisa Waktu : <span id="timer"></span></p>
                    <p>Topik Ujian</p>
                    <ul>
                        @php
                            $totalWaktu = 0; // Inisialisasi variabel untuk menyimpan total waktu
                        @endphp

                        @foreach ($ujian->topik as $topik)
                            <li>{{ $topik->nama_topik }} : {{ $topik->batas_waktu }} Menit</li>
                            @php
                                $totalWaktu += $topik->batas_waktu; // Menambahkan batas_waktu ke total
                            @endphp
                        @endforeach
                    </ul>
                    <p>Total Waktu Ujian : <span id="waktu">{{ $totalWaktu }} Menit</span></p>
            </div>
            <div style="width: 35%; border: 1px solid black; padding: 10px;">
                <h2>Detail Siswa</h2>
                <p>Nama Siswa : {{ $siswa->nama }}</p>
                <p>Email Siswa : {{ $siswa->email }}</p>
                <p>Kelas Siswa : {{ $siswa->kelas->nama_kelas }}</p>
                <p>Sekolah Siswa : {{ $siswa->kelas->asal_sekolah }}</p>
            </div>
        @else
            <center>Data Siswa Hilang atau Terhapus</center>
        @endif
    </div>

    <script>
        // Ambil waktu akhir dari PHP
        const endDate = new Date("{{ $ujian->waktu_selesai }}").getTime();

        // Update countdown setiap detik
        const timer = setInterval(() => {
            const now = new Date().getTime();
            const diff = endDate - now;

            // Jika waktu habis, hentikan timer
            if (diff <= 0) {
                clearInterval(timer);
                document.getElementById('timer').innerHTML = "Waktu habis!";
                return;
            }

            // Menghitung hari, jam, menit, dan detik
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);

            // Menampilkan hasil
            document.getElementById('timer').innerHTML = `${days} hari ${hours} jam ${minutes} menit ${seconds} detik tersisa`;
        }, 1000); // Memperbarui setiap detik
    </script>

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