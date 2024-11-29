<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Information extends Model
{
    use HasFactory;

    // Các cột cho phép cập nhật qua mass assignment
    protected $fillable = ['user_id', 'name', 'address', 'phone'];

    public function user()
{
    return $this->belongsTo(User::class, 'user_id', 'id');
}

}
