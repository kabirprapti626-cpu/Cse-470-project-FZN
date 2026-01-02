<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>

    <style>
        * { box-sizing: border-box; margin:0; padding:0; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background:#0d0d0d; color:#fff; min-height:100vh; padding:20px; }

        /* NAVIGATION BAR */
        .navbar {
            width: 100%;
            max-width: 900px;
            margin: 0 auto 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background:#111;
            padding:15px 25px;
            border-radius:12px;
            box-shadow:0 4px 12px rgba(0,0,0,0.5);
        }
        .navbar .brand { font-weight:700; color:#00fff7; font-size:1.1rem; }
        .navbar .nav-links { display:flex; gap:20px; align-items:center; }
        .navbar a, .navbar form button {
            color:#00fff7;
            font-weight:600;
            text-decoration:none;
            background:none;
            border:none;
            cursor:pointer;
            font-size:0.95rem;
        }
        .navbar form { display:inline-flex; align-items:center; margin:0; padding:0; }

        /* CARD */
        .card { background:#1a1a1a; border-radius:25px; border:1px solid #333; max-width:900px; width:100%; padding:50px; margin:0 auto; box-shadow:0 10px 30px rgba(0,0,0,0.7); }
        h1,h2 { text-align:center; margin-bottom:25px; font-weight:700; letter-spacing:1px; }
        h2 { font-size:1.7rem; margin-top:15px; }

        .info-grid { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:20px; margin-bottom:40px; }
        .info-box { background:#222; padding:20px; border-radius:16px; border:1px solid #333; text-align:center; transition:0.3s; }
        .info-box:hover { transform:translateY(-6px); box-shadow:0 0 15px rgba(0,255,247,0.3); }
        .info-box span { display:block; font-size:0.9rem; color:#aaa; }
        .info-box strong { font-size:1.1rem; color:#00fff7; }

        form { margin-bottom:40px; }
        label { display:block; margin-bottom:6px; font-weight:600; color:#ccc; }
        input[type="text"], input[type="password"], input[type="file"] { width:100%; padding:12px 15px; border-radius:12px; border:1px solid #444; background:#2a2a2a; color:#fff; margin-bottom:20px; transition:0.3s; }
        input:focus { outline:none; border-color:#00fff7; box-shadow:0 0 10px #00fff7; }

        button { width:100%; padding:15px; border-radius:12px; border:none; font-weight:bold; cursor:pointer; transition:0.3s; font-size:1rem; }
        .btn-update-profile { background:linear-gradient(90deg,#00f2ff,#0066ff); color:#fff; }
        .btn-update-profile:hover { transform:scale(1.05); box-shadow:0 0 15px #00f2ff; }
        .btn-update-password { background:linear-gradient(90deg,#00ff99,#00b377); color:#fff; }
        .btn-update-password:hover { transform:scale(1.05); box-shadow:0 0 15px #00ff99; }
        .btn-delete { background:#ff3333; color:#fff; }
        .btn-delete:hover { transform:scale(1.05); box-shadow:0 0 15px #ff3333; }

        hr { border:0; border-top:1px solid #333; margin:40px 0; }

        .flash-success { background:#00b377; padding:12px; border-radius:12px; text-align:center; font-weight:bold; margin-bottom:20px; }
        .flash-error { background:#ff4d4d; padding:12px; border-radius:12px; margin-bottom:20px; }
        .flash-error ul { padding-left:20px; }

        .profile-img { width:150px; height:150px; border-radius:50%; border:3px solid #00fff7; object-fit:cover; margin-bottom:15px; transition:0.3s; }
        .profile-img:hover { transform:scale(1.05); box-shadow:0 0 20px #00fff7; }
        .text-center { text-align:center; }

        @media(max-width:600px){ .card{padding:30px;} h2{font-size:1.4rem;} .navbar{flex-direction:column; gap:10px; text-align:center;} }
    </style>
</head>
<body>

<!-- TOP NAVIGATION BAR -->
<div class="navbar">
    <div class="brand">Car Store</div>
    <div class="nav-links">
        <a href="{{ route('dashboard') }}">Dashboard</a>
        @if(auth()->user()->role === 'seller')
            <a href="{{ url('/my-cars') }}">My Cars</a>
        @endif
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    </div>
</div>

<div class="card">

    <h1>Profile</h1>

    {{-- FLASH --}}
    @if(session('status'))
        <div class="flash-success">
            {{ str_replace('-', ' ', ucfirst(session('status'))) }}!
        </div>
    @endif

    {{-- ERRORS --}}
    @if ($errors->any())
        <div class="flash-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- PROFILE INFO --}}
    <div class="info-grid">
        <div class="info-box">
            <span>User ID</span>
            <strong>#{{ $user->id }}</strong>
        </div>

        <div class="info-box">
            <span>Email</span>
            <strong>{{ $user->email }}</strong>
        </div>

        @if($user->role === 'seller')
            <div class="info-box">
                <span>Seller ID</span>
                <strong>SELL-{{ $user->id }}</strong>
            </div>
        @endif
    </div>

    {{-- UPDATE PROFILE --}}
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        <div class="text-center">
            <img class="profile-img"
                 src="{{ $user->profile_image ? asset($user->profile_image) : 'https://via.placeholder.com/150' }}">
            <label>Change Profile Picture</label>
            <input type="file" name="profile_image" accept="image/*">
        </div>

        <label>Name</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label>Email</label>
        <input type="text" name="email" value="{{ $user->email }}" required>

        <button class="btn-update-profile">Update Profile</button>
    </form>

    <hr>

    {{-- CHANGE PASSWORD --}}
    <form method="POST" action="{{ route('profile.password') }}">
        @csrf
        <h2>Change Password</h2>

        <label>Current Password</label>
        <input type="password" name="current_password" required>

        <label>New Password</label>
        <input type="password" name="password" required>

        <label>Confirm New Password</label>
        <input type="password" name="password_confirmation" required>

        <button class="btn-update-password">Update Password</button>
    </form>

    <hr>

    {{-- DELETE ACCOUNT --}}
    <form method="POST" action="{{ route('profile.destroy') }}">
        @csrf
        @method('DELETE')
        <h2>Delete Account</h2>

        <label>Confirm Password</label>
        <input type="password" name="password" required>

        <button class="btn-delete">Delete Account</button>
    </form>

</div>

</body>
</html>
