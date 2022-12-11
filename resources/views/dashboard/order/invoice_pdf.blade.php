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
			width: 100px;
		}
		.nama_perusahaan{
			font-weight: bold;
			font-size: large
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
			margin-top: 20px;
		}
		.inv{
			font-weight: bold;
			font-size: 50px;
		}
		.header{
			width: 100%;
			height: 245px;
			background-color: aquamarine
		}
		.group-perusahaan{
			padding-left: 40px;
			padding-right: 40px;
			padding-top: 20px;
		}
		.info_keranjang{
			margin: auto;
			border-collapse: collapse;
  			width: 90%;
		}
		td, th{
			padding: 8px;
		}
	</style>
</head>
<body>
	<div class="header">
		<div class="group-perusahaan">
			<div class="perusahaan">
				<div class="nama_perusahaan">Bali Based Garment</div>
				<div class="alamat_perusahaan">Jl. Pura Wr. No.6, Canggu, Kec. Kuta Utara <br>Kabupaten Badung, Bali <br>Telp. 08990981233</div>
			</div>
			<img class="logo" src="{{ public_path('img/logo.png')}}" alt="BTS">
		</div>
		<div class="both"></div>
		<div class="judul">
			<div class="inv">INVOICE</div>
			<div>{{ $keranjang->kode_keranjang }}</div>
		</div>
	</div>
	<main>
		<table border="1" class="info_keranjang">
			<tr>
				<td>Produk</td>
				<td>Jumlah</td>
				<td>Size</td>
				<td>LD</td>
				<td>LB</td>
				<td>PB</td>
				<td>PT</td>
				<td>LLA</td>
				<td>LLB</td>
				<td>Keterangan</td>
			</tr>
		</table>
	</main>
</body>
</html>