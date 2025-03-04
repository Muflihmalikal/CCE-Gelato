<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f0f8ff; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" 
            style="padding: 12px 16px; position: fixed; top: 20px; right: 20px; z-index: 9999;
                    background: rgba(40, 167, 70, 0.8); color: white; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
            <strong>✔ Berhasil!</strong> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" 
                    style="border: none; font-size: 18px; color: white; background: none; padding-left: 10px;">
                &times;
            </button>
        </div>
    @endif


    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" 
            style="padding: 12px 16px; position: fixed; top: 20px; right: 20px; z-index: 9999;
                    background: rgba(255, 62, 56, 0.801); color: white; border-radius: 8px; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);">
            <strong>⚠ Gagal!</strong> {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close" 
                    style="border: none; font-size: 18px; color: white; background: none; padding-left: 10px;">
                &times;
            </button>
        </div>
    @endif


    <div style="background-color: #ffffff; border: 1px solid #007bff; border-radius: 10px; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 300px;">
        <h1 style="color: #007bff; text-align: center;">Form Pendaftaran</h1>

        <form action="{{ route('soal.login.post') }}" method="POST">
            @csrf

            <label for="email" style="color: #333; margin-top: 10px;">Email :</label>
            <input type="email" id="email" name="email" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">
            
            <label for="password" style="color: #333; margin-top: 10px;">Password :</label>
            <input type="password" id="password" name="password" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <label for="token" style="color: #333; margin-top: 10px;">Token :</label>
            <input type="text" id="token" name="token" required style="width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #007bff; border-radius: 5px; box-sizing: border-box;">

            <input type="submit" value="Daftar" style="background-color: #007bff; color: white; border: none; padding: 10px; border-radius: 5px; cursor: pointer; width: 100%;">
        </form>
    </div>
</body>
</html>