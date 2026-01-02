<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Uploaded Cars</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family:'Inter', sans-serif;
            margin:0;
            padding:20px;
            background:#f0f4f8;
        }
        h1 { text-align:center; margin-bottom:30px; color:#111827; }
        .car-grid {
            display:grid;
            grid-template-columns:repeat(auto-fill,minmax(300px,1fr));
            gap:25px;
        }
        .car-card {
            background:#fff;
            border-radius:20px;
            overflow:hidden;
            box-shadow:0 12px 28px rgba(0,0,0,0.06);
            transition:0.3s;
        }
        .car-card:hover {
            transform:translateY(-5px);
            box-shadow:0 18px 38px rgba(0,0,0,0.12);
        }
        .car-image {
            width:100%;
            height:180px;
            object-fit:cover;
        }
        .car-content {
            padding:16px;
        }
        .car-name { font-weight:700; font-size:18px; margin-bottom:5px; }
        .car-model { color:#6b7280; margin-bottom:10px; }
        .badge {
            padding:5px 12px;
            border-radius:999px;
            font-size:12px;
            font-weight:600;
        }
        .yes { background:#ecfdf5; color:#047857; }
        .no { background:#fef2f2; color:#b91c1c; }
        .action-buttons {
            margin-top:10px;
            display:flex;
            gap:8px;
        }
        .btn {
            padding:6px 12px;
            border-radius:8px;
            font-size:12px;
            text-decoration:none;
            color:#fff;
            text-align:center;
        }
        .edit { background:#2563eb; }
        .delete { background:#ef4444; border:none; cursor:pointer; }
        @media(max-width:600px){
            .car-grid { grid-template-columns:1fr; }
        }
    </style>
</head>
<body>

<h1>My Uploaded Cars</h1>

<div class="car-grid">
    @forelse($cars as $car)
        <div class="car-card">
            <img class="car-image" src="{{ $car->image ? asset('storage/' . $car->image) : 'https://via.placeholder.com/400x250' }}" alt="Car Image">
            <div class="car-content">
                <div class="car-name">{{ $car->name }}</div>
                <div class="car-model">Model: {{ $car->model }}</div>
                <span class="badge {{ $car->for_rent ? 'yes' : 'no' }}">
                    {{ $car->for_rent ? 'For Rent' : 'Not for Rent' }}
                </span>

                <div class="action-buttons">
                    <a href="{{ route('cars.edit', $car->id) }}" class="btn edit">Edit</a>
                    <form method="POST" action="{{ route('cars.destroy', $car->id) }}" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn delete" onclick="return confirm('Are you sure you want to delete this car?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <p style="grid-column:1/-1; text-align:center; color:#6b7280;">No cars uploaded yet.</p>
    @endforelse
</div>

</body>
</html>
