@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Kain</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Kain</li>
     </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Kain</h5>
              <hr>
              @if (session()->has('success'))   
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  <strong>{{ session('success') }}</strong> Cek data pada tabel di bawah.
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

          <div class="table-responsive">
            
            <a href="/dashboard/kain/create" class="btn btn-primary"><i class="bi bi-file-earmark-plus"></i><span class="ms-2">Kain</span></a>
              <table class="table table-striped table-sm mt-2">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Jenis Kain</th>
                    <th>Warna</th>
                    <th class="text-center">Stok</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($kains as $kain)  
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    
                    <td>{{ $kain->kode_kain }}</td>
                    <td>{{ $kain->nama_kain }}</td>
                    <td>{{ $kain->warna }}</td>
                    <td class="text-center">{{ $kain->stock }} CM</td>
                    <td class="text-center">
                      @if ($kain->status=="Aktif")
                            <span class="badge bg-success">{{ $kain->status }}</span>
                      @else
                            <span class="badge bg-danger">{{ $kain->status }}</span>
                      @endif 
                    </td>

                    <td class="text-center">
                      <a href="/dashboard/kain/{{ $kain->id }}/edit" class="tombol-aksi"><i class="bi bi-pencil"></i> Edit</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $kains->links() }}
            </div>
           </div>
        </div>
     </div>
  </div>
</section>

@endsection
