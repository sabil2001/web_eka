@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Profile</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">My Profile</li>
     </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center">
    <div class="col-xl-8">
        <div class="card">
           <div class="card-body pt-3">
              <ul class="nav nav-tabs nav-tabs-bordered">
                 <li class="nav-item"> <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Biodata</button></li>
                 <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Update Biodata</button></li>
                 <li class="nav-item"> <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password-edit">Update Password</button></li>
                 
              </ul>
              <div class="tab-content pt-2">
                 <div class="tab-pane fade show active profile-overview" id="profile-overview"> 
                    @if (session()->has('success'))   
                        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <h5 class="card-title">Profile</h5>
                    
                    @if (auth()->user()->foto)
                    <img src="{{ asset('storage/' . auth()->user()->foto) }}" class="rounded float-end" width="200px">
                    @elseif(auth()->user()->jenis_kelamin == 'Perempuan')
                    <img src="/img/pp-girl.jpg" alt="Profile" class="rounded float-end" width="200px">
                    @else
                    <img src="/img/pp-boy.jpg" alt="Profile" class="rounded float-end" width="200px">
                    @endif

                    <div class="row mt-3">
                       <div class="col-lg-3 col-md-4 label">Nama</div>
                       <div class="col-lg-9 col-md-8">{{ auth()->user()->name }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Email</div>
                       <div class="col-lg-9 col-md-8">{{ auth()->user()->email }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Alamat</div>
                       <div class="col-lg-9 col-md-8">{{ auth()->user()->alamat }}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">No. HP</div>
                       <div class="col-lg-9 col-md-8">{{ auth()->user()->no_telp}}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Jenis Kelamin</div>
                       <div class="col-lg-9 col-md-8">{{ auth()->user()->jenis_kelamin}}</div>
                    </div>
                    <div class="row">
                       <div class="col-lg-3 col-md-4 label">Jabatan</div>
                       <div class="col-lg-9 col-md-8">{{ auth()->user()->jabatan}}</div>
                    </div>
                 </div>
                 <div class="tab-pane fade profile-edit" id="profile-edit">
                    <h5 class="card-title">Biodata</h5>
                        <form method="post" action="/dashboard/profile/edit/{{ $user }}" enctype="multipart/form-data"> 
                        @method('put') 
                        @csrf
                            <div class="col-6 justify-content-center text-center">
                                @if (auth()->user()->foto)
                                <img src="{{ asset('/storage/' . auth()->user()->foto) }}" class="img-preview img-fluid mb-2 rounded-circle col-sm-5 shadow" id="blah">
                                @else
                                    <img class="img-preview img-fluid mb-2 rounded-circle col-sm-5 shadow" id="blah">
                                @endif
                            </div>
                            <div class="col-6">
                                <label for="foto" class="form-label">Foto Pegawai</label>
                                <input class="form-control @error ('foto') is-invalid @enderror" type='file' id="imgInp" name="foto">
                            </div>
                            <div class="col-6 mt-2">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control @error ('name') is-invalid @enderror" name="name" id="name" value="{{ auth()->user()->name }}">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6 mt-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control @error ('email') is-invalid @enderror" value="{{ auth()->user()->email }}" name="email" id="email">
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6 mt-2">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error ('alamat') is-invalid @enderror" value="{{ auth()->user()->alamat }}" name="alamat" id="alamat">
                                @error('alamat')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6 mt-2">
                                <label for="no_telp" class="form-label">No. HP</label>
                                <input type="number" class="form-control @error ('no_telp') is-invalid @enderror" value="{{ auth()->user()->no_telp }}" name="no_telp" id="no_telp">
                                @error('no_telp')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-6 mt-2">
                                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                                <select class="form-select" aria-label="Default select example" id="jenis_kelamin" name="jenis_kelamin" placeholder="jenis_kelamin" required value="{{ old('jenis_kelamin') }}">
                                    <option value="">--pilih--</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                @error('jenis_kelamin')
                                  <div class="invalid-feedback">
                                    {{ $message }}
                                  </div>
                                 @enderror 
                              </div>
                            <div class="col mt-2">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                 </div>
                 <div class="tab-pane fade password-edit" id="password-edit">
                    <h5 class="card-title">Passowrd</h5>
                        <form method="post" action="/dashboard/profile/edit_pass/{{ $user }}"> 
                        @method('put') 
                        @csrf
                            
                            <div class="col-6 mt-2">
                                <label for="password" class="form-label">Password Lama</label>
                                <input type="password" class="form-control @error ('password') is-invalid @enderror" id="password" name="password" required>
                                
                                <label for="new_password" class="form-label">Password Baru</label>
                                <input type="password" class="form-control @error ('new_password') is-invalid @enderror" id="new_password" name="new_password" required>
                                <input type="checkbox" class="form-check-input"id="passwordCheck" onclick="myFunction()">
                                <label class="form-check-label" for="passwordCheck">Check me out</label>
                                @error('new_password')
                                <div class="invalid-feedback">
                                {{ $message }}
                                </div>
                                @enderror
                            </div>
                            
                            <div class="col mt-2">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </div>
                        </form>
                 </div>
                 
                 
              </div>
           </div>
        </div>
     </div>
    </div>
  </section>
  <script>

    imgInp.onchange = evt => {
      const [file] = imgInp.files
      if (file) {
        blah.src = URL.createObjectURL(file)
      }
    }
      
    </script>
@endsection