<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Các cột có thể được gán giá trị hàng loạt.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
    ];

    public function comments()
{
    return $this->hasMany(Comment::class);
}

    public function shopping()
{
    return $this->hasMany(Shopping::class);
}

    public function unlogShopping()
{
    return $this->hasMany(UnlogShopping::class);
}

    public function images()
{
    return $this->hasMany(Image::class);
}


}
