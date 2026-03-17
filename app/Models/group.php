<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    //
    public function schedule(){
        return $this->belongsTo(schedule::class);
    }
}
