<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Customer;
use App\Models\Produksi;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardPesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        return view('dashboard.pesanan.index', [
            'tittle' => 'Pesanan',
            'pesanans' => Pesanan::with('customer')->latest()->paginate(10),
            
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
        return view ('dashboard.pesanan.create',[
            'tittle' => 'Tambah Pesanan',
            'customers' => DB::table('customers')->where('status', 'Aktif')->latest()->get()
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
        $validasi = $request->validate([
            'customer_id' => 'required',
            // 'tgl_pesanan' => 'required',
            'tgl_jatuh_tempo' => 'required',
            'model_produk' => 'required',
            'jenis_kain' => 'required',
            'total_barang' => 'required',
            'keterangan' => 'required',
            
        ]);
        $validasi['status'] = 'Belum Diproses';
        
        

        Pesanan::create($validasi);
        
        return redirect('/dashboard/pesanan')->with('success', 'Berhasil menambahkan pesanan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show(Pesanan $pesanan)
    {
        
        return view('dashboard.pesanan.detail', [
            
            'tittle' => 'Detail pesanan',
            'pesanan' => $pesanan,
            'produksi' => $pesanan->produksi     
        ]);  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
        return view ('dashboard.pesanan.edit',[
            'tittle' => 'Edit Pesanan',
            'pesanan' => $pesanan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
        $rules = [
            'tgl_jatuh_tempo' => 'required',
            'model_produk' => 'required',
            'jenis_kain' => 'required',
            'total_barang' => 'required',
            'keterangan' => 'required',
        ];
        
        $validatedData = $request->validate($rules);
        Pesanan::where('id', $pesanan->id)
                ->update($validatedData);
        return redirect('/dashboard/pesanan')->with('success', 'Berhasil update pesanan!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
    }
}
