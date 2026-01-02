<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Rent a Car</title>

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
                url("{{ asset('design/design6.jpg') }}") no-repeat center center / cover;
        }

        .container {
            max-width: 1100px;
            margin: 90px auto;
            padding: 0 20px;
        }

        h1 {
            margin-bottom: 35px;
            font-size: 32px;
            font-weight: 700;
            color: #f9fafb;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 26px;
            align-items: stretch;
        }

        .card {
            height: 100%;
            display: flex;
            flex-direction: column;
            background: linear-gradient(180deg, #020617, #020617cc);
            border-radius: 18px;
            border: 1px solid #1f2937;
            box-shadow: 0 25px 45px rgba(0,0,0,.6);
            overflow: hidden;
        }

        .image {
            height: 180px;
            background-size: cover;
            background-position: center;
            border-bottom: 1px solid #1f2937;
            flex-shrink: 0;
        }

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }

        .content h3 {
            margin: 0 0 10px;
            font-size: 18px;
            font-weight: 600;
            color: #f9fafb;
        }

        .content p {
            margin: 5px 0;
            font-size: 14px;
            color: #9ca3af;
        }

        .price {
            font-size: 16px;
            font-weight: 700;
            color: #22c55e;
            margin-top: 10px;
        }

        .content form {
            margin-top: auto;
        }

        button {
            width: 100%;
            padding: 12px;
            margin-top: 16px;
            border: none;
            border-radius: 14px;
            background: linear-gradient(135deg, #16a34a, #15803d);
            color: white;
            font-weight: 600;
            cursor: pointer;
        }

        button:disabled {
            cursor: not-allowed;
            opacity: 0.7;
        }

        .empty {
            text-align: center;
            color: #9ca3af;
            padding: 80px 20px;
        }

        .message {
            padding: 14px;
            border-radius: 10px;
            margin-bottom: 20px;
            color: white;
        }

        .message.success { background: #16a34a; }
        .message.error { background: #dc2626; }
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
        <div class="message success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="message error">
            {{ session('error') }}
        </div>
    @endif

    <h1>Rent a Car</h1>

    <div class="grid">
        @forelse($cars as $car)

            @php
                $requested = CarRequest::where('user_id', auth()->id())
                    ->where('car_id', $car->id)
                    ->where('type', 'rent')
                    ->where('status', 'pending')
                    ->exists();
            @endphp

            <div class="card">
                <div class="image"
                     style="background-image:url('{{ $car->image ? asset('storage/'.$car->image) : 'https://via.placeholder.com/400x250' }}')">
                </div>

                <div class="content">
                    <h3>{{ $car->name }}</h3>
                    <p>Model: {{ $car->model }}</p>
                    <p class="price">Rent Price: ৳{{ number_format($car->rent_price, 2) }}</p>

                    @if($requested)
                        <button style="background:#374151" disabled>
                            Requested
                        </button>
                    @else
                        <form method="POST" action="{{ route('requests.send') }}">
                            @csrf
                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                            <input type="hidden" name="type" value="rent">
                            <button>Rent This Car</button>
                        </form>
                    @endif
                </div>
            </div>

        @empty
            <div class="empty">
                <p>No cars are available for rent right now.</p>
            </div>
        @endforelse
    </div>
</div>

</body>
</html>
