<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pengurusankartukeluarga extends Model
{
    use HasFactory;

     /**
     * Nama tabel yang terkait dengan model.
     *
     * @var string
     */
    protected $table = 'pengurusankartukeluarga';

     /**
     * Kolom yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'nik',
        'nama',
        'tanggal_pengurusan',
        'status',
        'dokumen',
        'keterangan',
    ];

    /**
     * Relasi ke model Penduduk.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function penduduk()
    {
        return $this->belongsTo(penduduk::class, 'nik', 'nik');
    }
}
