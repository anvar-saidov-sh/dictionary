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
        'defition',
        'examples',
        'idioms',
        'image',
    ];

    public function word()
    {
        return $this->belongsTo(Words::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
