@extends('layouts.app')

@section('content')
    <div>
        <h1>Add a Car for Sale</h1>

        <!-- Step 1: License Plate -->
        <form id="license-form">
            @csrf
            <label for="license_plate">License Plate:</label>
            <input type="text" id="license_plate" name="license_plate" required>
            <button type="button" id="check-license">Next</button>
        </form>

        <!-- Step 2: Car Details -->
        <form id="car-details-form" action="{{ route('cars.store') }}" method="POST" style="display: none;">
            @csrf
            <input type="hidden" name="license_plate" id="license_plate_hidden">
            <label for="brand">Brand:</label>
            <input type="text" id="brand" name="brand" required>
            <label for="model">Model:</label>
            <input type="text" id="model" name="model" required>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>
            <label for="mileage">Mileage:</label>
            <input type="number" id="mileage" name="mileage" required>
            <button type="submit">Add Car</button>
        </form>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('check-license').addEventListener('click', async function() {
        const licensePlate = document.getElementById('license_plate').value;

        const response = await fetch("{{ route('cars.checkLicense') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ license_plate: licensePlate }),
        });

        if (response.ok) {
            const data = await response.json();
            document.getElementById('brand').value = data.brand;
            document.getElementById('model').value = data.model;

            document.getElementById('license_plate_hidden').value = licensePlate;

            document.getElementById('license-form').style.display = 'none';
            document.getElementById('car-details-form').style.display = 'block';
        } else {
            alert('License plate is invalid or already exists.');
        }
    });
</script>
@endpush
