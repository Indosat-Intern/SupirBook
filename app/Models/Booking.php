<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'driver_id',
        'customer_division',
        'customer_phone',
        'booking_datetime',
        'destination',
        'pickup_location',
        'passenger',
        'note',
        'status'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function historyBooking()
    {
        return $this->hasOne(HistoryBooking::class);
    }
}
