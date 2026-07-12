<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPelanggaran extends Model
{
    protected $table='detail_pelanggaran';

    protected $fillable=[
        'pelanggaran_id',
        'jenis_pelanggaran_id'
    ];

    public function pelanggaran()
    {
        return $this->belongsTo(Pelanggaran::class);
    }

    public function jenisPelanggaran()
    {
        return $this->belongsTo(JenisPelanggaran::class);
    }
}