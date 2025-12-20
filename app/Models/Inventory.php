<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    //inventory_id	product_id	quantity_in_stock	min_alert_quantity	last_updated	created_at	updated_at	
    protected $table = 'inventory';
    protected $primaryKey = 'inventory_id';
    protected $fillable = [
        'product_id',
        'quantity_in_stock',
        'min_alert_quantity',
    ];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
