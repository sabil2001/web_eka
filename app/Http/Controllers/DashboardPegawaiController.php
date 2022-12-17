<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DashboardPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
        return view('dashboard.pegawai.index', [
            'tittle' => 'Data Pegawai',
            'pegawais' => User::latest()->paginate(10)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
        return view ('dashboard.pegawai.create',[
            'tittle' => 'Tambah Pegawai'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $pegawai)
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
        $validatedData = $pegawai->validate([
            'name' => 'required|max:100|min:3',
            'email' => 'required|unique:users',
            'password' => 'required|min:5|max:55',
            'alamat' => 'required',
            'foto' => 'image|file|max:4096',
            'no_telp' => 'required|numeric|min:9',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required'
        ]);

        if($pegawai->file('foto')){
            $validatedData['foto'] = $pegawai->file('foto')->store('pegawai-foto');
        }
        $validatedData['status'] = 'Aktif';
        $validatedData['password'] = Hash::make($validatedData['password']);
        User::create($validatedData);

        return redirect('/dashboard/pegawai')->with('success', 'Berhasil menambahkan akun!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $pegawai)
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
        return view('dashboard.pegawai.detailPegawai', [
            'pegawai' => $pegawai,
            'tittle' => 'Detail Pegawai'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $pegawai)
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
        return view('dashboard.pegawai.edit', [
            'tittle' => 'Edit Pegawai',
            'pegawai' => $pegawai
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $pegawai)
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
        $rules = [
            'name' => 'required|max:100|min:3',
            'alamat' => 'required',
            'foto' => 'image|file|max:4096',
            'no_telp' => 'required|numeric|min:9',
            'jenis_kelamin' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
        ];

            // if($request->email != $user->email){
            //     $rules['email'] = 'required|unique:users';
            // }
            $validatedData = $request->validate($rules);
            if($request->file('foto')){
                $validatedData['foto'] = $request->file('foto')->store('pegawai-foto');
            }

        User::where('id', $pegawai->id)
                ->update($validatedData);
        return redirect('/dashboard/pegawai')->with('success', 'Berhasil update pegawai!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        // if(auth()->guest() || auth()->user()->jabatan !== 'Pimpinan'){
        //     abort(403);
        // }
    }
}
