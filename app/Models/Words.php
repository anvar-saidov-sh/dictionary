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
        'status',
    ];


    public function scopePublished($query)
    {
        return $query->where('status', 'approved');
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
    public function requests()
    {
        return $this->hasMany(WordRequest::class, 'word_id');
    }
}

