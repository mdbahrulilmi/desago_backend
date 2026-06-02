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
            padding-left: 10px;
            margin-bottom: 20px;
            border-radius: 20px;
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
                alt="User Icon">
        </div>
        <div class="text-center mt-4 name" style="margin-top: 20px;margin-bottom: 20px;">
            Reset Password - DESAGO
        </div>
        <form class="p-3 mt-3" action="{{ route('password.update') }}" method="POST">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <input type="password" name="password" id="password" placeholder="Masukkan Password Baru">
            </div>
            <input type="hidden" name="email" id="email" value="{{ request('email') }}" placeholder="Masukkan Password Baru">
            <input type="hidden" value="{{$token}}" name="token" id="">

            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi Password">
            </div>
            @if(session('success'))
            <div style="text-align: center;" class="p-4 mb-4 text-sm text-green-800 bg-green-100 rounded-lg" role="alert" style="color: rgb(0, 0, 0);font-weight:bold;">
                {{ session('success') }}
            </div>
            {{ session()->forget('success') }}
            @endif

            @if(session('error'))
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-100 rounded-lg" role="alert" style="background-color: red;color: white;font-weight:bold;">
                    {{ session('error') }}
                </div>
                {{ session()->forget('error') }}
            @endif
            <button class="btn mt-3">SUBMIT</button>
        </form>
    </div>
</body>

</html>