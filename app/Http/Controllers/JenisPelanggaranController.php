<?php

namespace App\Http\Controllers;

use App\Models\JenisPelanggaran;
use Illuminate\Http\Request;

class JenisPelanggaranController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $jenis = JenisPelanggaran::when($keyword,function($query) use($keyword){

            $query->where('nama_pelanggaran','like',"%$keyword%")
                  ->orWhere('pasal','like',"%$keyword%");

        })
        ->latest()
        ->paginate(10);

        return view('jenis_pelanggaran.index',compact('jenis'));
    }

    public function create()
    {
        return view('jenis_pelanggaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'nama_pelanggaran'=>'required',
            'pasal'=>'required',
            'denda'=>'required|numeric'

        ]);

        JenisPelanggaran::create([

            'nama_pelanggaran'=>$request->nama_pelanggaran,
            'pasal'=>$request->pasal,
            'denda'=>$request->denda

        ]);

        return redirect()
            ->route('jenis-pelanggaran.index')
            ->with('success','Data berhasil ditambahkan');
    }
        public function edit($id)
    {
        $jenis = JenisPelanggaran::findOrFail($id);

        return view('jenis_pelanggaran.edit',compact('jenis'));
    }

    public function update(Request $request,$id)
    {
        $jenis = JenisPelanggaran::findOrFail($id);

        $request->validate([

            'nama_pelanggaran'=>'required',
            'pasal'=>'required',
            'denda'=>'required|numeric'

        ]);

        $jenis->update([

            'nama_pelanggaran'=>$request->nama_pelanggaran,
            'pasal'=>$request->pasal,
            'denda'=>$request->denda

        ]);

        return redirect()
            ->route('jenis-pelanggaran.index')
            ->with('success','Data berhasil diupdate');
    }

    public function destroy($id)
    {
        $jenis = JenisPelanggaran::findOrFail($id);

        $jenis->delete();

        return redirect()
            ->route('jenis-pelanggaran.index')
            ->with('success','Data berhasil dihapus');
    }

}