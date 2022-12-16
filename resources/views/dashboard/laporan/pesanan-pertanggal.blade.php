<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
		}
		* 	{
		margin: 0;
		padding: 0;
		}

		.logo{
			width: 180px;
		}
		.invoice{
			float: right;
			font-weight: bold;
			font: 16px sans-serif;
			text-align: right;
			margin-top: 4px;
		}
		.nomor_invoive {
			color: #823ce7;
		}
		.alamat_perusahaan{
			color: gray;
			font-size: 15px;
		}
		.perusahaan{
			float: right;
			margin-top: 15px;
		}
		.both{
			clear: both;
		}
		.header .judul{
			text-align: center;
			/* margin-top: 20px; */
		}
		.inv{
			font-weight: bold;
			font-size: 50px;
		}
		.header{
			width: 100%;
			height: 245px;
			/* background-color: aquamarine */
		}
		.group-perusahaan{
			padding-left: 40px;
			padding-right: 40px;
			padding-top: 20px;
		}

		.bawah-perusahaan{
			padding-left: 40px;
			padding-right: 40px;
			padding-top: 30px;
		}
		.text-laporan-pesanan {
			text-align: center;
			font-size: 25px;
			font-weight: bold;
		}
		.range-tanggal {
			font-style: italic;
			color: #823ce7;
			text-align: center;
		}
		main {
			margin-top: -60px;
		}
		table{
			font-family: sans-serif;
			color: #232323;
			border-collapse: collapse;
			border: 1px solid #ddd;
		}
		table, th, td {
			/* border: 1px solid #999; */
    		padding: 1px 15px;
			font-size: 14px;
		}
		thead {
			background-color: #823ce7;
			color: white;
			text-align: left
		}
		tbody, td{
			font-size: 12px;
			padding-top: 5px;
			padding-bottom: 5px;
			
		}
		table tr:nth-child(even){background-color: #f2f2f2;}
	</style>
</head>
<body>
	<div class="header">
		<div class="group-perusahaan">
			<img class="logo" src="{{ public_path('img/logo.png')}}" alt="BTS">
			<div class="invoice" style="font-style: italic">
				<div>Printed on</div>
				<div class="nomor_invoive">{{ $date_laporan }}</div>
			</div>
		</div>
		<div class="both"></div>
		<div class="bawah-perusahaan">
			{{ $cetakpertanggal->sum('total_barang') }}
			<div class="text-laporan-pesanan">Laporan Pesanan</div>
			<div class="range-tanggal">{{  Carbon\Carbon::parse($tglawal)->format('l, d F Y') }} - {{  Carbon\Carbon::parse($tglakhir)->format('l, d F Y') }}</div>
		</div>
	</div>
	<main>
        <table>
            <thead>
                <tr>
                    <th style="width: 100px">No. Pesanan</th>
                    <th>Status</th>
                    <th>Customer</th>
                    <th style="width: 70px">No. Telp</th>
                    <th>Tanggal Pesanan</th>
                    <th>Jatuh Tempo</th>
                    <th>Nama Produk</th>
                    <th>Size</th>
                    <th>Jenin Kain</th>
                    <th>Warna</th>
                    <th style="width: 50px">Qty</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cetakpertanggal as $data)  
                <tr>
					<td>{{ $data->kode_keranjang }}</td>
                    <td>{{ $data->status }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->no_telp }}</td>
                    <td>{{ Carbon\Carbon::parse($data->pesanan_at)->format('d-m-Y') }}</td>
                    <td>{{ Carbon\Carbon::parse($data->tgl_jatuh_tempo)->format('d-m-Y') }}</td>
                    <td>{{ $data->nama_produk }}</td>
                    <td>{{ $data->size }}</td>
                    <td>{{ $data->nama_kain }}</td>
                    <td>{{ $data->warna }}</td>
                    <td style="text-align: right">{{ $data->total_barang }} pcs</td>
                    <td>{{ $data->keterangan }}</td>
                    {{-- <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->size }}</td>
                    <td>{{ $data->warna }}</td> --}}
                    {{-- <td>{{ $data->customer->no_telp }}</td>
                    <td>{{ $data->produk }}</td>
                    <td>{{ $data->jenis_kain }}</td> --}}
                    {{-- <td>{{ $data->total_barang }}</td>
                    <td>{{ Carbon\Carbon::parse($data->pesanan_at)->format('d/m/Y') }}</td>
                    <td>{{ $data->status }}</td> --}}
                </tr>
                @endforeach
                </tbody>
          </table>
	</main>
</body>
</html>