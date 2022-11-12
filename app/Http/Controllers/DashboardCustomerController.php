<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Pesanan;
use Illuminate\Http\Request;


class DashboardCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.customer.index', [
            'tittle' => 'Data Customer',
            'customers' => Customer::paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('dashboard.customer.create',[
            'tittle' => 'Tambah Customer'
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
        $validatedData = $request->validate([
            'nama' => 'required|min:2',
            'NIK' => 'required|unique:customers|min:16|max:16',
            'alamat' => 'required|min:5',
            'no_telp' => 'required|min:9',
            // 'status' => 'required',
        ]);
        
        $validatedData['status'] = 'Aktif';
        $validatedData['user_id'] = auth()->user()->id;

        Customer::create($validatedData);

        // return view('dashboard/customer');
        return redirect('/dashboard/customer')->with('success', 'Berhasil menambahkan customer!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        return view('dashboard.customer.detail', [
            'tittle' => 'Detail Customer',
            'customer' => $customer,           
            'pesanans' => $customer->pesanan           
        ]);       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        return view ('dashboard.customer.edit',[
            'tittle' => 'Edit Customer',
            'customer' => $customer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $rules = [
            'nama' => 'required|min:2',
            // 'NIK' => 'required|unique:customers|min:16|max:16',
            'alamat' => 'required|min:5',
            'no_telp' => 'required|min:9',
            'status' => 'required',
        ];

        if($request->NIK != $customer->NIK){
            $rules['NIK'] = 'required|unique:customers|min:16|max:16';
        }

        $validatedData = $request->validate($rules);
        $validatedData['user_id'] = auth()->user()->id;

        Customer::where('id', $customer->id)
                ->update($validatedData);
        return redirect('/dashboard/customer')->with('success', 'Berhasil update customer!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
