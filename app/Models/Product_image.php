<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    //image_id	product_id	image_url	alt_text	sort_order	created_at
    protected $table = 'product_images';
    protected $primaryKey = 'image_id';
    protected $fillable = ['product_id', 'image_url', 'alt_text', 'sort_order'];
    public $timestamps = true;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}
