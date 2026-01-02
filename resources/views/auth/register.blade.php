<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Car Store</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');
        body {
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(to bottom, #0f2027, #203a43, #2c5364);
        }
        .container {
            width: 900px;
            height: 500px;
            display: flex;
            border-radius: 15px;
            overflow: hidden;
        }
        .left {
            flex: 1;
            padding: 50px;
            background: rgba(0,0,0,0.85);
            color: white;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            background: #1c1c1c;
            border: none;
            color: white;
        }
        button {
            padding: 12px;
            width: 100%;
            background: #FFD700;
            border: none;
            font-weight: bold;
        }
        .right {
            flex: 1;
            background: url('{{ asset("loginsignup/image2.jpg") }}') center/cover no-repeat;
        }
        .error { color: #ff4d4d; }
    </style>
</head>
<body>

<div class="container">
    <div class="left">
        <h2>Create Account</h2>

        @if ($errors->any())
            <div class="error">
                @foreach ($errors->all() as $e) <p>{{ $e }}</p> @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('register.perform') }}">
            @csrf
            <input name="name" placeholder="Full Name" required>
            <input name="email" type="email" placeholder="Email" required>
            <input name="password" type="password" placeholder="Password" required>
            <input name="password_confirmation" type="password" placeholder="Confirm Password" required>

            <select name="role" required>
                <option value="">Register as</option>
                <option value="user">User</option>
                <option value="seller">Seller</option>
            </select>

            <button>Register</button>
        </form>

        <p><a href="{{ route('login') }}" style="color:#FFD700">Login</a></p>
    </div>
    <div class="right"></div>
</div>

</body>
</html>
