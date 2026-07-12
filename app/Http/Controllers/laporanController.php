<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{

    public function index(Request $request)
    {

        $query = Pelanggaran::with(
            'petugas',
            'pengendara',
            'kendaraan',
            'jenisPelanggaran'
        );

        if($request->tanggal_awal){

            $query->whereBetween('tanggal',[

                $request->tanggal_awal,

                $request->tanggal_akhir

            ]);

        }

        $pelanggaran = $query->get();

        return view(
            'laporan.index',
            compact('pelanggaran')
        );

    }

    public function pdf(Request $request)
    {

        $query = Pelanggaran::with(
            'petugas',
            'pengendara',
            'kendaraan',
            'jenisPelanggaran'
        );

        if($request->tanggal_awal){

            $query->whereBetween('tanggal',[

                $request->tanggal_awal,

                $request->tanggal_akhir

            ]);

        }

        $pelanggaran = $query->get();

        $pdf = Pdf::loadView(
            'laporan.pdf',
            compact('pelanggaran')
        );

        return $pdf->download('laporan-pelanggaran.pdf');

    }

}