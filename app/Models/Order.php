<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tx_id',
        'user_id',
        'product_id',
        'reward_rate',
        'maintenance_cost',
        'fuel_end_time',
        'maintenance_end_time',
        'price',
        'boost_end_time',
        'boost_x',
        'start_time',
        'last_reward_time',
        'created_at',
        'updated_at',
        'status',
    ];

    public function getProduct() {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }

}
