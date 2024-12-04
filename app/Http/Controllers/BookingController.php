<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Driver;
use App\Models\HistoryBooking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Services\WhatsAppNotificationService;

class BookingController extends Controller
{
    protected $whatsAppService;

    public function __construct(WhatsAppNotificationService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    public function index(Request $request)
    {
        $drivers = Driver::where('status', 'active')->get();
        $selectedDriverId = $request->query('driver_id');
        return view('customerss.booking', compact('drivers', 'selectedDriverId'));
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
            'note' => 'nullable|string',
        ]);

        // Get the driver
        $driver = Driver::findOrFail($validatedData['driver_id']);

        // Check if the driver is available for booking
        if (!$driver->isAvailable()) {
            return redirect()->back()->withErrors(['driver_id' => 'The selected driver is not available for booking.']);
        }

        // Create a booking
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
            'note' => $validatedData['note'],
        ]);

        // Mark the driver as booked
        $driver->markAsBooked();

        // Send WhatsApp notification to the driver
        $message = "New booking, Driver: " . $driver->name . "\n"
            . "Destination: " . $validatedData['destination'] . "\n"
            . "Pickup Location: " . $validatedData['pickup_location'] . "\n"
            . "Date and Time: " . $validatedData['booking_datetime'] . "\n"
            . "Passenger: " . $validatedData['passenger'];
        
        $this->whatsAppService->sendWhatsAppMessage('+6281394975823', $message);


        return redirect()->route('welcome', $booking);
    }

    public function history()
    {
        $customer = Auth::guard('customer')->user();
        $bookings = Booking::where('customer_id', $customer->id)->get();

        return view('customerss.history', compact('bookings'));
    }

    public function success(Booking $booking)
    {
        return view('booking.success', compact('booking'));
    }

    public function markAsDone(Booking $booking)
    {
        $booking->update(['status' => 'done']);

        $booking->driver->markAsAvailable();

        HistoryBooking::create([
            'booking_id' => $booking->id,
            'completed_at' => now(),
            'notes' => 'Booking marked as done.'
        ]);

        return redirect()->route('booking.history')->with('success', 'Booking marked as done.');
    }

    public function markAsCancel(Booking $booking)
    {
        $booking->update(['status' => 'cancelled']);

        $booking->driver->markAsAvailable();

        HistoryBooking::create([
            'booking_id' => $booking->id,
            'completed_at' => now(),
            'notes' => 'Booking marked as cancelled.'
        ]);

        return redirect()->route('booking.history')->with('success', 'Booking marked as cancelled.');
    }
}
