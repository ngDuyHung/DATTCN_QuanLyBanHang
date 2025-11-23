<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //cart_id	user_id	created_at	updated_at
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    protected $fillable = ['user_id'];
    public $timestamps = true;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cartItems()
    {
        return $this->hasMany(Cart_item::class, 'cart_id', 'cart_id');
    }
}
