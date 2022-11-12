@extends('dashboard.layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Data Customer</h1>
    <nav>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data</li>
          <li class="breadcrumb-item">Customer</li>
          <li class="breadcrumb-item active">Tambah</li>
       </ol>
    </nav>
  </div>


  <section class="section">
    <div class="row justify-content-center">
       <div class="col-lg-8">
          <div class="card">
             <div class="card-body">
                <h5 class="card-title">Form Customer</h5>
                    <form method="post" action="/dashboard/customer">
                        @csrf
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                <label for="nama" class="form-label">Nama</label>
                                <input type="nama" class="form-control @error ('nama') is-invalid @enderror" id="nama" name="nama" id="nama" placeholder="Nama" required value="{{ old('nama') }}" autofocus>
                                @error('nama')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror 
                                </div>
                                <div class="col">
                                <label for="NIK" class="form-label">NIK</label>
                                <input type="number" class="form-control @error ('NIK') is-invalid @enderror" id="NIK" name="NIK" id="NIK" placeholder="Nomor Induk Kewarganegaraan" required value="{{ old('NIK') }}">
                                @error('NIK')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror 
                                </div>
                            </div>     
                        </div>
                        <div class="mb-3">
                            <div class="row">
                                <div class="col">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <input type="text" class="form-control @error ('alamat') is-invalid @enderror" id="alamat" name="alamat"  placeholder="Alamat" required value="{{ old('alamat') }}">
                                    @error('alamat')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="no_telp" class="form-label">No. Telp</label>
                                    <input type="number" class="form-control @error ('no_telp') is-invalid @enderror" id="no_telp" name="no_telp"  placeholder="Nomor Telfon" required value="{{ old('no_telp') }}">
                                    @error('no_telp')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                    @enderror  
                                </div>
                            </div>     
                        </div>
                        {{-- <div class="mb-3">
                            <div class="row">
                                <div class="col-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select" aria-label="Default select example" id="status" name="status" placeholder="status" required value="{{ old('status') }}">
                                        <option value="">> Pilih <</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                            </div>     
                        </div> --}}
                        <div class="text-center"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                    </form>
                </div>
            </div>
         </div>
      </div>
    </section>
    

@endsection