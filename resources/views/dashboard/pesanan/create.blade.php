@extends('dashboard.layouts.main')

@section('container')

<div class="pagetitle">
  <h1>Tambah Pesanan</h1>
  <nav>
     <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tambah</li>
        <li class="breadcrumb-item active">Pesanan</li>
     </ol>
  </nav>
</div>

<section class="section">
  <div class="row justify-content-center">
     <div class="col-lg-8">
        <div class="card">
           <div class="card-body">
              <h5 class="card-title">Form Pemesanan</h5>
                  <form method="post" action="/dashboard/pesanan">
                      @csrf
                      <div class="mb-3">
                          <div class="row">
                              <div class="col-6">
                                <label for="customer_id" class="form-label">Nomor Induk Penduduk</label>    
                                <br>                           
                                <select class="select2" id="customer_id" name="customer_id" required>
                                  <option value="">--pilih--</option>
                                    @foreach ($customers as $customer)                                       
                                    <option value="{{ $customer->id }}">{{ $customer->NIK }} | {{ $customer->nama }}</option>
                                    @endforeach
                                </select>
                                  @error('customer_id')
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
                                <label for="tgl_jatuh_tempo" class="form-label">Tanggal Jatuh Tempo</label>
                                <input id="tgl_jatuh_tempo" class="form-control @error ('tgl_jatuh_tempo') is-invalid @enderror" type="date" name="tgl_jatuh_tempo" required value="{{ old('tgl_jatuh_tempo') }}">
                                @error('tgl_jatuh_tempo')
                                    <div class="invalid-feedback">
                                    {{ $message }}
                                    </div>
                                @enderror 
                              </div>
                              <div class="col">
                                <label for="model_produk" class="form-label">Model</label>
                                <input type="text" class="form-control @error ('model_produk') is-invalid @enderror" id="model_produk" name="model_produk"  placeholder="model..." required value="{{ old('model_produk') }}">
                                @error('model_produk')
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
                                <label for="jenis_kain" class="form-label">Jenis Kain</label>
                                <select class="form-select" aria-label="jenis_kain" id="jenis_kain" name="jenis_kain" placeholder="jenis kain..." required value="{{ old('jenis_kain') }}">
                                  <option value="">--pilih--</option>
                                  <option value="Katun">Katun</option>
                                  <option value="Baby Canvas">Baby Canvas</option>
                                  <option value="Linen">Linen</option>
                                  <option value="Drill">Drill</option>
                                  <option value="Polyester">Polyester</option>
                                  <option value="Denis">Denis</option>
                                  <option value="Rayon">Rayon</option>
                                  <option value="Organaza">Organaza</option>
                                  <option value="Tile">Tile</option>
                                  <option value="Brokat">Brokat</option>
                                  <option value="Satin">Satin</option>
                                  <option value="Sutra">Sutra</option>
                                  <option value="Velvet">Velvet</option>
                                  <option value="Sifon">Sifon</option>
                                  <option value="Twistcone">Twistcone</option>
                                  <option value="Rajut">Rajut</option>
                                  <option value="Kasmir">Kasmir</option>
                                  <option value="Tweed">Tweed</option>
                                  <option value="Viscose">Viscose</option>
                                  <option value="Lycra">Lycra</option>
                                  <option value="Jersey">Jersey</option>
                                  <option value="Kulit">Kulit</option>
                                  <option value="Taffeta">Taffeta</option>
                                  <option value="Wolfis">Wolfis</option>
                                  @error('jenis_kain')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>
                                  @enderror
                              </select>
                              </div>
                              <div class="col">
                                <label for="total_barang" class="form-label">Total Barang</label>
                                  <input type="number" class="form-control @error ('total_barang') is-invalid @enderror" id="total_barang" name="total_barang"  placeholder="total..." required value="{{ old('total_barang') }}">
                                  @error('total_barang')
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
                            <label for="keterangan" class="form-label">Keterangan</label>
                            <input type="text" class="form-control @error ('keterangan') is-invalid @enderror" id="keterangan" name="keterangan"  placeholder="keterangan..." value="{{ old('keterangan') }}">
                            @error('keterangan')
                                      <div class="invalid-feedback">
                                          {{ $message }}
                                      </div>
                                  @enderror      
                          </div>
                        </div>     
                    </div>
                      <div class="text-center"> <button type="submit" class="btn btn-primary">Submit</button> <button type="reset" class="btn btn-secondary">Reset</button></div>
                  </form>
              </div>
          </div>
       </div>
    </div>
  </section>



  {{-- <div class="table-responsive"> --}}


    
      {{-- <div class="col-md-8">
        <div class="search">
          <form action="" method="POST">
            @csrf
            <label for="search">Cari Customer</label>
            <input type="search" id="search" name="search" class="form-control" placeholder="NIK">
            <button type="submit" class="badge">Cari</button>
          </form>

        </div>
      </div>

    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">NIK</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($customers as $customer)  
        <tr>
          <td>{{ $loop->iteration }}</td>
          
          <td>{{ $customer->nama }}</td>
          <td>{{ $customer->NIK }}</td>

          
            
          
          <td>
            <a href="/dashboard/customer/{{ $customer->id }}" class="badge bg-info"><span data-feather="eye"></span></a>
            <a href="/dashboard/customer/{{ $customer->id }}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{-- <div>
      {{ $customers->firstItem() }}
    </div> --}}
    {{-- <div class="position-absolute end-0 me-4">
      {{ $customers->links() }} --}}
    {{-- </div>
    </div> --}} 
@endsection