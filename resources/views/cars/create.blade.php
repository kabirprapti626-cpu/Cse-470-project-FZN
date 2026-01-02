<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Car</title>

    <style>
        * {
            box-sizing: border-box;
            font-family: "Poppins", "Segoe UI", sans-serif;
        }

        body {
            margin: 0;
            min-height: 100vh;

            /* Dark overlay + image */
            background:
                linear-gradient(
                    rgba(5, 10, 20, 0.78),
                    rgba(5, 10, 20, 0.78)
                ),
                url("/design/design1.jpg");

            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;

            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .glass-card {
            width: 100%;
            max-width: 560px;
            padding: 36px;
            border-radius: 22px;

            background: rgba(255, 255, 255, 0.16);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);

            box-shadow:
                0 30px 60px rgba(0, 0, 0, 0.45),
                inset 0 0 0 1px rgba(255, 255, 255, 0.22);

            animation: rise 0.6s ease;
        }

        h1 {
            text-align: center;
            margin-bottom: 28px;
            color: #ffffff;
            font-weight: 700;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-size: 14px;
            font-weight: 600;
            color: #e6ecff;
        }

        input, select {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 18px;

            border-radius: 14px;
            border: none;
            outline: none;

            background: rgba(255, 255, 255, 0.9);
            font-size: 14px;

            transition: 0.25s ease;
        }

        input:focus, select:focus {
            transform: translateY(-1px);
            box-shadow: 0 0 0 3px rgba(0, 160, 255, 0.55);
        }

        input[type="file"] {
            background: rgba(255, 255, 255, 0.95);
            cursor: pointer;
        }

        button {
            width: 100%;
            padding: 16px;
            margin-top: 8px;

            border: none;
            border-radius: 16px;

            background: linear-gradient(
                135deg,
                #00b4ff,
                #0066ff
            );

            color: white;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: 0.6px;

            cursor: pointer;
            transition: 0.35s ease;
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow:
                0 14px 30px rgba(0, 102, 255, 0.65);
        }

        .success {
            background: rgba(0, 255, 170, 0.18);
            color: #00ffbf;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 18px;
            text-align: center;
            font-weight: 600;
        }

        .errors {
            background: rgba(255, 80, 80, 0.2);
            color: #ffb3b3;
            padding: 12px;
            border-radius: 10px;
            margin-bottom: 18px;
        }

        .errors ul {
            margin: 0;
            padding-left: 18px;
        }

        @keyframes rise {
            from {
                opacity: 0;
                transform: translateY(35px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>

    <div class="glass-card">
        <h1>Add New Car</h1>

        @if(session('success'))
            <div class="success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="errors">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/cars') }}" enctype="multipart/form-data">
            @csrf

            <label>Seller ID</label>
            <input type="number" name="seller_id" required>

            <label>Car Name</label>
            <input type="text" name="name" required>

            <label>Model</label>
            <input type="text" name="model" required>

            <label>For Rent</label>
            <select name="for_rent" required>
                <option value="1">Yes</option>
                <option value="0">No</option>
            </select>

            <label>Buy Price</label>
            <input type="number" name="buy_price">

            <label>Rent Price</label>
            <input type="number" name="rent_price">

            <label>Car Image</label>
            <input type="file" name="image" accept="image/*" required>

            <button type="submit">Add Car</button>
        </form>
    </div>

</body>
</html>
