<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FuelMaintenanceOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'order_id',
        'tx_id',
        'status',
    ];

    public function getProduct() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
