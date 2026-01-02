<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Browse Cars</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: #e5e7eb;

            /* Background images */
            background:
                linear-gradient(rgba(8,10,15,0.85), rgba(8,10,15,0.85)),
                url("{{ asset('design/design 7.jpg') }}") no-repeat center center / cover;
        }

        .container {
            max-width: 900px;
            margin: 140px auto;
            padding: 0 20px;
            text-align: center;
        }

        h1 {
            font-size: 34px;
            font-weight: 700;
            color: #f9fafb;
            margin-bottom: 50px;
        }

        .actions {
            display: flex;
            gap: 32px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .action-link {
            padding: 18px 36px;
            border-radius: 16px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            color: white;
            min-width: 200px;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            box-shadow: 0 15px 35px rgba(37,99,235,.35);
            transition: 0.25s ease;
        }

        .action-link:hover {
            transform: translateY(-3px);
            box-shadow: 0 25px 50px rgba(37,99,235,.45);
        }

        .rent {
            background: linear-gradient(135deg, #16a34a, #15803d);
            box-shadow: 0 15px 35px rgba(22,163,74,.35);
        }

        .rent:hover {
            box-shadow: 0 25px 50px rgba(22,163,74,.45);
        }

        @media(max-width: 600px) {
            h1 { font-size: 28px; }
            .action-link { min-width: 150px; padding: 14px 24px; }
        }
    </style>
</head>
<body>

@include('layouts.navigation')

<div class="container">
    <h1>What do you want to do?</h1>

    <div class="actions">
        <a href="{{ route('cars.buy') }}" class="action-link">Buy a Car</a>
        <a href="{{ route('cars.rent') }}" class="action-link rent">Rent a Car</a>
    </div>
</div>

</body>
</html>
