<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Car Store Dashboard</title>

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
            color: #1f2937;
        }

        .container {
            max-width: 1100px;
            margin: 80px auto;
            padding: 0 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 60px;
        }

        .header h1 {
            font-size: 34px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 16px;
            color: #6b7280;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .card {
            background: #ffffff;
            border-radius: 18px;
            padding: 32px;
            box-shadow:
                0 25px 50px rgba(0,0,0,0.08),
                0 1px 0 rgba(255,255,255,0.7) inset;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 35px 65px rgba(0,0,0,0.12);
        }

        .card h2 {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 18px;
            color: #111827;
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
            color: #1f2937;
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            transition: all 0.15s ease;
        }

        .actions a:hover {
            background: #2563eb;
            color: #ffffff;
            border-color: #2563eb;
            box-shadow: 0 10px 22px rgba(37,99,235,0.25);
        }
    </style>
</head>
<body>

    <div class="container">

        <div class="header">
            <h1>Welcome to Car Store</h1>
            <p>Manage cars, requests, and transactions in one place</p>
        </div>

        <div class="grid">

            <!-- Seller Actions -->
            <div class="card">
                <h2>Seller Actions</h2>
                <ul class="actions">
                    <li><a href="{{ url('/cars') }}">View All Cars</a></li>
                    <li><a href="{{ url('/cars/create') }}">Add New Car</a></li>
                    <li><a href="{{ url('/requests') }}">View Requests</a></li>
                </ul>
            </div>

            <!-- User Actions -->
            <div class="card">
                <h2>User Actions</h2>
                <ul class="actions">
                    <li><a href="{{ url('/requests/create') }}">Request to Buy / Rent a Car</a></li>
                    <li><a href="{{ url('/cars') }}">Browse Cars</a></li>
                </ul>
            </div>

        </div>
    </div>

</body>
</html>
