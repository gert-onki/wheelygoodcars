<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function create()
    {
        return view('cars.create'); // Show the initial form
    }

    public function checkLicense(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|unique:cars,license_plate',
        ]);

        // Simulate retrieving car data based on the license plate
        $carData = [
            'brand' => 'Default Brand',
            'model' => 'Default Model',
        ];

        return response()->json($carData); // Return dummy data for now
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_plate' => 'required|string|unique:cars,license_plate',
            'brand' => 'required|string',
            'model' => 'required|string',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
        ]);

        Car::create([
            'user_id' => auth()->id(),
            'license_plate' => $request->license_plate,
            'brand' => $request->brand,
            'model' => $request->model,
            'price' => $request->price,
            'mileage' => $request->mileage,
        ]);

        return redirect()->route('cars.create')->with('success', 'Car added successfully!');
    }
}

