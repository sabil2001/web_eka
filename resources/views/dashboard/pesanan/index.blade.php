@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Pesanan</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Pesanan</li>
     </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Pesanan</h5>

              @if (session()->has('success'))   
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                  {{ session('success') }}
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif

          <div class="table-responsive">
            @can('admin')  
            <a href="/dashboard/pesanan/create" class="btn btn-primary mb-2 mt-2" >Tambah Pesanan</a>
            @endcan

            <form action="/filterDate" method="GET">
            <div class="row">
              <div class="col-5">
                <div class="input-group">
                  <input type="date" class="form-control" name="start_date">
                  <input type="date" class="form-control ms-2" name="end_date">
                  <button class="btn btn-primary ms-2" type="submit">Filter</button>
                </div>
              </div>

            </div>
            </form>

              <table class="table table-striped table-sm mt-2">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Telfon</th>
                    <th scope="col">Model Produk</th>
                    <th scope="col">Kain</th>
                    <th scope="col">Total (pcs)</th>
                    <th scope="col">Pesanan</th>
                    <th scope="col">Jatuh Tempo</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col">Invoice</th>
                    @can('admin')
                    <th scope="col">Verifikasi</th>
                    @endcan
                    @can('produksi')
                    <th scope="col">Produksi</th>
                    @endcan
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pesanans as $pesanan)  
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pesanan->customer->nama }}</td>
                    <td>{{ $pesanan->customer->no_telp }}</td>
                    <td>{{ $pesanan->model_produk }}</td>
                    <td>{{ $pesanan->jenis_kain }}</td>
                    <td class="text-center">{{ $pesanan->total_barang }}</td>
                    <td>{{ Carbon\Carbon::parse($pesanan->pesanan_at)->format('d/m/Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($pesanan->tgl_jatuh_tempo)->format('d/m/Y')}}</td>
                    @if ($pesanan->status == 'Belum Diproses')
                      <td><span class="badge bg-danger">{{ $pesanan->status }}</span></td>
                    @elseif ($pesanan->status == 'Proses Produksi')
                      <td><span class="badge bg-warning">{{ $pesanan->status }}</span></td>
                    @elseif ($pesanan->status == 'Proses Verifikasi')
                      <td><span class="badge bg-secondary">{{ $pesanan->status }}</span></td>
                    @elseif ($pesanan->status == 'Revisi')
                      <td><span class="badge bg-danger">{{ $pesanan->status }}</span></td>
                    @else
                      <td><span class="badge bg-success">{{ $pesanan->status }}</span></td>
                    @endif
                    
                    {{-- action --}}
                    <td class="text-center">

                      <a href="/dashboard/pesanan/{{ $pesanan->id }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>

                      {{-- pengkondisian edit --}}
                      @can('admin')
                      @if ($pesanan->status == 'Belum Diproses')
                          <a href="/dashboard/pesanan/{{ $pesanan->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></a>
                      @else
                      <!-- Button trigger modal -->
                      <button type="button" class="badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        <i class="bi bi-pencil"data-bs-target="#staticBackdrop"></i>
                      </button>
                      <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header bg-info">
                              <h1 class="modal-title fs-5 text-light fw-bold" id="staticBackdropLabel">INFO</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Pesanan tidak dapat diubah.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @endif
                      @endcan
                    </td>
                    {{-- endaction --}}

                    {{-- cetak invoice --}}
                    <td class="text-center">
                      {{-- <a href="" class="badge bg-info"><i class="bi bi-eye"></i>invoice</span></a> --}}
                      <a href="/dashboard/pesanan/invoice/{{ $pesanan->id }}" class="badge bg-success" target="_blank"><i class="bi bi-receipt"></i></a>
                    </td>
                    {{-- end cetak invoice --}}

                    {{-- verifikasi --}}
                    @can('admin')
                    <td class="text-center">
                      @if ($pesanan->status == 'Belum Diproses'|| $pesanan->status == 'Proses Produksi')
                      <button type="button" class="badge bg-primary border-0" data-bs-toggle="modal" data-bs-target="#belumproses">
                        <i class="bi bi-folder-check" data-bs-target="#belumproses"></i>
                      </button>
                      <div class="modal fade" id="belumproses" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header bg-info">
                              <h1 class="modal-title fs-5 text-light fw-bold" id="staticBackdropLabel">INFO</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Pesanan belum diproses.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @elseif ($pesanan->status == 'Revisi')
                      <a href="/dashboard/pesanan/editverifikasi/{{ $pesanan->id }}" class="badge bg-primary"><i class="bi bi-folder-check"></i></span></a>
                      @elseif ($pesanan->status == 'Sudah Verifikasi')
                      <button type="button" class="badge bg-primary border-0" data-bs-toggle="modal" data-bs-target="#sudahVerifikasi">
                        <i class="bi bi-folder-check" data-bs-target="#sudahVerifikasi"></i>
                      </button>
                      <div class="modal fade" id="sudahVerifikasi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header bg-info">
                              <h1 class="modal-title fs-5 text-light fw-bold" id="staticBackdropLabel">INFO</h1>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              Pesanan sudah verifikasi.
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      @else
                      <a href="/dashboard/pesanan/verifikasi/{{ $pesanan->id }}" class="badge bg-primary"><i class="bi bi-folder-check"></i></span></a>
                      @endif
                    </td>
                    @endcan
                    {{-- endverifikasi --}}

                    {{-- produksi button --}}
                    @can('produksi')
                    <td class="text-center">
                      <div class="dropdown-center" >
                        <button class="btn btn-sm btn-dark dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="bi bi-card-list"></i>
                        </button>
                        <ul class="dropdown-menu bg-light text-center">

                          @if ($pesanan->status == 'Belum Diproses')
                            <li><a class="dropdown-item" href="/dashboard/produksi/{{ $pesanan->id }}">Mulai Produksi</a></li>
                          @elseif($pesanan->status == 'Proses Produksi')
                            <li><a class="dropdown-item" href="/dashboard/produksi/edit/{{ $pesanan->id }}">Edit Keterangan</a></li>
                            <li><a class="dropdown-item" href="/dashboard/produksi/form/{{ $pesanan->id }}">Selesai Produksi</a></li>
                          @else
                            <li><a class="dropdown-item" href="/dashboard/produksi/edit/{{ $pesanan->id }}">Edit Keterangan</a></li>
                          @endif
                        </ul>
                      </div>
                      </td>
                    @endcan
                      {{-- end produksi --}}
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $pesanans->links() }}
            </div>
           </div>
        </div>
     </div>
  </div>
</section>
@endsection
