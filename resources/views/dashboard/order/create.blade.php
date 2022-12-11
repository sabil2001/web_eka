@extends('dashboard.layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Data Order</h1>
    <nav>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data</li>
          <li class="breadcrumb-item">Order</li>
          <li class="breadcrumb-item active">Tambah</li>
       </ol>
    </nav>
  </div>


  <section class="section">
    <div class="row justify-content-center">
       <div class="col-lg-8">
          <div class="card">
             <div class="card-body">
                <h5 class="card-title">Form Order</h5>
                @if (session()->has('success'))   
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                                    <form method="post" action="/dashboard/order/store">
                        @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="kode_keranjang" class="form-label">Kode Order</label>
                                    <input readonly type="text" class="form-control @error ('kode_keranjang') is-invalid @enderror" name="kode_keranjang" id="kode_keranjang" value="{{ 'P-'.date('d-m-Y').'-'.$kd }}" required>
                                    @error('kode_keranjang')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div>
                                <div class="col-6">
                                    <div class="search_customer">
                                        <label for="kode_kain" class="form-label">Cari Customer</label>
                                        <select name="customer_id" id="customer_id" class="js-select2 form-control" autofocus required>
                                        @foreach ($customers as $customer)
                                            <option value=""></option>
                                            <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>     
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="warna" class="form-label">NIK</label>
                                    <select class="form-select" id="NIK" disabled>
                                        
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="stock" class="form-label">No. Handphone</label>
                                    <select class="form-select" id="no_telp" disabled>
                                        
                                    </select>
                                </div>
                            </div>     
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="tgl" class="form-label">Tanggal Pesan</label>
                                    <input type="text" class="form-control" id="tgl" value="{{ $date->format('d/m/Y') }}" disabled>
                                </div>
                                <div class="col-6">
                                    <label for="tgl_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo</label>
                                    <input type="date" class="form-control" id="tgl_jatuh_tempo" name="tgl_jatuh_tempo" required value="{{ old('tgl_jatuh_tempo') }}">
                                </div>
                                {{-- <div class="col">
                                    <label for="stock" class="form-label">Stok</label>
                                    <input type="number" class="form-control @error ('stock') is-invalid @enderror" name="stock" id="stock" placeholder="Stok" required value="{{ old('stock') }}">
                                    @error('stock')
                                        <div class="invalid-feedback">
                                        {{ $message }}
                                        </div>
                                    @enderror 
                                </div> --}}
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
        // In your Javascript (external .js resource or <script> tag)
        // $(document).ready(function() {
            $('.js-select2').select2({
                placeholder: "Cari customer",
                theme:"bootstrap-5"
            });
        // });

    </script>
    <script>
        // CSRF for all ajax call
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
  
        $(document).ready(function(){
          $("#customer_id").change(function(){
            var customer_id = $(this).val();
  
            $.ajax({
            
            type : "POST",
            url : "{{route('getcustomer')}}",
            
            data : {id_customer: customer_id},
              success: function(msg){
                  $('#NIK').html(msg);
              },
              error: function(xhr){
                console.log(xhr.responseText);
              }
            
            });

            $.ajax({
            
            type : "POST",
            url : "{{route('gettelpon')}}",
            
            data : {id_customer: customer_id},
              success: function(msg){
                  $('#no_telp').html(msg);
              },
              error: function(xhr){
                console.log(xhr.responseText);
              }
            
            });

          });
        });

        
      </script>

@endsection