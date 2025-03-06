<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penduduk extends Model
{
    use HasFactory;

    protected $table = 'penduduk';
    protected $fillable = [
        'nama',
        'nik',
        'tanggal_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'alamat',
    ];

    public function pengurusankartukeluarga()
{
    return $this->hasMany(pengurusankartukeluarga::class, 'nik', 'nik');
}
}
