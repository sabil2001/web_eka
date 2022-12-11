@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Verifikasi Produksi</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Verifikasi Produksi</li>
     </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Verifikasi Produksi</h5>
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
                      <th scope="col">Tgl. Selesai</th>
                      <th scope="col">Pegawai</th>
                      <th scope="col">Status</th>
                      <th scope="col" class="text-center">Invoice</th>
                      <th scope="col" class="text-center">Aksi</th>
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
                          <td>{{ Carbon\Carbon::parse($produksi->tgl_akhir)->format('Y-m-d') }}</td>
                          <td>{{ $produksi->user->name }}</td>
                          <td>
                              <span class="badge bg-success">{{ $produksi->status }}</span>
                          </td>
                          <td class="text-center">
                            <a href="/dashboard/order/invoice/{{ $produksi->keranjang->id }}" target="_blank" title="Invoice {{ $produksi->keranjang->kode_keranjang }}" class="tombol-invoice text-center"><i class="bi bi-receipt"></i> Cetak</a>
                          </td>
                          <td class="text-center">
                            <a href="/dashboard/verifikasi/formverif/{{ $produksi->id }}" title="Verifikasi {{ $produksi->keranjang->kode_keranjang }}" class="tombol-aksi text-center"><i class="bi bi-cart-check-fill"></i> Verifikasi</a>
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
