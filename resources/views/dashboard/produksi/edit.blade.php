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
                    <h5 class="card-title">Edit Keterangan Produksi</h5>
                    @foreach ($produksis as $produksi)
                    @endforeach
                    <div class="row mt-2">
                        <form method="post" action="/dashboard/produksi/edit/{{ $produksi->id }}"> 
                        @method('put') 
                        @csrf
                        <div class="col-4">
                            <input type="hidden" class="form-control" value="{{ $produksi->id }}" name="produksi_id" >
                        </div>
                        <div class="col-6">
                          <label for="total_barang_jadi" class="form-label">Total Barang Selesai</label>
                            <input type="number" class="form-control @error ('total_barang_jadi') is-invalid @enderror" name="total_barang_jadi" id="total_barang_jadi"  placeholder="total..." value="{{ $produksi->total_barang_jadi }}">
                            @error('total_barang_jadi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="col mt-2">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control" value="{{ $produksi->keterangan }}" name="keterangan" id="keterangan">
                        </div>
                        <div class="col mt-2">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Update Status</button>
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