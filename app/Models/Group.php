<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['group_name', 'student_id', 'class_id', 'description'];


    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }


    public function students()
    {
        return $this->belongsToMany(Student::class, 'group_students');
    }
}
