<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            * {
                font-family: 'Poppins';
            }
            html, body {
                background-color: #DDF7E3;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            body {
                height: 50% !important;
            }
            
            ul {
                list-style: none;
                margin: 0px;
            }
            input[type=text], input[type=password] {
                display: block;
                width: 77%;
                margin-left: 10.5%;
                margin-top: 6%;
                margin-bottom: 2%;
                min-width: 100px;
                height: 30px;
                padding: 4px;
                padding-right: 4px;
                padding-left: 4px;
                border: none;
                border-radius: 2px;
                background-color: #c7e8ca;
                border-bottom: 2px solid #4a7d47;
                font-size: 18px;
                z-index: 3;
            }

            input[type=text]:focus, input[type=password]:focus {
                outline: none;
            }

            input[type=text]:autofill, input[type=password]:autofill {
                background-color: #6da66a !important;
            }

            .loginDiv {
                position: relative;
                margin: auto;
                margin-top: 18vh;
            width: clamp(350px, 30%, 420px);
                height: clamp(400px, 50%, 450px);
                background-color: #C7E8CA;
                border-radius: 35px;
                box-sizing: content-box;
                box-shadow: 0 0 20px -8px #4a7d47;
            }

            .login {
            position: absolute;
                bottom: 32px;
                left: 5%;
                width: 90%;
            padding: 10px;
            background-color: #4a7d47;
            color: white;
            border: none;
            cursor: pointer;
                border-radius: 15px;
                font-size: 18px;
                box-shadow: 0 0 10px -5px #2D5C29;
                transition: all 0.1s;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                    -ms-user-select: none;
                        user-select: none;
            }

            .login:hover {
                bottom: 31px;
                font-size: 20px;
                background-color: #5D9C59;
                transition: all 0.1s;
                box-shadow: 0 0 20px -2px #2D5C29;
            }

            .login:active {
                bottom: 32px;
                font-size: 18px;
                background-color: #385e35;
                transition: all 0.1s;
                box-shadow: 0 0 10px -7px #2D5C29;
            }

            h1 {
                text-align: center;
                padding-top: 24px;
                font-family: 'Poppins';
                padding-bottom: 15px;
                color: #253e24;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                    -ms-user-select: none;
                        user-select: none;
            }

            label {
                position: relative;
                top: -40px;
                margin-left: 10.5%;
                font-size: 18px;
                z-index: 0;
                transition: all 0.4s;
            pointer-events: none;
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                    -ms-user-select: none;
                        user-select: none;
            }

            #password:focus ~ label, #password:valid ~ label {
                font-size: 14px;
                top: -70px;
                transition: all 0.2s;
                color: #4a7d47;
            }

            #email:focus ~ label,
            #email:valid ~ label {
                font-size: 14px;
                top: -70px;
                transition: all 0.2s;
                color: #4a7d47;
            }

            #email:valid ~ .error {
                display: none;
            }

            .inputField {
                height: 60px;
            }

            .error {
                display: none;
                width: 80%;
                margin: auto;
                color: #DF2E38;
                margin-top: -20px;
            }

            input[aria-invalid="true"] {
            border-bottom: 2px solid #DF2E38;
            }

            .modal {
            display: none; 
            position: fixed; 
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%;
            }

            .modal-content {
                position: relative;
                background-color: #C7E8CA;
                border-radius: 35px;
                box-shadow: 0 0 25px -8px #1a4d17;
            margin: 15% auto; 
                margin-top: 15vh;
            padding: 20px;
            border: none;
            width: clamp(300px, 40%, 800px);
                height: clamp(350px, 50%, 800px);
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                    -ms-user-select: none;
                        user-select: none;
            }

            span {
                display: block;
                text-align: center;
                color: #253e24;
                width: 100%;
                padding-bottom: 24px;s
            }

            #smile {
                font-size: 80px;
                margin-top: -15px;
            }

            @keyframes shake {
                0% {transform: translateX(-10px);}
                20% {transform: translateX(10px);}
                40% {transform: translateX(-10px);}
                60% {transform: translateX(10px);}
                80% {transform: translateX(0px);}
            }
        </style>
    </head>
    <body class="font-sans antialiased dark:bg-black dark:text-white/50">
        
        <div class="loginDiv" id="loginDiv">
            <form action="{{ route('auth.login.post') }}" method="POST">
                @csrf
                <h1>Login</h1>
                <div class="inputField">
                    <input type="text" id="email" name="email" required/>
                    <label>Email</label>
                </div>
                <div class="inputField">
                    <input type="password" id="password" name="password" required/>
                    <label>Password</label>
                </div>
                <button type="submit" id="login" class="login">Login</button>
            </form>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
                @if(session()->has('loginError'))
                    {{ session()->get('loginError') }}
                @endif
                @if(session()->has('logout'))
                    {{ session()->get('logout') }}
                @endif
            </ul>
        </div>
    </body>
</html>
