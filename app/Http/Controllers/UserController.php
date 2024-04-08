<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function updateProfileData(Request $request){
        try {
            # code...
            $user_auth_id = Auth::user()->id;
            $user = User::find($user_auth_id);
            $user->nama = $request->get('nama');
            $user->username = $request->get('username');
            $user->alamat = $request->get('alamat');
            $user->telepon = $request->get('telepon');
            $user->save();
            return response()->json(array('status' => 'success', 'msg' => 'Data Profile Berhasil Di Ubah'), 200);
        } catch (\Throwable $e) {
            # code...
            return response()->json(array('status' => 'error', 'msg' => 'Data Profile Gagal Di Ubah'), 200);

        }
    }

    public function updateProfilePassword(Request $request){
        try {
            $user_auth_id = Auth::user()->id;
            $user = User::find($user_auth_id);
            $password_lama = $request->get('password_lama');
            $password_baru = $request->get('password_baru');
            if (Hash::check($password_lama,  $user->password)) { 
                $user->password = Hash::make($password_baru);
                $user->save();
                return response()->json(array('status' => 'success', 'msg' => 'Password Berhasil Diubah'), 200);
            } 
            else {
                return response()->json(array('status' => 'error', 'msg' => 'Masukan Password Lama Dengan Benar'), 200);
            }
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json(array('status' => 'error', 'msg' => 'Password Gagal Diubah'), 200);
        }
    }

}
