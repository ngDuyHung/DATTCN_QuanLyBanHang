<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $primaryKey = 'menu_id';

    protected $fillable = [
        'name',
        'url',
        'type',
        'parent_id',
        'sort_order',
        'is_active',
    ];

    public $timestamps = true;

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Định nghĩa các loại menu
     */
    const TYPE_HEADER = 'header';
    const TYPE_FOOTER = 'footer';
    const TYPE_SIDEBAR = 'sidebar';

    /**
     * Lấy danh sách các loại menu
     */
    public static function getTypes()
    {
        return [
            self::TYPE_HEADER => 'Header Menu',
            self::TYPE_FOOTER => 'Footer Menu',
            self::TYPE_SIDEBAR => 'Sidebar Menu',
        ];
    }

    /**
     * Quan hệ với menu cha
     */
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id', 'menu_id');
    }

    /**
     * Quan hệ với menu con
     */
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'menu_id')->orderBy('sort_order');
    }

    /**
     * Lấy tên loại menu để hiển thị
     */
    public function getTypeNameAttribute()
    {
        $types = self::getTypes();
        return $types[$this->type] ?? $this->type;
    }

    /**
     * Lấy URL đầy đủ
     */
    public function getFullUrlAttribute()
    {
        if (empty($this->url)) {
            return '#';
        }
        
        // Nếu URL đã có http hoặc https thì giữ nguyên
        if (preg_match('/^https?:\/\//', $this->url)) {
            return $this->url;
        }
        
        // Nếu không, thêm base URL
        return url($this->url);
    }

    /**
     * Scope để lấy menu theo loại
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    /**
     * Scope để lấy menu đang hoạt động
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

    /**
     * Scope để lấy menu cấp 1 (không có parent)
     */
    public function scopeParentMenus($query)
    {
        return $query->whereNull('parent_id');
    }
}
