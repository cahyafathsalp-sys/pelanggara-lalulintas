@extends('layouts.app')

@section('content')

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container py-4 dashboard-page">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h2 class="fw-bold">
                🚦 Dashboard Sistem Pendataan Pelanggaran Lalu Lintas
            </h2>

            <small class="text-muted">
                Selamat datang di Sistem Informasi Pendataan Pelanggaran
            </small>
        </div>

        <div class="text-end">
            <h5 id="clock"></h5>
        </div>

    </div>

    <div class="row g-4">

        <!-- Petugas -->

        <div class="col-md-4">

            <div class="card bg-primary text-white shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h5>Total Petugas</h5>

                            <h1>{{ $petugas }}</h1>

                        </div>

                        <i class="bi bi-person-badge-fill icon"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Pengendara -->

        <div class="col-md-4">

            <div class="card bg-success text-white shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h5>Total Pengendara</h5>

                            <h1>{{ $pengendara }}</h1>

                        </div>

                        <i class="bi bi-person-fill icon"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Kendaraan -->

        <div class="col-md-4">

            <div class="card bg-warning text-dark shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h5>Total Kendaraan</h5>

                            <h1>{{ $kendaraan }}</h1>

                        </div>

                        <i class="bi bi-car-front-fill icon"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Jenis Pelanggaran -->

        <div class="col-md-6">

            <div class="card bg-info text-white shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h5>Jenis Pelanggaran</h5>

                            <h1>{{ $jenispelanggaran }}</h1>

                        </div>

                        <i class="bi bi-list-check icon"></i>

                    </div>

                </div>

            </div>

        </div>

        <!-- Total Pelanggaran -->

        <div class="col-md-6">

            <div class="card bg-danger text-white shadow">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <h5>Total Pelanggaran</h5>

                            <h1>{{ $pelanggaran }}</h1>

                        </div>

                        <i class="bi bi-exclamation-triangle-fill icon"></i>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Grafik -->

    <div class="card shadow mt-5">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                📊 Statistik Data

            </h5>

        </div>

        <div class="card-body">

            <canvas id="chartData" height="100"></canvas>

        </div>

    </div>

    <!-- Aktivitas -->

    <div class="card shadow mt-4">

        <div class="card-header bg-white">

            <h5 class="fw-bold mb-0">

                📋 Aktivitas Sistem

            </h5>

        </div>

        <div class="card-body">

            <ul class="list-group">

                <li class="list-group-item">
                    ✔ Data Petugas berhasil dikelola
                </li>

                <li class="list-group-item">
                    ✔ Data Pengendara berhasil dikelola
                </li>

                <li class="list-group-item">
                    ✔ Data Kendaraan berhasil dikelola
                </li>

                <li class="list-group-item">
                    ✔ Data Pelanggaran siap diproses
                </li>

            </ul>

        </div>

    </div>

</div>

<script>

// Jam Digital

setInterval(function(){

let now = new Date();

document.getElementById("clock").innerHTML =
now.toLocaleDateString('id-ID')+"<br>"+now.toLocaleTimeString('id-ID');

},1000);

// Chart

const ctx=document.getElementById('chartData');

new Chart(ctx,{

type:'bar',

data:{

labels:[
'Petugas',
'Pengendara',
'Kendaraan',
'Jenis Pelanggaran',
'Pelanggaran'
],

datasets:[{

label:'Jumlah Data',

data:[
{{ $petugas }},
{{ $pengendara }},
{{ $kendaraan }},
{{ $jenispelanggaran }},
{{ $pelanggaran }}
]

}]

},

options:{

responsive:true,

plugins:{

legend:{
display:false
}

}

}

});

</script>

@endsection