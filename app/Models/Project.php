<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client',
        'phone',
        'email',
        'venue',
        'address',
        'description',
        'event_start',
        'event_end',
        'invoice_date',
        'is_paid',
    ];
    
    protected $appends = ['total'];

    /**
     * Relasi ke ProjectItem
     */
    public function items()
    {
        return $this->hasMany(ProjectItem::class);
    }

    /**
     * Relasi ke Payment (kalau mau tracking pembayaran)
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Hitung total harga dari semua item
     */
    public function getTotalAttribute()
    {
        return $this->items->sum(fn ($item) => $item->qty * $item->price);
    }
}
