<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnlogShopping extends Model
{
    use HasFactory;

    protected $table = 'unlog_shopping';

    protected $fillable = [
        'name',
        'phone',
        'product_id',
        'quantity',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
