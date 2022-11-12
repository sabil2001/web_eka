<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>laporan</title>
    <link rel="stylesheet" href="style.css" media="all" />
	<style>
		body{
			padding: 2%;
			font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
		}
		main{
			margin-top: 20px
		}
		.ttd{
			position: absolute;
			bottom: 150px;
			width: 30%;
			text-align: center;
			margin-left: 60%;
			border: 0;
		}
        table{
            border-collapse:collapse;
            font:normal normal 12px Verdana,Arial,Sans-Serif;
            color:#333333;
        }
        table th {
            background:#00BFFF;
            font-weight:bold;
            font-size:14px;
        }
        table th,
        table td {
            vertical-align:top;
            padding:5px 10px;
            border:1px solid #696969;
        }
        table tr {
            background:#F5FFFA;
        }
		table tr:nth-child(even) {
            background:#F0F8FF;
        }
	</style>
  </head>
  <body>
    <main>
    <h2>Bali Based Garment</h2> 
        <h4>Data pesanan</h4>
      <table>
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">No. Telp</th>
                <th scope="col">Model Produk</th>
                <th scope="col">Kain</th>
                <th scope="col">Qty</th>
                <th scope="col">Pesanan</th>
                <th scope="col">Status</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($cetakpertanggal as $pesanan)  
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $pesanan->customer->nama }}</td>
                <td>{{ $pesanan->customer->no_telp }}</td>
                <td>{{ $pesanan->model_produk }}</td>
                <td>{{ $pesanan->jenis_kain }}</td>
                <td>{{ $pesanan->total_barang }}</td>
                <td>{{ Carbon\Carbon::parse($pesanan->pesanan_at)->format('d/m/Y') }}</td>
                <td>{{ $pesanan->status }}</td>
            </tr>
            @endforeach
            </tbody>
      </table>
    </main>
	{{-- <table class="ttd">
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
	</table> --}}
    
  </body>
</html>