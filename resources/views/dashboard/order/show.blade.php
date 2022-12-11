@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Detail Order</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Order</li>
        <li class="breadcrumb-item active">Detail Order</li>
     </ol>
  </nav>
</div>

<!-- Modal rincian -->
<div class="modal fade" id="rincianModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Rincian ukuran</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="atas" class="d-none">
                <div class="row">
                    <div class="col-4">Lebar dada</div>
                    <div class="col-2" id="lebar_dada"></div>
                    <div class="col-4">Lebar bahu</div>
                    <div class="col-2" id="lebar_bahu"></div>
                </div>
                <div class="row">
                    <div class="col-4">Panjang badan</div>
                    <div class="col-2" id="panjang_badan"></div>
                    <div class="col-4">Panjang tangan</div>
                    <div class="col-2" id="panjang_tangan"></div>
                </div>
                <div class="row">
                    <div class="col-4">Lg. lengan atas</div>
                    <div class="col-2" id="lingkar_lengan_atas"></div>
                    <div class="col-4">Lg. lengan bawah</div>
                    <div class="col-2" id="lingkar_lengan_bawah"></div>
                </div>
            </div>

            <div id="bawah" class="d-none">
                <div class="row">
                    <div class="col-4">Panjang luar</div>
                    <div class="col-2" id="panjang_luar"></div>
                    <div class="col-4">Panjang dalam</div>
                    <div class="col-2" id="panjang_dalam"></div>
                </div>
                <div class="row">
                    <div class="col-4">L. pinggang</div>
                    <div class="col-2" id="lebar_pinggang"></div>
                    <div class="col-4">L. pergelangan</div>
                    <div class="col-2" id="lebar_pergelangan"></div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-4">Keterangan</div>
                <div class="col-2" id="keterangan"></div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
