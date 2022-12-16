<header id="header" class="header fixed-top d-flex align-items-center">
   <div class="d-flex align-items-center justify-content-between">
      <a href="/dashboard" class="logo d-flex align-items-center ms-4 me-4">
         <img src="/img/logo.png" alt=""> <span class="d-none d-lg-block"></span>
      </a>
      <i style="margin-left: 100px" class="bi bi-list toggle-sidebar-btn"></i>
   </div>
    <nav class="header-nav ms-auto">
       <ul class="d-flex align-items-center">
          <li class="nav-item dropdown pe-3">
             <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
               @if (auth()->user()->foto)
                  <img src="{{ asset('/storage/' . auth()->user()->foto) }}" alt="Profile" class="rounded-circle">
               @elseif (auth()->user()->jenis_kelamin == 'Perempuan'||auth()->user()->foto='')
                  <img src="/img/pp-girl.jpg" alt="Profile" class="rounded-circle">
               @else
               <img src="/img/pp-boy.jpg" alt="Profile" class="rounded-circle"> 
               @endif
               <span class="d-none d-md-block dropdown-toggle ps-2">{{ auth()->user()->name }}</span> </a>
             <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                   <h6>{{ auth()->user()->name }}</h6>
                   <span>{{ auth()->user()->jabatan }}</span>
                </li>
                <li>
                   <hr class="dropdown-divider">
                </li>
                <li> <a class="dropdown-item d-flex align-items-center" href="/dashboard/profile"><span>My Profile</span> </a></li>
                <li>
                   <hr class="dropdown-divider">
                </li>
                <li><a href="">
                  <form action="/logout" method="post" class="d-flex">
                     @csrf
                     {{-- <a class="dropdown-item d-flex align-items-center"> <i class="bi bi-box-arrow-right"><button type="submit" onclick="return confirm('Yakin untuk keluar?')"></button></i>Logout</a> --}}
                     <button type="submit" class="dropdown-item d-flex align-items-center" onclick="return confirm('Yakin untuk keluar?')">Logout</button>
                  </form>
               </a>
               </li>
             </ul>
          </li>
       </ul>
    </nav>
 </header>


  