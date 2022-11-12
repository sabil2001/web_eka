@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Produksi</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Pesanan</li>
        <li class="breadcrumb-item active">Produksi</li>
     </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
           <div class="card-body">
              <div class="tab-content">
                 <div class="tab-pane fade show active profile-overview" id="profile-overview"> 
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
                       <div class="col-lg-3 col-md-4 label">No. Handphone</div>
                       <div class="col-lg-9 col-md-8">: {{ $pesanan->customer->no_telp }}</div>
                    </div>
                    <h5 class="card-title">Pesanan</h5>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Model</div>
                       <div class="col-lg-9 col-md-8">: {{ $pesanan->model_produk }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Kain</div>
                       <div class="col-lg-9 col-md-8">: {{ $pesanan->jenis_kain }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Pesanan</div>
                       <div class="col-lg-9 col-md-8">: {{ $pesanan->tgl_pesanan }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Deadline</div>
                       <div class="col-lg-9 col-md-8">: {{ $pesanan->tgl_jatuh_tempo }}</div>
                    </div>
                    <h5 class="card-title">Produksi</h5>
                    <div class="row mt-2">
                        <form method="post" action="/dashboard/produksi/{{ $pesanan->id }}">  
                        @csrf
                        <div class="col-4">
                            {{-- <label for="keterangan" class="form-label">Kode pesanan</label> --}}
                            <input type="hidden" class="form-control" value="{{ $pesanan->id }} " name="pesanan_id" >
                        </div>
                        <div class="col mt-2">
                            <label for="keterangan" class="form-label">keterangan</label>
                            <input type="text" class="form-control" value="" name="keterangan" id="keterangan" required>
                        </div>
                        <div class="text-center mt-2"> <button type="submit" class="btn btn-primary">Update Status</button></div>
                        </form>
                    </div>
                        
                    </div>           
                   </div>
              </div>
           </div>
        </div>
     </div>
    </div>
  </section>
@endsection