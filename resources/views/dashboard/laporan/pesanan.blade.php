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
              <h5 class="card-title">Statistik Pesanan</h5>
              <canvas id="mataChart" class="chartjs" width="undefined" height="undefined"></canvas>

          
           </div>
        </div>
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data</h5>
              <p>Range data</p>
              <div class="row">
                <div class="col-2">
                    <input type="date" name="tglawal" id="tglawal" class="form-control">
                </div>
                <div class="col-2">
                    <input type="date" name="tglakhir" id="tglakhir" class="form-control">
                </div>
                <div class="col-2">
                    <a href="#" onclick="this.href='/dashboard/laporan/pesanan-pertanggal/'+document.getElementById('tglawal').value +
                '/' + document.getElementById('tglakhir').value " target="_blank" class="btn btn-primary col-md-12">Cetak</a>
                </div>
              </div>
              <p><small class="text-danger">*wajib input tanggal sebelum cetak laporan</small></p>
                <div class="table-responsive">
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
                        
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dataPesanan as $pesanan)  
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
                    </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $dataPesanan->links() }}
                </div>
           </div>
        </div>
     </div>
  </div>
</section>
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
</script>

@endsection


