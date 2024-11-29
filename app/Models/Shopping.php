<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shopping extends Model
{
    use HasFactory;

    protected $table = 'shopping';

    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
    ];

    // Liên kết với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Liên kết với Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
