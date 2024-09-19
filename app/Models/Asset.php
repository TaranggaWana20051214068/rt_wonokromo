<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'name',
        'category',
        'purchase_date',
        'value',
        'amount',
        'location'
    ];
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%$search%")
                ->orWhere('category', 'like', "%$search%")
                ->orWhere('location', 'like', "%$search%");
        });
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
