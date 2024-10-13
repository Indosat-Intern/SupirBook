<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use Illuminate\Support\Facades\Auth;


use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $drivers = Driver::where('status', 'active')->get();
        return view('customerss.booking', compact('drivers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'booking_datetime' => 'required|date_format:Y-m-d\TH:i',
            'pickup_location' => 'required|string',
            'destination' => 'required|string',
            'customer_division' => 'required|string',
            'customer_phone' => 'required|string',
            'passenger' => 'required|string',
        ]);

        $booking = Booking::create([
            'customer_id' => auth('customer')->id(),
            'driver_id' => $validatedData['driver_id'],
            'booking_datetime' => $validatedData['booking_datetime'],
            'pickup_location' => $validatedData['pickup_location'],
            'destination' => $validatedData['destination'],
            'customer_division' => $validatedData['customer_division'],
            'customer_phone' => $validatedData['customer_phone'],
            'passenger' => $validatedData['passenger'],
            'status' => 'pending',
        ]);

        // dd($booking);

        // return redirect()->route('booking.success', $booking);
        return redirect()->route('welcome', $booking);
    }

    public function history()
    {
        // Fetch bookings for the authenticated customer
        $customer = Auth::guard('customer')->user();
        $bookings = Booking::where('customer_id', $customer->id)->get();

        // Pass bookings data to the view
        return view('customerss.history', compact('bookings'));
    }

    public function success(Booking $booking)
    {
        return view('booking.success', compact('booking'));
    }
}
