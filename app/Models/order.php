<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_date',
        'order_time',
        'total_price',
        'brief',
        'status',
        'paid'
    ];


    public function items()
    {
        return $this->hasMany(item::class, 'order_id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
