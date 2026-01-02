<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Request as CarRequest;

class RequestController extends Controller
{
    /**
     * Show form for users to request a car
     */
    public function create()
    {
        $cars = Car::all();
        return view('requests.create', compact('cars'));
    }

    /**
     * Store a buy/rent request (user)
     */
    public function store(Request $request)
    {
        $request->validate([
            'car_id' => 'required|exists:cars,id',
            'type'   => 'required|in:buy,rent',
        ]);

        $userId = auth()->id();

        // Prevent duplicate pending requests
        $alreadyRequested = CarRequest::where('user_id', $userId)
            ->where('car_id', $request->car_id)
            ->where('type', $request->type)
            ->where('status', 'pending')
            ->exists();

        if ($alreadyRequested) {
            return redirect()->back()->with('error', 'You already have a pending request for this car.');
        }

        CarRequest::create([
            'user_id' => $userId,
            'car_id'  => $request->car_id,
            'type'    => $request->type,
            'status'  => 'pending',
        ]);

        return redirect()->back()->with('success', 'Request submitted successfully!');
    }

    /**
     * Show all requests for seller to approve/reject
     */
    public function index()
    {
        $requests = CarRequest::whereHas('car', function ($q) {
            $q->where('seller_id', auth()->id());
        })
        ->with('user', 'car')
        ->latest()
        ->get();

        return view('requests.index', compact('requests'));
    }

    /**
     * Show only Buy Requests (seller)
     */
    public function buyRequests()
    {
        $requests = CarRequest::where('type', 'buy')
            ->whereHas('car', function ($q) {
                $q->where('seller_id', auth()->id());
            })
            ->with('user', 'car')
            ->latest()
            ->get();

        return view('requests.index', compact('requests'));
    }

    /**
     * Show only Rent Requests (seller)
     */
    public function rentRequests()
    {
        $requests = CarRequest::where('type', 'rent')
            ->whereHas('car', function ($q) {
                $q->where('seller_id', auth()->id());
            })
            ->with('user', 'car')
            ->latest()
            ->get();

        return view('requests.index', compact('requests'));
    }

    /**
     * Approve or reject a request (seller)
     */
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:approved,rejected',
        ]);

        $carRequest = CarRequest::with('car')->findOrFail($id);

        // Ensure seller owns the car
        if ($carRequest->car->seller_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $carRequest->status = $request->status;
        $carRequest->save();

        // If approved, update car availability
        if ($request->status === 'approved') {
            if ($carRequest->type === 'buy') {
                $carRequest->car->sale_status = 'sold';
            }

            if ($carRequest->type === 'rent') {
                $carRequest->car->rent_status = 'rented';
            }

            $carRequest->car->save();
        }

        return redirect()->back()->with('success', 'Request status updated successfully!');
    }

    /**
     * Make a rented car available again (seller)
     */
    public function makeAvailableAgain($id)
    {
        $carRequest = CarRequest::with('car')->findOrFail($id);

        // Ensure seller owns the car
        if ($carRequest->car->seller_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if ($carRequest->type === 'rent') {
            $carRequest->car->rent_status = 'available';
            $carRequest->car->save();

            // Optionally, you can delete or mark the request as completed
            $carRequest->delete();
        }

        return redirect()->back()->with('success', 'Car is now available for rent again!');
    }

    /**
     * Show all requests made by the logged-in user
     */
    public function userRequests(Request $request)
    {
        $query = CarRequest::where('user_id', auth()->id())->with('car');

        // Optional filtering
        if ($request->type) {
            $query->where('type', $request->type); // buy or rent
        }
        if ($request->status) {
            $query->where('status', $request->status); // pending, approved, rejected
        }

        $requests = $query->latest()->get();

        return view('requests.user-requests', compact('requests'));
    }
}
