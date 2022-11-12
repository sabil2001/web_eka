<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>inv#{{ $pesanan->id }}{{ $pesanan->customer_id }}</title>
    <link rel="stylesheet" href="style.css" media="all" />
	<style>
		body{
			padding: 2%;
			font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
		}
		main{
			margin-top: 20px
		}
		thead{
			background-color: palevioletred;
		}
		th{
			padding: 20px;
		}
		.header-right{
			text-align: right;
		}
		h1{
			text-align: left;
		}
		.header-table{
			width: 100%;
		}
		.invoice{
			font-size: 70px;
			color: darkgrey;
			font-weight: 200;
		}
		#project{
			margin-top: 50px;
		}
		.bio{
			width: 80px;
		}
		.pesanan{
			width: 100%;
		}
		.isi-pesanan{
			padding-left: 20px;
		}
		.qty{
			text-align: center;
		}
		#notices{
			margin-top: 20px;
		}

		.notice{
			color: red;
		}
		#notices{
			color: red;
		}
		.ttd{
			position: absolute;
			bottom: 150px;
			width: 30%;
			text-align: center;
			margin-left: 60%;
			
		}
		
	</style>
  </head>
  <body>
    <header>
		<table class="header-table">
			<tr>
				<td class="invoice">INVOICE</td>
				<td style="text-align: right">
					Invoice #:{{ $pesanan->id }}{{ $pesanan->customer_id }} <br>
					Tanggal : {{ Carbon\Carbon::parse($pesanan->pesanan_at)->format('d/m/Y') }} <br>
					Jatuh Tempo : {{ Carbon\Carbon::parse($pesanan->tgl_jatuh_tempo)->format('d/m/Y') }}
				</td>
			</tr>
		</table>
      <div>
        <div>Bali Based Garment</div>
        <div>Kuta Utara, Kabupaten Badung,<br /> Bali</div>
        <div>(0361) 445566</div>
      </div>
	  <div id="project">
		<table class="header-table">
			<tr>
				<td class="bio">NIK</td>
				<td> : {{ $pesanan->customer->NIK }}</td>
			</tr>
			<tr>
				<td class="bio">Nama</td>
				<td> : {{ $pesanan->customer->nama }}</td>
			</tr>
			<tr>
				<td class="bio">Alamat</td>
				<td> : {{ $pesanan->customer->alamat }}</td>
			</tr>
			<tr>
				<td class="bio">No. Telp</td>
				<td> : {{ $pesanan->customer->no_telp }}</td>
			</tr>
		</table>
      </div>
    </header>

    <main>
      <table class="pesanan">
        <thead>
          <tr>
            <th class="service">Model</th>
            <th class="desc">Keterangan</th>
            <th>Kain</th>
            <th>QTY</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td class="isi-pesanan">{{ $pesanan->model_produk }}</td>
            <td class="isi-pesanan">{{ $pesanan->keterangan }}</td>
            <td class="isi-pesanan">{{ $pesanan->jenis_kain }}</td>
            <td class="qty">{{ $pesanan->total_barang }}</td>
          </tr>
          </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Perhatikan jatuh tempo pesanan.</div>
      </div>
    </main>
	<table class="ttd">
		<tr>
			<td>Bali Based Garment</td>
		</tr>
		<tr>
			<td><p></p></td>
		</tr>
		<tr>
			<td><p></p></td>
		</tr>
		<tr>
			<td>( Admin )</td>
		</tr>
	</table>
  </body>
</html>