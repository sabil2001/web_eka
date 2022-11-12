<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Produksi;
use App\Models\Verifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardProduksiController extends Controller
{
    public function create(Pesanan $pesanan)
    {
        if(auth()->guest() || auth()->user()->jabatan !== 'Produksi'){
            abort(403);
        }
        return view('dashboard.produksi.create', [
            'tittle' => 'Produksi',
            'pesanan' => $pesanan
            
        ]);
    }

    public function store(Request $request, Pesanan $pesanan)
    {
        if(auth()->guest() || auth()->user()->jabatan !== 'Produksi'){
            abort(403);
        }
        $produksi = new Produksi;
 
        $produksi->pesanan_id = $request->pesanan_id;
        $produksi->keterangan = $request->keterangan;
        $produksi['user_id'] = auth()->user()->id;
        $produksi->save();

        $statusUpdate['status'] = 'Proses Produksi';
        Pesanan::where('id', $pesanan->id)
                ->update($statusUpdate);
        
        return redirect('/dashboard/pesanan');
    }

    public function edit(Pesanan $pesanan){
        if(auth()->guest() || auth()->user()->jabatan !== 'Produksi'){
            abort(403);
        }
        return view('dashboard.produksi.edit',[
            'tittle' => 'Edit Keterangan',
            'pesanan' => $pesanan,
            'produksis' => $pesanan->produksi
        ]);
    }

    public function update(Request $request, Produksi $produksi){
        if(auth()->guest() || auth()->user()->jabatan !== 'Produksi'){
            abort(403);
        }
            $rules = [
                'total_barang_jadi' => '',
                'keterangan' => 'required'
            ];

            $validatedData = $request->validate($rules);
            Produksi::where('id', $produksi->id)
                ->update($validatedData);
            return redirect('/dashboard/pesanan')->with('success', 'Berhasil update keterangan!');
    }

    public function finish(Pesanan $pesanan){
        if(auth()->guest() || auth()->user()->jabatan !== 'Produksi'){
            abort(403);
        }
        return view('dashboard.produksi.finish',[
            'tittle' => 'Produksi',
            'pesanan' => $pesanan,
            'produksis' => $pesanan->produksi
        ]);
    }

    public function save(Request $request, Produksi $produksi){
        if(auth()->guest() || auth()->user()->jabatan !== 'Produksi'){
            abort(403);
        }
        $rulesProduksi = [
            'total_barang_jadi' => 'required',
            'tgl_akhir' => 'required',
            'keterangan' => 'required'
        ];

        $validatedData = $request->validate($rulesProduksi);
        Produksi::where('id', $produksi->id)
            ->update($validatedData);

        $statusUpdate['status'] = 'Proses Verifikasi';
        Pesanan::where('id', $produksi->pesanan_id)
                ->update($statusUpdate);    
        return redirect('/dashboard/pesanan')->with('success', 'Berhasil menyelesaikan pesanan!');
    }

    public function checkverif(Request $request, Pesanan $pesanan){
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
        return view('dashboard.pesanan.verifikasi',[
            'tittle' => 'Verifikasi',
            'pesanan' => $pesanan,
            'produksis' => $pesanan->produksi
        ]);
    }

    public function verifikasi(Request $request, Produksi $produksi){
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }

            $validasi = $request->validate([
            'status_verifikasi' => 'required',
            'keterangan' => 'required'
            ]);
            $validasi['produksi_id'] = $produksi->id;
            $validasi['user_id'] = auth()->user()->id;
            $save = Verifikasi::create($validasi);
            if ($save['status_verifikasi'] == 'Verifikasi') {
                $statusUpdate['status'] = 'Sudah Verifikasi';
                Pesanan::where('id', $produksi->pesanan_id)
                ->update($statusUpdate);
                return redirect('/dashboard/pesanan')->with('success', 'Verifikasi produksi berhasil');
            } else {
                $statusUpdate['status'] = 'Revisi';
                Pesanan::where('id', $produksi->pesanan_id)
                ->update($statusUpdate);
                return redirect('/dashboard/pesanan')->with('success', 'pesan untuk tim produksi berhasil');
            }
            
    }

    public function editverifikasi(Pesanan $pesanan){
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
        return view('dashboard.pesanan.editverifikasi',[
            'tittle' => 'Verifikasi',
            'pesanan' => $pesanan,
            'produksis' => $pesanan->produksi
        ]);
    }

    public function saveeditverifikasi(Request $request, Produksi $produksi){
        if(auth()->guest() || auth()->user()->jabatan !== 'Admin'){
            abort(403);
        }
        $rules = [
            'status_verifikasi' => 'required',
            'keterangan' => 'required'
        ];
        $validatedData = $request->validate($rules);
        Verifikasi::where('produksi_id', $produksi->id)
                ->update($validatedData);
        if ($request->status_verifikasi == 'Verifikasi') {
            $statusUpdate['status'] = 'Sudah Verifikasi';
                Pesanan::where('id', $produksi->pesanan_id)
                ->update($statusUpdate);
            return redirect('/dashboard/pesanan')->with('success', 'Berhasil verifikasi pesanan!');
        } else {
            $statusUpdate['status'] = 'Revisi';
                Pesanan::where('id', $produksi->pesanan_id)
                ->update($statusUpdate);
            return redirect('/dashboard/pesanan')->with('success', 'pesan untuk tim produksi berhasil!');
        }
}
}
