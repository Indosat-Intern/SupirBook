<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryBooking extends Model
{
    use HasFactory;

    protected $fillable = ['booking_id', 'completed_at', 'notes'];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
    
}
