<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = 'brands';
    protected $primaryKey = 'brand_id';
    protected $fillable = ['name', 'logo_url', 'description'];
    public $timestamps = true;

 
    protected $casts = [
        'is_active' => 'boolean',
    ];
    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'brand_id');
    }

}
