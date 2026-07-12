@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-warning">
            <h4>Edit Data Pelanggaran</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('pelanggaran.update',$pelanggaran->id) }}" method="POST">

                @csrf
                @method('PUT')

                {{-- Petugas --}}
                <div class="mb-3">

                    <label>Petugas</label>

                    <select name="petugas_id" class="form-control">

                        @foreach($petugas as $p)

                        <option
                            value="{{ $p->id }}"
                            {{ $pelanggaran->petugas_id==$p->id ? 'selected':'' }}>

                            {{ $p->nama }}

                        </option>

                        @endforeach

                    </select>

                </div>

                {{-- Pengendara --}}
                <div class="mb-3">

                    <label>Pengendara</label>

                    <select name="pengendara_id" class="form-control">

                        @foreach($pengendara as $p)

                        <option
                            value="{{ $p->id }}"
                            {{ $pelanggaran->pengendara_id==$p->id ? 'selected':'' }}>

                            {{ $p->nama }}

                        </option>

                        @endforeach

                    </select>

                </div>

                {{-- Kendaraan --}}
                <div class="mb-3">

                    <label>Kendaraan</label>

                    <select name="kendaraan_id" class="form-control">

                        @foreach($kendaraan as $k)

                        <option
                            value="{{ $k->id }}"
                            {{ $pelanggaran->kendaraan_id==$k->id ? 'selected':'' }}>

                            {{ $k->nomor_polisi }}

                            -

                            {{ $k->merk }}

                        </option>

                        @endforeach

                    </select>

                </div>

                {{-- Tanggal --}}
                <div class="mb-3">

                    <label>Tanggal</label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ $pelanggaran->tanggal }}">

                </div>

                {{-- Lokasi --}}
                <div class="mb-3">

                    <label>Lokasi</label>

                    <input
                        type="text"
                        name="lokasi"
                        class="form-control"
                        value="{{ $pelanggaran->lokasi }}">

                </div>

                {{-- Keterangan --}}
                <div class="mb-3">

                    <label>Keterangan</label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="3">{{ $pelanggaran->keterangan }}</textarea>

                </div>

                {{-- MANY TO MANY --}}
                <div class="mb-3">

                    <label>Jenis Pelanggaran</label>

                    @foreach($jenis as $j)

                    <div class="form-check">

                        <input
                            type="checkbox"
                            class="form-check-input"
                            name="jenis_pelanggaran[]"
                            value="{{ $j->id }}"

                            {{ $pelanggaran->jenisPelanggaran->contains($j->id) ? 'checked' : '' }}

                        >

                        <label class="form-check-label">

                            {{ $j->nama_pelanggaran }}

                            ({{ $j->pasal }})

                        </label>

                    </div>

                    @endforeach

                </div>

                <button class="btn btn-primary">

                    Update

                </button>

                <a href="{{ route('pelanggaran.index') }}"
                    class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection