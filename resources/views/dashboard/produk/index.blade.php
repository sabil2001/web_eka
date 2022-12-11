@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Produk</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Produk</li>
     </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Produk</h5>
              <hr>
              @if (session()->has('success'))   
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong> Cek data pada tabel di bawah.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

          <div class="table-responsive">
            
            <a href="/dashboard/produk/create" class="btn btn-primary"><i class="bi bi-file-earmark-plus"></i><span class="ms-2">Produk</span></a>
              <table class="table table-striped table-sm mt-2">
                <thead>
                  <tr>
                    <th >No</th>
                    <th>Kode</th>
                    <th>Nama Produk</th>
                    <th>Size</th>
                    <th class="text-center">Total Pembelian</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($produks as $produk)  
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>{{ $produk->kode_produk }}</td>
                    <td>{{ $produk->nama_produk }}</td>
                    <td>{{ $produk->size }}</td>
                    <td class="text-center">{{ $produk->jumlah_laku }}</td>
                    <td class="text-center">
                      @if ($produk->status=="Aktif")
                            <span class="badge bg-success">{{ $produk->status }}</span>
                      @else
                            <span class="badge bg-danger">{{ $produk->status }}</span>
                      @endif 
                    </td>

                    <td class="text-center">
                      <a href="/dashboard/produk/{{ $produk->id }}" class="tombol-invoice"><i class="bi bi-list-ol"></i> Detail</a>
                      
                      <a href="/dashboard/produk/{{ $produk->id }}/edit" class="tombol-aksi"><i class="bi bi-pencil"></i> Edit</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $produks->links() }}
            </div>
           </div>
        </div>
     </div>
  </div>
</section>

@endsection
