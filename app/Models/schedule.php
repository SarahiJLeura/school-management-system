<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    //
    public function course(){
        return $this->belongsTo(course::class);
    }

    public function teacher(){
        return $this->belongsTo(User::class, 'teacher_id');
    }
}
