<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f8ff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div style="background-color: #ffffff; border: 1px solid #007bff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 300px;">
        <h1 style="color: #007bff; text-align: center;">Form Pendaftaran</h1>

        @if(session('success'))
            <p style="color: green; text-align: center; margin-bottom: 15px;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <label for="nis" style="color: #333; margin-top: 10px;">NIS:</label>
            <input type="text" id="nis" name="nis" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <label for="name" style="color: #333; margin-top: 10px;">Nama:</label>
            <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <label for="email" style="color: #333; margin-top: 10px;">Email:</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <label for="password" style="color: #333; margin-top: 10px;">Kata Sandi:</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <input type="submit" value="Daftar" style="background-color: #007bff; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; width: 100%;">
        </form>
    </div>
</body>
</html><!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f8ff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    <div style="background-color: #ffffff; border: 1px solid #007bff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 300px;">
        <h1 style="color: #007bff; text-align: center;">Form Pendaftaran</h1>

        @if(session('success'))
            <p style="color: green; text-align: center; margin-bottom: 15px;">{{ session('success') }}</p>
        @endif

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            {{-- <label for="nis" style="color: #333; margin-top: 10px;">NIS:</label>
            <input type="text" id="nis" name="nis" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;"> --}}

            <label for="name" style="color: #333; margin-top: 10px;">Nama:</label>
            <input type="text" id="name" name="name" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <label for="email" style="color: #333; margin-top: 10px;">Email:</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <label for="password" style="color: #333; margin-top: 10px;">Kata Sandi:</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <input type="submit" value="Daftar" style="background-color: #007bff; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; width: 100%;">
        </form>
    </div>
</body>
</html>