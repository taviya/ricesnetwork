<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RewardHistory extends Model
{
    use HasFactory;

    protected $table = 'reward_history';

    protected $fillable = [
        'user_id',
        'order_id',
        'amount',
    ];
}
