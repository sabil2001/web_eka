@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Pegawai</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Detail</li>
        <li class="breadcrumb-item active">Pegawai</li>
     </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center">
    <div class="col-xl-10">
        <div class="card">
            <div class="card-body">
               <h5 class="card-title">Pegawai</h5>
                @if ($pegawai->foto)
                    <img src="{{ asset('storage/' . $pegawai->foto) }}" class="rounded float-end" width="200px">
                @elseif($pegawai->jenis_kelamin == 'Perempuan')
                    <img src="/img/pp-girl.jpg" alt="Profile" class="rounded float-end" width="200px">
                @else
                    <img src="/img/pp-boy.jpg" alt="Profile" class="rounded float-end" width="200px">
                @endif
                <div class="row">
                    <div class="col-lg-4 col-md-4 label">Nama</div>
                    <div class="col-lg col-md-8">: {{ $pegawai->name }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label">Email</div>
                    <div class="col-lg col-md-8">: {{ $pegawai->email }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label">Alamat</div>
                    <div class="col-lg col-md-8">: {{ $pegawai->alamat }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label">No. Telfon</div>
                    <div class="col-lg col-md-8">: {{ $pegawai->no_telp }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label">Jenis Kelamin</div>
                    <div class="col-lg col-md-8">: {{ $pegawai->jenis_kelamin }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label">Jabatan</div>
                    <div class="col-lg col-md-8">: {{ $pegawai->jabatan }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 label">Status Akun</div>
                    <div class="col-lg col-md-8">: {{ $pegawai->status }}</div>
                </div>
                <button onclick="history.back()" class="btn btn-secondary mt-2">Back</button>
            </div>
         </div>
     </div>
    </div>
  </section>
@endsection