@extends('layouts.layout')

@section('title', 'SupirBook - Booking')

@section('content')
    <section class="booking-form-container">
        <div class="driver-photo-container">
            <img src="" alt="Driver Photo" id="driverPhoto">
        </div>
        <form method="POST" action="{{ route('booking.store') }}" class="booking-form">
            @csrf
            <h2>Form Booking <span>Driver</span></h2>
            <div class="input-group">
                <label for="name"></label>
                <input type="text" id="name" placeholder="Nama" value="{{ auth('customer')->user()->name }}"
                    required>
            </div>
            <div class="input-group">
                <label for="driver_id"></label>
                <select id="driver_id" name="driver_id" required>
                    <option value="" disabled selected>Select a driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ $selectedDriverId == $driver->id ? 'selected' : '' }}
                            data-photo="{{ $driver->photo ? asset('storage/' . $driver->photo) : asset('storage/driver-photos/default.jpg') }}">
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="input-group">
                <label for="destination"></label>
                <input type="text" id="destination" name="destination" placeholder="Tujuan" required>
            </div>
            <div class="input-group">
                <label for="pickup_location"></label>
                <input type="text" id="pickup_location" name="pickup_location" placeholder="Titik Jemput" required>
            </div>
            <div class="input-group">
                <label for="booking_datetime"></label>
                <input type="datetime-local" id="booking_datetime" name="booking_datetime" required>
            </div>
            <div class="input-group">
                <label for="customer_division"></label>
                <input type="text" id="customer_division" name="customer_division" placeholder="Divisi"
                    value="{{ auth('customer')->user()->division }}" required>
            </div>
            <div class="input-group">
                <label for="customer_phone"></label>
                <input type="tel" id="customer_phone" name="customer_phone" placeholder="Nomor Telepone"
                    value="{{ auth('customer')->user()->phone }}" required>
            </div>
            <div class="input-group">
                <label for="passenger"></label>
                <input type="number" id="passenger" name="passenger" placeholder="Jumlah Penumpang" required>
            </div>
            <div class="input-group">
                <label for="note"></label>
                <textarea id="note" name="note" placeholder="Catatan" rows="4">{{ old('note') }}</textarea>
            </div>
            <button type="submit" class="submit-button">Submit</button>
        </form>

    </section>
    {{-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const driverSelect = document.getElementById('driver_id');
            const driverPhoto = document.getElementById('driverPhoto');

            driverSelect.addEventListener('change', function() {
                const selectedDriver = this.options[this.selectedIndex];
                const driverPhotoUrl = selectedDriver.getAttribute('data-photo');
                driverPhoto.src = driverPhotoUrl || "{{ asset('storage/driver-photos/default.jpg') }}";
            });

            // Trigger change event on page load to set initial photo
            driverSelect.dispatchEvent(new Event('change'));
        });
    </script>

@endsection


{{-- @extends('layouts.layout')

@section('title', 'SupirBook - Booking')

@section('content')
    <section class="booking-form-container">
        <div class="driver-photo-container">
            <img src="img/heri.jpg" alt="Driver Photo" id="driverPhoto">
        </div>
        <form method="POST" action="{{ route('booking.store') }}" class="booking-form">
            @csrf
            <h2>Form Booking <span>Driver</span></h2>
            <div class="input-group">
                <label for="name"></label>
                <input type="text" id="name" placeholder="Nama" value="{{ auth('customer')->user()->name }}"
                    required>
            </div>
            <div class="input-group">
                <label for="driver_id"></label>
                <select id="driver_id" name="driver_id" required>
                    <option value="">Select a driver</option>
                    @foreach ($drivers as $driver)
                        <option value="{{ $driver->id }}" {{ $selectedDriverId == $driver->id ? 'selected' : '' }}>
                            {{ $driver->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <!-- Rest of the form fields -->
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </section>


@endsection --}}
