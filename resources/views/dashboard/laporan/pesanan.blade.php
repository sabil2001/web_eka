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
  {{-- <div class="row">
    <div class="col-lg-12">
       <div class="card">
          <div class="card-body">
             <h5 class="card-title">Datatables</h5>
             <p>Add lightweight datatables to your project with using the <a href="https://github.com/fiduswriter/Simple-DataTables" target="_blank">Simple DataTables</a> library. Just add <code>.datatable</code> class name to any table you wish to conver to a datatable</p>
             <table class="table datatable">
                <thead>
                   <tr>
                      <th scope="col">#</th>
                      <th scope="col">Name</th>
                      <th scope="col">Position</th>
                      <th scope="col">Age</th>
                      <th scope="col">Start Date</th>
                   </tr>
                </thead>
                <tbody>
                   <tr>
                      <th scope="row">1</th>
                      <td>Brandon Jacob</td>
                      <td>Designer</td>
                      <td>28</td>
                      <td>2016-05-25</td>
                   </tr>
                   <tr>
                      <th scope="row">2</th>
                      <td>Bridie Kessler</td>
                      <td>Developer</td>
                      <td>35</td>
                      <td>2014-12-05</td>
                   </tr>
                   <tr>
                      <th scope="row">3</th>
                      <td>Ashleigh Langosh</td>
                      <td>Finance</td>
                      <td>45</td>
                      <td>2011-08-12</td>
                   </tr>
                   <tr>
                      <th scope="row">4</th>
                      <td>Angus Grady</td>
                      <td>HR</td>
                      <td>34</td>
                      <td>2012-06-11</td>
                   </tr>
                   <tr>
                      <th scope="row">5</th>
                      <td>Raheem Lehner</td>
                      <td>Dynamic Division Officer</td>
                      <td>47</td>
                      <td>2011-04-19</td>
                   </tr>
                </tbody>
             </table>
          </div>
       </div>
    </div>
 </div> --}}
  <div class="row">
    <div class="col-lg-12">
       <div class="card">
          <div class="card-body">
             <h5 class="card-title"><i class="bi bi-search"></i> Filter Data</h5>
             {{-- <form action="" method="get"> --}}
              {{-- <div class="row">
                @if ($tglawal || $tglakhir)
                    sasa
                @else
                    
                @endif
                {{-- <div>{{ Carbon\Carbon::parse($start)->format('d-m-Y') }}</div> --}}
                {{-- <div>{{ Carbon\Carbon::parse($end)->format('d-m-Y') }}</div> --}}
                {{-- <div class="col-2">
                    <input type="date" name="tglawal" id="tglawal" class="form-control">
                </div>
                <div class="col-2">
                    <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                </div>
                <div class="col-2">
                    <a href="#" onclick="this.href='/dashboard/laporan/pesanan-pertanggal/'+document.getElementById('tglawal').value +
                '/' + document.getElementById('tglakhir').value " target="_blank" class="btn btn-primary col-md-12">Cetak</a>
                <button>cari</button>
                </div>
              </div> --}} 
          </div>
       </div>
    </div>
  </div>
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Order</h5>
              <div class="row">
                <div class="col-11">
                  <div class="ms-1">Waktu Pesanan Dibuat</div>
                  <div class="filter">
                    <form action="" method="get">
                    <input type="date" name="tglawal" id="tglawal">
                    <input type="date" name="tglakhir" id="tglakhir">
                    
                    <button class="filter-button">Tampilkan</button>
                    <a href="#" onclick="this.href='/dashboard/laporan/pesanan-pertanggal/'+document.getElementById('tglawal').value +
                        '/' + document.getElementById('tglakhir').value " target="_blank" class="button-cetak">Cetak</a>
                    </form>
                  </div>
                  <div>
                    @if ($tglawal || $tglakhir)
                        <div class="small ms-1">Menampilkan pesanan dibuat pada tanggal {{ Carbon\Carbon::parse($tglawal)->format('d-m-Y') }} sampai {{ Carbon\Carbon::parse($tglakhir)->format('d-m-Y') }}.</div>
                    @else
                        
                    @endif
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
