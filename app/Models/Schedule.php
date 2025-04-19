<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'class_id',
        'subject_id',
        'date',
        'start_time',
        'end_time',
    ];
    


    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
    
    public function class() {
        return $this->belongsTo(Classes::class);
    }
    
    public function subject() {
        return $this->belongsTo(Subject::class);
    }
    
}
