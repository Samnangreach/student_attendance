<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $fillable = ['student_id', 'date', 'status', 'note'];
    // protected $fillable = ['eng_name', 'kh_name', 'gender', 'phone', 'address'];
    // Define the relationship with the Student model
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
