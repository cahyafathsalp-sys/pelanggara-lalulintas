@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

body{
    background:linear-gradient(rgba(15,23,42,.9),rgba(15,23,42,.9)),
    url('https://images.unsplash.com/photo-1518770660439-4636190af475');
    background-size:cover;
    background-attachment:fixed;
    color:white;
}

/* HEADER */

.hero{
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(15px);
    border-radius:20px;
    padding:30px;
    margin-bottom:25px;
    border:1px solid rgba(255,255,255,.1);
}

.hero h2{
    font-weight:bold;
}

#jam{
    font-size:22px;
    font-weight:bold;
}

/* CARD */

.card-dashboard{
    border:none;
    border-radius:18px;
    overflow:hidden;
    color:white;
    transition:.4s;
    position:relative;
}

.card-dashboard:hover{
    transform:translateY(-10px);
    box-shadow:0 20px 35px rgba(0,0,0,.35);
}

.card-dashboard::before{
    content:"";
    position:absolute;
    width:150px;
    height:150px;
    background:rgba(255,255,255,.15);
    border-radius:50%;
    right:-40px;
    top:-40px;
}

.card-body{
    position:relative;
    z-index:2;
}

.icon{
    font-size:55px;
    opacity:.3;
    float:right;
}

.bg1{background:linear-gradient(135deg,#4e54c8,#8f94fb);}
.bg2{background:linear-gradient(135deg,#00b894,#55efc4);}
.bg3{background:linear-gradient(135deg,#f7971e,#ffd200);}
.bg4{background:linear-gradient(135deg,#0984e3,#74b9ff);}
.bg5{background:linear-gradient(135deg,#d63031,#ff7675);}

.number{
    font-size:40px;
    font-weight:bold;
}

/* CHART */

.glass{
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(15px);
    border-radius:20px;
    border:1px solid rgba(255,255,255,.1);
    padding:20px;
}

/* MENU */

.menu-btn{

display:flex;

align-items:center;

justify-content:center;

flex-direction:column;

padding:20px;

border-radius:15px;

text-decoration:none;

color:white;

background:rgba(255,255,255,.08);

transition:.3s;

}

.menu-btn:hover{

background:#2563eb;

transform:translateY(-5px);

color:white;

}

.menu-btn i{

font-size:35px;

margin-bottom:10px;

}

/* PROGRESS */

.progress{

height:10px;

background:rgba(255,255,255,.15);

}

.progress-bar{

background:#00d2ff;

}

</style>

<div class="container py-4">

<div class="hero d-flex justify-content-between align-items-center">

<div>

<h2>🚦 Dashboard Pendataan Pelanggaran</h2>

<p class="mb-0">Selamat datang di Sistem Informasi Pendataan Pelanggaran Lalu Lintas</p>

</div>

<div class="text-end">

<h3 id="jam"></h3>

<span>{{ date('d F Y') }}</span>

</div>

</div>

<div class="row g-4">

<div class="col-lg-4">
<div class="card card-dashboard bg1">
<div class="card-body">
<i class="fas fa-user-shield icon"></i>
<h5>Petugas</h5>
<div class="number">{{ $petugas }}</div>

<div class="progress mt-3">
<div class="progress-bar" style="width:80%"></div>
</div>

</div>
</div>
</div>

<div class="col-lg-4">
<div class="card card-dashboard bg2">
<div class="card-body">
<i class="fas fa-motorcycle icon"></i>
<h5>Pengendara</h5>
<div class="number">{{ $pengendara }}</div>

<div class="progress mt-3">
<div class="progress-bar" style="width:70%"></div>
</div>

</div>
</div>
</div>

<div class="col-lg-4">
<div class="card card-dashboard bg3">
<div class="card-body">
<i class="fas fa-car icon"></i>
<h5>Kendaraan</h5>
<div class="number">{{ $kendaraan }}</div>

<div class="progress mt-3">
<div class="progress-bar" style="width:90%"></div>
</div>

</div>
</div>
</div>

<div class="col-lg-6">
<div class="card card-dashboard bg4">
<div class="card-body">
<i class="fas fa-list icon"></i>
<h5>Jenis Pelanggaran</h5>
<div class="number">{{ $jenispelanggaran }}</div>
</div>
</div>
</div>

<div class="col-lg-6">
<div class="card card-dashboard bg5">
<div class="card-body">
<i class="fas fa-triangle-exclamation icon"></i>
<h5>Total Pelanggaran</h5>
<div class="number">{{ $pelanggaran }}</div>
</div>
</div>
</div>

</div>

<div class="row mt-4">

<div class="col-lg-8">

<div class="glass">

<h4 class="mb-4">

📊 Statistik Pelanggaran

</h4>

<canvas id="myChart"></canvas>

</div>

</div>

<div class="col-lg-4">

<div class="glass">

<h4 class="mb-4">

⚡ Menu Cepat

</h4>

<div class="row g-3">

<div class="col-6">

<a href="{{ route('petugas.index') }}" class="menu-btn">

<i class="fas fa-user-shield"></i>

Petugas

</a>

</div>

<div class="col-6">

<a href="{{ route('pengendara.index') }}" class="menu-btn">

<i class="fas fa-user"></i>

Pengendara

</a>

</div>

<div class="col-6">

<a href="{{ route('kendaraan.index') }}" class="menu-btn">

<i class="fas fa-car"></i>

Kendaraan

</a>

</div>

<div class="col-6">

<a href="{{ route('pelanggaran.index') }}" class="menu-btn">

<i class="fas fa-file-circle-exclamation"></i>

Pelanggaran

</a>

</div>

</div>

</div>

</div>

</div>

</div>

<script>

const ctx=document.getElementById('myChart');

new Chart(ctx,{
type:'bar',
data:{
labels:['Jan','Feb','Mar','Apr','Mei','Jun'],
datasets:[{
label:'Jumlah Pelanggaran',
data:[12,19,8,15,10,22],
backgroundColor:[
'#4e54c8',
'#00b894',
'#f7971e',
'#0984e3',
'#d63031',
'#8e44ad'
],
borderRadius:8
}]
},
options:{
plugins:{
legend:{
labels:{
color:'white'
}
}
},
scales:{
x:{
ticks:{color:'white'}
},
y:{
ticks:{color:'white'}
}
}
}
});

setInterval(function(){

let now=new Date();

document.getElementById('jam').innerHTML=

now.toLocaleTimeString('id-ID');

},1000);

</script>

@endsection