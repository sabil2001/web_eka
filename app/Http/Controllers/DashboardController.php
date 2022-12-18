<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Customer;
use App\Models\Keranjang;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Exports\PesananExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Validation\Rules\RequiredIf;



class DashboardController extends Controller
{
    public function index(Request $request){
        // $bulan = Carbon::now()->format('m');
        // $produks = DB::table('pesanans')
        //                 ->select(DB::raw('count(pesanans.id) as produks_total, produk_id'), 'produks.nama_produk')
        //                 ->join('produks', 'pesanans.produk_id', '=', 'produks.id')
        //                 ->where('pesanans.status', 'Selesai produksi')
        //                 ->whereMonth('pesanans.created_at', '=', $bulan)
        //                 ->groupBy('produk_id', 'produks.nama_produk')
        //                 ->limit(3)->get();
        // dd($produks);
        
        // dd($bulan);
        // foreach ($produks as $row) {
        //     $nama_produk[] = $row->nama_produk;
        //     $jumlah_laku[] = $row->jumlah_laku;
        // }
        // // $pesanan_bulan = Pesanan::select(
        //     DB::raw('sum(total_barang_jadi) as `sums`'),
        //     DB::raw("DATE_FORMAT(created_at,'%M %Y') as months"),
        //     DB::raw('max(created_at) as createdAt')
        // )
        //    ->where("created_at", ">", Carbon::now()->subMonths(6))
        //    ->orderBy('createdAt', 'desc')
        //    ->groupBy('months')
        //    ->get();

        $deadlines = Keranjang::where('status', '=', 'Belum diproduksi')
                                ->orWhere('status', '=', 'Proses produksi')
                                ->get();
        $jumlah_customer= Customer::all()->count();
        $jumlah_pesanan= Pesanan::all()->count();

        $pesanan       = collect(DB::SELECT("SELECT count(id) as jumlah from keranjangs"))->first();
        $dataPesanan   = Pesanan::paginate(10);
        $label         = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
        for($bulan=1;$bulan < 13;$bulan++){
        $chartuser     = collect(DB::SELECT("SELECT count(id) AS jumlah from keranjangs where month(created_at)='$bulan'"))->first();
        $jumlah_user[] = $chartuser->jumlah;
        }
        $tglawal = $request->tgl_awal;
        $tglakhir = $request->tgl_akhir;
        return view ('dashboard.index',[
            'tittle' => 'Dashboard',
            'pesanan' => $pesanan,
            'dataPesanan' => $dataPesanan,
            'label' => $label,
            'chartuser' => $chartuser,
            'jumlah_user' => $jumlah_user,
            'jumlah_customer' => $jumlah_customer,
            'jumlah_pesanan' => $jumlah_pesanan,
            'deadline' => $deadlines,
            // 'label_produk' => $nama_produk,
            // 'jumlah_laku' => $jumlah_laku,
            // 'produkTerlaris' => $produkPalingLaku
        ]);
    }

    public function dataStockKain()
    {

    }

    public function dataProdukTerlaris()
    {
        $orderBy = 'produks.kode_produk';
        
        $columnsOrder = [
            'produks.kode_produk',
            'produks.nama_produk',
            'produks.size',
            'jumlah_laku',
        ];
        
        $orderBy = $columnsOrder[request('order.0.column')];

        $data = Pesanan::select(DB::raw("COUNT(pesanans.id) as jumlah_laku"), 'pesanans.produk_id', 'produks.nama_produk', 'produks.size', 'produks.kode_produk', 'kains.nama_kain', 'kains.warna')
            ->join('produks', 'produks.id', '=', 'pesanans.produk_id')
            ->join('kains', 'kains.id', '=', 'pesanans.kain_id')
            ->where('pesanans.status', 'Selesai produksi')->limit(5);

        if(request('tahun')){
            $data->whereYear("pesanans.updated_at", request('tahun'));
        }
        if(request('bulan')){
            $data->whereMonth('pesanans.updated_at', request('bulan'));
        }

        if(request('search.value')!=null){
            $data->where(function($q){
                $q
                ->whereRaw('LOWER(produks.nama_produk) like ? ',['%'.strtolower(request('search.value')).'%'])
                ->orWhereRaw('LOWER(produks.kode_produk) like ? ',['%'.strtolower(request('search.value')).'%'])
                ->orWhereRaw('LOWER(produks.size) like ? ',['%'.strtolower(request('search.value')).'%'])
                ;
            });
        }

        $data = $data->groupBy([DB::raw("CONCAT(YEAR(pesanans.updated_at),'-',MONTH(pesanans.updated_at))"), 'pesanans.produk_id', 'produks.nama_produk', 'produks.size', 'produks.kode_produk', 'kains.nama_kain', 'kains.warna']);
        $recordsFiltered = $data->get()->count();

        if(request('length')!=-1) $data = $data->skip(request('start'))->take(request('length'));
        $data = $data->orderBy($orderBy,request('order.0.dir'))->get();
        $recordsTotal = $data->count();
        return response()->json([
            'draw'=>request('draw'),
            'recordsTotal'=>$recordsTotal,
            'recordsFiltered'=>$recordsFiltered,
            'data'=>$data
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
