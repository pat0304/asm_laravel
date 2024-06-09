<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
        'address',
        'user_id',
        'amount',
        'total',
        'status'

    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class);
    }
}