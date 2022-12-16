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
		.text-customer {
			font-weight: bold;
			font-size: 15px;
			width: 50%
		}
		.table-customer {
			font-size: 14px;
			border-collapse: collapse;
  			/* width: 100%; */
			margin-left: -3px
		}
		.table-customer, tr, td {
			/* padding-left: 2px; */
			vertical-align: top;
			padding: 2px;
		}
		.colum {
			float: left;
  			width: 50%;
		}

		.pesanan-table {
			font-size: 14px;
		}
		
		.pesanan-table, .header, .isi-header {
			padding: 5px
		}
		
	</style>
</head>
<body>
	<div class="header">
		<div class="group-perusahaan">
			<img class="logo" src="{{ public_path('img/logo.png')}}" alt="BTS">
			<div class="invoice">
				<div>INVOICE</div>
				<div class="nomor_invoive">ORD/20220022/003</div>
			</div>
		</div>
		<div class="both"></div>
		<div class="bawah-perusahaan">
			<div class="colum">	
				<div class="text-customer">CUSTOMER</div>
				<table class="table-customer">
					<tr>
						<td style="width: 100px">Nama</td>
						<td>:</td>
						<td style="height: 20px;">Muhammad Sabil</td>
					</tr>
					<tr>
						<td>NIK</td>
						<td>:</td>
						<td>3512130202010002</td>
					</tr>
					<tr>
						<td>No. Telp</td>
						<td>:</td>
						<td>081529039723</td>
					</tr>
					<tr>
						<td>Alamat</td>
						<td>:</td>
						<td>Jalan gelogor carik ganggotra denpasar bali indonesia merdeka aselolasasasa</td>
					</tr>
				</table>
			</div>
			<div class="colum" style="margin-left: 100px">	
				<div class="text-customer">INFORMASI PESANAN</div>
				<table class="table-customer">
					<tr>
						<td>Tanggal Pesan</td>
						<td>:</td>
						<td>20/12/2022</td>
					</tr>
					<tr>
						<td>Jatuh Tempo</td>
						<td>:</td>
						<td>30/12/2022</td>
					</tr>
					<tr>
						<td>Total Barang</td>
						<td>:</td>
						<td>1 Barang</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	<main>
		<table class="pesanan-table">
			<tr class="header">
				<th class="isi-header">FOTO</th>
				<th class="isi-header">NAMA PRODUK</th>
				<th class="isi-header">JENIS KAIN</th>
				<th class="isi-header">WARNA</th>
				<th class="isi-header">SIZE</th>
			</tr>
		</table>
	</main>
</body>
</html>