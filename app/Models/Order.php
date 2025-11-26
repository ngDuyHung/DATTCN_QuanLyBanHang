<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //order_id	order_number	user_id	address_snapshot	promo_id	payment_method	shipping_fee	subtotal	discount_amount	total_amount	status	placed_at	updated_at	handled_by	

    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    protected $fillable = ['order_number', 'user_id', 'full_name', 'email', 'phone' ,'address_snapshot', 'promo_id', 'payment_method', 'shipping_fee', 'subtotal', 'discount_amount', 'total_amount', 'status', 'note', 'placed_at', 'handled_by'];

    const CREATED_AT = 'placed_at';   // thay cho created_at
    const UPDATED_AT = 'updated_at'; // giữ nguyên

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(Order_item::class, 'order_id', 'order_id');
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class, 'promo_id', 'promo_id');
    }

    public function handler()
    {
        return $this->belongsTo(User::class, 'handled_by', 'id');
    }
}
