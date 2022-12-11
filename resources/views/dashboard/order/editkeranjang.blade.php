@extends('dashboard.layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Edit Order</h1>
    <nav>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data</li>
          <li class="breadcrumb-item">Order</li>
          <li class="breadcrumb-item active">Edit</li>
       </ol>
    </nav>
  </div>


  <section class="section">
    <div class="row justify-content-center">
       <div class="col-lg-8">
          <div class="card">
             <div class="card-body">
                <h5 class="card-title">Edit Order</h5>
                    <form method="post" action="/dashboard/order/editkeranjang/{{ $keranjang->id }}">
                        @method('put')
                        @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="kode_keranjang" class="form-label">No. Pesanan</label>
                                    <input readonly type="text" class="form-control" id="kode_keranjang" value="{{ $keranjang->kode_keranjang }}">
                                </div>
                                <div class="col-6">
                                    <div class="search_customer">
                                        <label for="customer" class="form-label">Customer</label>
                                    <input readonly type="text" class="form-control" id="customer" value="{{ $keranjang->customer->nama }}">
                                    </div>
                                </div>
                            </div>     
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="nik" class="form-label">NIK</label>
                                    <input readonly type="number" class="form-control" id="nik" value="{{ $keranjang->customer->NIK }}">
                                </div>
                                <div class="col">
                                    <label for="no_telp" class="form-label">No. Telfon</label>
                                    <input readonly type="text" class="form-control" id="no_telp" value="{{ $keranjang->customer->no_telp }}">
                                </div>
                            </div>     
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="pesanan_at" class="form-label">Tanggal Pesan</label>
                                    <input readonly type="text" class="form-control" id="pesanan_at" value="{{ $keranjang->pesanan_at }}">
                                </div>
                                <div class="col-6">
                                    <label for="tgl_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo <span class="text-danger">*</span></label>
                                    <input autofocus type="date" class="form-control" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" value="{{ old('tgl_jatuh_tempo', $keranjang->tgl_jatuh_tempo) }}">
                                </div>
                            </div>     
                        <div class="row mt-3">
                            <div class="col">
                                {{-- <button onclick="history.back()" class="btn btn-secondary"><i class="bi bi-backspace"></i><span class="ms-2">Home</span></button> --}}
                                <a href="/dashboard/order" class="btn btn-secondary"><i class="bi bi-house"></i><span class="ms-2">Home</span></a>
                            </div>
                            <div class="col">
                                <div class="float-end">
                                    {{-- <button type="reset" class="btn btn-secondary"><i class="bi bi-x-circle"></i><span class="ms-2">Reset</span></button> --}}
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
@endsection