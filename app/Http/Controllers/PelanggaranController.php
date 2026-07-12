<?php

namespace App\Http\Controllers;

use App\Models\Pelanggaran;
use App\Models\Petugas;
use App\Models\Pengendara;
use App\Models\Kendaraan;
use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;

class PelanggaranController extends Controller
{

    public function index()
    {

        $pelanggaran = Pelanggaran::with(

            'petugas',
            'pengendara',
            'kendaraan',
            'jenisPelanggaran'

        )->latest()->paginate(10);

        return view(
            'pelanggaran.index',
            compact('pelanggaran')
        );

    }

    public function create()
    {

        $petugas = Petugas::all();

        $pengendara = Pengendara::all();

        $kendaraan = Kendaraan::all();

        $jenis = JenisPelanggaran::all();

        return view(
            'pelanggaran.create',
            compact(
                'petugas',
                'pengendara',
                'kendaraan',
                'jenis'
            )
        );

    }
    public function store(Request $request)
{

    $request->validate([

        'petugas_id'=>'required',
        'pengendara_id'=>'required',
        'kendaraan_id'=>'required',
        'tanggal'=>'required',
        'lokasi'=>'required',
        'jenis_pelanggaran'=>'required'

    ]);

    $pelanggaran=Pelanggaran::create([

        'petugas_id'=>$request->petugas_id,
        'pengendara_id'=>$request->pengendara_id,
        'kendaraan_id'=>$request->kendaraan_id,
        'tanggal'=>$request->tanggal,
        'lokasi'=>$request->lokasi,
        'keterangan'=>$request->keterangan

    ]);

    $pelanggaran
        ->jenisPelanggaran()
        ->sync($request->jenis_pelanggaran);

    return redirect()
        ->route('pelanggaran.index')
        ->with(
            'success',
            'Data pelanggaran berhasil ditambahkan.'
        );

}
/**
 * Form Edit Pelanggaran
 */
public function edit($id)
{
    $pelanggaran = Pelanggaran::with('jenisPelanggaran')->findOrFail($id);

    $petugas = Petugas::all();
    $pengendara = Pengendara::all();
    $kendaraan = Kendaraan::all();
    $jenis = JenisPelanggaran::all();

    return view(
        'pelanggaran.edit',
        compact(
            'pelanggaran',
            'petugas',
            'pengendara',
            'kendaraan',
            'jenis'
        )
    );
}

/**
 * Update Pelanggaran
 */
public function update(Request $request, $id)
{
    $request->validate([

        'petugas_id'=>'required',
        'pengendara_id'=>'required',
        'kendaraan_id'=>'required',
        'tanggal'=>'required',
        'lokasi'=>'required',
        'jenis_pelanggaran'=>'required'

    ]);

    $pelanggaran = Pelanggaran::findOrFail($id);

    $pelanggaran->update([

        'petugas_id'=>$request->petugas_id,
        'pengendara_id'=>$request->pengendara_id,
        'kendaraan_id'=>$request->kendaraan_id,
        'tanggal'=>$request->tanggal,
        'lokasi'=>$request->lokasi,
        'keterangan'=>$request->keterangan

    ]);

    $pelanggaran
        ->jenisPelanggaran()
        ->sync($request->jenis_pelanggaran);

    return redirect()
        ->route('pelanggaran.index')
        ->with('success','Data berhasil diupdate');
}

/**
 * Hapus Pelanggaran
 */
public function destroy($id)
{
    $pelanggaran = Pelanggaran::findOrFail($id);

    $pelanggaran
        ->jenisPelanggaran()
        ->detach();

    $pelanggaran->delete();

    return redirect()
        ->route('pelanggaran.index')
        ->with('success','Data berhasil dihapus');
}
}