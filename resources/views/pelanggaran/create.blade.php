@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">

            <h4>Tambah Data Pelanggaran</h4>

        </div>

        <div class="card-body">

            <form action="{{ route('pelanggaran.store') }}" method="POST">

                @csrf

                <!-- Petugas -->
                <div class="mb-3">

                    <label>Petugas</label>

                    <select name="petugas_id" class="form-control">

                        <option value="">-- Pilih Petugas --</option>

                        @foreach($petugas as $p)

                        <option value="{{ $p->id }}">

                            {{ $p->nama }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- Pengendara -->
                <div class="mb-3">

                    <label>Pengendara</label>

                    <select name="pengendara_id" class="form-control">

                        <option value="">-- Pilih Pengendara --</option>

                        @foreach($pengendara as $p)

                        <option value="{{ $p->id }}">

                            {{ $p->nama }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- Kendaraan -->
                <div class="mb-3">

                    <label>Kendaraan</label>

                    <select name="kendaraan_id" class="form-control">

                        <option value="">-- Pilih Kendaraan --</option>

                        @foreach($kendaraan as $k)

                        <option value="{{ $k->id }}">

                            {{ $k->nomor_polisi }}

                            -

                            {{ $k->merk }}

                        </option>

                        @endforeach

                    </select>

                </div>

                <!-- Tanggal -->
                <div class="mb-3">

                    <label>Tanggal</label>

                    <input
                        type="date"
                        name="tanggal"
                        class="form-control"
                        value="{{ old('tanggal') }}">

                </div>

                <!-- Lokasi -->
                <div class="mb-3">

                    <label>Lokasi</label>

                    <input
                        type="text"
                        name="lokasi"
                        class="form-control"
                        value="{{ old('lokasi') }}">

                </div>

                <!-- Keterangan -->
                <div class="mb-3">

                    <label>Keterangan</label>

                    <textarea
                        name="keterangan"
                        class="form-control"
                        rows="3">{{ old('keterangan') }}</textarea>

                </div>

                <!-- MANY TO MANY -->
                <div class="mb-3">

                    <label>Jenis Pelanggaran</label>

                    @foreach($jenis as $j)

                    <div class="form-check">

                        <input
                            class="form-check-input"
                            type="checkbox"
                            name="jenis_pelanggaran[]"
                            value="{{ $j->id }}">

                        <label class="form-check-label">

                            {{ $j->nama_pelanggaran }}

                            ({{ $j->pasal }})

                            - Rp {{ number_format($j->denda,0,',','.') }}

                        </label>

                    </div>

                    @endforeach

                </div>

                <button class="btn btn-success">

                    Simpan

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