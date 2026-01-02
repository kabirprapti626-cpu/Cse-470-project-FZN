<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Car Store</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, #2c3e50, #bdc3c7);
        }
        .container {
            width: 900px;
            height: 500px;
            display: flex;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }
        .left {
            flex: 1;
            background: rgba(20,20,20,0.85);
            color: #fff;
            padding: 60px;
        }
        .left h2 { color: #FFD700; margin-bottom: 10px; }
        .left input {
            width: 100%;
            padding: 14px;
            margin-bottom: 15px;
            background: #222;
            border: none;
            border-radius: 8px;
            color: #fff;
        }
        button {
            width: 100%;
            padding: 14px;
            background: #FFD700;
            border: none;
            border-radius: 8px;
            font-weight: bold;
        }
        .right {
            flex: 1;
            background: url('{{ asset("loginsignup/image1.jpg") }}') center/cover no-repeat;
        }
        .error { color: #ff4d4d; }
        .success { color: #4CAF50; }
    </style>
</head>
<body>

<div class="container">
    <div class="left">
        <h2>Login</h2>

        @if(session('error')) <p class="error">{{ session('error') }}</p> @endif
        @if(session('success')) <p class="success">{{ session('success') }}</p> @endif

        <form method="POST" action="{{ route('login.perform') }}">
            @csrf
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button>Login</button>
        </form>

        <p style="margin-top:15px">
            <a href="{{ route('register.show') }}" style="color:#FFD700">Create account</a>
        </p>
    </div>
    <div class="right"></div>
</div>

</body>
</html>
