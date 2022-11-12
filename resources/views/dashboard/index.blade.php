@extends('dashboard.layouts.main')

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
 <section>
  <div class="row">
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
</div>
  <div class="row">
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

            
         