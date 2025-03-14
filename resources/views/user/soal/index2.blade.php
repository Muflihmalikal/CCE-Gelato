<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Soal Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div></div>
    <div></div>
</body>
<body>
    <div style="text-align: center;">
        {{-- <h2>{{ $exam->name }}</h2> --}}
        <h2>Ujian Matematika</h2>
        <p>Sisa Waktu: <span id="timer"></span></p>
    </div>
    <div style="display: flex; justify-content: space-between;">
        <div style="width: 60%; border: 1px solid black; padding: 10px;">
            <h3>Soal </h3>
            <p></p>
            {{-- <form action="{{ route('exam.show', $question + 1) }}" method="GET"> --}}
                <button type="submit">Selanjutnya</button>
            {{-- </form> --}}
        </div>
        <div style="width: 35%; border: 1px solid black; padding: 10px;">
            <h3>Nomor Soal</h3>
            {{-- @foreach($questions as $index => $q)
                <a href="{{ route('exam.show', $index + 1) }}" style="margin: 5px; padding: 5px; border: 1px solid black; display: inline-block;">{{ $index + 1 }}</a>
            @endforeach --}}
            {{-- <form action="{{ route('exam.submit') }}" method="POST" style="margin-top: 10px;">
                @csrf --}}
                <button type="submit">Selesai</button>
            {{-- </form> --}}
        </div>
    </div>
    {{-- <script>
        let duration = {{ $exam->duration }} * 60;
        function updateTimer() {
            let minutes = Math.floor(duration / 60);
            let seconds = duration % 60;
            document.getElementById('timer').textContent = `${minutes}:${seconds}`;
            duration--;
            if (duration < 0) {
                alert('Waktu habis!');
                document.forms[1].submit();
            }
        }
        setInterval(updateTimer, 1000);
    </script> --}}

    {{ $ujian->judul }} <br>
    {{ $topik->nama_topik }} <br>
    {{ $siswa->nama }} <br>
    {{ $siswa->kelas->nama_siswa }} <br>
    {{ $soal->teks_soal }} <br>
    @foreach ($topik->soal as $item)
        {{ $item->teks_soal }} <br>
    @endforeach
    @foreach ($soal->pilihanJawaban as $jawaban)
        {{ $jawaban->teks_pilihan }} <br>
    @endforeach
</body>
</html>