<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'qty',
        'price',
    ];

    /**
     * Relasi ke Project
     */
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    /**
     * Subtotal tiap item
     */
    public function getSubtotalAttribute()
    {
        return $this->qty * $this->price;
    }
}
