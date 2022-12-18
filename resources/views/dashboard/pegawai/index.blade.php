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
            <a href="/dashboard/pegawai/create" class="btn btn-primary mb-3" ><i class="bi bi-file-earmark-plus"></i><span class="ms-2">Pegawai</a>
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Email</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Status</th>
                    <th scope="col" class="text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pegawais as $pegawai)  
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      @if ($pegawai->foto)
                        <img src="{{ asset('storage/' . $pegawai->foto) }}" class="rounded" style="width:100px; height:100px; overflow:hidden">
                      @elseif (!$pegawai->foto && $pegawai->jenis_kelamin == 'Perempuan')
                        <img src="/img/pp-girl.jpg" class="rounded" style="width:100px; height:100px; overflow:hidden">
                      @else
                        <img src="/img/pp-boy.jpg" class="rounded" style="width:100px; height:100px; overflow:hidden">
                      @endif
                    </td>
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

                    <td class="text-center">
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}" class="tombol-invoice"><i class="bi bi-list-ol"></i> Detail</a>
                      <a href="/dashboard/pegawai/{{ $pegawai->id }}/edit" class="tombol-aksi"><i class="bi bi-pencil"></i> Edit</a>
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

