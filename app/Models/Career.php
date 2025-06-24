<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'title',
        'category',
        'description',
        'responsibilities',
        'criteria',
    ];
}
