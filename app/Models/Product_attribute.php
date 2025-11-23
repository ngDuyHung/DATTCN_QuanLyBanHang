<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_attribute extends Model
{
    //attr_id	product_id	attr_key	attr_value	sort_order	created_at	
    protected $table = 'product_attributes';
    protected $primaryKey = 'attr_id';
    protected $fillable = ['product_id', 'attr_key', 'attr_value', 'sort_order'];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
