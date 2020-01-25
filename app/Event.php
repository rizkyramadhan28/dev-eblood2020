<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'date', 'user', 'description', 'address'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
