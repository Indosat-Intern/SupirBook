<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'car_type',
        'phone',
        'status',
        'photo',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isAvailable()
    {
        return $this->status === 'active';
    }

    public function markAsBooked()
    {
        $this->update(['status' => 'booked']);
    }

    public function markAsAvailable()
    {
        $this->update(['status' => 'active']);
    }
}
