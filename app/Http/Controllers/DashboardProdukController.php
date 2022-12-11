<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.produk.index', [
            'tittle' => 'Data Produk',
            'produks' => Produk::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $q = DB::table('produks')->select(DB::raw('MAX(RIGHT(kode_produk,3)) as kode'));
        $kd="";
        if ($q->count()>0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }

        $tittle = "Tambah Produk";
        return view('dashboard.produk.create', compact('kd', 'tittle'));
        // return view('dashboard.produk.create', [
        //     'tittle' => 'Tambah Produk'
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

        $validatedData = $request->validate([
            'nama_produk' => 'required',
            'foto_produk' => 'required|image|mimes:jpeg,png,jpg|max:4096',
            'kategori' => 'required',
            'size' => 'required',
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
            'deskripsi' => ''
        ]);
        if($request->file('foto_produk')){
            $file = $request->file('foto_produk');
            $fileName = $file->hashName();
            $validatedData['foto_produk'] = $file->storeAs('produk-foto', $fileName);
        }
        $validatedData['kode_produk'] = $request->kode_produk;
        $validatedData['jumlah_laku'] = 0;
        $validatedData['status'] = 'Aktif';
        Produk::create($validatedData);
        return redirect('/dashboard/produk')->with('success', 'Berhasil menambahkan Produk!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        return view('dashboard.produk.show', [
            'tittle' => 'Detail Produk',
            'produk' => $produk,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        return view('dashboard.produk.edit', [
            'tittle' => 'Edit Produk',
            'produk' => $produk,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $rules = [
            'nama_produk' => 'required',
            'status' => 'required',
            'size' => 'required',
            'kategori' => 'required',
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
            'deskripsi' => ''
        ];
        if($request->kode_produk != $produk->kode_produk){
            $rules['kode_produk'] = 'required|unique:produks';
        }
        $validatedData = $request->validate($rules);
        if($request->file('foto_produk')){
            // $validatedData['foto_produk'] = $request->file('foto_produk')->store('produk-foto');
            $file = $request->file('foto_produk');
            $fileName = $file->hashName();
            $validatedData['foto_produk'] = $file->storeAs('produk-foto', $fileName);
        }
        Produk::where('id', $produk->id)
                ->update($validatedData);
        return redirect('/dashboard/produk')->with('success', 'Berhasil update Produk!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
