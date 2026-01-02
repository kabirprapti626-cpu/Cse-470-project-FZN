<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Car Store') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Basic CSS -->
    <style>
        body { font-family: 'Figtree', sans-serif; background: #f3f4f6; margin: 0; }
        header { background: white; padding: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); display:flex; justify-content:space-between; align-items:center; }
        main { padding: 20px; }
        nav a, nav button { margin-left: 15px; text-decoration: none; color: #1f2937; font-weight: 500; background:none; border:none; cursor:pointer; font-size:1rem; }
        nav button:hover, nav a:hover { color: #FFD700; }
    </style>
</head>
<body>
<div class="min-h-screen">

    {{-- Navigation --}}
    <header>
        <div>
            <a href="{{ url('/') }}">{{ config('app.name', 'Car Store') }}</a>
        </div>
        <nav>
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>

                {{-- Logout button --}}
                <form method="POST" action="{{ route('logout') }}" style="display:inline">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register.show') }}">Register</a>
            @endauth
        </nav>
    </header>

    {{-- Page Heading --}}
    @isset($header)
        <header>{{ $header }}</header>
    @endisset

    {{-- Page Content --}}
    <main>{{ $slot }}</main>
</div>
</body>
</html>
