@extends('dashboard.layouts.main')

@section('container')


<div class="pagetitle">
  <h1>Data Customer</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Customer</li>
     </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Customer</h5>
              <hr>
              @if (session()->has('success'))   
              <div class="alert alert-success" role="alert">
                <span data-feather="check-circle"></span>
                  {{ session('success') }}
                  
              </div>
              @endif

              <div class="table-responsive">
                @can('admin')
                <a href="/dashboard/customer/create" class="btn btn-primary mb-3"><i class="bi bi-file-earmark-plus"></i><span class="ms-2">Customer</span></a>
                {{-- <a href="/dashboard/kain/create" class="btn btn-primary"><i class="bi bi-file-earmark-plus"></i><span class="ms-2">Kain</span></a> --}}
                @endcan
                  <table class="table table-striped table-sm">
                    <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">NIK</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">No Telfon</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="text-center">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($customers as $customer)  
                      <tr>
                        <td>{{ $loop->iteration }}</td>
                        
                        <td>{{ $customer->nama }}</td>
                        <td>{{ $customer->NIK }}</td>
                        <td>{{ $customer->alamat }}</td>
                        <td>{{ $customer->no_telp }}</td>
                        
                        @if ($customer->status=="Aktif")
                            <td><span class="badge bg-success">{{ $customer->status }}</span></td>
                        @else
                            <td><span class="badge bg-danger">{{ $customer->status }}</span></td>
                        @endif                                                                 
                        <td class="text-center">
                          <a href="/dashboard/customer/{{ $customer->id }}" class="tombol-invoice"><i class="bi bi-list-ol"></i> Detail</a>
                          @can('admin')
                          <a href="/dashboard/customer/{{ $customer->id }}/edit" class="tombol-aksi"><i class="bi bi-pencil"></i> Edit</a>
                          @endcan
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                  {{ $customers->links() }}
                </div>
           </div>
        </div>
     </div>
  </div>
</section>
@endsection