@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Data Pegawai</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Data</li>
        <li class="breadcrumb-item">Pegawai</li>
        <li class="breadcrumb-item active">Tambah</li>
     </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center">
     <div class="col-lg-8">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Form Pegawai</h5>
              <form method="post" action="/dashboard/pegawai" enctype="multipart/form-data">
                
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">Nama</label>
                  <input type="name" class="form-control @error ('name') is-invalid @enderror" id="name" name="name" id="name" placeholder="name" required value="{{ old('name') }}">
                  @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                  @enderror 
                </div>
                <div class="row">
                    <div class="col">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error ('email') is-invalid @enderror" id="email" name="email" placeholder="email" required value="{{ old('email') }}">
                        @error('email')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror 
                    </div>
                    <div class="col">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error ('password') is-invalid @enderror" id="password" name="password" required>
                        <input type="checkbox" class="form-check-input"id="passwordCheck" onclick="myFunction()">
                        <label class="form-check-label" for="passwordCheck">Check me out</label>
                        @error('password')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror 
                    </div>
                  </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat</label>
                  <input type="text" class="form-control @error ('alamat') is-invalid @enderror" id="alamat" name="alamat"  placeholder="alamat" required value="{{ old('alamat') }}">
                  @error('alamat')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                  @enderror 
                </div>
                {{-- <div class="mb-3">
                  <label for="foto" class="form-label">Foto Pegawai</label>
                  <img class="img-preview img-fluid mb-2 rounded-circle col-sm-5 shadow" id="blah">
                  <input class="form-control @error ('foto') is-invalid @enderror" type='file' id="imgInp" name="foto">
                  @error('foto')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                   @enderror 
                </div> --}}
                <div class="row mb-3">
                  <div class="col-6">
                    <label for="foto" class="form-label">Foto Pegawai</label>
                    <input class="form-control @error ('foto') is-invalid @enderror" type='file' id="imgInp" name="foto">
                  </div>
                  <div class="col-6 justify-content-center text-center">
                    <img class="img-preview img-fluid mb-2 rounded-circle col-sm-5 shadow" id="blah">
                  </div>
                </div>  
                <div class="row mb-3">
                    <div class="col">
                        <label for="no_telp" class="form-label">No. Telp</label>
                        <input type="number" class="form-control @error ('no_telp') is-invalid @enderror" id="no_telp" name="no_telp"  placeholder="no_telp" required value="{{ old('no_telp') }}">
                        @error('no_telp')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror 
                    </div>
                    <div class="col">
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
                  </div>
                <div class="row mb-3">
                    <div class="col">
                        <label for="jabatan" class="form-label">Jabatan</label>
                        <select class="form-select" aria-label="Default select example" id="jabatan" name="jabatan">
                            
                            <option value="">--pilih--</option>
                            <option value="Admin">Admin</option>
                            <option value="Produksi">Produksi</option>
                            <option value="Pimpinan">Pimpinan</option>
                            {{-- <option value="Master Admin">Master Admin</option> --}}
                        </select>
                        @error('jabatan')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror 
                    </div>
                  </div>
                 <div class="text-center"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
              </form>
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