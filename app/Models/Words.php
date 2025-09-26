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
    ];
}
