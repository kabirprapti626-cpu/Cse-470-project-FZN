<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as CarRequest;
use App\Models\Car;

class SellerRequestController extends Controller
{
    // Show menu: Buy or Rent Requests
    public function index()
    {
        return view('seller.requests.index');
    }

    // Show buy requests for the seller's cars
    public function buyRequests()
    {
        $requests = CarRequest::whereHas('car', function ($q) {
            $q->where('seller_id', auth()->id());
        })->where('type', 'buy')->with('user', 'car')->get();

        return view('seller.requests.buy', compact('requests'));
    }

    // Show rent requests for the seller's cars
    public function rentRequests()
    {
        $requests = CarRequest::whereHas('car', function ($q) {
            $q->where('seller_id', auth()->id());
        })->where('type', 'rent')->with('user', 'car')->get();

        return view('seller.requests.rent', compact('requests'));
    }

    // Approve a request
    public function approve(CarRequest $request)
    {
        // Only seller can approve
        if ($request->car->seller_id !== auth()->id()) {
            abort(403);
        }

        $request->status = 'approved';
        $request->save();

        // Update car status
        if ($request->type === 'buy') {
            $request->car->sale_status = 'sold';
            $request->car->rent_status = 'not-available';
        } else { // rent
            $request->car->rent_status = 'rented';
        }
        $request->car->save();

        return back()->with('success', 'Request approved successfully!');
    }
}
