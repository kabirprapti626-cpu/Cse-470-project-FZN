@extends('layouts.app')

@section('content')
<h2>Buy Requests</h2>

@if($requests->count())
    <table>
        <thead>
            <tr>
                <th>User</th>
                <th>Car</th>
                <th>Price</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($requests as $req)
            <tr>
                <td>{{ $req->user->name }} ({{ $req->user->email }})</td>
                <td>{{ $req->car->name }}</td>
                <td>{{ $req->car->buy_price }}</td>
                <td>{{ ucfirst($req->status) }}</td>
                <td>
                    @if($req->status === 'pending')
                    <form method="POST" action="{{ route('seller.requests.approve', $req->id) }}">
                        @csrf
                        <button type="submit">Approve</button>
                    </form>
                    @else
                        Approved
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
<p>No buy requests yet.</p>
@endif
@endsection
