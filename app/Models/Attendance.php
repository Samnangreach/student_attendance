<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $fillable = ['student_id', 'class_id', 'date', 'status', 'note'];
    protected $casts = [
        'date' => 'date',
    ];
    
    // protected $fillable = ['eng_name', 'kh_name', 'gender', 'phone', 'address'];
    // Define the relationship with the Student model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

}
