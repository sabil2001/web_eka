<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Produksi;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardRevisiController extends Controller
{
    public function index()
    {
        return view('dashboard.revisi.index', [
            'tittle' => 'Data Revisi',
            'keranjangs' => Keranjang::where('status', 'Revisi')->latest()->paginate(10)
        ]);
    }
    
    public function revisi(Produksi $produksi)
    {
        $date = Carbon::now();
        $pesanan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->get();
        // $produksi = Produksi::where('keranjang_id', $produksi->keranjang_id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->count();
        return view('dashboard.revisi.form', [
            'tittle' => 'Revisi Produksi',
            'produksi' => $produksi,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'date' => $date,
        ]);
    }

    public function edit(Pesanan $pesanan)
    {
        $pesanan = Pesanan::where('id', $pesanan->id)->first();
        return response()->json(['result' => $pesanan]);
    }

    public function update(Pesanan $pesanan, Request $request)
    {
        $kain = Kain::where('id', $request->kain_id)->first();
        $stock_tersedia = $kain->stock;
        $produk = Produk::where('id', $request->produk_id)->first();
        $jumlah_laku_sekarang = $produk->jumlah_laku;

        if ($request->status == 'Dibatalkan') {
            $update_stock_kain = $pesanan->total_kain_digunakan - $stock_tersedia;
            // Kain::where('id', $request->kain_id)
            //             ->update(['stock' => $update_stock_kain]);
            DB::table('kains')
            ->where('id', $request->kain_id)
            ->update(['stock' => $update_stock_kain]);

            $update_jumlah_laku = $pesanan->total_barang_jadi - $jumlah_laku_sekarang;
            // Produk::where('id', $request->produk_id)
            //             ->update(['jumlah_laku' => $update_jumlah_laku]);
            DB::table('produks')
            ->where('id', $request->produk_id)
            ->update(['jumlah_laku' => $update_jumlah_laku]);

            $update_pesanan = [
                'status' => $request->status,
                'total_barang_jadi' => 0,
                'total_kain_digunakan' => 0
            ];
            Pesanan::where('id', $pesanan->id)
                ->update($update_pesanan);
            return response()->json(['errors' => 'Membatalkan produksi pesanan berhasil!']);
        }else {
            $stock_kain_baru = $pesanan->total_kain_digunakan - $stock_tersedia;
            $update_kain = $stock_kain_baru + $request->total_kain_digunakan;
            Kain::where('id', $request->kain_id)
                        ->update(['stock' => $update_kain]);
            $jumlah_laku = $pesanan->total_barang_jadi - $jumlah_laku_sekarang;
            $update_jumlah_laku = $jumlah_laku + $request->total_barang_jadi;
            Produk::where('id', $request->produk_id)
                        ->update(['jumlah_laku' => $update_jumlah_laku]);
            $update_pesanan = [
                'status' => $request->status,
                'total_barang_jadi' => $request->total_barang_jadi,
                'total_kain_digunakan' => $request->total_kain_digunakan
            ];
            Pesanan::where('id', $pesanan->id)
                ->update($update_pesanan);
            return response()->json(['success' => 'Revisi produksi pesanan berhasil!']);
        }
    }

    
}
