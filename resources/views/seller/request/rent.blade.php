@extends('layouts.app')

@section('content')
<h2>Rent Requests</h2>

@if($requests->count())
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Car</th>
                <th>Rent Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr>
                <td>{{ $req->user->name }} ({{ $req->user->email }})</td>
                <td>{{ $req->car->name }}</td>
                <td>{{ $req->car->rent_price }}</td>
                <td>{{ ucfirst($req->status) }}</td>
                <td>
                    @if($req->status === 'pending')
                    <form method="POST" action="{{ route('seller.requests.approve', $req->id) }}">
                        @csrf
                        <button type="submit">Approve</button>
                    </form>
                    @elseif($req->status === 'approved' && $req->car->rent_status === 'rented')
                        <form method="POST" action="{{ route('seller.rent.available', $req->car->id) }}">
                            @csrf
                            <button type="submit">Available for Rent Again</button>
                        </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
<p>No rent requests yet.</p>
@endif
@endsection
