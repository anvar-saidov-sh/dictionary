<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'definition',
        'examples',
        'idioms',
        'image',
        'student_id',
        'verified_by_scholar',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function requests()
    {
        return $this->hasMany(WordRequest::class, 'student_id');
    }
}
