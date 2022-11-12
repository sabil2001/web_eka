<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Pesanan;
use App\Models\Customer;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Exports\PesananExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;



class DashboardController extends Controller
{
    public function index(){
        $jumlah_customer= Customer::all()->count();
        $jumlah_pesanan= Pesanan::all()->count();
        $pesanan       = collect(DB::SELECT("SELECT count(id) as jumlah from pesanans"))->first();
        $dataPesanan   = Pesanan::paginate(10);
        $label         = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan=1;$bulan < 13;$bulan++){
        $chartuser     = collect(DB::SELECT("SELECT count(id) AS jumlah from pesanans where month(created_at)='$bulan'"))->first();
        $jumlah_user[] = $chartuser->jumlah;
        }
        return view ('dashboard.index',[
            'tittle' => 'Dashboard',
            'pesanan' => $pesanan,
            'dataPesanan' => $dataPesanan,
            'label' => $label,
            'chartuser' => $chartuser,
            'jumlah_user' => $jumlah_user,
            'jumlah_customer' => $jumlah_customer,
            'jumlah_pesanan' => $jumlah_pesanan
        ]);
    }

    public function filtertanggal(){
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = Pesanan::whereBetween('pesanan_at',[$start_date,$end_date])->paginate(30);
        } else {
            $data = Pesanan::latest()->paginate(10);
        }
        return view('dashboard.pesanan.index', [
            'tittle' => 'Pesanan',
            'pesanans' => $data
            
            ]);
    }

    public function invoice(Pesanan $pesanan){
        $pdf = PDF::loadView('dashboard.pesanan.invoice_pdf', ['pesanan'=>$pesanan]);
        return $pdf->download('Invoce.pdf');
    }

    public function export() 
    {
        return Excel::download(new PesananExport, 'users.xlsx');
    }

    
}
