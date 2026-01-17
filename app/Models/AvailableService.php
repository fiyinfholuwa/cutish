<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AvailableService extends Model
{
    protected $guarded = ['id'];

    public function service()
{
    return $this->belongsTo(AvailableService::class, 'available_service_id');
}

}
