<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    protected $fillable = [
        'cart',
    ];
    public function user() {
        
        return $this->belongsTo('App\User');
    }
}
