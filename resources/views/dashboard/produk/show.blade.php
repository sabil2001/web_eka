@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Produk</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Detail</li>
        <li class="breadcrumb-item active">Produk</li>
     </ol>
  </nav>
</div>

<section class="section">
    <div class="row justify-content-center">
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Produk</h5>
                    <div class="row">
                        <div class="col-4 label">Kode</div>
                        <div class="col-8">: {{ $produk->kode_produk }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 label">Nama</div>
                        <div class="col-8">: {{ $produk->nama_produk }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 label">Kategori</div>
                        <div class="col-8">: {{ $produk->kategori }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 label">Total</div>
                        <div class="col">: {{ $produk->jumlah_laku }} Pembelian</div>
                    </div>
                    <div class="row">
                        <div class="col-4 label">Status</div>
                        <div class="col">: {{ $produk->status }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4 label">Deskripsi</div>
                        <div class="col">: {{ $produk->deskripsi }}</div>
                    </div>
                <h5 class="card-title">Size Chart ({{ $produk->size }})</h5>

                @if ($produk->kategori == "Pakaian atas")
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Ukuran</th>
                          <th scope="col">Centimeter</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Lebar dada</td>
                          <td>{{ $produk->lebar_dada }} CM</td>
                        </tr>
                        <tr>
                          <td>Lebar bahu</td>
                          <td>{{ $produk->lebar_bahu }} CM</td>
                        </tr>
                        <tr>
                          <td>Panjang badan</td>
                          <td>{{ $produk->panjang_badan }} CM</td>
                        </tr>
                        <tr>
                          <td>Panjang lengan</td>
                          <td>{{ $produk->panjang_tangan }} CM</td>
                        </tr>
                        <tr>
                          <td>Lengan atas</td>
                          <td>{{ $produk->lingkar_lengan_atas }} CM</td>
                        </tr>
                        <tr>
                          <td>Lengan bawah</td>
                          <td>{{ $produk->lingkar_lengan_bawah }} CM</td>
                        </tr>
                      </tbody>
                    </table>
                @else
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Ukuran</th>
                          <th scope="col">Centimeter</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>Panjang luar</td>
                          <td>{{ $produk->panjang_luar }} CM</td>
                        </tr>
                        <tr>
                          <td>Panjang dalam</td>
                          <td>{{ $produk->panjang_dalam }} CM</td>
                        </tr>
                        <tr>
                          <td>Lebar pinggang</td>
                          <td>{{ $produk->lebar_pinggang }} CM</td>
                        </tr>
                        <tr>
                          <td>Lebar Pergelangan</td>
                          <td>{{ $produk->lebar_pergelangan }} CM</td>
                        </tr>
                      </tbody>
                    </table>
                @endif
                
                    
                    <button onclick="history.back()" class="btn btn-secondary mt-2"><i class="bi bi-backspace"></i><span class="ms-2">Kembali</span></button>
                    <div class="float-end">
                    <a href="/dashboard/produk/{{ $produk->id }}/edit" class="btn btn-warning mt-2"><i class="bi bi-pencil"></i><span class="ms-2">Edit</span></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Foto Produk</h5>
                    <div class="row">
                        <div class="row">
                            <div class="col">
                                <div class="text-center">
                                    <img src="{{ asset('storage/' . $produk->foto_produk) }}" class="rounded" style="width:190px">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
  </section>
@endsection