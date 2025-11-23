<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_item extends Model
{
    //cart_item_id	cart_id	product_id	quantity	added_at
    protected $table = 'cart_items';
    protected $primaryKey = 'cart_item_id';
    protected $fillable = ['cart_id', 'product_id', 'quantity'];
    public $timestamps = false;

    public function cart()
    {
        return $this->belongsTo(Cart::class, 'cart_id', 'cart_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
