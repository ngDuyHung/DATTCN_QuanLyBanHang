<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    //order_item_id	order_id	product_id	sku	product_name	unit_price	quantity	line_total	created_at	
    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    protected $fillable = ['order_id', 'product_id', 'sku', 'product_name', 'unit_price', 'quantity', 'line_total', 'created_at'];
    const UPDATED_AT = null; // disable updated_at

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function getUnitPriceFormatAttribute()
    {
        return number_format($this->unit_price, 0, ',', '.') . ' đ';
    }

    public function getLineTotalFormatAttribute()
    {
        return number_format($this->line_total, 0, ',', '.') . ' đ';
    }
}
