<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy a Car</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #e5e7eb;
            background:
                linear-gradient(rgba(8,10,15,.88), rgba(8,10,15,.88)),
                url("{{ asset('design/design5.jpg') }}") no-repeat center center / cover;
        }

        .container {
            max-width: 1200px;
            margin: 90px auto;
            padding: 0 20px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 35px;
            gap: 20px;
            flex-wrap: wrap;
        }

        .header h1 {
            font-size: 32px;
            font-weight: 700;
            color: #f9fafb;
        }

        .filters {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        input, select, button {
            padding: 11px 14px;
            border-radius: 12px;
            border: 1px solid #1f2937;
            background: #020617;
            color: #e5e7eb;
            font-size: 14px;
        }

        button {
            cursor: pointer;
            font-weight: 600;
            background: #1f2937;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 28px;
        }

        .card {
            background: linear-gradient(180deg, #020617, #020617cc);
            border-radius: 20px;
            overflow: hidden;
            border: 1px solid #1f2937;
            box-shadow: 0 25px 50px rgba(0,0,0,.6);
        }

        .image {
            height: 180px;
            background-size: cover;
            background-position: center;
            border-bottom: 1px solid #1f2937;
        }

        .content {
            padding: 20px;
        }

        .price {
            font-size: 20px;
            font-weight: 700;
            color: #22c55e;
        }

        .actions {
            padding: 20px;
            border-top: 1px solid #1f2937;
        }

        .buy-btn {
            width: 100%;
            padding: 12px;
            border-radius: 14px;
            border: none;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: white;
            font-size: 14px;
            font-weight: 600;
        }
    </style>
</head>
<body>

@include('layouts.navigation')

@php
use App\Models\Request as CarRequest;
@endphp

<div class="container">

    {{-- SUCCESS / ERROR MESSAGE --}}
    @if(session('success'))
        <div style="background:#16a34a;padding:14px;border-radius:10px;margin-bottom:20px;color:white;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#dc2626;padding:14px;border-radius:10px;margin-bottom:20px;color:white;">
            {{ session('error') }}
        </div>
    @endif

    <div class="header">
        <h1>Buy a Car</h1>

        <form method="GET" class="filters">
            <input type="text" name="search" placeholder="Search car name..." value="{{ request('search') }}">
            <select name="sort">
                <option value="">Default</option>
                <option value="low" {{ request('sort')=='low'?'selected':'' }}>Low → High</option>
                <option value="high" {{ request('sort')=='high'?'selected':'' }}>High → Low</option>
            </select>
            <button type="submit">Apply</button>
        </form>
    </div>

    @if($cars->count())
        <div class="grid">
            @foreach($cars as $car)
                @if($car->buy_price && $car->sale_status === 'available')

                @php
                    $requested = CarRequest::where('user_id', auth()->id())
                        ->where('car_id', $car->id)
                        ->where('type', 'buy')
                        ->where('status', 'pending')
                        ->exists();
                @endphp

                <div class="card">
                    <div class="image" style="background-image:url('{{ asset('storage/'.$car->image) }}')"></div>

                    <div class="content">
                        <h2>{{ $car->name }}</h2>
                        <div class="price">৳{{ number_format($car->buy_price,2) }}</div>
                    </div>

                    <div class="actions">
                        @if($requested)
                            <button class="buy-btn" style="background:#374151" disabled>
                                Requested
                            </button>
                        @else
                            <form method="POST" action="{{ route('requests.send') }}">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <input type="hidden" name="type" value="buy">
                                <button class="buy-btn">Buy This Car</button>
                            </form>
                        @endif
                    </div>
                </div>

                @endif
            @endforeach
        </div>
    @else
        <div style="text-align:center;padding:80px;color:#9ca3af;">
            <h2>No cars available for buying</h2>
        </div>
    @endif

</div>

</body>
</html>
