<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Car Store') }}</title>

    <!-- Fonts (CDN only, NO Node) -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Minimal CSS (safe) -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background: #f3f4f6;
            margin: 0;
        }
        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .box {
            width: 100%;
            max-width: 420px;
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 15px;
            font-weight: bold;
            font-size: 22px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="box">
        <div class="logo">
            Car Store
        </div>

        {{ $slot }}
    </div>
</div>

</body>
</html>
