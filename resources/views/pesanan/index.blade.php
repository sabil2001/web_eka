<!DOCTYPE html>
<html>
<head>
	<title>Tutorial Laravel #24 : Relasi One To Many Eloquent</title>
	<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 
	<div class="container">
		<div class="card mt-5">
			<div class="card-body">
				<h3 class="text-center"><a href="https://www.malasngoding.com">www.malasngoding.com</a></h3>
				<h5 class="text-center my-4">Eloquent One To Many Relationship</h5>
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>id</th>
							<th>Nama</th>
							<th>Tanggal Pesanan</th>
							<th>tanggal jatuh tempo</th>
							<th>model produk</th>
							<th>jenis kain</th>
							<th>total barang</th>
							<th>keterangan</th>
							<th width="15%" class="text-center">Jumlah Tag</th>
						</tr>
					</thead>
					<tbody>
						@foreach($pesanan as $a)
						<tr>
							<td><a href="/detailCustomer/{{ $a->id }}">{{ $a->id_customer }}</a></td>
							<td>{{ $a->customer->nama}}</td>
							<td>{{ $a->tgl_pesanan }}</td>
							<td>{{ $a->tgl_jatuh_tempo }}</td>
							<td>{{ $a->model_produk }}</td>
							<td>{{ $a->jenis_kain }}</td>
							<td>{{ $a->total_barang }}</td>
							<td>{{ $a->keterangan }}</td>
							<td class="text-center"><a href=""></a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
 
</body>
</html>