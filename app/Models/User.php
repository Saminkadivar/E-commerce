<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
   protected $fillable = ['name','email','password','role','phone','address','bank_name','account_number','ifsc'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function products(){ return $this->hasMany(Product::class,'vendor_id'); }
    
    public function orders(){ return $this->hasMany(Order::class); }
    
    public function vendorItems(){ return $this->hasMany(OrderItem::class,'vendor_id'); }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'vendor_id');
    }

    public function orderItems()
    {   
    return $this->hasMany(OrderItem::class, 'vendor_id');   
    }
}
