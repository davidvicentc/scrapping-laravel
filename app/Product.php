<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //



    public function users()
    {
        return $this->belongstoMany(User::class);
    }

    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }
}
