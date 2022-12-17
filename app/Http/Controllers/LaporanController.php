<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request){
        // $tglawal = $request->tglawal;
        // $tglakhir = $request->tglakhir;
        // $keranjangs   = Keranjang::with('customer')->whereBetween('pesanan_at',[$tglawal, $tglakhir])->paginate(10);

        // $start = Carbon::parse($request->tglawal);
        // $end = Carbon::parse($request->tglakhir);
        // $keranjangs = Keranjang::whereDate('created_at','<=',$end)
        // ->whereDate('created_at','>=',$start)
        // ->paginate(10);
        
        

        if (request()->tglawal || request()->tglakhir) {
            $tglawal = Carbon::parse(request()->tglawal)->toDateTimeString();
            $tglakhir = Carbon::parse(request()->tglakhir)->toDateTimeString();
            $keranjangs = Keranjang::whereBetween('created_at',[$tglawal,$tglakhir])->paginate(10);
        } else {
            $keranjangs = Keranjang::latest()->paginate(10);
            $tglawal = '';
            $tglakhir = '';
        }

        $tittle = 'Laporan';
        return view('/dashboard/laporan/pesanan', [
            'tittle' => $tittle,
            'keranjangs' => $keranjangs,
            'tglawal' => $tglawal,
            'tglakhir' => $tglakhir
        ]);
        // return view('/dashboard/laporan/pesanan',compact('tittle','keranjangs', 'tglawal', 'tglakhir'));
    }

    public function cetakPesanan($tglawal, $tglakhir)
    {
        $date_laporan = Carbon::now()->format('l, d F Y');
        $tittle        = 'Dashboard';
        $cetakpertanggal = DB::table('keranjangs')
                    ->join('customers', 'customers.id', '=', 'keranjangs.customer_id')
                    ->join('pesanans', 'keranjangs.id', '=', 'pesanans.keranjang_id')
                    ->join('produks', 'pesanans.produk_id', '=', 'produks.id')
                    ->join('kains', 'pesanans.kain_id', '=', 'kains.id')
                    ->select('keranjangs.*', 'customers.*','pesanans.*','produks.*','kains.*', 'pesanans.status')
                    ->whereBetween('pesanan_at',[$tglawal, $tglakhir])
                    ->get();
        $Belum_diproses = Keranjang::where('status', 'Belum diproduksi')->whereBetween('pesanan_at',[$tglawal, $tglakhir])->count();
        $Proses_produksi = Keranjang::where('status', 'Proses produksi')->whereBetween('pesanan_at',[$tglawal, $tglakhir])->count();
        $Selesai_produksi = Pesanan::where('pesanans.status', 'Selesai produksi')->join('keranjangs', 'pesanans.keranjang_id', '=', 'keranjangs.id')->select('keranjangs.pesanan_at')->whereBetween('pesanan_at',[$tglawal, $tglakhir])->count();
        $data = DB::table('pesanans')
                ->select(DB::raw('count(pesanans.id) as produks_total, produk_id'), 'produks.nama_produk')
                ->join('produks', 'pesanans.produk_id', '=', 'produks.id')
                ->join('keranjangs', 'pesanans.keranjang_id', '=', 'keranjangs.id') 
                ->groupBy('produk_id', 'produks.nama_produk')
                ->whereBetween('pesanan_at',[$tglawal, $tglakhir])
                ->get();
        // $data_kain = DB::table('pesanans')
        //             ->select(DB::raw('count(pesanans.id) as kains_total, kain_id'), 'kains.nama_kain', 'kains.warna')
        //             ->join('kains', 'pesanans.kain_id', '=', 'kains.id')
        //             ->join('keranjangs', 'pesanans.keranjang_id', '=', 'keranjangs.id') 
        //             ->groupBy('kain_id', 'kains.nama_kain', 'kains.warna')
        //             ->whereBetween('pesanan_at',[$tglawal, $tglakhir])
        //             ->get();
                    // dd($data_kain);
        $total_kain = DB::table('pesanans')
                    ->select(DB::raw('sum(total_kain_digunakan) as total_digunakan'), 'kains.nama_kain', 'kains.warna')
                    ->join('kains', 'pesanans.kain_id', '=', 'kains.id')
                    ->join('keranjangs', 'pesanans.keranjang_id', '=', 'keranjangs.id') 
                    ->groupBy('kains.nama_kain', 'kains.warna')
                    ->whereBetween('pesanan_at',[$tglawal, $tglakhir])
                    ->get();
        // dd($total_kain);
        $pdf = PDF::loadView('dashboard.laporan.pesanan-pertanggal',compact('cetakpertanggal','tittle', 'date_laporan', 'tglawal', 'tglakhir', 'Belum_diproses','Selesai_produksi', 'data', 'Proses_produksi', 'total_kain'))->setPaper('A4', 'landscape');;
        return $pdf->stream('laporan.pdf');
        
    }


    public function invoice(Keranjang $keranjang)
    {
        $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        $pdf = PDF::loadView('dashboard.order.invoice_pdf', ['keranjang'=>$keranjang, 'pesanan'=>$pesanan])->setPaper('A4', 'potrait');
        return $pdf->stream('Invoce.pdf');
    }
}
