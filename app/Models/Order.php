<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $fillable=
    [
        'user_id',
        'total_amount',
        'status',
        'payment_ref',
        'paid_at',
        'shipping_address'
    ];

    protected $casts=
    [
        'paid_at'=>'datetime'
    ];


    public function user(){ return $this->belongsTo(User::class); }
    
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
