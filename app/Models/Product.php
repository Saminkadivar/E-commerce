<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'vendor_id',
        'name',
        'description',
        'price',
        'stock',
        'category_id',
        'image_path',
    ];

    /**
     * The category this product belongs to
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * The vendor who owns this product
     */
    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }



    // Product has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
