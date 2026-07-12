<?php

namespace App\Http\Controllers;

use App\Models\Pengendara;
use Illuminate\Http\Request;

class PengendaraController extends Controller
{
    /**
     * Menampilkan daftar pengendara
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $pengendara = Pengendara::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('nik', 'like', "%{$keyword}%")
                      ->orWhere('no_sim', 'like', "%{$keyword}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('pengendara.index', compact('pengendara'));
    }

    /**
     * Form tambah pengendara
     */
    public function create()
    {
        return view('pengendara.create');
    }

    /**
     * Simpan data pengendara
     */
    public function store(Request $request)
    {
        $request->validate([
            'nik'     => 'required|unique:pengendara,nik',
            'nama'    => 'required|max:100',
            'alamat'  => 'required',
            'no_sim'  => 'required|unique:pengendara,no_sim',
        ],[
            'nik.required'    => 'NIK wajib diisi.',
            'nik.unique'      => 'NIK sudah terdaftar.',
            'nama.required'   => 'Nama wajib diisi.',
            'alamat.required' => 'Alamat wajib diisi.',
            'no_sim.required' => 'Nomor SIM wajib diisi.',
            'no_sim.unique'   => 'Nomor SIM sudah terdaftar.',
        ]);

        Pengendara::create([
            'nik'     => $request->nik,
            'nama'    => $request->nama,
            'alamat'  => $request->alamat,
            'no_sim'  => $request->no_sim,
        ]);

        return redirect()
            ->route('pengendara.index')
            ->with('success', 'Data pengendara berhasil ditambahkan.');
    }

    /**
     * Form edit pengendara
     */
    public function edit($id)
    {
        $pengendara = Pengendara::findOrFail($id);

        return view('pengendara.edit', compact('pengendara'));
    }

    /**
     * Update data pengendara
     */
    public function update(Request $request, $id)
    {
        $pengendara = Pengendara::findOrFail($id);

        $request->validate([
            'nik'     => 'required|unique:pengendara,nik,' . $pengendara->id,
            'nama'    => 'required|max:100',
            'alamat'  => 'required',
            'no_sim'  => 'required|unique:pengendara,no_sim,' . $pengendara->id,
        ]);

        $pengendara->update([
            'nik'     => $request->nik,
            'nama'    => $request->nama,
            'alamat'  => $request->alamat,
            'no_sim'  => $request->no_sim,
        ]);

        return redirect()
            ->route('pengendara.index')
            ->with('success', 'Data pengendara berhasil diperbarui.');
    }

    /**
     * Hapus data pengendara
     */
    public function destroy($id)
    {
        $pengendara = Pengendara::findOrFail($id);

        $pengendara->delete();

        return redirect()
            ->route('pengendara.index')
            ->with('success', 'Data pengendara berhasil dihapus.');
    }
}