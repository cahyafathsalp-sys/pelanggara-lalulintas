@extends('layouts.app')

@vite(['resources/css/app.css','resources/css/login.css'])

@section('content')

@vite([
    
    'resources/css/login.css',
    
])
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

<div class="container-fluid p-0">

    <div class="row g-0 min-vh-100">

        <!-- LEFT -->
        <div class="col-lg-7 d-none d-lg-flex left-panel">

            <div class="overlay">

                <div class="content">

                    <div class="logo-circle">
                        <i class="fas fa-road"></i>
                    </div>

                    <h5 class="text-info mb-3">
                        Sistem Informasi
                    </h5>

                    <h1>
                        PENDATAAN
                        <br>
                        PELANGGARAN
                        <br>
                        LALU LINTAS
                    </h1>

                    <p class="mt-4">
                        Sistem informasi berbasis Laravel untuk membantu
                        proses pendataan kendaraan, pengendara,
                        petugas, serta pelanggaran lalu lintas
                        secara cepat, akurat dan terdokumentasi.
                    </p>

                    <img src="{{ asset('image/jjj.jpg') }}"
                        class="hero-img mt-4"
                        alt="Traffic">

                </div>

            </div>

        </div>

        <!-- RIGHT -->
        <div class="col-lg-5 d-flex align-items-center justify-content-center login-side">

            <div class="login-card">

                <div class="text-center mb-4">

                    <div class="avatar">

                        <i class="fas fa-user-shield"></i>

                    </div>

                    <h2>Selamat Datang</h2>

                    <p>Silakan login untuk masuk ke dashboard.</p>

                </div>

                <form method="POST" action="{{ route('login') }}">

                    @csrf

                    <div class="mb-3">

                        <label>Email</label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>

                            <input
                                type="email"
                                name="email"
                                class="form-control @error('email') is-invalid @enderror"
                                placeholder="Masukkan email"
                                required
                                autofocus>

                        </div>

                        @error('email')
                        <span class="invalid-feedback d-block">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label>Password</label>

                        <div class="input-group">

                            <span class="input-group-text">
                                <i class="fas fa-lock"></i>
                            </span>

                            <input
                                id="password"
                                type="password"
                                name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Masukkan password"
                                required>

                            <button
                                type="button"
                                class="btn btn-light border"
                                onclick="togglePassword()">

                                <i class="fas fa-eye" id="eye"></i>

                            </button>

                        </div>

                        @error('password')
                        <span class="invalid-feedback d-block">
                            {{ $message }}
                        </span>
                        @enderror

                    </div>

                    <div class="d-flex justify-content-between mb-4">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                name="remember">

                            <label class="form-check-label">
                                Remember Me
                            </label>

                        </div>

                        @if(Route::has('password.request'))

                        <a href="{{ route('password.request') }}">

                            Lupa Password?

                        </a>

                        @endif

                    </div>

                    <button class="btn btn-primary btn-login w-100">

                        <i class="fas fa-right-to-bracket me-2"></i>

                        Login

                    </button>

                </form>

                <hr>

                <div class="text-center text-secondary">

                    © {{ date('Y') }}

                    Sistem Pendataan Pelanggaran Lalu Lintas

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function togglePassword(){

let pass=document.getElementById("password");

let eye=document.getElementById("eye");

if(pass.type==="password"){

pass.type="text";

eye.classList.remove("fa-eye");

eye.classList.add("fa-eye-slash");

}else{

pass.type="password";

eye.classList.remove("fa-eye-slash");

eye.classList.add("fa-eye");

}

}

</script>

@endsection