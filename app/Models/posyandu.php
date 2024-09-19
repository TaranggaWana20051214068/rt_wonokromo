<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class posyandu extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tanggal_lahir',
        'kategori',
        'alamat',
        'no_telepon',
        'nama_ibu',
        'nama_ayah',
        'status_aktif'
    ];
    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama', 'like', "%$search%")
                ->orWhere('kategori', 'like', "%$search%")
                ->orWhere('alamat', 'like', "%$search%");
        });
    }

}
