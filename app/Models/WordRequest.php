<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordRequest extends Model
{
    use HasFactory;

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
        'rejected_by_owner',
    ];

    

    public function word()
    {
        return $this->belongsTo(Words::class, 'word_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function scholar()
    {
        return $this->belongsTo(Scholars::class, 'scholar_id');
    }
}
