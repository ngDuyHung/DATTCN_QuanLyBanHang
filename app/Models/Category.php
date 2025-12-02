<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    protected $fillable = [ // Các cột có thể gán giá trị hàng loạt thông qua update/create
        'name',
        'slug',
        'description',
        'parent_id',
        'is_active',
    ];

    //  Nếu cột timestamps không phải kiểu mặc định (created_at, updated_at), có thể giữ nguyên
    // Laravel sẽ tự hiểu vì bạn đã đặt đúng tên.
    public $timestamps = true;


    // Chuyển đổi kiểu dữ liệu cho cột is_active thành boolean 
    //(vd: trong db là 0,1 thì khi gọi ra nó ép thành true/false)
    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
    public function brands()
    {
        // return $this->hasManyThrough(
        //     Brand::class,
        //     Product::class,
        //     'category_id', // Khóa ngoại trên bảng products
        //     'brand_id',    // Khóa ngoại trên bảng brands
        //     'category_id', // Khóa chính trên bảng categories
        //     'brand_id'     // Khóa chính trên bảng products
        // )->distinct();
        return $this->hasMany(Brand::class, 'category_id', 'category_id');

    }
}
