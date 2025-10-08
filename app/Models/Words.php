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
        'verified',
        'rejected',
    ];


    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function requests()
    {
        return $this->hasMany(WordRequest::class, 'word_id');
    }

    public function scholar()
    {
        return $this->belongsTo(Scholars::class, 'approved_by_scholar')->withDefault();
    }
}
