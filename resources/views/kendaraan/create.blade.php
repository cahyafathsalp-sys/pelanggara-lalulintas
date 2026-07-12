@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">
            <h4>Tambah Data Kendaraan</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('kendaraan.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">Pengendara</label>

                    <select name="pengendara_id" class="form-control">

                        <option value="">-- Pilih Pengendara --</option>

                        @foreach($pengendara as $p)

                        <option value="{{ $p->id }}">

                            {{ $p->nama }}

                        </option>

                        @endforeach

                    </select>

                    @error('pengendara_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Nomor Polisi</label>

                    <input
                        type="text"
                        name="nomor_polisi"
                        class="form-control"
                        value="{{ old('nomor_polisi') }}">

                    @error('nomor_polisi')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Merk</label>

                    <input
                        type="text"
                        name="merk"
                        class="form-control"
                        value="{{ old('merk') }}">

                    @error('merk')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Jenis Kendaraan</label>

                    <select name="jenis" class="form-control">

                        <option value="">-- Pilih Jenis --</option>

                        <option value="Motor">Motor</option>

                        <option value="Mobil">Mobil</option>

                    </select>

                    @error('jenis')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Warna</label>

                    <input
                        type="text"
                        name="warna"
                        class="form-control"
                        value="{{ old('warna') }}">

                    @error('warna')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Tahun</label>

                    <input
                        type="number"
                        name="tahun"
                        class="form-control"
                        value="{{ old('tahun') }}">

                    @error('tahun')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <button type="submit" class="btn btn-success">

                    Simpan

                </button>

                <a href="{{ route('kendaraan.index') }}"
                   class="btn btn-secondary">

                    Kembali

                </a>

            </form>

        </div>

    </div>

</div>

@endsection