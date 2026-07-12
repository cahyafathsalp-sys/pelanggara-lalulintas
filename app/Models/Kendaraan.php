<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table='kendaraan';

    protected $fillable=[
        'pengendara_id',
        'nomor_polisi',
        'merk',
        'jenis',
        'warna',
        'tahun'
    ];

    public function pengendara()
    {
        return $this->belongsTo(Pengendara::class);
    }

    public function pelanggaran()
    {
        return $this->hasMany(Pelanggaran::class);
    }
}