<!DOCTYPE html>
<html>
<head>
    <title>All Cars</title>
</head>
<body>
    <h1>All Cars</h1>

    <a href="{{ url('/cars/create') }}">Add New Car</a>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Seller</th>
            <th>Name</th>
            <th>Model</th>
            <th>For Rent</th>
            <th>Buy Price</th>
            <th>Rent Price</th>
        </tr>
        @foreach($cars as $car)
        <tr>
            <td>{{ $car->seller->name }}</td>
            <td>{{ $car->name }}</td>
            <td>{{ $car->model }}</td>
            <td>{{ $car->for_rent ? 'Yes' : 'No' }}</td>
            <td>{{ $car->buy_price ?? '-' }}</td>
            <td>{{ $car->rent_price ?? '-' }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>