<section class="section">
    <div class="row justify-content-center">
        <div class="col-xl-12 col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-4">
                        <div class="col p-2">
                            <div class="tittle-detail-order rounded text-white"><i class="bi bi-info-circle"></i> Informasi Orderan</div>
                        </div>
                        <div class="col p-2">
                            <div class="border border-danger rounded text-danger text-deadline"><span class="">Status: {{ $keranjang->status }}</span></div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="fw-bold text-judul">No. Pesanan</div>
                            <div>{{ $keranjang->kode_keranjang }}</div>
                        </div>
                        <div class="col">
                            <div class="fw-bold text-judul">Customer</div>
                            <div>{{ $keranjang->customer->nama }}</div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="fw-bold text-judul">Tanggal Order</div>
                            <div>{{ Carbon\Carbon::parse($keranjang->pesanan_at)->format('d-m-Y') }}</div>
                        </div>
                        <div class="col">
                            <div class="fw-bold text-judul">No. Telp</div>
                            <div>{{ $keranjang->customer->no_telp }}</div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="fw-bold text-judul">Jatuh Tempo</div>
                            <div>{{ Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->format('d-m-Y') }}</div>
                        </div>
                        <div class="col">
                            <div class="fw-bold text-judul">Alamat</div>
                            <div>{{ $keranjang->customer->alamat }}</div>
                        </div>
                    </div>
                    @if (!$produksi)
                        
                    @else
                    
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="fw-bold text-judul">Pegawai Produksi</div>
                            <div>{{ $produksi->user->name }}</div>
                        </div>
                        <div class="col-6">
                            <div class="fw-bold text-judul">Tanggal Produksi</div>
                            <div>{{ Carbon\Carbon::parse($produksi->tgl_mulai)->format('d-m-Y') }}</div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-6">
                            <div class="fw-bold text-judul">Keterangan</div>
                            <div>{{ $produksi->keterangan }}</div>
                        </div>
                        <div class="col-6">
                            <div class="fw-bold text-judul">Tanggal Selesai</div>
                            <div>{{ Carbon\Carbon::parse($produksi->tgl_akhir)->format('d-m-Y') }}</div>
                        </div>
                    </div>
                    @endif
                    
                    @if ($keranjang->status == 'Belum diproduksi')
                    <div class="row mt-4 bg-light p-2 rounded">
                        <div class="col-8 col-md-6">
                            <div class="text-muted text-secondary small">
                                <ul class="list-unstyled">
                                <li>Aksi yang dapat dilakukan:
                                  <ul>
                                        <li>Tombol Edit untuk merubah jatuh tempo orderan</li>
                                        <li>Tombol Batal untuk membatalkan orderan</li>
                                  </ul>
                                </li>
                              </ul>
                            </div>
                        </div>
                        <div class="col d-flex">
                            <div class="justify-content-center align-self-center mx-auto">
                                
                                <a href="/dashboard/order/edit/{{ $keranjang->id }}" class="button-show-edit" style="width: 220px"><i class="bi bi-pencil-square"></i><span class="ms-2">EDIT</span></a>
                                <a href="#" onclick="batal()" class="button-show-batal" title="Batalkan Pesanan" style="width: 220px"><i class="bi bi-x-circle"></i><span class="ms-2">BATAL</span></a>
                            
                                <form action="/dashboard/order/batal/{{ $keranjang->id }}" method="post" id="batal" class="mt-2">
                                    @method('put')
                                    @csrf
                                    <label for="keterangan" class="form-label">Alasan</label>
                                    <input type="text" required name="keterangan" id="keterangan" class="form-control">
                                    <button class="btn btn-sm bg-primary mt-2 text-white" type="submit"><i class="bi bi-box-arrow-down me-2"></i>Simpan Perubahan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @else
                        
                    @endif
                    

                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-xl-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pesanan</h5>
                    <table class="table align-middle">
                        <thead>
                           <tr>
                              <th scope="col">No</th>
                              <th scope="col" style="width: 260px">Produk</th>
                              <th scope="col">Kain</th>
                              <th scope="col">Size</th>
                              <th scope="col">Status</th>
                              <th scope="col">Jumlah Kain</th>
                              <th scope="col">Barang Jadi</th>
                              <th scope="col" style="width: 180px">Aksi</th>
                           </tr>
                        </thead>
                        <tbody>
                        @foreach ($pesanan as $pesanan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $pesanan->produk->foto_produk) }}"class="img-fluid p-1 rounded img-produk-detail">
                                    {{ $pesanan->produk->nama_produk }} (x{{ $pesanan->total_barang }})
                                </td>
                                <td>{{ $pesanan->kain->nama_kain }} {{ $pesanan->kain->warna }}</td>
                                <td>{{ $pesanan->size }}</td>
                                <td>{{ $pesanan->status }}</td>
                                <td>
                                    @if ($pesanan->total_kain_digunakan)
                                    {{ $pesanan->total_kain_digunakan }} CM
                                    @else
                                        
                                    @endif
                                </td>
                                <td>
                                    @if ($pesanan->total_barang_jadi)
                                        {{ $pesanan->total_barang_jadi }} pcs
                                    
                                    @else
                                        Belum selesai
                                    @endif
                                </td>
                                <td>
                                    <div><a href="#" data-id="{{ $pesanan->id }}" title="Rincian ukuran" class="tombol-lihat tombol-halaman-detail"><i class="bi bi-eye"></i> Lihat Rincian Ukuran</a></div>
                                    @if ($keranjang->status == 'Belum diproduksi')
                                        <div class="mt-2"><a href="/dashboard/order/edit/pesanan/{{ $pesanan->id }}" class="tombol-halaman-produksi " title="Edit Informasi Pesanan"><i class="bi bi-pencil-square"></i> Edit Pesanan</a></div>
                                        
                                    @else
                                        
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                     </table>

                    
                    <div class="row mt-2">
                        <div class="col">
                            <button onclick="history.back()" class="btn btn-secondary"><i class="bi bi-backspace"></i><span class="ms-2">Kembali</span></button>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
  </section>

  <script>

$(document).on('click', '.tombol-lihat', function(e){
        var id = $(this).data('id');
        $.ajax({
            url: '/dashboard/prosesproduksi/lihatrincian/'+id,
            type: 'GET',
            success: function(response){
                $('#rincianModal').modal('show');
                console.log(response.result);
                $('#keterangan').html(response.result.keterangan);
                if (response.kategori == 'Pakaian atas') {
                    $('#atas').removeClass('d-none');
                    $('#lebar_dada').html(response.result.lebar_dada);
                    $('#lebar_bahu').html(response.result.lebar_bahu);
                    $('#panjang_badan').html(response.result.panjang_badan);
                    $('#panjang_tangan').html(response.result.panjang_tangan);
                    $('#lingkar_lengan_atas').html(response.result.lingkar_lengan_atas);
                    $('#lingkar_lengan_bawah').html(response.result.lingkar_lengan_bawah);
                }else{
                    $('#bawah').removeClass('d-none');
                    $('#panjang_luar').html(response.result.panjang_luar);
                    $('#panjang_dalam').html(response.result.panjang_dalam);
                    $('#lebar_pinggang').html(response.result.lebar_pinggang);
                    $('#lebar_pergelangan').html(response.result.lebar_pergelangan);
                }
            }
        });
    });

    $("#batal").hide();
    function batal() {
        // document.getElementById('batal').style.display = "block";
        $("#batal").toggle();
    }
  </script>
@endsection