<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Words extends Model
{
    protected $fillable = [
        'name',
        'definition',
        'examples',
        'idioms',
        'image',
    ];
}
