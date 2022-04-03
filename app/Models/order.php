<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;

    public function items()
    {
        return $this->hasMany(item::class);
    }
    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
