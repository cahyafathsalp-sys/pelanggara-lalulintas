<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\User;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Menampilkan semua data petugas
     */
    public function index()
    {
        $petugas = Petugas::with('user')
                    ->latest()
                    ->get();

        return view('petugas.index', compact('petugas'));
    }

    /**
     * Menampilkan form tambah petugas
     */
    public function create()
    {
        $users = User::where('role', 'petugas')->get();

        return view('petugas.create', compact('users'));
    }

    /**
     * Menyimpan data petugas
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|unique:petugas,nip',
            'nama' => 'required|max:100',
            'pangkat' => 'required|max:100',
            'no_hp' => 'required|max:15',
        ],[
            'user_id.required' => 'User wajib dipilih.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Nama wajib diisi.',
            'pangkat.required' => 'Pangkat wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        Petugas::create([
            'user_id' => $request->user_id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'pangkat' => $request->pangkat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()
            ->route('petugas.index')
            ->with('success', 'Data petugas berhasil ditambahkan.');
    }
        /**
     * Menampilkan form edit data petugas
     */
    public function edit($id)
    {
        $petugas = Petugas::findOrFail($id);

        $users = User::where('role', 'petugas')->get();

        return view('petugas.edit', compact('petugas', 'users'));
    }

    /**
     * Mengupdate data petugas
     */
    public function update(Request $request, $id)
    {
        $petugas = Petugas::findOrFail($id);

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'nip' => 'required|unique:petugas,nip,' . $petugas->id,
            'nama' => 'required|max:100',
            'pangkat' => 'required|max:100',
            'no_hp' => 'required|max:15',
        ], [
            'user_id.required' => 'User wajib dipilih.',
            'nip.required' => 'NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Nama wajib diisi.',
            'pangkat.required' => 'Pangkat wajib diisi.',
            'no_hp.required' => 'Nomor HP wajib diisi.',
        ]);

        $petugas->update([
            'user_id' => $request->user_id,
            'nip' => $request->nip,
            'nama' => $request->nama,
            'pangkat' => $request->pangkat,
            'no_hp' => $request->no_hp,
        ]);

        return redirect()
            ->route('petugas.index')
            ->with('success', 'Data petugas berhasil diperbarui.');
    }

    /**
     * Menghapus data petugas
     */
    public function destroy($id)
    {
        $petugas = Petugas::findOrFail($id);

        $petugas->delete();

        return redirect()
            ->route('petugas.index')
            ->with('success', 'Data petugas berhasil dihapus.');
    }
}