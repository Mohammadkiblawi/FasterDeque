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
        'brief'
    ];


    public function items()
    {
        return $this->hasMany(item::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function paidOrders()
    {
        return $this->paid > 0 ? true : false;
    }
}
