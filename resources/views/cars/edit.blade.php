<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Car</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family:'Inter', sans-serif;
            margin:0;
            padding:20px;
            background:#f0f4f8;
        }
        .container {
            max-width:600px;
            margin:0 auto;
            background:#fff;
            padding:30px;
            border-radius:20px;
            box-shadow:0 12px 28px rgba(0,0,0,0.06);
        }
        h1 { text-align:center; margin-bottom:25px; }
        label { font-weight:600; display:block; margin-bottom:6px; color:#374151; }
        input, select { width:100%; padding:12px; margin-bottom:18px; border-radius:10px; border:1px solid #ccc; }
        button {
            width:100%; padding:14px; border:none; border-radius:12px;
            background:#2563eb; color:#fff; font-weight:600; cursor:pointer; transition:0.3s;
        }
        button:hover { background:#1e40af; }
        .current-image { width:100%; height:200px; object-fit:cover; border-radius:12px; margin-bottom:15px; }
        .success { background:#d1fae5; color:#047857; padding:10px; border-radius:10px; margin-bottom:15px; text-align:center; }
        .error { background:#fee2e2; color:#b91c1c; padding:10px; border-radius:10px; margin-bottom:15px; }
    </style>
</head>
<body>

<div class="container">
    <h1>Edit Car</h1>

    @if(session('success'))
        <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label>Car Name</label>
        <input type="text" name="name" value="{{ $car->name }}" required>

        <label>Model</label>
        <input type="text" name="model" value="{{ $car->model }}" required>

        <label>For Rent</label>
        <select name="for_rent" required>
            <option value="1" {{ $car->for_rent ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ !$car->for_rent ? 'selected' : '' }}>No</option>
        </select>

        <label>Buy Price</label>
        <input type="number" name="buy_price" value="{{ $car->buy_price }}">

        <label>Rent Price</label>
        <input type="number" name="rent_price" value="{{ $car->rent_price }}">

        <label>Current Image</label>
        <img src="{{ $car->image ? asset('storage/' . $car->image) : 'https://via.placeholder.com/400x250' }}" alt="Car Image" class="current-image">

        <label>Change Image</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit">Update Car</button>
    </form>
</div>

</body>
</html>
