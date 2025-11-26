<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    //promo_id	code	description	discount_type	discount_value	starts_at	ends_at	usage_limit	times_used	is_active	created_at	updated_at	
    protected $table = 'promotions';
    protected $primaryKey = 'promo_id';
    protected $fillable = ['code', 'description', 'discount_type', 'discount_value', 'starts_at', 'ends_at', 'usage_limit', 'times_used', 'is_active'];
    public $timestamps = true;
    
    public function orders()
    {
        return $this->hasMany(Order::class, 'promo_id', 'promo_id');
    }
}
