<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggaran extends Model
{

    protected $table = 'pelanggaran';

    protected $fillable=[

        'petugas_id',
        'pengendara_id',
        'kendaraan_id',
        'tanggal',
        'lokasi',
        'keterangan'

    ];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class);
    }

    public function pengendara()
    {
        return $this->belongsTo(Pengendara::class);
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class);
    }

    public function jenisPelanggaran()
    {
        return $this->belongsToMany(
            JenisPelanggaran::class,
            'detail_pelanggaran'
        );
    }

}