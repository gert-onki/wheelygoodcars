@extends('layouts.app')

@section('content')
<div class="container">
    <h1>List Your Car for Sale</h1>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form -->
    <form method="POST" action="{{ route('cars.store') }}">
        @csrf

        <div class="mb-3">
            <label for="license_plate" class="form-label">License Plate</label>
            <input 
                type="text" 
                id="license_plate" 
                name="license_plate" 
                class="form-control @error('license_plate') is-invalid @enderror" 
                value="{{ old('license_plate') }}"
                required
            >
            @error('license_plate')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="brand" class="form-label">Brand</label>
            <input 
                type="text" 
                id="brand" 
                name="brand" 
                class="form-control @error('brand') is-invalid @enderror" 
                value="{{ old('brand') }}"
                required
            >
            @error('brand')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="model" class="form-label">Model</label>
            <input 
                type="text" 
                id="model" 
                name="model" 
                class="form-control @error('model') is-invalid @enderror" 
                value="{{ old('model') }}"
                required
            >
            @error('model')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input 
                type="number" 
                id="price" 
                name="price" 
                class="form-control @error('price') is-invalid @enderror" 
                value="{{ old('price') }}"
                required
            >
            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
