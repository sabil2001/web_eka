

 <aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
     <li class="nav-item"> <a class="nav-link {{ Request::is('/dashboard') ? '' : 'collapsed' }}" href="/dashboard"> <i class="bi bi-grid"></i> <span>Dashboard</span> </a></li>

    
     <li class="nav-heading">pelayanan</li>
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/pesanan*') ? 'active' : 'collapsed' }}" href="/dashboard/pesanan"> <i class="bi bi-bag-plus"></i> <span>Pesanan</span> </a></li>
     <li class="nav-heading">data</li>
     @can('master')
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/pegawai*') ? 'active' : 'collapsed' }}" href="/dashboard/pegawai"> <i class="bi bi-person"></i> <span>Pegawai</span> </a></li>
     @endcan
   
     <li class="nav-item"> <a class="nav-link {{ Request::is('dashboard/customer*') ? 'active' : 'collapsed' }}" href="/dashboard/customer"> <i class="bi bi-person-rolodex"></i> <span>Customer</span> </a></li>
     @if(Gate::check('pimpinan') || Gate::check('master'))
      <li class="nav-heading">report</li>
      <li class="nav-item">
      <a class="nav-link nav-link {{ Request::is('dashboard/laporan*') ? 'active' : 'collapsed' }}" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> <i class="bi bi-menu-button-wide"></i><span>Laporan</span><i class="bi bi-chevron-down ms-auto"></i> </a>
         <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
         {{-- <li> <a href="/dashboard/pesanan/export"> <i class="bi bi-circle"></i><span>Pesanan</span> </a></li> --}}
            <li> <a href="/dashboard/laporan/pesanan"> <i class="bi bi-circle"></i><span>Pesanan</span> </a></li>
         </ul>
      </li>
      @endif
   
    </ul>
</aside>
