@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Batal Produksi</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Batal Produksi</li>
     </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Batal Produksi</h5>
              <hr>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Tidak dapat menambah pesanan</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      Pesanan ini batal atau diproses atau telah selesai.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>
              @if (session()->has('success'))   
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
          
          <div class="row">
            <div class="col">
              <div class="table-responsive">
                <table class="table table-striped table-sm">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">No. Pesanan</th>
                      <th scope="col">Customer</th>
                      <th scope="col">Tgl. Produksi</th>
                      <th scope="col">Deadline</th>
                      <th scope="col">Pegawai</th>
                      <th scope="col">Status</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col">Aksi</th>
                      </tr>
                  </thead>
                  <tbody>
                    @foreach ($produksis as $produksi)
                        <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $produksi->keranjang->kode_keranjang }}
                          </td>
                          <td>{{ $produksi->keranjang->customer->nama }}</td>
                          <td>{{ Carbon\Carbon::parse($produksi->tgl_mulai)->format('Y-m-d') }}</td>
                          <td>{{ Carbon\Carbon::parse($produksi->keranjang->tgl_jatuh_tempo)->format('Y-m-d') }}</td>
                          <td>{{ $produksi->user->name }}</td>
                          <td>
                              <span class="badge bg-danger">{{ $produksi->status }}</span>
                          </td>
                          <td>{{ $produksi->keterangan }}</td>
                          <td>
                            <a href="/dashboard/batal/produksi/detail/{{ $produksi->id }}" title="Detail {{ $produksi->keranjang->kode_keranjang }}" class="tombol-aksi text-center"><i class="bi bi-list-ol"></i> Detail</a>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
                {{ $produksis->links() }}
            </div>
            </div>
          </div>
            
           </div>
        </div>
     </div>
  </div>
</section>
@endsection
