@extends('layouts.app')

@section('content')

<div class="container">

    <div class="card">

        <div class="card-header bg-primary text-white">
            <h4>Tambah Data Petugas</h4>
        </div>

        <div class="card-body">

            <form action="{{ route('petugas.store') }}" method="POST">

                @csrf

                <div class="mb-3">

                    <label class="form-label">User</label>

                    <select name="user_id" class="form-control">

                        <option value="">-- Pilih User --</option>

                        @foreach($users as $user)

                        <option value="{{ $user->id }}">
                            {{ $user->name }}
                            
                        </option>

                        @endforeach

                    </select>

                    @error('user_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">NIP</label>

                    <input
                        type="text"
                        name="nip"
                        class="form-control"
                        value="{{ old('nip') }}"
                    >

                    @error('nip')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Nama Petugas</label>

                    <input
                        type="text"
                        name="nama"
                        class="form-control"
                        value="{{ old('nama') }}"
                    >

                    @error('nama')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Pangkat</label>

                    <input
                        type="text"
                        name="pangkat"
                        class="form-control"
                        value="{{ old('pangkat') }}"
                    >

                    @error('pangkat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <div class="mb-3">

                    <label class="form-label">Nomor HP</label>

                    <input
                        type="text"
                        name="no_hp"
                        class="form-control"
                        value="{{ old('no_hp') }}"
                    >

                    @error('no_hp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror

                </div>

                <button class="btn btn-success">
                    Simpan
                </button>

                <a href="{{ route('petugas.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>

            </form>

        </div>

    </div>

</div>

@endsection