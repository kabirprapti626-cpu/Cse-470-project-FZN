<!DOCTYPE html>
<html>
<head>
    <title>Car Requests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: url("{{ asset('design/design9.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            color: #e5e7eb;
        }

        .content {
            margin: 20px;
            background: rgba(0,0,0,0.65);
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.7);
        }

        h1 {
            margin-top: 0;
            color: #f9fafb;
            text-shadow: 0 2px 10px rgba(0,0,0,0.6);
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
            background: linear-gradient(180deg, #020617, #000);
            color: #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #1f2937;
            padding: 10px;
            text-align: center;
        }

        th {
            background: linear-gradient(90deg, #1e3a8a, #2563eb);
            color: #ffffff;
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }

        tr:hover td {
            background: rgba(37,99,235,0.15);
        }

        .buttons {
            margin-bottom: 20px;
        }

        .buttons a {
            display: inline-block;
            margin-right: 10px;
            padding: 12px 18px;
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 600;
            box-shadow: 0 10px 25px rgba(37,99,235,0.4);
            transition: all 0.25s ease;
        }

        .buttons a:hover {
            transform: translateY(-2px);
            background: linear-gradient(135deg, #1e40af, #4338ca);
            box-shadow: 0 16px 35px rgba(79,70,229,0.55);
        }

        select {
            padding: 6px;
            background: #020617;
            color: #e5e7eb;
            border: 1px solid #334155;
            border-radius: 6px;
        }

        button {
            padding: 6px 14px;
            background: linear-gradient(135deg, #22c55e, #16a34a);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-weight: 600;
            cursor: pointer;
        }

        button:hover {
            background: linear-gradient(135deg, #16a34a, #15803d);
        }

        .success {
            color: #22c55e;
            font-weight: 600;
        }
    </style>
</head>
<body>

    @include('layouts.navigation')

    <div class="content">
        <h1>Car Requests</h1>

        @if(session('success'))
            <p class="success">{{ session('success') }}</p>
        @endif

        <div class="buttons">
            <a href="{{ route('requests.buy') }}">View Buy Requests</a>
            <a href="{{ route('requests.rent') }}">View Rent Requests</a>
        </div>

        @if($requests->count())
        <table>
            <tr>
                <th>Request ID</th>
                <th>User</th>
                <th>Car</th>
                <th>Type</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            @foreach($requests as $request)
            <tr>
                <td>{{ $request->id }}</td>
                <td>{{ $request->user->name }}</td>
                <td>{{ $request->car->name }}</td>
                <td>{{ ucfirst($request->type) }}</td>
                <td>{{ ucfirst($request->status) }}</td>
                <td>
                    @if($request->status == 'pending')
                        <form method="POST" action="{{ url('/requests/'.$request->id.'/status') }}">
                            @csrf
                            <select name="status">
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
            @endforeach
        </table>
        @else
            <p>No requests found.</p>
        @endif
    </div>

</body>
</html>
