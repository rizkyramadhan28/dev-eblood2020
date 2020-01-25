<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{
    protected $fillable = [
        'total_point', 'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
