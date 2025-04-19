<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject_id',
        'class_id',
        'date',
        'term',
        'week',
        'classwork',
        'homework',
        'behavior',
        'note',
        'recorded_by'
    ];

    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id'); // or ClassRoom if that's your model
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }
}
