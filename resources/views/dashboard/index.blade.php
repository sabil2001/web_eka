@extends('dashboard.layouts.main')

@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.13.1/datatables.min.css"/>
@stop
@section('container')

<div class="pagetitle">
  <h1>Dashboard</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
 </div>
 <section class="d-flex">
  <div class="layar-kiri">
    <div class="row">
      <div class="col-12 col-xl-12">
        <div class="card p-3">
          <div class="row">
            <div class="col">
              <div class="fw-bold h6">
                <i class="bi bi-list-task"></i> Yang perlu dilakukan
                <div class="fw-light small">Hal-hal yang perlu kamu tangani</div>
              </div>
            </div>
          </div>
          @php
            $belum_produksi = DB::table('keranjangs')->where('status', '=', 'Belum diproduksi')->count();
            $proses_produksi = DB::table('keranjangs')->where('status', '=', 'Proses produksi')->count();
            $selesai_produksi = DB::table('keranjangs')->where('status', '=', 'Selesai produksi')->count();
          @endphp
          <div class="row text-center mt-2">
            <div class="d-flex box-box-dashboard justify-content-center align-self-center mx-auto">
              <a href="/dashboard/verifikasi" class="link-tugas">
                <div class="col-12 box-tugas">
                  <div class="fw-bold text-danger jumlah-tugas">{{ $selesai_produksi }}</div>
                  <div class="small text-dark">Belum diverifikasi</div>
                </div>
              </a>
              <a href="/dashboard/prosesproduksi" class="link-tugas">
                <div class="col-12 box-tugas">
                  <div class="fw-bold text-danger jumlah-tugas">{{ $belum_produksi }}</div>
                  <div class="small text-dark">Belum diproduksi</div>
                </div>
              </a>
              <a href="/dashboard/keranjang/produksi/proses" class="link-tugas">
                <div class="col-12 box-tugas-akhir">
                  <div class="fw-bold text-danger jumlah-tugas">{{ $proses_produksi }}</div>
                  <div class="small text-dark">Selesaikan produksi</div>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: -15px">
      <div class="col-12 col-xl-12">
        <div class="card p-3">
          <div class="row">
            <div class="col">
              <div class="fw-bold h6">
                <i class="bi bi-sort-down-alt"></i> Stock kain hampir habis
                <div class="fw-light small">Segera isi stock kain</div>
              </div>
            </div>
            <div class="col">
              <a href="/dashboard/kain" class="float-end">Lainnya <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <table class="table table-sm table-striped table-hover">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Jenis Kain</th>
                    <th scope="col">Warna</th>
                    <th scope="col">Stock</th>
                  </tr>
                </thead>
                <tbody>
                  @php
                    // $stock_habis = DB::table('kains')->where('stock', '<', 1500)->orderByDesc('stock')->limit(5)->get();
                    $stock_habis = DB::table('kains')->where('stock', '<=', 10)->orderBy('stock', 'asc')->limit(5)->get();
                    $total_data = DB::table('kains')->where('stock', '<=', 10)->count();
                  @endphp
                  @foreach ($stock_habis as $data)
                  <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td><a href="/dashboard/kain/{{ $data->id }}/edit" class="text-dark">{{ $data->kode_kain }}</a></td>
                    <td>{{ $data->nama_kain }}</td>
                    <td>{{ $data->warna }}</td>
                    <td>{{ $data->stock }} M</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="small">Menampilkan 1 sampai 5 dari {{ $total_data }} data</div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: -15px">
      <div class="col-12 col-xl-12">
        <div class="card p-3">
          <div class="row">
            <div class="col">
              <div class="fw-bold h6">
                <i class="bi bi-sort-up"></i> Produk terlaris
                <div class="fw-light small">Menampilkan data produk terlaris</div>
              </div>
            </div>
            <div class="col">
              <a href="/dashboard/produk" class="float-end">Lainnya <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <label for="">Filter Bulan</label>
              <select class="form-control filter-terlaris" id="filter-bulan">
                @foreach(list_bulan() as $key=>$bulan)
                <option @if($key == date('m')) selected @endif value="{{ $key }}">{{ $bulan }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-sm-6">
              <label for="">Filter Tahun</label>
              <select class="form-control filter-terlaris" id="filter-tahun">
                @for($i=date('Y');$i>=date('Y', strtotime('-5 years'));$i--)
                <option @if($key == date('Y')) selected @endif value="{{ $i }}">{{ $i }}</option>
                @endfor
              </select>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <table class="table table-sm table-striped table-hover" id="produk-terlaris">
                <thead>
                  <tr>
                    <th scope="col">Kode</th>
                    <th scope="col">Produk</th>
                    <th scope="col">Size</th>
                    <th scope="col">Kain</th>
                    <th scope="col">Warna</th>
                    <th scope="col" class="text-center">Total</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              {{-- <div class="small">Menampilkan 1 sampai 5 dari {{ $total_data_produk }} data</div> --}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: -15px">
      <div class="col-12 col-xl-12">
        <div class="card p-3">
          <div class="row">
            <div class="col">
              <div class="fw-bold h6">
                <i class="bi bi-bar-chart"></i> Statistik Pesanan
                <div class="fw-light small">Menampilkan data pesanan perbulan</div>
              </div>
            </div>
            <div class="col">
              <a href="/dashboard/order" class="float-end">Lainnya <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <canvas id="mataChart" class="chartjs" width="undefined" height="undefined"></canvas>
            </div>
          </div>
          {{-- <div class="row">
            <div class="col">
              <div><span class="fw-bold">8 </span>bulan ini vs bulan kemarin <span class="fw-bold">8 </span> pesanan</div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: -15px">
      <div class="col-12 col-xl-12">
        <div class="card p-3">
          <div class="row">
            <div class="col">
              <div class="fw-bold h6">
                <i class="bi bi-bar-chart"></i> Stacked Bar Chart
                <div class="fw-light small">Menampilkan data pesanan perbulan</div>
              </div>
            </div>
            <div class="col">
              <a href="/dashboard/order" class="float-end">Lainnya <i class="bi bi-chevron-right"></i></a>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <canvas id="mataChart" class="chartjs" width="undefined" height="undefined"></canvas>
            </div>
          </div>
          {{-- <div class="row">
            <div class="col">
              <div><span class="fw-bold">8 </span>bulan ini vs bulan kemarin <span class="fw-bold">8 </span> pesanan</div>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
    <div class="row" style="margin-top: -15px">
      <div class="col-12 col-xl-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Line Chart</h5>
              <canvas id="lineChart" style="max-height: 400px;"></canvas>
              <script>document.addEventListener("DOMContentLoaded", () => {
                 new Chart(document.querySelector('#lineChart'), {
                   type: 'line',
                   data: {
                     labels: <?php echo json_encode($label); ?>,
                     datasets: [{
                       label: 'Statistik Pesanan',
                       data: <?php echo json_encode($jumlah_user); ?>,
                       fill: false,
                       borderColor: 'rgb(75, 192, 192)',
                       tension: 0.1
                     }]
                   },
                   options: {
                     scales: {
                       y: {
                         beginAtZero: true
                       }
                     }
                   }
                 });
                 });
              </script> 
           </div>
        </div>
     </div>
    </div>
    <div class="row" style="margin-top: -15px">
      {{-- @php
          $produk = mysqli_query($koneksi,"select * from tb_barang");
          while($row = mysqli_fetch_array($produk)){
            $nama_produk[] = $row['barang'];
            
            $query = mysqli_query($koneksi,"select sum(jumlah) as jumlah from tb_penjualan where id_barang='".$row['id_barang']."'");
            $row = $query->fetch_array();
            $jumlah_produk[] = $row['jumlah'];
          }
      @endphp  --}}
      <div class="col-12 col-xl-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Pie Chart</h5>
              {{-- <form action="" method="get">
                <input type="date" class="form-control" name="tgl_awal">
                <input type="date" class="form-control" name="tgl_akhir">
                <button>cari</button>
              </form> --}}
              <canvas id="pieChart" style="max-height: 400px;"></canvas>
              <script>document.addEventListener("DOMContentLoaded", () => {
                 new Chart(document.querySelector('#pieChart'), {
                   type: 'pie',
                   data: {
                     labels: <?php echo json_encode($label_produk); ?> ,
                     datasets: [{
                       label: 'My First Dataset',
                       data: <?php echo json_encode($jumlah_laku); ?>,
                       backgroundColor: [
                         'rgb(255, 99, 132)',
                         'rgb(54, 162, 235)',
                         'rgb(255, 205, 86)'
                       ],
                       hoverOffset: 4
                     }]
                   }
                 });
                 });
              </script> 
           </div>
        </div>
     </div>
    </div>
  </div>
    <div class="layar-kanan ms-3">
      <div class="row">
        <div class="col-12 col-xl-12">
          <div class="card p-3">
            <div class="row">
              <div class="col">
                <div class="fw-bold h6">
                  <i class="bi bi-card-list"></i> Jatuh tempo
                  <div class="fw-light small">Segera selesaikan orderan</div>
                </div>
              </div>
            </div>
            @forelse ($deadline as $keranjang)
              @if (Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) <= 5) 
                <div class="bg-card mt-2">
                  <div class="fw-bold text-danger"><i class="bi bi-calendar3"></i> Sisa waktu {{ Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) }} Hari <span class="date-list">{{ Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->format('d/m/Y') }}</span></div>
                  <div class="judul-deadline">
                    <span style="position: relative; top:6px;">{{ $keranjang->kode_keranjang }}</span>
                    <a href="/dashboard/order/show/{{ $keranjang->id }}" class="link-menuju-pesanan">Lihat</a>
                  </div>
                </div>
              @elseif (Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) <= 0)
              <div class="bg-card mt-2">
                <div class="fw-bold text-danger"><i class="bi bi-calendar3"></i> Waktu Habis <span class="date-list">{{ Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->format('d/m/Y') }}</span></div>
                <div class="judul-deadline">
                  <span style="position: relative; top:6px;">{{ $keranjang->kode_keranjang }}</span>
                  <a href="/dashboard/order/show/{{ $keranjang->id }}" class="link-menuju-pesanan">Lihat</a>
                </div>
              </div>
              @endif
            @empty
              <p>-</p>
            @endforelse
        </div>
      </div>  
      {{-- <div class="row" style="margin-top: -15px">
        <div class="col-12 col-xl-12">
          <div class="card p-3">
            <div class="row">
              <div class="col">
                <div class="fw-bold h6">
                  <i class="bi bi-graph-up"></i> Bisnis saya
                  <div class="fw-light small">Tinjauan data pesanan</div>
                </div>
              </div>
              <div class="col">
                <a href="/dashboard/produk" class="float-end">Lainnya <i class="bi bi-chevron-right"></i></a>
              </div>
            </div>
            @php
                $hari_ini = Carbon\Carbon::now()->format('d/m/Y');
                $kemarin = Carbon\Carbon::yesterday()->format('d/m/Y');
                $keranjang = DB::table('keranjangs')
                                ->whereBetween('status',['Belum diproduksi', 'Proses produksi', 'Selesai produksi', 'Selesai'])
                                ->orWhere('pesanan_at', $hari_ini)
                                ->count();
                $total_kemarin = DB::table('keranjangs')
                                ->whereBetween('status',['Belum diproduksi', 'Proses produksi', 'Selesai produksi', 'Selesai'])
                                ->orWhere('pesanan_at', $kemarin)
                                ->count();
            @endphp
            <div class="bg-card">
              <div>Pesanan hari ini</div>
              <div><span class="text-dark fw-bold" style="font-size: 23px">{{ $keranjang }}</span> pesanan</div>
              <div>vs kemarin <span class="text-dark fw-bold">1{{ $total_kemarin }}</span> pesanan 
                @if ($keranjang < $total_kemarin)
                  <span class="text-success" style="font-size: 20px"><i class="bi bi-arrow-up-circle-fill"></i></span>
                @else
                  <span class="text-danger" style="font-size: 20px"><i class="bi bi-arrow-down-circle-fill"></i></span>
                @endif

              </div>
            </div>
        </div>
      </div>  
      </div> --}}
  </div>


  {{-- <div class="row">
    <div class="col-xxl-4 col-xl-6">
      <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Customer <span>| Bali Based Garment</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-warning"> <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="" class="bi bi-people-fill" viewBox="0 0 16 16">
                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z"/>
                <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z"/>
              </svg></div>
              <div class="ps-3">
                  <span class="text-danger pt-1 fw-bold h3">{{ $jumlah_customer }}</span> <span class="text-muted small pt-2 ps-1">customer</span>
              </div>
            </div>
        </div>
      </div>
  </div>
    <div class="col-xxl-4 col-xl-6">
      <div class="card info-card customers-card">
        <div class="card-body">
            <h5 class="card-title">Pesanan <span>| Bali Based Garment</span></h5>
            <div class="d-flex align-items-center">
              <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger"> <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" fill="" class="bi bi-cart-check-fill" viewBox="0 0 16 16">
                <path d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm-1.646-7.646-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L8 8.293l2.646-2.647a.5.5 0 0 1 .708.708z"/>
              </svg></div>
              <div class="ps-3">
                  <span class="text-danger pt-1 fw-bold h3">{{ $jumlah_pesanan }}</span> <span class="text-muted small pt-2 ps-1">pesanan</span>
              </div>
            </div>
        </div>
      </div>
  </div>
</div> --}}
  {{-- <div class="row">
    <div class="col-xl-4">
      <div class="card">
         <div class="card-body profile-card pt-4 d-flex flex-column align-items-center" style="height: 388px">
            @if (auth()->user()->foto)
            <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Profile" class="foto-pegawai img-fluid img-thumbnail rounded-circle border-0">
            @elseif (auth()->user()->jenis_kelamin == 'Perempuan'||auth()->user()->foto='')
              <img src="img/pp-girl.jpg" alt="Profile" class="foto-pegawai img-fluid img-thumbnail rounded-circle border-0">
            @else
              <img src="img/pp-boy.jpg" alt="Profile" class="foto-pegawai img-fluid img-thumbnail rounded-circle border-0">
            @endif

            <h2 class="mt-2 fw-bold">{{ auth()->user()->name }}</h2>
            <h4>{{ auth()->user()->jabatan }}</h4>
            <p class="text-center">Jika Anda hidup untuk tujuan yang kuat, maka kerja keras bukanlah pilihan. Itu suatu kebutuhan."<br><span class="fw-bold"> - Steve Pavlina</span></p>
          </div>
      </div>
   </div>
    <div class="col-xl-8">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Statistik Pesanan</h5>
          <canvas id="mataChart" class="chartjs" width="undefined" height="undefined"></canvas>
       </div>
      </div>
   </div>
  </div> --}}
  
</section>

@stop

@section('script')
 <script>
  var ctx = document.getElementById("mataChart").getContext('2d');
  var myChart = new Chart(ctx, {
          type: 'bar',
          data: {
              labels: <?php echo json_encode($label); ?>,
          datasets: [{
          label: 'Statistik Pesanan',
          backgroundColor: '#ADD8E6',
          borderColor: '#93C3D2',
          data: <?php echo json_encode($jumlah_user); ?>
          }],
          options: {  
      animation: {
          onProgress: function(animation) {
              progress.value = animation.animationObject.currentStep / animation.animationObject.numSteps;
          }
        }
      }
    },
  });

  const table = $('#produk-terlaris').DataTable({
		"pageLength": 100,
    "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
    "bLengthChange": false,
    "bFilter": false,
    "bInfo": false,
    "processing":false,
    "bServerSide": true,
    
		ajax:{
      url: "{{url('dashboard/data-terlaris')}}",
      type: "POST",
      data: function(d){
        d._token = "{{ csrf_token() }}"
        d.bulan = $("#filter-bulan").val()
        d.tahun = $("#filter-tahun").val()
        return d
      }
    },
    columns: [
      {
        "render": function(data, type, row, meta){
          return row.kode_produk
        }
      },
      {
        "render": function(data, type, row, meta){
          return row.nama_produk
        }
      },
      {
        "render": function(data, type, row, meta){
          return row.size
        }
      },
      {
        "render": function(data, type, row, meta){
          return row.nama_kain
        }
      },
      {
        "render": function(data, type, row, meta){
          return row.warna
        }
      },
      {
        "render": function(data, type, row, meta){
          return row.jumlah_laku
        },
        className: "text-center"
      }
    ]
	});

  $(".filter-terlaris").on('change', function(){
    table.ajax.reload(function(){
      console.log("TABLE SUDAH DIREFRESH")
    }, true)
  })
</script>
@endsection