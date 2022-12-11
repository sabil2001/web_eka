@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Mulai Produksi</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
        <li class="breadcrumb-item">Produksi</li>
        <li class="breadcrumb-item active">Mulai Produksi</li>
     </ol>
  </nav>
</div>


<!-- Modal -->
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
                <div class="col-8" id="keterangan"></div>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

<!-- Modal --> 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Form Produksi</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="" method="post">
            @csrf
            @method('put')
        
        <div class="modal-body">
            <div class="alert alert-success d-none"></div>
            <div class="alert alert-danger d-none"></div>

            <input type="hidden" id="kain_id" name="kain_id">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" aria-label="Default select example">
                <option value="Proses">Proses</option>
                <option value="Dibatalkan">Dibatalkan</option>
            </select>
            <div class="row">
                <div class="col">
                    <label for="stock" class="form-label mt-3">Stock Kain</label>
                    <input type="number" class="form-control" id="stock" name="stock" value="" readonly>
                </div>
                <div class="col">
                    <label for="total_kain_digunakan" class="form-label mt-3">Kain yang digunakan</label>
                    <input type="number" class="form-control" id="total_kain_digunakan" name="total_kain_digunakan" placeholder="satuan mater (CM)">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary tombol-simpan">Simpan</button>
        </div>
    </form>
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
                            <div class="tittle-detail-order rounded text-white"><i class="bi bi-info-circle"></i> Produksi Orderan</div>
                        </div>
                        <div class="col p-2">
                            <div class="border border-danger rounded text-danger text-deadline"><span class=""><i class="bi bi-alarm"></i> Sisa Waktu</span> {{ Carbon\Carbon::parse($keranjang->tgl_jatuh_tempo)->diffInDays(Carbon\Carbon::now()) }} Hari</div>
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
                    <div class="row mt-4 bg-light p-2 rounded">
                        <div class="col-8 col-md-6">
                            <div class="text-muted text-secondary small">
                                <ul class="list-unstyled">
                                <li>Aksi yang dilakukan selanjutnya:
                                  <ul>
                                        <li>Lihat detail ukuran yang diminta Customer</li>
                                        <li>Tambahkan kain yang akan digunakan</li>
                                        <li>Klik tombol Simpan untuk memulai produksi</li>
                                        <li>Jika ingin membatalkan pesanan, Ceklis batal produksi</li>
                                  </ul>
                                </li>
                                <div class="text-danger">Note: Barang yang sudah diproses Produksi tidak dapat dibatalkan.</div>
                              </ul>
                            </div>
                        </div>
                        <div class="col d-flex">
                            <div class="justify-content-center align-self-center mx-auto">
                                <form action="/dashboard/prosesproduksi/mulai/klik/{{ $keranjang->id }}" method="post">
                                    @csrf
                                    <button class="button-produksi" style="width: 220px"><i class="bi bi-save2"></i><span class="ms-2">SIMPAN</span></button>
                                    <div class="form-check mt-1">
                                        <input class="form-check-input" type="checkbox" id="button_batal" value="Batal produksi" name="batal_produksi">
                                        <label class="form-check-label small" for="flexCheckDefault">
                                        Batal produksi
                                        </label>
                                    </div>
                                    <div class="" id="keterangan-form">
                                        <label for="keterangan" class="form-label">Keterangan</label>
                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"></textarea>
                                    </div>
                                    {{-- <button class="button-produksi"><i class="bi bi-save2"></i><span class="ms-2">SIMPAN</span></button> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-xl-12 col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pesanan</h5>
                    <table class="table table-responsive align-middle">
                        <thead>
                           <tr>
                              <th scope="col">No</th>
                              <th scope="col" style="100px">Produk</th>
                              <th scope="col">Kain</th>
                              <th scope="col">Size</th>
                              <th scope="col">Status</th>
                              <th scope="col">Kain digunakan</th>
                              <th scope="col">Aksi</th>
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
                                    <div><a href="#" data-id="{{ $pesanan->id }}" title="Rincian ukuran" class="tombol-lihat tombol-halaman-detail"><i class="bi bi-eye"></i> Lihat Rincian Ukuran</a></div>
                                    @if ($pesanan->total_kain_digunakan)
                                        
                                    @else
                                        <div class="mt-2"><a href="#" data-id="{{ $pesanan->id }}" title="Tambahkan kain yang digunakan" class="tombol-edit tombol-halaman-produksi"><i class="bi bi-play-circle"></i> Tambah Kain Produksi</a></div>
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

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

    $(document).on('click', '.tombol-edit', function(e){
        var id = $(this).data('id');
        $.ajax({
            url: '/dashboard/prosesproduksi/edit/'+id,
            type: 'GET',
            success: function(response){
                $('#exampleModal').modal('show');
                $('#kain_id').val(response.result.kain_id);
                $('#stock').val(response.stock);
                // console.log(response.result);
            }
        });
        
        $('.tombol-simpan').click(function(){
            
            $.ajax({
                url: '/dashboard/prosesproduksi/update/'+id,
                type: 'PUT',
                data: {
                    status: $('#status').val(),
                    stock: $('#stock').val(),
                    total_kain_digunakan: $('#total_kain_digunakan').val(),
                    kain_id: $('#kain_id').val()
                },
                success: function(response){
                    if (response.errors) {
                        console.log(response.errors);
                        $('.alert-danger').removeClass('d-none');
                        $('.alert-danger').html(response.errors);
                    }else{
                        $('.alert-success').removeClass('d-none');
                        $('.alert-success').html(response.success);
                    }
                    location.reload();  
                }

                
            });

        });
    });

    $('#exampleModal').on('hidden.bs.modal', function(){
        $('#kain_id').val('');
        $('#stock').val('');

        $('.alert-success').addClass('d-none');
        $('.alert-success').html('');
        $('.alert-danger').addClass('d-none');
        $('.alert-danger').html('');
    });

    $("#status").change(function(){
        var status = $(this).val();
        if (status == "Proses") {
                $('#total_kain_digunakan').removeAttr('disabled');
            }else {
                // $("#total_kain_digunakan").disabled();
                $('#total_kain_digunakan').attr('disabled', '');
                $('#total_kain_digunakan').val('');
            }
    });

    $("#keterangan-form").hide();
    $("#button_batal").click(function() {
        if($(this).is(":checked")) {
            $("#keterangan-form").show(300);
        } else {
            $("#keterangan-form").hide(200);
        }
    });
  </script>

@endsection