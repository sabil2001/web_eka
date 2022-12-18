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
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <form method="post" action="/dashboard/order/pesanan">
                        @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="search_customer">
                                        <input type="hidden" class="form-control" id="keranjang_id" name="keranjang_id" value="{{ $keranjang->id }}">
                                    </div>
                                </div>
                            </div>    
                            <div class="row">
                                <div class="col">
                                    <label for="nik">NIK Customer</label>
                                    <input type="text" id="nik" class="form-control" readonly value="{{ $keranjang->customer->NIK }}">
                                </div>
                                <div class="col">
                                    <label for="nama_customer">Nama Customer</label>
                                    <input type="text" id="nama_customer" class="form-control" readonly value="{{ $keranjang->customer->nama }}">
                                </div>
                            </div> 
                            
                            <div class="row mt-3">
                                <div class="col col-md-6">
                                    <label for="produk_id" class="form-label">Produk <span class="text-danger">*</span></label>
                                    <select name="produk_id" id="produk_id" class="js-select2 form-select cari-produk" autofocus required>
                                    @foreach ($produks as $produk)
                                        <option value=""></option>
                                        <option value="{{ $produk->id }}">
                                            {{ $produk->nama_produk }} Size: {{ $produk->size }} | {{ $produk->kode_produk }}
                                        </option>
                                    @endforeach
                                    </select>
                                    <div class="form-text">Berdasarkan kode atau nama produk.</div>
                                </div>
                                <div class="col col-md-6">
                                    <label for="kain_id" class="form-label">Kain <span class="text-danger">*</span></label>
                                    <select name="kain_id" id="kain_id" class="js-select2 form-select cari-kain"  required>
                                    @foreach ($kains as $kain)
                                        <option value=""></option>
                                        <option value="{{ $kain->id }}">{{ $kain->nama_kain }} Warna {{ $kain->warna }} | {{  $kain->kode_kain }}</option>
                                    @endforeach
                                    </select>
                                    <div class="form-text">Berdasarkan kode atau nama kain.</div>
                                </div>
                            </div> 
                            <div class="row mt-3">
                                <div class="col-4 col-md-4">
                                    <label for="kode_produk" class="form-label">Kode Produk</label>
                                    <input type="text" id="kode_produk" class="form-control" readonly>
                                </div>
                                <div class="col-4 col-md-4">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" id="nama_produk" class="form-control" readonly>
                                </div>
                                <div class="col-4 col-md-2">
                                    <label for="size" class="form-label">Size</label>
                                    <input type="text" id="size" name="size" class="form-control" readonly>
                                </div>
                            </div>   
                            
                            <div class="row mt-3">
                                <div class="col-4 col-md-4">
                                    <label for="kode_kain" class="form-label">Kode Kain</label>
                                    <input type="text" id="kode_kain" class="form-control" readonly>
                                </div>
                                <div class="col-4 col-md-4">
                                    <label for="nama_kain" class="form-label">Nama Kain</label>
                                    <input type="text" id="nama_kain" class="form-control" readonly>
                                </div>
                                <div class="col-4 col-md-2">
                                    <label for="warna" class="form-label">Warna</label>
                                    <input type="text" id="warna" class="form-control" readonly>
                                </div>
                            </div>  
                            
                            <div id="pakaian_atas">
                                <div class="row mt-3">
                                    <div class="col">
                                        <label for="lebar_dada" class="form-label"><abbr title="Lebar Dada">LD</abbr></label>
                                        <input type="number" id="lebar_dada" class="form-control" name="lebar_dada">
                                    </div>
                                    <div class="col">
                                        <label for="lebar_bahu" class="form-label"><abbr title="Lebar Bahu">LB</abbr></label>
                                        <input type="number" id="lebar_bahu" class="form-control" name="lebar_bahu">
                                    </div>
                                    <div class="col">
                                        <label for="panjang_badan" class="form-label"><abbr title="Panjang Badan">PB</abbr></label>
                                        <input type="number" id="panjang_badan" class="form-control" name="panjang_badan">
                                    </div>
                                    <div class="col">
                                        <label for="panjang_tangan" class="form-label"><abbr title="Panjang Tangan">PT</abbr></label>
                                        <input type="number" id="panjang_tangan" class="form-control" name="panjang_tangan">
                                    </div>
                                    <div class="col">
                                        <label for="lingkar_lengan_atas" class="form-label"><abbr title="Lingkar Lengan Atas">LLA</abbr></label>
                                        <input type="number" id="lingkar_lengan_atas" class="form-control" name="lingkar_lengan_atas">
                                    </div>
                                    <div class="col">
                                        <label for="lingkar_lengan_bawah" class="form-label"><abbr title="Lingkan Lengan Bawah">LLB</abbr></label>
                                        <input type="number" id="lingkar_lengan_bawah" class="form-control" name="lingkar_lengan_bawah">
                                    </div>
                                </div>
                            </div>

                            <div id="pakaian_bawah">
                                <div class="row mt-3">
                                    <div class="col-2">
                                        <label for="panjang_luar" class="form-label"><abbr title="Panjang Luar">PL</abbr></label>
                                        <input type="number" id="panjang_luar" class="form-control" name="panjang_luar">
                                    </div>
                                    <div class="col-2">
                                        <label for="panjang_dalam" class="form-label"><abbr title="Panjang Dalam">PD</abbr></label>
                                        <input type="number" id="panjang_dalam" class="form-control" name="panjang_dalam">
                                    </div>
                                    <div class="col-2">
                                        <label for="lebar_pinggang" class="form-label"><abbr title="Lebar Pinggang">LP</abbr></label>
                                        <input type="number" id="lebar_pinggang" class="form-control" name="lebar_pinggang">
                                    </div>
                                    <div class="col-2">
                                        <label for="lebar_pergelangan" class="form-label"><abbr title="Lebar Pergelangan">LPG</abbr></label>
                                        <input type="number" id="lebar_pergelangan" class="form-control" name="lebar_pergelangan">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-4">
                                    <label for="total_barang">Total Order <span class="text-danger">*</span></label>
                                    <input type="number" min="12" max="" id="total_barang" name="total_barang" class="form-control" required>
                                    {{-- <div class="small">Minimum pesanan 12 pcs</div> --}}
                                </div>
                                <div class="col-12 col-md">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea class="form-control" name="keterangan" id="keterangan" rows="2" value="{{ old('keterangan') }}"></textarea>
                                </div>
                            </div> 
                            
                               
                        <div class="row mt-3">
                            <div class="col-12">
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
            $('.cari-produk').select2({
                placeholder: "Cari produk",
                theme:"bootstrap-5"
            });
            $('.cari-kain').select2({
                placeholder: "Cari kain",
                theme:"bootstrap-5"
            });

    </script>
    <script>
        
        // CSRF for all ajax call
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        
        $(document).ready(function(){
        $("#pakaian_atas").hide();
        $("#pakaian_bawah").hide();
          $("#produk_id").change(function(){
            var produk_id = $(this).val();
            // produk
            $.ajax({
            
            type : "POST",
            url : "{{route('data-produk')}}",
            data : {produk_id: produk_id},
              success: function (response){
                $('#nama_produk').val(response.result.nama_produk);
                $('#kode_produk').val(response.result.kode_produk);
                $('#size').val(response.result.size);
                $('#lebar_dada').val(response.result.lebar_dada);
                $('#lebar_bahu').val(response.result.lebar_bahu);
                $('#panjang_badan').val(response.result.panjang_badan);
                $('#panjang_tangan').val(response.result.panjang_tangan);
                $('#lingkar_lengan_atas').val(response.result.lingkar_lengan_atas);
                $('#lingkar_lengan_bawah').val(response.result.lingkar_lengan_bawah);
                $('#panjang_luar').val(response.result.panjang_luar);
                $('#panjang_dalam').val(response.result.panjang_dalam);
                $('#lebar_pinggang').val(response.result.lebar_pinggang);
                $('#lebar_pergelangan').val(response.result.lebar_pergelangan);
                
                
                
                // console.log(response.result);
              },
              error: function(xhr){
                console.log(xhr.responseText);
              }
            
            });
            // endproduk

            $.ajax({
            
            type : "POST",
            url : "{{route('data-kategori')}}",
            
            data : {produk_id: produk_id},
              success: function(msg){
                //   $('#kategori').html(msg);
                //   alert(msg.result);
                  
                if (msg.result == "Pakaian atas") {
                    $("#pakaian_atas").show();
                    $("#pakaian_bawah").hide();
                } else{
                    $("#pakaian_bawah").show();
                    $("#pakaian_atas").hide();
                }
                

              },
              error: function(xhr){
                console.log(xhr.responseText);
              }
            
            });

          });

          $("#kain_id").change(function(){
            var kain_id = $(this).val();
            // kain
            $.ajax({
            
            type : "POST",
            url : "{{route('data-kain')}}",
            data : {kain_id: kain_id},
              success: function (response){
                $('#kode_kain').val(response.result.kode_kain);
                $('#nama_kain').val(response.result.nama_kain);
                $('#warna').val(response.result.warna);
                
                
              },
              error: function(xhr){
                console.log(xhr.responseText);
              }
            
            });
            // endkain
          });
          

        });

        $(function () {
            $("input").keydown(function () {
                // Save old value.
                if (!$(this).val() || (parseInt($(this).val()) <= 11 && parseInt($(this).val()) >= 0))
                $(this).data("old", $(this).val());
            });
            $("input").keyup(function () {
                // Check correct, else revert back to old value.
                if (!$(this).val() || (parseInt($(this).val()) <= 11 && parseInt($(this).val()) >= 0))
                ;
                else
                $(this).val($(this).data("old"));
            });
        });
    </script>

@endsection