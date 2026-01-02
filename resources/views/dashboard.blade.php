<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Car Store</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #fff;
            background: url('{{ asset('design/design2.1.jpg') }}') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
            color: #ffffff;
            text-shadow: 0 2px 8px rgba(0,0,0,0.6);
        }

        .header h1 {
            font-size: 34px;
            font-weight: 600;
        }

        .header p {
            font-size: 16px;
            color: #d1d5db;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .card {
            background: rgba(0,0,0,0.6);
            border-radius: 18px;
            padding: 32px;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            color: #fff;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 35px 65px rgba(0,0,0,0.3);
        }

        .card.profile-card {
            background: url('{{ asset('design/design3.jpg') }}') no-repeat center center;
            background-size: cover;
        }

        .card.other-card {
            background: url('{{ asset('design/design4.jpg') }}') no-repeat center center;
            background-size: cover;
        }

        .card h2 {
            font-size: 22px;
            font-weight: 600;
            margin-bottom: 18px;
        }

        .actions {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .actions li {
            margin-bottom: 12px;
        }

        .actions a {
            display: block;
            padding: 12px 16px;
            border-radius: 12px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            color: #111827;
            background: rgba(255,255,255,0.85);
            transition: all 0.15s ease;
        }

        .actions a:hover {
            background: rgba(37,99,235,0.9);
            color: #fff;
            box-shadow: 0 10px 22px rgba(37,99,235,0.35);
        }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="container">

    <div class="header">
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p>Role: {{ ucfirst(auth()->user()->role) }}</p>
    </div>

    <div class="grid">

        <!-- Profile -->
        <div class="card profile-card">
            <h2>My Profile</h2>
            <ul class="actions">
                <li><a href="{{ route('profile.edit') }}">Profile</a></li>
            </ul>
        </div>

        @if(auth()->user()->role === 'seller')
            <!-- Seller -->
            <div class="card other-card">
                <h2>Seller Dashboard</h2>
                <ul class="actions">
                    <li><a href="{{ route('cars.index') }}">View All Cars</a></li>
                    <li><a href="{{ route('cars.my') }}">My Cars</a></li>
                    <li><a href="{{ route('cars.create') }}">Add New Car</a></li>

                    @php
                        $buyCount = \App\Models\Request::whereHas('car', function($q) {
                            $q->where('seller_id', auth()->id());
                        })->where('type', 'buy')->where('status', 'pending')->count();

                        $rentCount = \App\Models\Request::whereHas('car', function($q) {
                            $q->where('seller_id', auth()->id());
                        })->where('type', 'rent')->where('status', 'pending')->count();
                    @endphp

                    <li>
                        <a href="{{ route('requests.index') }}">
                            View Requests
                            @if($buyCount + $rentCount > 0)
                                (Buy: {{ $buyCount }} | Rent: {{ $rentCount }})
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        @endif

        @if(auth()->user()->role === 'user')
            <!-- User -->
            <div class="card other-card">
                <h2>User Dashboard</h2>
                <ul class="actions">
                    <li><a href="{{ route('cars.browse') }}">Buy / Rent Cars</a></li>
                    <li><a href="{{ route('cars.index') }}">View All Cars</a></li>
                    <li><a href="{{ route('requests.user') }}">My Requested Cars</a></li>
                </ul>
            </div>
        @endif

    </div>
</div>

</body>
</html>
