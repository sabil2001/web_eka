<?php

namespace App\Exports;

use App\Models\Pesanan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;

class PesananExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function headings() :array
    {
        return [
            'No',
            'NIK',
            'Nama',
            'Alamat',
            'No. Telp',
            'Model Pesanan',
            'Kain',
            'Qty',
            'Tanggal Pesanan',
            'Status Pesanan',

        ];
    }
    public function collection()
    {
        $data =  Pesanan::all();
        $xport[] = [
            'No',
            'Nama',
            'Alamat',
            'No. Telp',
            'Model Pesanan',
            'Kain',
            'Qty',
            'Tanggal Pesanan',
            'Status Pesanan',

        ];
        $no =1;
        foreach ($data as $key) {
            $export[] = [
                'No' => $no,               
                'Nama' => $key->customer->nama,
                'Alamat' => $key->customer->alamat,
                'No. Telp' => $key->customer->no_telp,
                'Model Pesanan' => $key->model_produk,
                'Kain' => $key->jenis_kain,
                'Qty' => $key->total_barang,
                'Tanggal Pesanan' => Carbon::parse($key->tgl_jatuh_tempo)->format('d/m/Y'),
                'Status Pesanan' => $key->status
    
            ];
            $no++;
        }
        return collect($export);
    }
}
