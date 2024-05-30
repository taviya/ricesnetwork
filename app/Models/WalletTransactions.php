<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletTransactions extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'user_id',
        'tx_id',
        'type',
        'status',
        'c_type',
        'created_at'
    ];
}
