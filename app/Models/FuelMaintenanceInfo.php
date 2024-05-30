<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelMaintenanceInfo extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'tx_id',
        'fuel_end_time',
        'maintenance_end_time',
        'status',
    ];
}
