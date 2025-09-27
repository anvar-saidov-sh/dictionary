<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Notifications\Notifiable;

class Professor extends Authenticable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        
    ];
}
