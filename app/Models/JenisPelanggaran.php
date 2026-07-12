<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisPelanggaran extends Model
{
    protected $table='jenis_pelanggaran';

    protected $fillable=[
        'nama_pelanggaran',
        'pasal',
        'denda'
    ];

    public function pelanggaran()
    {
        return $this->belongsToMany(
            Pelanggaran::class,
            'detail_pelanggaran'
        );
    }
}