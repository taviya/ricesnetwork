<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Auth;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'reward_rate',
        'price',
        'qty',
        'max_buy_qty',
        'fuel_cost',
        'initial_fuel',
        'maintenance_cost',
        'initial_maintaince',
        'rarity_id',
        'size_id',
        'description',
        'img',
        'status',
    ];

    public function getSize() {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function getRarity() {
        return $this->belongsTo(Rarity::class, 'rarity_id');
    }

    public function getOrder() {
        return $this->hasOne(Order::class, 'product_id')->where('user_id', Auth::user()->id);
    }
}
