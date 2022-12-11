<?php

namespace App\Http\Controllers;

use App\Models\Kain;
use App\Models\Produk;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getcustomer(Request $request)
    {
        $id_customer = $request->id_customer;
        $customers = DB::table('customers')->where('id', $id_customer)->get();
        
        
        foreach ($customers as $customer) {
            echo "<option value='$customer->id'>$customer->NIK</option>";
        }
    }

    public function gettelpon(Request $request)
    {
        $id_customer = $request->id_customer;
        $customers = DB::table('customers')->where('id', $id_customer)->get();
        
        
        foreach ($customers as $customer) {
            echo "<option value='$customer->no_telp'>$customer->no_telp</option>";
        }
    }

    

    public function dataproduk(Request $request)
    {
        $produk_id = $request->produk_id;
        // $data = DB::table('produks')->where('id', $produk_id)->get();
        $data = Produk::where('id', $produk_id)->first();
        return response()->json(['result' => $data]);
    }

    public function datakategori(Request $request)
    {
        $produk_id = $request->produk_id;
        $data = Produk::where('id', $produk_id)->first();
        $kategori = $data->kategori;
        return response()->json(['result' => $kategori]);
    }

    public function datakain(Request $request)
    {
        $kain_id = $request->kain_id;
        $data = Kain::where('id', $kain_id)->first();
        return response()->json(['result' => $data]);
    }

    // public function cekkain(Request $request)
    // {
    //     $kain_id = $request->kain_id;
    //     $data = Kain::where('id', $kain_id)->first();
    //     return response()->json(['result' => $data]);
    // }

    
}
