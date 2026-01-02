<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Request Car</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;

            /* PREMIUM BACKGROUND */
            background:
                radial-gradient(circle at top left, rgba(37,99,235,0.06), transparent 40%),
                radial-gradient(circle at bottom right, rgba(16,185,129,0.05), transparent 40%),
                linear-gradient(180deg, #f9fafb 0%, #eef2f7 100%);

            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1f2937;
        }

        .card {
            width: 420px;
            background: #ffffff;
            border-radius: 18px;
            padding: 36px;
            box-shadow:
                0 25px 50px rgba(0,0,0,0.08),
                0 1px 0 rgba(255,255,255,0.7) inset;
        }

        h1 {
            margin: 0 0 25px 0;
            font-size: 24px;
            font-weight: 600;
            color: #111827;
            text-align: center;
        }

        .success {
            background: #ecfdf5;
            color: #047857;
            padding: 12px 14px;
            border-radius: 10px;
            font-size: 14px;
            margin-bottom: 20px;
            text-align: center;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 500;
            margin-bottom: 6px;
            color: #374151;
        }

        input, select {
            width: 100%;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid #e5e7eb;
            font-size: 14px;
            background: #ffffff;
            transition: border 0.2s ease, box-shadow 0.2s ease;
        }

        input:focus, select:focus {
            outline: none;
            border-color: #2563eb;
            box-shadow: 0 0 0 3px rgba(37,99,235,0.15);
        }

        .field {
            margin-bottom: 18px;
        }

        button {
            width: 100%;
            padding: 14px;
            border-radius: 12px;
            border: none;
            background: #2563eb;
            color: #ffffff;
            font-size: 15px;
            font-weight: 500;
            cursor: pointer;
            transition: transform 0.15s ease, box-shadow 0.15s ease, background 0.15s ease;
        }

        button:hover {
            background: #1e40af;
            box-shadow: 0 12px 24px rgba(37,99,235,0.25);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

    <div class="card">
        <h1>Request Car</h1>

        @if(session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ url('/requests') }}">
            @csrf

            <div class="field">
                <label>User ID</label>
                <input type="number" name="user_id" required>
            </div>

            <div class="field">
                <label>Car ID</label>
                <input type="number" name="car_id" required>
            </div>

            <div class="field">
                <label>Request Type</label>
                <select name="type" required>
                    <option value="buy">Buy</option>
                    <option value="rent">Rent</option>
                </select>
            </div>

            <button type="submit">
                Submit Request
            </button>
        </form>
    </div>

</body>
</html>
