<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class item extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity',
        'price',
        'description',

    ];
    public function category()
    {
        return $this->hasOne(category::class, 'category_id');
    }
    public function order()
    {
        return $this->belongsTo(order::class, 'order_id');
    }
}
