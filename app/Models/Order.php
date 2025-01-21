<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'id',
        'package_id',
        'user_id',
        'total_price',
        'status',
    ];

    public function package()
    {
        return $this->belongsTo(UserPackage::class, 'package_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
