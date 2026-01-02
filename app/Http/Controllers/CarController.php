<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    /**
     * Show all cars
     */
    public function index()
    {
        $cars = Car::with('seller')->get();
        return view('cars.index', compact('cars'));
    }

    /**
     * Entry page: Buy or Rent
     */
    public function browse()
    {
        return view('cars.browse');
    }

    /**
     * Buy cars page
     */
    public function buyCars(Request $request)
    {
        $cars = Car::where('sale_status', 'available')
            ->whereNotNull('buy_price') // Only cars with a buy price
            ->whereDoesntHave('requests', function ($q) {
                $q->where('type', 'buy')->where('status', 'approved');
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->sort, function ($q) use ($request) {
                if ($request->sort === 'low') {
                    $q->orderBy('buy_price', 'asc');
                } elseif ($request->sort === 'high') {
                    $q->orderBy('buy_price', 'desc');
                }
            })
            ->get();

        return view('cars.buy', compact('cars'));
    }

    /**
     * Rent cars page
     */
    public function rentCars(Request $request)
    {
        $cars = Car::where('for_rent', true)
            ->where('rent_status', 'available')
            ->whereDoesntHave('requests', function ($q) {
                $q->where('type', 'buy')->where('status', 'approved');
            })
            ->when($request->search, function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%');
            })
            ->when($request->sort, function ($q) use ($request) {
                if ($request->sort === 'low') {
                    $q->orderBy('rent_price', 'asc');
                } elseif ($request->sort === 'high') {
                    $q->orderBy('rent_price', 'desc');
                }
            })
            ->get();

        return view('cars.rent', compact('cars'));
    }

    /**
     * Create car form
     */
    public function create()
    {
        return view('cars.create');
    }

    /**
     * Store car
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'       => 'required|string|max:255',
            'model'      => 'required|string|max:255',
            'for_rent'   => 'required|boolean',
            'buy_price'  => 'nullable|numeric|min:0',
            'rent_price' => 'nullable|numeric|min:0',
            'image'      => 'nullable|image|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('cars', 'public');
        }

        Car::create([
            'seller_id'   => auth()->id(),
            'name'        => $request->name,
            'model'       => $request->model,
            'for_rent'    => $request->for_rent,
            'buy_price'   => $request->buy_price,
            'rent_price'  => $request->rent_price,
            'image'       => $imagePath,
            'sale_status' => 'available',
            'rent_status' => 'available',
        ]);

        return back()->with('success', 'Car added successfully!');
    }

    /**
     * Seller cars
     */
    public function myCars()
    {
        $cars = auth()->user()->cars ?? collect();
        return view('cars.my-cars', compact('cars'));
    }

    /**
     * Edit car
     */
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        abort_if($car->seller_id !== auth()->id(), 403);

        return view('cars.edit', compact('car'));
    }

    /**
     * Update car
     */
    public function update(Request $request, $id)
    {
        $car = Car::findOrFail($id);
        abort_if($car->seller_id !== auth()->id(), 403);

        $request->validate([
            'name'       => 'required|string|max:255',
            'model'      => 'required|string|max:255',
            'for_rent'   => 'required|boolean',
            'buy_price'  => 'nullable|numeric|min:0',
            'rent_price' => 'nullable|numeric|min:0',
            'image'      => 'nullable|image|max:2048',
        ]);

        $car->update($request->only(
            'name', 'model', 'for_rent', 'buy_price', 'rent_price'
        ));

        if ($request->hasFile('image')) {
            if ($car->image && file_exists(storage_path('app/public/' . $car->image))) {
                unlink(storage_path('app/public/' . $car->image));
            }
            $car->image = $request->file('image')->store('cars', 'public');
            $car->save();
        }

        return redirect()->route('cars.my')->with('success', 'Car updated successfully!');
    }

    /**
     * Delete car
     */
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        abort_if($car->seller_id !== auth()->id(), 403);

        if ($car->image && file_exists(storage_path('app/public/' . $car->image))) {
            unlink(storage_path('app/public/' . $car->image));
        }

        $car->delete();

        return redirect()->route('cars.my')->with('success', 'Car deleted successfully!');
    }
}
