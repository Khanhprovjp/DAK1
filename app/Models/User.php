<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'email',
        'password',
        'account_type', // Đảm bảo account_type có trong fillable để lưu được giá trị loại tài khoản
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function information()
{
    return $this->hasMany(Information::class);
}
public function shopping()
{
    return $this->hasMany(Shopping::class);
}

public function ShoppingInfo()
{
    return $this->hasOne(Information::class, 'user_id', 'id');
}


}
