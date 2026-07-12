@extends('layouts.app')
@vite(['resources/css/app.css', 'resources/css/login.css'])
@section('content')

<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

<div class="container-fluid p-0">

<div class="row vh-100">

    <!-- KIRI -->
    <div class="col-lg-7 d-none d-lg-block left-panel">

        <div class="overlay">

            <div class="left-content">

                <h5 class="text-info">
                    Pendataan Lalu Lintas
                </h5>

               <img src="{{ asset('image/Dashboard.png') }}" class="img-fluid">
                <h1>
                    SISTEM PENDATAAN
                    <br>
                    LALU LINTAS 
                </h1>

                <p>
                    Monitoring kendaraan dan pelanggaran lalu lintas
                    berbasis Laravel.
                </p>

            </div>

        </div>

    </div>

    <!-- KANAN -->
    <div class="col-lg-5 login-side">

        <div class="login-box">

            <div class="text-center mb-4">

                <div class="avatar">

                    <i class="fas fa-user"></i>

                </div>

                <h2>Login</h2>

                <p>Masuk untuk mengakses sistem</p>

            </div>

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="mb-3">

                    <label>Email</label>

                    <input
                    type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email"
                    required
                    autofocus>

                    @error('email')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                    @enderror

                </div>

                <div class="mb-3">

                    <label>Password</label>

                    <input
                    type="password"
                    class="form-control @error('password') is-invalid @enderror"
                    name="password"
                    required>

                    @error('password')
                    <span class="invalid-feedback">
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
                            Forgot Password?
                        </a>
                    @endif

                </div>

                <button class="btn btn-primary btn-login w-100">

                    Login

                </button>

            </form>

        </div>

    </div>

</div>

</div>

@endsection