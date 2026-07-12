<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pengendara;
use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $kendaraan = Kendaraan::with('pengendara')
            ->when($keyword,function($query) use ($keyword){

                $query->where('nomor_polisi','like',"%$keyword%")
                      ->orWhere('merk','like',"%$keyword%")
                      ->orWhere('jenis','like',"%$keyword%");
            })
            ->latest()
            ->paginate(10);

        return view('kendaraan.index',compact('kendaraan'));
    }

    public function create()
    {
        $pengendara = Pengendara::all();

        return view('kendaraan.create',compact('pengendara'));
    }

    public function store(Request $request)
    {
        $request->validate([

            'pengendara_id'=>'required',
            'nomor_polisi'=>'required|unique:kendaraan',
            'merk'=>'required',
            'jenis'=>'required',
            'warna'=>'required',
            'tahun'=>'required'

        ]);

        Kendaraan::create($request->all());

        return redirect()
            ->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil ditambahkan');
    }
    /**
     * Form Edit Kendaraan
     */
    public function edit($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $pengendara = Pengendara::all();

        return view('kendaraan.edit', compact('kendaraan','pengendara'));
    }

    /**
     * Update Kendaraan
     */
    public function update(Request $request, $id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $request->validate([

            'pengendara_id' => 'required|exists:pengendara,id',
            'nomor_polisi' => 'required|unique:kendaraan,nomor_polisi,' . $kendaraan->id,
            'merk' => 'required|max:100',
            'jenis' => 'required|max:100',
            'warna' => 'required|max:50',
            'tahun' => 'required|digits:4'

        ]);

        $kendaraan->update([

            'pengendara_id' => $request->pengendara_id,
            'nomor_polisi' => $request->nomor_polisi,
            'merk' => $request->merk,
            'jenis' => $request->jenis,
            'warna' => $request->warna,
            'tahun' => $request->tahun,

        ]);

        return redirect()
            ->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil diupdate');
    }

    /**
     * Hapus Kendaraan
     */
    public function destroy($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);

        $kendaraan->delete();

        return redirect()
            ->route('kendaraan.index')
            ->with('success','Data kendaraan berhasil dihapus');
    }
}