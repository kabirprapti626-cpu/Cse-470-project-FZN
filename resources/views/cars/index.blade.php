<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Cars</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #e5e7eb;
            background: linear-gradient(180deg, #020617, #020617ee);
        }

        .container {
            max-width: 1300px;
            margin: 90px auto;
            padding: 0 20px;
        }

        /* TOP BAR */
        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 36px;
            flex-wrap: wrap;
            gap: 20px;
        }

        h1 {
            font-size: 30px;
            font-weight: 700;
            color: #f9fafb;
        }

        .add-btn {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            padding: 12px 22px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            border: 1px solid #1f2937;
        }

        .add-btn:hover {
            background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
        }

        /* GRID */
        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 28px;
            align-items: stretch;
        }

        /* CARD */
        .car-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #020617, #020617cc);
            border-radius: 20px;
            border: 1px solid #1f2937;
            overflow: hidden;
            box-shadow: 0 25px 50px rgba(0,0,0,.6);
        }

        /* IMAGE */
        .car-image {
            width: 100%;
            height: 190px;
            object-fit: cover;
            border-bottom: 1px solid #1f2937;
        }

        /* CONTENT */
        .car-content {
            padding: 22px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .seller {
            font-size: 13px;
            color: #9ca3af;
            margin-bottom: 8px;
        }

        .car-name {
            font-size: 18px;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 4px;
        }

        .car-model {
            font-size: 14px;
            color: #9ca3af;
            margin-bottom: 14px;
        }

        /* BADGE */
        .badge {
            align-self: flex-start;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            border-radius: 999px;
            margin-bottom: 16px;
        }

        .yes {
            background: rgba(34,197,94,.15);
            color: #22c55e;
        }

        .no {
            background: rgba(239,68,68,.15);
            color: #ef4444;
        }

        /* PRICE ROW */
        .price-row {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            gap: 10px;
        }

        .price {
            font-size: 14px;
            font-weight: 600;
            color: #e5e7eb;
        }

        @media(max-width: 600px) {
            h1 { font-size: 24px; }
            .car-image { height: 160px; }
        }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="container">

    <div class="top-bar">
        <h1>All Cars</h1>

        {{-- Seller only --}}
        @if(auth()->user()->role === 'seller')
            <a href="{{ route('cars.create') }}" class="add-btn">
                + Add New Car
            </a>
        @endif
    </div>

    <div class="car-grid">

        @foreach($cars as $car)
            <div class="car-card">

                <img
                    class="car-image"
                    src="{{ $car->image ? asset('storage/' . $car->image) : 'https://via.placeholder.com/400x250' }}"
                    alt="Car Image"
                >

                <div class="car-content">
                    <div class="seller">
                        Seller: <strong>{{ $car->seller->name }}</strong>
                    </div>

                    <div class="car-name">{{ $car->name }}</div>
                    <div class="car-model">Model: {{ $car->model }}</div>

                    <span class="badge {{ $car->for_rent ? 'yes' : 'no' }}">
                        {{ $car->for_rent ? 'For Rent' : 'Not for Rent' }}
                    </span>

                    <div class="price-row">
                        <div class="price">
                            Buy: {{ $car->buy_price ? '৳'.$car->buy_price : '-' }}
                        </div>

                        <div class="price">
                            Rent: {{ $car->rent_price ? '৳'.$car->rent_price : '-' }}
                        </div>
                    </div>
                </div>

            </div>
        @endforeach

    </div>
</div>

</body>
</html>
