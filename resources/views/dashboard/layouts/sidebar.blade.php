

 <aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
     <li class="nav-item"> <a class="nav-link {{ Request::is('/dashboard') ? '' : 'collapsed' }}" href="/dashboard"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a></li>

      @php
         $belum_produksi = DB::table('keranjangs')->where('status', '=', 'Belum diproduksi')->count();
         $proses_produksi = DB::table('keranjangs')->where('status', '=', 'Proses produksi')->count();
         $selesai_produksi = DB::table('keranjangs')->where('status', '=', 'Selesai produksi')->count();
      @endphp
     <li class="nav-heading">pemesanan</li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/order*') ? 'active' : 'collapsed' }}" href="/dashboard/order"> <i class="bi bi-cart"></i> <span>Semua Order</span> </a></li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/verifikasi*') ? 'active' : 'collapsed' }}" href="/dashboard/verifikasi"><i class="bi bi-cart-check"></i><span>Verifikasi Produksi</span>
         @if ($selesai_produksi > 0)
         <div class="notifikasi"><div class="text-notif">{{ $selesai_produksi }}</div></div>
         @else

         @endif
         </a>
      </li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/tuntas*') ? 'active' : 'collapsed' }}" href="/dashboard/tuntas"><i class="bi bi-cart-check-fill"></i><span>Order Selesai</span> </a></li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/batal/pesan*') ? 'active' : 'collapsed' }}" href="/dashboard/batal/pesan"><i class="bi bi-cart-x"></i><span>Batal Order</span> </a></li>
     
      
    
     <li class="nav-heading">produksi</li>
     
      <li class="nav-item">
         <a class="nav-link {{ Request::is('dashboard/prosesproduksi*') ? 'active' : 'collapsed' }}" href="/dashboard/prosesproduksi"><i class="bi bi-bar-chart"></i>
            <span>Belum Produksi</span>
            @if ($belum_produksi > 0)
               <div class="notifikasi"><div class="text-notif">{{ $belum_produksi }}</div></div>
            @else

            @endif
         </a>
      </li>
      <li class="nav-item">
         <a class="nav-link {{ Request::is('dashboard/keranjang/produksi/proses*') ? 'active' : 'collapsed' }}" href="/dashboard/keranjang/produksi/proses"><i class="bi bi-stopwatch"></i>
            <span>Proses Produksi</span>
            @if ($proses_produksi > 0)
               <div class="notifikasi"><div class="text-notif">{{ $proses_produksi }}</div></div>
            @else

            @endif
         </a>
      </li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/barang/selesai*') ? 'active' : 'collapsed' }}" href="/dashboard/barang/selesai"><i class="bi bi-bar-chart-fill"></i><span>Selesai Produksi</span> </a></li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/batalpengerjaan*') ? 'active' : 'collapsed' }}" href="/dashboard/batalpengerjaan"><i class="bi bi-x-square"></i><span>Batal Produksi</span> </a></li>
     <li class="nav-heading">data</li>
     @can('master')
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/pegawai*') ? 'active' : 'collapsed' }}" href="/dashboard/pegawai"> <i class="bi bi-person"></i> <span>Pegawai</span> </a></li>
     @endcan
   
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/customer*') ? 'active' : 'collapsed' }}" href="/dashboard/customer"> <i class="bi bi-person-rolodex"></i> <span>Customer</span> </a></li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/produk*') ? 'active' : 'collapsed' }}" href="/dashboard/produk"> <i class="bi bi-card-list"></i> <span>Produk</span> </a></li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/kain*') ? 'active' : 'collapsed' }}" href="/dashboard/kain"> <i class="bi bi-bag-plus"></i> <span>Kain</span> </a></li>
     @if(Gate::check('pimpinan') || Gate::check('master'))
      <li class="nav-heading">report</li>
      <li class="nav-item">
      <a class="nav-link nav-link {{ Request::is('dashboard/laporan*') ? 'active' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-menu-button-wide"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i> </a>
         <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
            <li> <a href="/dashboard/laporan/pesanan"> <i class="bi bi-circle"></i><span>Pesanan</span> </a></li>
         </ul>
      </li>
      @endif
   
    </ul>
</aside>
