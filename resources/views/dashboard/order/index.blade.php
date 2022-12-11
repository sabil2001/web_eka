@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Order</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.html">Home</a></li>
      <li class="breadcrumb-item">Data</li>
      <li class="breadcrumb-item active">Order</li>
    </ol>
</div>
     
     
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Order</h5>
              {{-- @foreach ($deadlines as $keranjang)
                @if ( Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) <= 7 && Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) >= 1)
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Waktu Tersisa <strong>{{ Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) }} Hari</strong>, No Pesanan<a class="stretched-link" href="/dashboard/order/show/{{ $keranjang->id }}"> {{ $keranjang->kode_keranjang }}</a>.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @elseif ( Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) <= 0 )
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Pesanan <a class="stretched-link" href="/dashboard/order/show/{{ $keranjang->id }}">{{ $keranjang->kode_keranjang }}</a> Waktu <strong>Melebihi</strong> Jatuh Tempo, cek Produksi dan hubungi Customer.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif
              @endforeach --}}
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
          <hr>
          <div class="row">
            <div class="col">
              @can('admin')  
              <a href="/dashboard/order/create" class="btn btn-primary mb-2"><i class="bi bi-file-earmark-plus"></i><span class="ms-2">Order</span></a>
              @endcan
            </div>
          </div>
          <div class="table-responsive">
              <table class="table table-striped table-sm mt-2">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">No. Pesanan</th>
                    <th scope="col">Customer</th>
                    <th scope="col">Tanggal Pesan</th>
                    <th scope="col">Jatuh Tempo</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Invoice</th>
                    <th scope="col" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                  @foreach ($keranjangs as $keranjang)
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $keranjang->kode_keranjang }}
                          @if ($keranjang->status == 'Belum diproduksi')
                              <a href="/dashboard/order/create/{{ $keranjang->id }}" title="Tambah Pesanan"><i class="bi bi-plus-circle-fill"></i></a>
                          @else
                              <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" title="Tambah Pesanan"><i class="bi bi-plus-circle-fill"></i></a>
                          @endif
                        </td>
                        <td>{{ $keranjang->customer->nama }}</td>
                        <td>{{ Carbon\Carbon::parse($keranjang->pesanan_at)->format('Y-m-d') }}</td>
                        <td>{{ $keranjang->tgl_jatuh_tempo }}</td>
                        <td>
                          @if ($keranjang->status == 'Batal')
                            <span class="badge bg-danger">{{ $keranjang->status }}</span>
                          @elseif ($keranjang->status == 'Batal produksi')
                            <span class="badge bg-danger">{{ $keranjang->status }}</span>
                          @elseif ($keranjang->status == 'Belum diproduksi')
                            <span class="badge bg-warning">{{ $keranjang->status }}</span>
                          @elseif ($keranjang->status == 'Proses produksi')
                            <span class="badge bg-info">{{ $keranjang->status }}</span>
                          @elseif ($keranjang->status == 'Selesai produksi')
                          <span class="badge bg-success">{{ $keranjang->status }}</span>
                          @elseif ($keranjang->status == 'Revisi')
                          <span class="badge bg-warning">{{ $keranjang->status }}</span>
                          @else
                          <span class="badge bg-success">{{ $keranjang->status }}</span>
                          @endif
                          
                        </td>
                        <td class="text-center">
                          <a href="/dashboard/order/invoice/{{ $keranjang->id }}" target="_blank" title="Invoice {{ $keranjang->kode_keranjang }}" class="tombol-invoice text-center"><i class="bi bi-receipt"></i> Cetak</a>
                        </td>
                        <td class="text-center">
                          <a href="/dashboard/order/show/{{ $keranjang->id }}" title="Detail {{ $keranjang->kode_keranjang }}" class="tombol-aksi text-center"><i class="bi bi-list-ol"></i> Detail Pesanan</a>
                        </td>
                      </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $keranjangs->links() }}
            </div>
           </div>
        </div>
     </div>
  </div>
</section>
@endsection
