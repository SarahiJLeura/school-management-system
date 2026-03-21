<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class grade extends Model
{
    protected $fillable = ['enrollment_id', 'grade'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
