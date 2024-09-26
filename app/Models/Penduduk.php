<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduks';

    protected $fillable = [
        'no_kk',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'pendidikan_terakhir',
        'pekerjaan',
        'status_perkawinan',
        'alamat',
        'rt',
        'rw',
        'nomor_telepon',
        'status_dalam_keluarga',
        'umur_kategori',
        'status_kesejahteraan',
        'keterangann_tidak_aktif',
        'keluarga',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where(function ($q) use ($search) {
            $q->where('nama_lengkap', 'like', "%$search%")
                ->orWhere('nik', 'like', "%$search%")
                ->orWhere('alamat', 'like', "%$search%")
                ->orWhere('umur_kategori', 'like', "%$search%")
                ->orWhere('status_kesejahteraan', 'like', "%$search%");
        });
    }
}
