@extends('layouts.layout')

@section('title', 'SupirBook - Booking')

@section('content')
<section class="booking-form-container">
    <div class="driver-photo-container">
        <img src="img/heri.jpg" alt="Driver Photo">
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
                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <label for="destination"></label>
            <input type="text" id="destination" name="destination" placeholder="Tujuan" required>
        </div>
        <div class="input-group">
            <label for="pickup_location"></label>
            <input type="text" id="pickup_location" name="pickup_location" placeholder="Titik Jemput"
                required>
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
@endsection
