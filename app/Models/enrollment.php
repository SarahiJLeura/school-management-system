<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class enrollment extends Model
{
    //
    public function group(){
        return $this->belongsTo(group::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function grade(){
        return $this->hasOne(Grade::class);
    }
}
