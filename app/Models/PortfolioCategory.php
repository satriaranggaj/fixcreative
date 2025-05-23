<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PortfolioCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function portfolios()
    {
        return $this->hasMany(Portfolio::class, 'portfolio_category_id');
    }
}
