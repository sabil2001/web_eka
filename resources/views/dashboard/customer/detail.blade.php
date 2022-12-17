@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Customer {{ $customer->nama }}</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Detail</li>
        <li class="breadcrumb-item active">Customer</li>
     </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
           <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">
                 <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button></li>
                 <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">History</button></li>
                 
              </ul>
              <div class="tab-content pt-2">
                 <div class="tab-pane fade show active profile-overview" id="profile-overview"> 
                    @if ($customer->status == 'Aktif')                
                    <h5 class="card-title">Profile <i class="bi bi-person-check bg-success p-2 text-light rounded"></i></h5>
                    @else
                    <h5 class="card-title">Profile <i class="bi bi-person-x bg-danger p-2 text-light rounded"></i></h5>
                    @endif
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Nama lengkap</div>
                       <div class="col-lg-9 col-md-8">{{ $customer->nama }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">NIK</div>
                       <div class="col-lg-9 col-md-8">{{ $customer->NIK }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Alamat</div>
                       <div class="col-lg-9 col-md-8">{{ $customer->alamat }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Nomor HP</div>
                       <div class="col-lg-9 col-md-8">{{ $customer->no_telp }}</div>
                    </div>
                 </div>
                 <div class="tab-pane fade profile-edit pt-3" id="profile-edit">
                    <h5 class="card-title">History</h5>
                    <table class="table table-striped table-sm">
                        <thead>
                          <tr>
                            <th scope="col">No</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">No. Pesanan</th>
                            <th scope="col">Total Pesan</th>
                            <th scope="col">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($pesanans as $keranjang)  
                          <tr>
                            <td>{{ $loop->iteration }}</td>
                            
                            <td>{{ Carbon\Carbon::parse($keranjang->pesanan_at)->format('d/m/Y') }}</td>
                            <td><a href="/dashboard/order/show/{{ $keranjang->id }}">{{ $keranjang->kode_keranjang }}</a></td>
                            <td>{{ $keranjang->pesanan->count() }} Pesanan</td>
                              @if ($keranjang->status == 'Belum Diproses' || $keranjang->status == 'Batal')
                                 <td><span class="badge bg-danger">{{ $keranjang->status }}</span></td>
                              @elseif ($keranjang->status == 'Proses Produksi')
                                 <td><span class="badge bg-warning">{{ $keranjang->status }}</span></td>
                              @else
                                 <td><span class="badge bg-success">{{ $keranjang->status }}</span></td>
                              @endif
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                 </div>
                 
                 
              </div>
           </div>
           <div class="row">
            <div class="col-12 ms-3">
               <button onclick="history.back()" class="btn btn-secondary btn-sm btn-block mb-4 btn-back">Back</button>
            </div>
           </div>
        </div>
        
     </div>
     
    </div>
  </section>
@endsection