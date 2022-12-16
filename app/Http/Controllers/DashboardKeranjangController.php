<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Produksi;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class DashboardKeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $keyword = $request->keyword;
        $status = $request->status;
        $tglawal = $request->jangkauan_awal;
        $tglakhir = $request->jangkauan_akhir;
        $keranjang = Keranjang::where('status', 'LIKE', '%'.$status.'%')
                                ->where('kode_keranjang', 'LIKE', '%'.$keyword.'%')
                                // ->whereBetween('pesanan_at', 'LIKE', '%'.$tglawal, $tglakhir.'%')
                                ->latest()->paginate(10);
        $deadlines = Keranjang::where('status', 'Batal')->get();
        return view('dashboard.order.index', [
            'tittle' => 'Data Order',
            // 'keranjangs' => Keranjang::latest()->paginate(10),
            'keranjangs' => $keranjang,
            'deadlines' => $deadlines
        ]);
    }

    public function batal()
    {
        
        return view('dashboard.order.batalpesan', [
            'tittle' => 'Data Batal Order',
            'keranjangs' => Keranjang::where('status', 'Batal')->latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('dashboard.order.create', [
        //     'tittle' => 'Tambah Order',
        //     'customers' => DB::table('customers')->where('status', 'Aktif')->latest()->get()
        // ]);

        $q = DB::table('keranjangs')->select(DB::raw('MAX(RIGHT(kode_keranjang,3)) as kode'));
        $kd="";
        if ($q->count()>0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }

        $date = Carbon::now();
        $tittle = "Tambah Order";
        $customers = DB::table('customers')->where('status', 'Aktif')->latest()->get();
        return view('dashboard.order.create', compact('kd', 'tittle', 'customers', 'date'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $dateNow = Carbon::now();
        if (Carbon::parse($request->tgl_jatuh_tempo) <= Carbon::now()) {
            return Redirect::back()->with('success', 'Tanggal jatuh tempo tidak boleh kurang dari sama dengan tanggal pesan!');
        }
        $keranjang = new Keranjang;
        $keranjang->customer_id = $request->customer_id;
        $keranjang->user_id = auth()->user()->id;
        $keranjang->kode_keranjang = $request->kode_keranjang;
        $keranjang->tgl_jatuh_tempo = $request->tgl_jatuh_tempo;
        $keranjang->status = "Batal";
        $keranjang->save();
        $tittle = 'Tambah Order';
        // $produks = Produk::all();
        $produks = DB::table('produks')->where('status', 'Aktif')->latest()->get();
        $kains = DB::table('kains')->where('status', 'Aktif')->latest()->get();
        return view('dashboard.order.pesanan')->with(['keranjang' => $keranjang,'tittle' => $tittle, 'produks' => $produks, 'kains' => $kains]);
    }

    public function tambahpesanan(Keranjang $keranjang)
    {
        $produks = DB::table('produks')->where('status', 'Aktif')->latest()->get();
        $kains = DB::table('kains')->where('status', 'Aktif')->latest()->get();
        return view('dashboard.order.pesanan', [
            'tittle' => 'Data Order',
            'keranjang' => $keranjang,
            'produks' => $produks,
            'kains' => $kains
        ]);
    }

    public function storepesanan(Request $request)
    {
        $validatedData = $request->validate([
            'size' => '',
            'lebar_dada' => '',
            'lebar_bahu' => '',
            'panjang_badan' => '',
            'panjang_tangan' => '',
            'lingkar_lengan_atas' => '',
            'lingkar_lengan_bawah' => '',
            'panjang_luar' => '',
            'panjang_dalam' => '',
            'lebar_pinggang' => '',
            'lebar_pergelangan' => '',
            'total_barang' => 'required',
            'keterangan' => '',
        ]);
        // $keranjang = Keranjang::find($request->keranjang_id);
        // $success = 'Minimun order 12 pcs / 1 lusin!';
        // $tittle = 'Data Order';
        // $produks = DB::table('produks')->where('status', 'Aktif')->latest()->get();
        // $kains = DB::table('kains')->where('status', 'Aktif')->latest()->get();
        // if ($validatedData['total_barang'] <= 11) {
        //     return Redirect::back()->with('success', 'Tanggal jatuh tempo tidak boleh kurang dari sama dengan tanggal pesan!');
        // }
        $validatedData['keranjang_id'] = $request->keranjang_id;
        $validatedData['produk_id'] = $request->produk_id;
        $validatedData['kain_id'] = $request->kain_id;
        $validatedData['status'] = 'Belum diproduksi';
        Pesanan::create($validatedData);
        $id_keranjang = $request->keranjang_id;
        DB::table('keranjangs')
            ->where('id', $id_keranjang)
            ->update(['status' => 'Belum diproduksi']);
        return redirect('/dashboard/order')->with('success', 'Berhasil menambahkan Orderan!');

    }

    public function test()
    {
        
        $tittle = 'Tambah Order';
        $produks = Produk::all();
        $kains = Kain::all();
        return view('dashboard.order.pesanan')->with(['tittle' => $tittle, 'produks' => $produks, 'kains' => $kains]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function show(Keranjang $keranjang)
    {
        $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        $produksi = Produksi::where('keranjang_id', $keranjang->id)->first();
        // $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        $total_pesan = Pesanan::where('keranjang_id', $keranjang->id)->count();
        return view('dashboard.order.show', [
            'tittle' => 'Detail Order',
            'keranjang' => $keranjang,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'produksi' => $produksi
        ]);
    }

    public function showbatal(Keranjang $keranjang)
    {
        
        $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        $produksi = Produksi::where('keranjang_id', $keranjang->id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $keranjang->id)->count();
        return view('dashboard.order.show', [
            'tittle' => 'Detail Order',
            'keranjang' => $keranjang,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'produksi' => $produksi
        ]);
    }

    public function editkeranjang(Keranjang $keranjang)
    {
        return view('dashboard.order.editkeranjang', [
            'tittle' => 'Edit Order',
            'keranjang' => $keranjang
        ]);
    }

    public function updatekeranjang(Keranjang $keranjang, Request $request)
    {
        
        DB::table('keranjangs')
            ->where('id', $keranjang->id )
            ->update(['tgl_jatuh_tempo' => $request->tgl_jatuh_tempo]);
        
        return redirect('/dashboard/order')->with('success', 'Pesanan ('.$keranjang->kode_keranjang.') Berhasil perbarui Jatuh Tempo!');
    }

    public function batalpesan(Keranjang $keranjang, Request $request)
    {
        $data['status'] = 'Batal';
        $data['keterangan'] = $request->keterangan;
        DB::table('keranjangs')
            ->where('id', $keranjang->id )
            ->update($data);
        DB::table('pesanans')
            ->where('keranjang_id', $keranjang->id )
            ->update(['status' => 'Batal']);
        return redirect('/dashboard/order')->with('success', 'Pesanan ('.$keranjang->kode_keranjang.') dibatalkan!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Keranjang  $keranjang
     * @return \Illuminate\Http\Response
     */
    public function editpesanan(Pesanan $pesanan)
    {
        $keranjang = Keranjang::where('id', $pesanan->keranjang_id)->first();
        $kode = $keranjang->kode_keranjang;
        return view('dashboard.order.editpesanan', [
            'tittle' => 'Detail Order',
            'keranjang' => $keranjang,
            'pesanan' => $pesanan,
            'kode' => $kode
        ]);
    }

    public function editpesanansave(Pesanan $pesanan, Request $request) //edit barang pada keranjang
    {
        $rules = [
            'lebar_dada' => '',
            'lebar_bahu' => '',
            'panjang_badan' => '',
            'panjang_tangan' => '',
            'lingkar_lengan_atas' => '',
            'lingkar_lengan_bawah' => '',
            'panjang_luar' => '',
            'panjang_dalam' => '',
            'lebar_pinggang' => '',
            'lebar_pergelangan' => '',
            'total_barang' => 'required',
            'status' => '',
            'keterangan' => '',
        ];
        $validatedData = $request->validate($rules);
        Pesanan::where('id', $pesanan->id)
                ->update($validatedData);
        return redirect('/dashboard/order')->with('success', 'Pesanan ('.$pesanan->keranjang->kode_keranjang.') diperbarui!');
    }


}
