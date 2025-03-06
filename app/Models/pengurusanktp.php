<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengurusanktp extends Model
{
    use HasFactory;

    protected $table = 'pengurusanktp';
    protected $fillable = [
        'penduduk_nik',
        'tanggal_pengurusan',
        'status',
        'keterangan',
    ];

    protected $attributes = [
        'keterangan' => null,
    ];

    public function penduduk()
    {
        return $this->belongsTo(penduduk::class, 'penduduk_nik', 'nik');
    }
}
