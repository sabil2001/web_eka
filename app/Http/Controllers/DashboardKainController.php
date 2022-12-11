<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardKainController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kain.index', [
            'tittle' => 'Data Produk',
            'kains' => Kain::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $q = DB::table('kains')->select(DB::raw('MAX(RIGHT(kode_kain,3)) as kode'));
        $kd="";
        if ($q->count()>0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kode)+1;
                $kd = sprintf("%03s", $tmp);
            }
        }else{
            $kd = "001";
        }

        $tittle = "Tambah Kain";
        return view('dashboard.kain.create', compact('kd', 'tittle'));
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
            'nama_kain' => 'required',
            'warna' => 'required',
            'stock' => 'required'
        ]);
        $validatedData['kode_kain'] = $request->kode_kain;
        $validatedData['status'] = 'Aktif';
        Kain::create($validatedData);
        return redirect('/dashboard/kain')->with('success', 'Berhasil menambahkan barang Kain!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function show(Kain $kain)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function edit(Kain $kain)
    {
        return view('dashboard.kain.edit', [
            'tittle' => 'Edit Kain',
            'kain' => $kain,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kain $kain)
    {
        $rules = [
            'nama_kain' => 'required',
            'warna' => 'required',
            'stock' => 'required',
            'status' => 'required',
        ];
        if($request->kode_kain != $kain->kode_kain){
            $rules['kode_kain'] = 'required|unique:kains';
        }
        $validatedData = $request->validate($rules);
        Kain::where('id', $kain->id)
                ->update($validatedData);
        return redirect('/dashboard/kain')->with('success', 'Berhasil update Kain!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kain  $kain
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kain $kain)
    {
        //
    }
}
