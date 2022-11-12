@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Produksi</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Pesanan</li>
        <li class="breadcrumb-item active">Verifikasi</li>
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
                    <h5 class="card-title">Verifikasi Produksi</h5>
                    @foreach ($produksis as $produksi)
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Nama Customer</div>
                        <div class="col-lg-9 col-md-8">: {{ $pesanan->customer->nama }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Nama Pekerja</div>
                        <div class="col-lg-9 col-md-8">: {{ $produksi->user->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Ket. Pesanan</div>
                        <div class="col-lg-9 col-md-8">: {{ $pesanan->keterangan }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Total order</div>
                        <div class="col-lg-9 col-md-8">: {{ $pesanan->total_barang }}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 label">Total Barang Jadi</div>
                        <div class="col-lg-9 col-md-8">: {{ $produksi->total_barang_jadi }}</div>
                    </div>
                    
                    
                    @endforeach
                    <div class="row mt-2">
                        <form method="post" action="/dashboard/pesanan/verifikasi/{{ $produksi->id }}"> 
                        @csrf
                        <div class="col-4">
                            <input type="hidden" class="form-control" value="{{ $produksi->id }}" name="produksi_id" >
                        </div>
                        <div class="col mt-2">
                            <label for="status_verifikasi" class="form-label">Status Verifikasi</label>
                            <select class="form-select" aria-label="status_verifikasi" id="status_verifikasi" name="status_verifikasi" placeholder="status_verifikasi" required value="{{ old('status_verifikasi') }}">
                                <option value="" class="text-center">--pilih--</option>
                                <option value="Verifikasi" class="">Verifikasi</option>
                                <option value="Revisi" class="">Revisi</option>
                                @error('status_verifikasi')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </select>
                        </div>
                        <div class="col mt-2">
                            <label for="keterangan" class="form-label">Keterangan Verifikasi</label>
                            <input type="text" class="form-control" placeholder="keterangan..." name="keterangan" id="keterangan">
                            @error('keterangan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                            @enderror
                        </div>
                        <div class="col mt-2">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Verifikasi</button>
                                <a class="btn btn-secondary" href="/dashboard/pesanan">Kembali</a>
                            </div>
                        </div>
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