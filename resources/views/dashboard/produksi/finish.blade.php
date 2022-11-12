@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Produksi</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Selesai</li>
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
                    <h5 class="card-title">Form Selesai Produksi</h5>
                    @foreach ($produksis as $produksi)
                    @endforeach
                    <div class="row mt-2">
                        <form method="post" action="/dashboard/produksi/finish/{{ $produksi->id }}"> 
                        @method('put') 
                        @csrf
                        <div class="col-4">
                            <input type="hidden" class="form-control" value="{{ $produksi->id }}" name="produksi_id" >
                        </div>
                    <div class="row">
                        <div class="col-6">
                            <label for="total_barang_jadi" class="form-label">Total Barang Selesai</label>
                              <input type="number" class="form-control @error ('total_barang_jadi') is-invalid @enderror" name="total_barang_jadi" id="total_barang_jadi"  placeholder="total..." required value="{{ old('total_barang_jadi') }}">
                              @error('total_barang_jadi')
                                  <div class="invalid-feedback">
                                      {{ $message }}
                                  </div>
                              @enderror
                          </div>
                          <div class="col-6">
                            <label for="tgl_akhir" class="form-label">Tanggal Selesai</label>
                            <input id="tgl_akhir" class="form-control @error ('tgl_akhir') is-invalid @enderror" type="date" name="tgl_akhir" required value="">
                            @error('tgl_akhir')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                            @enderror 
                          </div>
                    </div>
                        <div class="col mt-2">
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error ('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" value="{{ $produksi->keterangan }}">
                            @error('keterangan')
                            <div class="invalid-feedback">
                            {{ $message }}
                            </div>
                        @enderror 
                        </div>
                        <div class="col mt-2">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">Selesai Produksi</button>
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