<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function create()
    {
        return view('cars.create');
    }


    // Store method in CarController

    
    public function store(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'license_plate' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
        ]);
    
        // Add the logged-in user's ID
        $validatedData['user_id'] = Auth::id();
    
        // Create the car entry with validated data
        Car::create($validatedData);
    
        return redirect()->route('cars.index')->with('success', 'Car created successfully!');
    }
    
}

