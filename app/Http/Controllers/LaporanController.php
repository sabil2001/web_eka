<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Pesanan;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(){
        $tittle        = 'Dashboard';
        $pesanan       = collect(DB::SELECT("SELECT count(id) as jumlah from pesanans"))->first();
        $dataPesanan   = Pesanan::paginate(10);
        $label         = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan=1;$bulan < 13;$bulan++){
        $chartuser     = collect(DB::SELECT("SELECT count(id) AS jumlah from pesanans where month(created_at)='$bulan'"))->first();
        $jumlah_user[] = $chartuser->jumlah;
        }
        return view('/dashboard/laporan/pesanan',compact('tittle','pesanan','jumlah_user','label', 'dataPesanan'));
    }

    public function cetakPesanan($tglawal, $tglakhir)
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Master Admin' || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
        $tittle        = 'Dashboard';
        $cetakpertanggal = Pesanan::with('customer')->whereBetween('pesanan_at',[$tglawal, $tglakhir])->get();

        $pdf = PDF::loadView('dashboard.laporan.pesanan-pertanggal',compact('cetakpertanggal','tittle'));
        return $pdf->download('laporan.pdf');
        
    }


    public function invoice(Keranjang $keranjang)
    {
        $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        $pdf = PDF::loadView('dashboard.order.invoice_pdf', ['keranjang'=>$keranjang, 'pesanan'=>$pesanan])->setPaper('A4', 'potrait');
        return $pdf->stream('Invoce.pdf');
    }
}
