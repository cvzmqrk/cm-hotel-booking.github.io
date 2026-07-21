<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkyRoom extends Model
{
    use HasFactory;

    protected $primaryKey = 'marky_room_id';
    protected $fillable = ['marky_room_name', 'marky_room_description', 'marky_room_price'];

    // One Room has many Bookings
    public function markyBookings()
    {
        return $this->hasMany(MarkyBooking::class, 'marky_room_id', 'marky_room_id');
    }
}