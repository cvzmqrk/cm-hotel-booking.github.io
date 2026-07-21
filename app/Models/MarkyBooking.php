<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkyBooking extends Model
{
    use HasFactory;

    protected $primaryKey = 'marky_booking_id';

    protected $fillable = [
        'marky_room_id',
        'marky_customer_name',
        'marky_customer_email',
        'marky_check_in',       // Added
        'marky_check_out',      // Added
        'marky_total_price',     // Added
        'marky_confirmation_file',
    ];

    public function markyRoom()
    {
        return $this->belongsTo(MarkyRoom::class, 'marky_room_id', 'marky_room_id');
    }
}