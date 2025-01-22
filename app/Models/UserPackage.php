<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPackage extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'price',
        'duration',
        'available',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
