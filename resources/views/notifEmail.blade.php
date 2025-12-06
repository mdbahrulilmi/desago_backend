<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap-theme.min.css" integrity="sha384-6pzBo3FDv/PJ8r2KRkGHifhEocL+1X2rVCTTkUfGk7/0pbek5mMa1upzvWbrUbOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/Loopple/loopple-public-assets@main/motion-tailwind/motion-tailwind.css" rel="stylesheet">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
        /* Importing fonts from Google */
        
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');
        /* Reseting */
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background: #ecf0f3;
        }
        
        .wrapper {
            max-width: 350px;
            min-height: 400px;
            margin: 80px auto;
            padding: 40px 30px 30px 30px;
            background-color: #ecf0f3;
            border-radius: 15px;
            box-shadow: 13px 13px 20px #cbced1, -13px -13px 20px #fff;
        }
        
        .logo {
            width: 80px;
            margin: auto;
        }
        
        .logo img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0px 0px 3px #5f5f5f, 0px 0px 0px 5px #ecf0f3, 8px 8px 15px #a7aaa7, -8px -8px 15px #fff;
        }
        
        .wrapper .name {
            font-weight: 600;
            font-size: 1.4rem;
            letter-spacing: 1.3px;
            padding-left: 10px;
            color: #555;
        }
        
        .wrapper .form-field input {
            width: 100%;
            display: block;
            border: none;
            outline: none;
            background: none;
            font-size: 1.2rem;
            color: #666;
            padding: 10px 15px 10px 10px;
            /* border: 1px solid red; */
        }
        
        .wrapper .form-field {
            padding-left: 20px;
            padding-right: 20px;
            margin-bottom: 20px;
            border-radius: 20px;
            min-height: 200px;
            padding-top: 30px;
            text-align: center;
            box-shadow: inset 8px 8px 8px #cbced1, inset -8px -8px 8px #fff;
        }
        
        .wrapper .form-field .fas {
            color: #555;
        }
        
        .wrapper .btn {
            box-shadow: none;
            width: 100%;
            height: 40px;
            background-color: #03A9F4;
            color: #fff;
            border-radius: 25px;
            box-shadow: 3px 3px 3px #b1b1b1, -3px -3px 3px #fff;
            letter-spacing: 1.3px;
        }
        
        .wrapper .btn:hover {
            background-color: #039BE5;
        }
        
        .wrapper a {
            text-decoration: none;
            font-size: 0.8rem;
            color: #03A9F4;
        }
        
        .wrapper a:hover {
            color: #039BE5;
        }
        
        @media(max-width: 380px) {
            .wrapper {
                margin: 30px 20px;
                padding: 40px 15px 15px 15px;
            }
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="logo">
            <img src="data:image/png;base64,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"
                alt="Verify Icon">
        </div>
        <div class="text-center mt-4 name" style="margin-top: 20px;margin-bottom: 20px;">
            @if ($success == true)
            Berhasil Verifikasi Email
            @else
            Gagal Verifikasi Email
            @endif
        </div>
        <form class="p-3 mt-3" action="" method="POST">

            <div class="form-field align-items-center">
                <span class="far fa-user" style="text-align: center;">
                    @if ($success == true)
                    Akun Anda kini aktif dan siap digunakan. Silakan login untuk melanjutkan.
                    @else
                    @if ($message == null)
                    Akun Anda Gagal Diverifikasi. Silahkan Mendaftar Akun Kembali
                    @else
                    Akun Anda Gagal Diverifikasi. Silahkan Mendaftar Akun Kembali <br> <br> <code>{{$message}}</code>
                    @endif
                    @endif
            </span>
            </div>
        </form>
    </div>
</body>

</html>