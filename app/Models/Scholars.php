<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Scholars extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function approvedWords()
    {
        return $this->hasMany(Words::class, 'scholar_id');
    }

    public function reviewedRequests()
    {
        return $this->hasMany(WordRequest::class, 'scholar_id');
    }
}
