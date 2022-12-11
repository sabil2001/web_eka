<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user()->id;
        return view('dashboard.profile.index', [
            'tittle' => 'Profile',
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user()->id;
        $rules = [
            'name' => 'required|max:100|min:3',
            'email' => 'required|email',
            'alamat' => 'required',
            'foto' => 'image|file|max:4096',
            'no_telp' => 'required|numeric|min:9',
            'jenis_kelamin' => 'required',
        ];
        $validatedData = $request->validate($rules);
        
        if($request->file('foto')){
            $validatedData['foto'] = $request->file('foto')->store('pegawai-foto');
        }
        User::where('id', $user)
                ->update($validatedData);
        return redirect('/dashboard/profile')->with('success', 'Berhasil update biodata!');
    }

    public function edit_pass(Request $request)
    {
        // $id = auth()->user()->id;
        $user = User::find(auth()->user()->id);
        

        // $this->validate($request, [
        //     'password' => 'required|min:5|max:55',
        // ]);
        // $userData = $request->only(["password"]);
        // $userData['password'] = Hash::make($userData['password']);
        // User::find($id)->update($userData);
        // return redirect('/dashboard/profile')->with('success', 'Berhasil update passowrd!');


        $this->validate($request, [
            'password' => 'required',
            'new_password' => 'required|min:5|max:55',
        ]);
        
        if (Hash::check($request->password, $user->password)) { 
           $user->fill([
            'password' => Hash::make($request->new_password)
            ])->save();
            return redirect('/dashboard/profile')->with('success', 'Berhasil update passowrd!');
        
        } else {
            return redirect('/dashboard/profile')->with('success', 'Passowrd lama tidak sesuai!');
        }
    }
}
