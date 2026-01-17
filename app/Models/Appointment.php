<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'available_service_id',
        'appointment_date',
        'appointment_time',
        'location_type',
        'address',
        'special_requests',
        'price',
        'status'
    ];
    
    protected $casts = [
        'appointment_date' => 'date',
        'price' => 'decimal:2'
    ];
    
    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function service()
    {
        return $this->belongsTo(AvailableService::class);
    }
}