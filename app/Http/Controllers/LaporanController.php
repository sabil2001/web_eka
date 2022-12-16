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
        $tittle        = 'Dashboard';
        $cetakpertanggal = DB::table('keranjangs')
                    ->join('customers', 'customers.id', '=', 'keranjangs.customer_id')
                    ->join('pesanans', 'keranjangs.id', '=', 'pesanans.keranjang_id')
                    ->join('produks', 'pesanans.produk_id', '=', 'produks.id')
                    ->join('kains', 'pesanans.kain_id', '=', 'kains.id')
                    ->select('keranjangs.*', 'customers.*','pesanans.*','produks.*','kains.*', 'pesanans.status')
                    ->whereBetween('pesanan_at',[$tglawal, $tglakhir])
                    ->get();
        $date_laporan = Carbon::now()->format('l, d F Y');
                    // dd($cetakpertanggal);

        // $cetakpertanggal = Keranjang::with('pesanan.produk')->whereBetween('pesanan_at',[$tglawal, $tglakhir])->get();

        $pdf = PDF::loadView('dashboard.laporan.pesanan-pertanggal',compact('cetakpertanggal','tittle', 'date_laporan', 'tglawal', 'tglakhir'))->setPaper('A4', 'landscape');;
        return $pdf->stream('laporan.pdf');
        
    }


    public function invoice(Keranjang $keranjang)
    {
        $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        $pdf = PDF::loadView('dashboard.order.invoice_pdf', ['keranjang'=>$keranjang, 'pesanan'=>$pesanan])->setPaper('A4', 'potrait');
        return $pdf->stream('Invoce.pdf');
    }
}
