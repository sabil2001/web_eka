@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Pesanan</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Detail</li>
        <li class="breadcrumb-item active">Pesanan</li>
     </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
               <h5 class="card-title">Customer</h5>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Nama lengkap</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->customer->nama }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">NIK</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->customer->NIK }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Alamat</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->customer->alamat }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">No. Telfon</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->customer->no_telp }}</div>
                </div>

               <h5 class="card-title">Pesanan</h5>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Model </div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->model_produk }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Kain</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->jenis_kain }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Total Order</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->total_barang }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Keterangan</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->keterangan }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">tgl Pesanan</div>
                    <div class="col-lg-9 col-md-8">: {{ Carbon\Carbon::parse($pesanan->pesanan_at)->format('d/m/Y') }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">tgl Jatuh Tempo</div>
                    <div class="col-lg-9 col-md-8">: {{ Carbon\Carbon::parse($pesanan->tgl_jatuh_tempo)->format('d/m/Y') }}</div>
                </div>
                @foreach ($produksi as $produksi)
                <h5 class="card-title">Produksi</h5>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Pegawai Handle</div>
                    <div class="col-lg-9 col-md-8">: {{ $produksi->user->name }}</div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Status</div>
                    <div class="col-lg-9 col-md-8">: {{ $pesanan->status }}, diupdate {{ Carbon\Carbon::parse($pesanan->updated_at)->format('d/m/Y') }}</div>
                </div>
                <div class="row">
                        <div class="col-lg-3 col-md-4 label">Keterangan</div>
                        <div class="col-lg-9 col-md-8">: {{ $produksi->keterangan }}, diupdate {{ Carbon\Carbon::parse($produksi->updated_at)->format('d/m/Y') }}</div>
                </div>
                @if (!$produksi)
                    
                @else
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Total Barang Jadi</div>
                    @if (!$produksi->total_barang_jadi)
                        <div class="col-lg-9 col-md-8">: -</div>
                    @else
                        <div class="col-lg-9 col-md-8">: {{ $produksi->total_barang_jadi }}</div>
                    @endif                   
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-4 label">Tanggal Selesai</div>
                    @if (!$produksi->tgl_akhir)
                        <div class="col-lg-9 col-md-8">: -</div>
                    @else
                        <div class="col-lg-9 col-md-8">: {{ Carbon\Carbon::parse($produksi->tgl_akhir)->format('d/m/Y') }}</div>
                    @endif                   
                </div>
                @endif
                @endforeach
                

                
                
                
            </div>
         </div>
     </div>
    </div>
  </section>
@endsection