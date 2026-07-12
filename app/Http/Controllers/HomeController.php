<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Pengendara;
use App\Models\Kendaraan;
use App\Models\JenisPelanggaran;
use App\Models\Pelanggaran;

class HomeController extends Controller
{
    public function index()
    {
        $petugas = Petugas::count();

        $pengendara = Pengendara::count();

        $kendaraan = Kendaraan::count();

        $jenispelanggaran = JenisPelanggaran::count();

        $pelanggaran = Pelanggaran::count();

        return view('home', compact(
            'petugas',
            'pengendara',
            'kendaraan',
            'jenispelanggaran',
            'pelanggaran'
        ));
    }
}
