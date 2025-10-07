<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordRequest extends Model
{
    protected $fillable = [
        'word_id',
        'student_id',
        'message',
        'status',
        'definition',
        'examples',
        'idioms',
        'image',
        'scholar_id',
        'approved_by_owner',
    ];

    public function word()
    {
        return $this->belongsTo(Words::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function scholar()
    {
        return $this->belongsTo(Scholars::class);
    }
}
