@extends('dashboard.layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Edit Produk</h1>
    <nav>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Edit</li>
          <li class="breadcrumb-item">Produk</li>
       </ol>
    </nav>
  </div>


  <section class="section">
    <div class="row justify-content-center">
       <div class="col-lg-8">
          <div class="card">
             <div class="card-body">
                <h5 class="card-title">Form Produk</h5>
                    <form method="post" action="/dashboard/produk/{{ $produk->id }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="">
                            <div class="row">
                                
                                <div class="col justify-content-center text-center">
                                    <div id="" class="form-text mb-2">Preview Gambar Produk.</div>
                                    @if ($produk->foto_produk)
                                    <img src="{{ asset('/storage/' . $produk->foto_produk) }}" class="img-preview img-fluid rounded border border-2 produk-preview-image" id="blah">
                                    @else
                                    <img class="img-preview img-fluid rounded border border-2 produk-preview-image" id="blah">
                                    @endif
                                </div>
                            </div>     
                        </div>
                        
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="foto_produk" class="form-label">Foto Produk</label>
                                    <input type='file' class="form-control @error ('foto_produk') is-invalid @enderror" id="imgInp" name="foto_produk"  placeholder="Nomor Induk Kewarganegaraan" value="{{ old('foto_produk') }}">
                                    <div id="" class="form-text">Pilih file jika edit foto produk.</div>
                                    @error('foto_produk')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                                <div class="col-6">
                                    <label for="kode_produk" class="form-label">Kode Produk</label>
                                    <input readonly type="text" class="form-control @error ('kode_produk') is-invalid @enderror" name="kode_produk" id="kode_produk" value="{{ $produk->kode_produk }}" required>
                                    @error('kode_produk')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                            </div>     

                            <div class="row mt-2">
                                <div class="col-6">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control @error ('nama_produk') is-invalid @enderror" name="nama_produk" id="nama_produk" placeholder="Nama" required value="{{ old('nama_produk', $produk->nama_produk) }}">
                                    @error('nama_produk')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                                <div class="col-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-select" aria-label=".form-select-lg example">
                                        
                                        @if ($produk->status == 'Aktif')
                                            <option value="{{ $produk->status }}">{{ $produk->status }}</option>
                                            <option value="Non aktif">Non aktif</option>
                                        @else
                                        <option value="Non aktif">Non aktif</option>
                                        <option value="Aktif">Aktif</option>
                                        @endif
                                      </select>
                                        @error('status')
                                            <div class="invalid-feedback">
                                            {{ $message }}
                                            </div>
                                        @enderror 
                                </div>
                                <div class="col-3">
                                    <label for="size" class="form-label">Size</label>
                                    <select name="size" id="size" class="form-select" required>
                                        <option value="">--PILIH--</option>
                                        <option value="S">S</option>
                                        <option value="M">M</option>
                                        <option value="L">L</option>
                                        <option value="XL">XL</option>
                                        <option value="XXL">XXL</option>
                                        <option value="3XL">3XL</option>
                                        <option value="4XL">4XL</option>
                                    </select>
                                    @error('size')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                            </div> 
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <input type="text" name="kategori" id="kategori" class="form-control" value="{{ $produk->kategori }}" readonly>
                                    @error('kategori')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                            </div> 
                            @if ($produk->kategori == "Pakaian atas")
                                <div id="atas">     
                                    <div class="row mt-3">
                                        <div class="col-4 col-md-3">
                                            <label for="lebar_dada" class="form-label">Lebar Dada</label>
                                            <input type="number" class="form-control @error ('lebar_dada') is-invalid @enderror" name="lebar_dada" id="lebar_dada" placeholder="dada" value="{{ old('lebar_dada', $produk->lebar_dada) }}">
                                            @error('lebar_dada')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <label for="lebar_bahu" class="form-label">Lebar Bahu<span class="form-text text-danger"> (1 sisi)</span></label>
                                            <input type="number" class="form-control @error ('lebar_bahu') is-invalid @enderror" name="lebar_bahu" id="lebar_bahu" placeholder="bahu" value="{{ old('lebar_bahu', $produk->lebar_bahu) }}">
                                            @error('lebar_bahu')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <label for="panjang_badan" class="form-label">Panjang Badan</label>
                                            <input type="number" class="form-control @error ('panjang_badan') is-invalid @enderror" name="panjang_badan" id="panjang_badan" placeholder="badan" value="{{ old('panjang_badan', $produk->panjang_badan) }}">
                                            @error('panjang_badan')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <label for="panjang_tangan" class="form-label">Panjang Lengan</label>
                                            <input type="number" class="form-control @error ('panjang_tangan') is-invalid @enderror" name="panjang_tangan" id="panjang_tangan" placeholder="lengan" value="{{ old('panjang_tangan', $produk->panjang_tangan) }}">
                                            @error('panjang_tangan')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                    </div>     
                                    <div class="row mt-3">
                                        <div class="col-4 col-md-3">
                                            <label for="lingkar_lengan_atas" class="form-label">Lengan Atas</label>
                                            <input type="number" class="form-control @error ('lingkar_lengan_atas') is-invalid @enderror" name="lingkar_lengan_atas" id="lingkar_lengan_atas" placeholder="lingkar lengan" value="{{ old('lingkar_lengan_atas', $produk->lingkar_lengan_atas) }}">
                                            @error('lingkar_lengan_atas')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <label for="lingkar_lengan_bawah" class="form-label">Lengan Bawah</label>
                                            <input type="number" class="form-control @error ('lingkar_lengan_bawah') is-invalid @enderror" name="lingkar_lengan_bawah" id="lingkar_lengan_bawah" placeholder="lingkar lengan" value="{{ old('lingkar_lengan_bawah', $produk->lingkar_lengan_bawah) }}">
                                            @error('lingkar_lengan_bawah')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>                           
                                        <div class="form-text text-danger">Satuan panjang Centimeter (CM)</div>
                                    </div> 
                                </div>  
                            @else
                                <div id="bawah">
                                    <div class="row mt-3">
                                        <div class="col-4 col-md-3">
                                            <label for="panjang_luar" class="form-label">Panjang Luar</label>
                                            <input type="number" class="form-control @error ('panjang_luar') is-invalid @enderror" name="panjang_luar" id="panjang_luar" placeholder="luar" value="{{ old('panjang_luar', $produk->panjang_luar) }}">
                                            @error('panjang_luar')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <label for="panjang_dalam" class="form-label">Panjang Dalam</label>
                                            <input type="number" class="form-control @error ('panjang_dalam') is-invalid @enderror" name="panjang_dalam" id="panjang_dalam" placeholder="dalam" value="{{ old('panjang_dalam', $produk->panjang_dalam) }}">
                                            @error('panjang_dalam')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <label for="lebar_pinggang" class="form-label">L. Pinggang</label>
                                            <input type="number" class="form-control @error ('lebar_pinggang') is-invalid @enderror" name="lebar_pinggang" id="lebar_pinggang" placeholder="pinggang" value="{{ old('lebar_pinggang', $produk->lebar_pinggang) }}">
                                            @error('lebar_pinggang')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="col-4 col-md-3">
                                            <label for="lebar_pergelangan" class="form-label">L. Pergelangan</label>
                                            <input type="number" class="form-control @error ('lebar_pergelangan') is-invalid @enderror" name="lebar_pergelangan" id="lebar_pergelangan" placeholder="pergelangan" value="{{ old('lebar_pergelangan', $produk->lebar_pergelangan) }}">
                                            @error('lebar_pergelangan')
                                                <div class="invalid-feedback">
                                                {{ $message }}
                                                </div>
                                            @enderror 
                                        </div>
                                        <div class="form-text text-danger">Satuan panjang Centimeter (CM)</div>
                                    </div>    
                                </div> 
                            @endif
                            
                        <div class="mb-3 mt-3">
                            <div class="row">
                                <div class="col">
                                    <label for="deskripsi" class="form-label">Deskripsi Produk</label>
                                    <input type="text" class="form-control @error ('deskripsi') is-invalid @enderror" name="deskripsi" id="deskripsi" placeholder="Deskripsi" value="{{ old('deskripsi', $produk->deskripsi) }}">
                                    @error('deskripsi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                            </div>     
                        </div>
                        
                        <div class="row">
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

    // $(document).ready(function(){
    //     $("#atas").hide();
    //     $("#bawah").hide();
    //     $("#kategori").change(function(){
    //         var value_pekerjaan = $(this).val();
            
    //         if (value_pekerjaan == "Pakaian atas") {
    //             $("#atas").show();
    //             $("#bawah").hide();
    //         } else if (value_pekerjaan == "Pakaian bawah") {
    //             $("#atas").hide();
    //             $("#bawah").show();
    //         }else {
    //             $("#atas").hide();
    //             $("#bawah").hide();
    //         }
    //     });

        
    //   });
        
    </script>

@endsection