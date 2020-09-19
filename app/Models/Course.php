<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'info', 'estmated_time'
    ];

    public function students (){
        return $this->belongsToMany('App\Models\User', 'enrollments','course_id','user_id')->withTimestamps();
    }
    public function enrollments()
    {
        return $this->hasMany('App\Models\Enrollment');
    }
}
