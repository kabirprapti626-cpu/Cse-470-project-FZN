<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Requested Cars</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            background: url("{{ asset('design/design8.png') }}") no-repeat center center fixed;
            background-size: cover;
            color: #e5e7eb;
        }

        .container { max-width: 1100px; margin: 80px auto; padding: 0 20px; }
        h1 { font-size: 32px; font-weight: 700; margin-bottom: 30px; }
        form { display: flex; gap: 12px; margin-bottom: 25px; flex-wrap: wrap; }
        select, button { padding: 10px 14px; border-radius: 10px; border: 1px solid #1f2937; background: #020617; color: #e5e7eb; font-size: 14px; }
        button { cursor: pointer; background: #2563eb; color: #fff; border: none; }
        button:hover { background: #1d4ed8; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 28px; }
        .card { background: #020617cc; border-radius: 18px; border: 1px solid #1f2937; padding: 20px; box-shadow: 0 15px 35px rgba(0,0,0,.5); }
        .card h2 { margin: 0 0 6px; font-size: 18px; font-weight: 600; }
        .card p { margin: 4px 0; font-size: 14px; }
        .status { font-weight: 600; padding: 4px 8px; border-radius: 8px; display: inline-block; margin-top: 6px; }
        .pending { background: rgba(251,191,36,0.2); color: #fbbf24; }
        .approved { background: rgba(34,197,94,0.2); color: #22c55e; }
        .rejected { background: rgba(239,68,68,0.2); color: #ef4444; }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="container">
    <h1>My Requested Cars</h1>

    <form method="GET">
        <select name="type">
            <option value="">All Types</option>
            <option value="buy" {{ request('type')=='buy'?'selected':'' }}>Buy</option>
            <option value="rent" {{ request('type')=='rent'?'selected':'' }}>Rent</option>
        </select>

        <select name="status">
            <option value="">All Status</option>
            <option value="pending" {{ request('status')=='pending'?'selected':'' }}>Pending</option>
            <option value="approved" {{ request('status')=='approved'?'selected':'' }}>Approved</option>
            <option value="rejected" {{ request('status')=='rejected'?'selected':'' }}>Rejected</option>
        </select>

        <button type="submit">Filter</button>
    </form>

    @if($requests->count())
        <div class="grid">
            @foreach($requests as $req)
            <div class="card">
                <h2>{{ $req->car->name }}</h2>
                <p>Model: {{ $req->car->model }}</p>
                <p>Type: {{ ucfirst($req->type) }}</p>
                <p>Status: <span class="status {{ $req->status }}">{{ ucfirst($req->status) }}</span></p>
            </div>
            @endforeach
        </div>
    @else
        <p>No requests found.</p>
    @endif
</div>

</body>
</html>
