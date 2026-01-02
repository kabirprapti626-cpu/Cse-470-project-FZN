@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Requests Dashboard</h1>

    <div style="margin-top:20px;">
        <a href="{{ route('requests.buy') }}" class="btn btn-primary">Buy Requests ({{ $buyCount }})</a>
        <a href="{{ route('requests.rent') }}" class="btn btn-success">Rent Requests ({{ $rentCount }})</a>
    </div>
</div>
@endsection
