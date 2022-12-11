<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kain;
use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Produksi;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardProduksiController extends Controller
{

    public function verifikasi()
    {
        $produksi = Produksi::where('status', 'Selesai produksi')->latest()->paginate(10);
        return view('dashboard.verifikasi.index', [
            'tittle' => 'Data Verifikasi Produksi',
            'produksis' => $produksi,
        ]);
    }
    public function index()
    {
        return view('dashboard.prosesproduksi.index', [
            'tittle' => 'Data Belum diProduksi',
            'keranjangs' => Keranjang::where('status', 'Belum diproduksi')->latest()->paginate(10)
        ]);
    }

    public function tuntas()
    {
        // return 'saa';
        return view('dashboard.tuntas.index', [
            'tittle' => 'Order Selesai',
            'keranjangs' => Keranjang::where('status', 'Selesai')->latest()->paginate(10)
        ]);
    }

    public function detail_tuntas(Keranjang $keranjang)
    {
        $date = Carbon::now();
        $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        $produksi = Produksi::where('keranjang_id', $keranjang->id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $keranjang->id)->count();
        return view('dashboard.tuntas.detail', [
            'tittle' => 'Mulai Produksi',
            'keranjang' => $keranjang,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'date' => $date,
            'produksi' => $produksi
        ]);
    }

    public function mulaiproduksi(Keranjang $keranjang)
    {
        $date = Carbon::now();
        $pesanan = Pesanan::where('keranjang_id', $keranjang->id)->get();
        // $produksi = Produksi::where('keranjang_id', $keranjang->id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $keranjang->id)->count();
        return view('dashboard.prosesproduksi.mulai', [
            'tittle' => 'Mulai Produksi',
            'keranjang' => $keranjang,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'date' => $date,
            // 'produksi' => $produksi
        ]);
    }

    public function edit(Pesanan $pesanan)
    {
        $pesanan = Pesanan::where('id', $pesanan->id)->first();
        $stock = $pesanan->kain->stock;
        return response()->json(['result' => $pesanan, 'stock' => $stock]);
    }
    
    public function lihatrincian(Pesanan $pesanan)
    {
        $pesanan = Pesanan::where('id', $pesanan->id)->first();
        $kategori = $pesanan->produk->kategori;
        return response()->json(['result' => $pesanan, 'kategori' => $kategori]);
    }

    public function update(Pesanan $pesanan, Request $request)
    {


        $kain = Kain::where('id', $request->kain_id)->first();
        $stock_tersedia = $kain->stock;

        if ($stock_tersedia < $request->total_kain_digunakan) {
            return response()->json(['errors' => 'Stok kain tidak mencukupi']);
        }else{
            $data = [
                'status' => $request->status,
                'total_kain_digunakan' => $request->total_kain_digunakan
            ];
            Pesanan::where('id', $pesanan->id)
                ->update($data);

            $sisa_stock = $stock_tersedia - $request->total_kain_digunakan;
            DB::table('kains')
            ->where('id', $request->kain_id)
            ->update(['stock' => $sisa_stock]);
            return response()->json(['success' => 'Berhasil menyimpan data!']);
        }

    }

    public function saveproduksi(Keranjang $keranjang, Request $request)
    {
        if ($request->batal_produksi == 'Batal produksi') {
            $produksi = new Produksi();
            $produksi->user_id = auth()->user()->id;
            $produksi->keranjang_id = $keranjang->id;
            $produksi->status = $request->batal_produksi;
            $produksi->keterangan = $request->keterangan;
            $produksi->save();
            DB::table('keranjangs')
            ->where('id', $keranjang->id)
            ->update(['status' => 'Batal produksi']);
            return redirect('dashboard/prosesproduksi')->with('success', 'Produksi dibatalkan!');
        } else {
            $produksi = new Produksi();
            $produksi->user_id = auth()->user()->id;
            $produksi->keranjang_id = $keranjang->id;
            $produksi->status = "Proses produksi";
            $produksi->save();

            DB::table('keranjangs')
                ->where('id', $keranjang->id)
                ->update(['status' => 'Proses produksi']);
            return redirect('/dashboard/keranjang/produksi/proses')->with('success', 'Mulai Produksi berhasil!');
        }
        
    }

    public function selesaisimpan(Keranjang $keranjang, Request $request)
    {
        $data = [
            'tgl_akhir' => Carbon::now()->format('Y-m-d'),
            'status' => 'Selesai produksi',
            'keterangan' => $request->keterangan_produksi
        ];

        Produksi::where('id', $request->produksi_id)
                ->update($data);

        DB::table('keranjangs')
            ->where('id', $keranjang->id)
            ->update(['status' => 'Selesai produksi']);
        return redirect('/dashboard/barang/selesai')->with('success', 'Berhasil menyelesaikan produksi!');
        
    }

    // public function simpanrevisi(Produksi $produksi, Request $request)
    // {
    //     Produksi::where('id', $produksi->id)
    //             ->update(['keterangan' => $request->keterangan]);

    //     return redirect('/dashboard/barang/selesai')->with('success', 'Berhasil menyelesaikan produksi!');
    // }

    public function produksiberlangsung()
    {
        $produksi = Produksi::where('status', 'Proses produksi')->latest()->paginate(10);
        return view('dashboard.produksiberlangsung.index', [
            'tittle' => 'Data Proses diProduksi',
            'produksis' => $produksi,
        ]);
    }
    
    public function produksibatal()
    {
        $produksi = Produksi::where('status', 'Batal produksi')->latest()->paginate(10);
        return view('dashboard.prosesproduksi.batal', [
            'tittle' => 'Data Batal diProduksi',
            'produksis' => $produksi,
        ]);
    }

    public function selesai_produksi(Produksi $produksi)
    {
        $date = Carbon::now();
        $pesanan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->get();
        // $produksi = Produksi::where('keranjang_id', $produksi->keranjang_id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->count();
        return view('dashboard.produksiberlangsung.selesai', [
            'tittle' => 'Mulai Produksi',
            'produksi' => $produksi,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'date' => $date,
        ]);
    }

    public function detail_batal_produksi(Produksi $produksi)
    {
        $date = Carbon::now();
        $pesanan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->get();
        // $produksi = Produksi::where('keranjang_id', $produksi->keranjang_id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->count();
        return view('dashboard.prosesproduksi.detailbatalproduksi', [
            'tittle' => 'Mulai Produksi',
            'produksi' => $produksi,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'date' => $date,
        ]);
    }

    public function detail_selesai_produksi(Produksi $produksi)
    {
        $date = Carbon::now();
        $pesanan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->get();
        // $produksi = Produksi::where('keranjang_id', $produksi->keranjang_id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->count();
        return view('dashboard.produksiberlangsung.detailpesanan', [
            'tittle' => 'Mulai Produksi',
            'produksi' => $produksi,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'date' => $date,
        ]);
    }

    public function modalselesai(Pesanan $pesanan)
    {   
        $date = Carbon::now()->format('Y-m-d');
        $pesanan = Pesanan::where('id', $pesanan->id)->first();
        return response()->json(['result' => $pesanan, 'date_now' => $date]);
    }

    public function modalselesaisave(Pesanan $pesanan, Request $request)
    {   
        // return 'hai';
        $produk = Produk::where('id', $pesanan->produk_id)->first();
        $jumlah_laku = $produk->jumlah_laku;
        
        if ($request->status == 'Batal produksi') {
            $data = [
                'status' => $request->status,
                'total_barang_jadi' => ''
            ];
            Pesanan::where('id', $pesanan->id)
                ->update($data);

            DB::table('kains')
            ->where('id', $pesanan->kain_id)
            ->update(['stock' => $pesanan->total_kain_digunakan]);
            return response()->json(['errors' => 'Berhasil membatalkan produksi']);
        }else{
            $data2 = [
                'status' => $request->status,
                'total_barang_jadi' => $request->total_barang_jadi
            ];
            Pesanan::where('id', $pesanan->id)
                ->update($data2);

            $laku = $jumlah_laku + $request->total_barang_jadi;
            DB::table('produks')
                ->where('id', $pesanan->produk_id)
                ->update(['jumlah_laku' => $laku]);
            return response()->json(['success' => 'Berhasil menyelesaikan produksi']);
        }
    }

    public function data_selesai_produksi()
    {
        $produksi = Produksi::where('status', 'Selesai produksi')->latest()->paginate(10);
        return view('dashboard.produksiberlangsung.selesaiproduksi', [
            'tittle' => 'Data Selesai Produksi',
            'produksis' => $produksi,
        ]);
    }

    

    public function mulaiverif(Produksi $produksi)
    {
        $date = Carbon::now();
        $pesanan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->get();
        // $produksi = Produksi::where('keranjang_id', $produksi->keranjang_id)->first();
        $total_pesan = Pesanan::where('keranjang_id', $produksi->keranjang_id)->count();
        return view('dashboard.verifikasi.mulaiverif', [
            'tittle' => 'Verifikasi Produksi',
            'produksi' => $produksi,
            'pesanan' => $pesanan,
            'total_pesan' => $total_pesan,
            'date' => $date,
        ]);
    }

    public function simpanverifikasi(Keranjang $keranjang, Request $request)
    {
        $data = [
            'status' => 'Selesai',
            'keterangan' => $request->keterangan
        ];

        Produksi::where('id', $request->produksi_id)
                ->update($data);

        DB::table('keranjangs')
            ->where('id', $keranjang->id)
            ->update(['status' => 'Selesai']);
        return redirect('/dashboard/tuntas')->with('success', 'Pesanan selesai!');

        // if ($request->revisi == 'Revisi') {
        //     $data = [
        //         'status' => 'Revisi',
        //         'keterangan' => $request->keterangan
        //     ];
        //     Keranjang::where('id', $keranjang->id)
        //             ->update($data);
        //     DB::table('produksis')
        //     ->where('id', $request->produksi_id)
        //     ->update(['status' => 'Revisi']);
        //     return redirect('dashboard/prosesproduksi')->with('success', 'Revisi orderan!');

        // } else {
        //     $data = [
        //         'status' => 'Selesai',
        //         'keterangan' => $request->keterangan
        //     ];

        //     Produksi::where('id', $request->produksi_id)
        //             ->update($data);

        //     DB::table('keranjangs')
        //         ->where('id', $keranjang->id)
        //         ->update(['status' => 'Selesai']);
        //     return redirect('/dashboard/barang/selesai')->with('success', 'Pesanan selesai!');
        // }
        
    }
}
