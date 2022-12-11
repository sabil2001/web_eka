@extends('dashboard.layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Edit Kain</h1>
    <nav>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Edit</li>
          <li class="breadcrumb-item">Kain</li>
       </ol>
    </nav>
  </div>


  <section class="section">
    <div class="row justify-content-center">
       <div class="col-lg-8">
          <div class="card">
             <div class="card-body">
                <h5 class="card-title">Form Edit Kain</h5>
                    <form method="post" action="/dashboard/kain/{{ $kain->id }}">
                        @method('put')
                        @csrf
                        
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="nama_kain" class="form-label">Jenis Kain</label>
                                    <input autofocus type="text" class="form-control @error ('nama_kain') is-invalid @enderror" name="nama_kain" id="nama_kain" placeholder="Kain" required value="{{ old('nama_kain', $kain->nama_kain) }}">
                                    @error('nama_kain')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                                <div class="col-6">
                                    <label for="kode_kain" class="form-label">Kode Kain</label>
                                    <input readonly type="text" class="form-control @error ('kode_kain') is-invalid @enderror" name="kode_kain" id="kode_kain" value="{{ $kain->kode_kain }}" required>
                                    @error('kode_kain')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                            </div>     

                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="warna" class="form-label">Warna</label>
                                    <input type="text" class="form-control @error ('warna') is-invalid @enderror" name="warna" id="warna" placeholder="Warna" required value="{{ old('warna', $kain->warna) }}">
                                    @error('warna')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                                <div class="col-3">
                                    <label for="stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control @error ('stock') is-invalid @enderror" name="stock" id="stock" placeholder="Stok" required value="{{ old('stock', $kain->stock) }}">
                                    @error('stock')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                                <div class="col-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select">
                                        @if ($kain->status == 'Aktif')
                                            <option value="{{ $kain->status }}">{{ $kain->status }}</option>
                                            <option value="Non aktif">Non aktif</option>
                                        @else
                                        <option value="Non aktif">Non aktif</option>
                                        <option value="Aktif">Aktif</option>
                                        @endif
                                    </select>
                                    @error('stock')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                            </div>     
                        <div class="row mt-3">
                            <div class="col">
                                <button onclick="history.back()" class="btn btn-secondary"><i class="bi bi-backspace"></i><span class="ms-2">Kembali</span></button>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    <button type="reset" class="btn btn-secondary"><i class="bi bi-x-circle"></i><span class="ms-2">Reset</span></button>
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i><span class="ms-2">Simpan</span></button>
                                </div>
                            </div>
                        </div>
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