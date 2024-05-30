<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'user_id',
        'tx_id',
        'wallet_address',
        'tx_hash',
        'c_type',
        'notes',
        'status',
    ];

    public function getUser() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
