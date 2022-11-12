@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Pegawai</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item active">Pegawai</li>
     </ol>
  </nav>
</div>
<section class="section">
  <div class="row">
     <div class="col-lg-12">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Data Pegawai</h5>

              @if (session()->has('success'))   
                <div class="alert alert-success" role="alert">
                  <span data-feather="check-circle"></span>
                    {{ session('success') }}
                </div>
              @endif

          <div class="table-responsive">
            <a href="/dashboard/pegawai/create" class="btn btn-primary mb-3" >Tambah Pegawai</a>
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pegawais as $pegawai)  
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $pegawai->name }}</td>
                    <td>{{ $pegawai->email }}</td>
                    <td>{{ $pegawai->jabatan }}</td>

                    <td>
                      @if ($pegawai->status=="Aktif")
                            <span class="badge bg-success">{{ $pegawai->status }}</span>
                      @else
                            <span class="badge bg-danger">{{ $pegawai->status }}</span>
                      @endif 
                    </td>

                    <td>
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}" class="badge bg-info"><i class="bi bi-eye"></i></span></a>
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}/edit" class="badge bg-warning"><i class="bi bi-pencil"></i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {{ $pegawais->links() }}
            </div>
           </div>
        </div>
     </div>
  </div>
</section>
  

@endsection

