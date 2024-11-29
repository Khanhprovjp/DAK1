<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_path',
        'alt_text',
        'product_id',
    ];

    // Định nghĩa mối quan hệ với bảng products
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

