@extends('dashboard.layouts.main')

@section('container')
<div class="pagetitle">
    <h1>Edit Pesanan</h1>
    <nav>
       <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Data</li>
          <li class="breadcrumb-item">Pesanan</li>
          <li class="breadcrumb-item active">Edit</li>
       </ol>
    </nav>
  </div>


  <section class="section">
    <div class="row justify-content-center">
       <div class="col-lg-8">
          <div class="card">
             <div class="card-body">
                <h5 class="card-title">Edit Pesanan</h5>
                    <form method="post" action="/dashboard/order/edit/pesanansave/{{ $pesanan->id }}">
                        @method('put')
                        @csrf
                            <div class="row">
                                <div class="col-6">
                                    <label for="kode_keranjang" class="form-label">No. Pesanan</label>
                                    <input readonly type="text" class="form-control" id="kode_keranjang" value="{{ $kode }}">
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
                                    <label for="pesanan_at" class="form-label">Tanggal Pesan</label>
                                    <input readonly type="text" class="form-control" id="pesanan_at" value="{{ $keranjang->pesanan_at }}">
                                </div>
                                <div class="col-6">
                                    <label for="tgl_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo</label>
                                    <input autofocus type="date" class="form-control" id="tgl_jatuh_tempo" readonly value="{{ old('tgl_jatuh_tempo', $keranjang->tgl_jatuh_tempo) }}">
                                </div>
                            </div>  
                            <div class="row mt-3">
                                <div class="col-6">
                                    <label for="produk" class="form-label">Produk</label>
                                    <input readonly type="text" class="form-control" id="produk" value="{{ $pesanan->produk->nama_produk }}">
                                </div>
                                <div class="col-6">
                                    <label for="kain" class="form-label">Kain</label>
                                    <input autofocus type="text" class="form-control" id="kain" readonly value="{{ $pesanan->kain->nama_kain }}">
                                </div>
                            </div>  
                            <div class="row mt-3">
                                <div class="col-3">
                                    <label for="size" class="form-label">Size</label>
                                    <input readonly type="text" class="form-control" id="size" value="{{ $pesanan->size }}">
                                </div>
                                <div class="col-6 col-md-3">
                                    <label for="total_barang" class="form-label">Total Barang</label>
                                    <input required type="number" class="form-control" name="total_barang" id="total_barang" value="{{ old('total_barang', $pesanan->total_barang) }}">
                                </div>
                            </div>  
                            <div class="row mt-3">
                                <div class="col-12 col-md-12">
                                    <div class="form-check">
                                        <input onclick="batal()" class="form-check-input" name="status" type="checkbox" value="Batal" id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                          Batalkan untuk pesanan barang ini.
                                        </label>
                                    </div>
                                </div>
                            </div>  
                            <div class="row mt-2" id="batal">
                                <div class="col-md-6 col-12">
                                    <label for="keterangan" class="form-label">Alasan</label>
                                    <input type="text" name="keterangan" id="keterangan" class="form-control">
                                </div>
                            </div>

                        @if ($pesanan->produk->kategori == 'Pakaian atas')
                        <div class="row">
                            <div class="col">
                                <div id="pakaian_atas">
                                    <div class="row mt-3">
                                        <div class="col">
                                            <label for="lebar_dada" class="form-label"><abbr title="Lebar Dada">LD</abbr></label>
                                            <input type="number" id="lebar_dada" class="form-control" name="lebar_dada" value="{{ old('lebar_dada', $pesanan->lebar_dada) }}">
                                        </div>
                                        <div class="col">
                                            <label for="lebar_bahu" class="form-label"><abbr title="Lebar Bahu">LB</abbr></label>
                                            <input type="number" id="lebar_bahu" class="form-control" name="lebar_bahu" value="{{ old('lebar_bahu', $pesanan->lebar_bahu) }}">
                                        </div>
                                        <div class="col">
                                            <label for="panjang_badan" class="form-label"><abbr title="Panjang Badan">PB</abbr></label>
                                            <input type="number" id="panjang_badan" class="form-control" name="panjang_badan" value="{{ old('panjang_badan', $pesanan->panjang_badan) }}">
                                        </div>
                                        <div class="col">
                                            <label for="panjang_tangan" class="form-label"><abbr title="Panjang Tangan">PT</abbr></label>
                                            <input type="number" id="panjang_tangan" class="form-control" name="panjang_tangan" value="{{ old('panjang_tangan', $pesanan->panjang_tangan) }}">
                                        </div>
                                        <div class="col">
                                            <label for="lingkar_lengan_atas" class="form-label"><abbr title="Lingkar Lengan Atas">LLA</abbr></label>
                                            <input type="number" id="lingkar_lengan_atas" class="form-control" name="lingkar_lengan_atas" value="{{ old('lingkar_lengan_atas', $pesanan->lingkar_lengan_atas) }}">
                                        </div>
                                        <div class="col">
                                            <label for="lingkar_lengan_bawah" class="form-label"><abbr title="Lingkan Lengan Bawah">LLB</abbr></label>
                                            <input type="number" id="lingkar_lengan_bawah" class="form-control" name="lingkar_lengan_bawah" value="{{ old('lingkar_lengan_bawah', $pesanan->lingkar_lengan_bawah) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="row">
                            <div class="col">
                                <div id="pakaian_bawah">
                                    <div class="row mt-3">
                                        <div class="col-2">
                                            <label for="panjang_luar" class="form-label"><abbr title="Panjang Luar">PL</abbr></label>
                                            <input type="number" id="panjang_luar" class="form-control" name="panjang_luar" value="{{ old('panjang_luar', $pesanan->panjang_luar) }}">
                                        </div>
                                        <div class="col-2">
                                            <label for="panjang_dalam" class="form-label"><abbr title="Panjang Dalam">PD</abbr></label>
                                            <input type="number" id="panjang_dalam" class="form-control" name="panjang_dalam" value="{{ old('panjang_dalam', $pesanan->panjang_dalam) }}">
                                        </div>
                                        <div class="col-2">
                                            <label for="lebar_pinggang" class="form-label"><abbr title="Lebar Pinggang">LP</abbr></label>
                                            <input type="number" id="lebar_pinggang" class="form-control" name="lebar_pinggang" value="{{ old('lebar_pinggang', $pesanan->lebar_pinggang) }}">
                                        </div>
                                        <div class="col-2">
                                            <label for="lebar_pergelangan" class="form-label"><abbr title="Lebar Pergelangan">LPG</abbr></label>
                                            <input type="number" id="lebar_pergelangan" class="form-control" name="lebar_pergelangan" value="{{ old('lebar_pergelangan', $pesanan->lebar_pergelangan) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif    
                        <div class="row mt-2">
                            <div class="col-12 col-md-9">
                                <div class="bg-light border border-warning rounded p-2">
                                    <div class="fw-bold text-danger h6"><i class="bi bi-megaphone"></i> INFORMASI</div>
                                    <p class="fw-light">Anda hanya diperkenankan untuk mengedit ukuran dan jumlah barang saja. Jika lebih dari itu batalkan pesanan ini dan Tambah Baru.</p>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col">
                                <a href="/dashboard/order/show/{{ $keranjang->id }}" class="btn btn-secondary"><i class="bi bi-backspace"></i><span class="ms-2">Back</span></a>
                            </div>
                            <div class="col">
                                <div class="float-end">
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
        $("#batal").hide();
        function batal() {
            // document.getElementById('batal').style.display = "block";
            $("#batal").toggle();
        }
    </script>
@endsection