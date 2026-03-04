<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;


class User extends Authenticatable implements JWTSubject
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'phone',
        'role_id',
        'email',
        'password',
    ];

    // --- JWT Methods ---

    /**
     * Lấy định danh lưu vào JWT (thường là ID)
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Lưu thêm thông tin tùy chỉnh vào Payload của Token.
     * Để giảm tải truy vấn Database (Redis Cache), bạn nên cho role_id vào đây.
     */
    public function getJWTCustomClaims()
    {
        return [
            'role_id' => $this->role_id,
            'email' => $this->email
        ];
    }

    // --- Relationships ---

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'role_id');
    }

    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id', 'id');
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function handled()
    {
        return $this->hasMany(Order::class, 'handled_by', 'id');
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
