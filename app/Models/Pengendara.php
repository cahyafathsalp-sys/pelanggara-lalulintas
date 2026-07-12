<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengendara extends Model
{
    protected $table='pengendara';

    protected $fillable=[
        'nik',
        'nama',
        'alamat',
        'no_sim'
    ];

    public function kendaraan()
    {
        return $this->hasMany(Kendaraan::class);
    }
}