<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update_profile(Request $request) {
        $id = $request->input('id');
        $firstname = $request->input('firstname');
        $address = $request->input('address');
        $phone = $request->input('phone');
        $email = $request->input('email');
        DB::update('update users set firstname = ?, address = ?, phone_number = ?, email = ?
 where id = ?', [$firstname, $address, $phone, $email, $id]);
        $msg = "You've successfully update your profile !";
        return redirect()->back()->with('msg', $msg);
    }

    public function index($id) {
        $id_user = null;
        $users = DB::select("SELECT * FROM users WHERE id=$id");
        if (Auth::user() != null) {
            $id_user = Auth::user()->id;
            $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
            return view('profile', ['users' => $users, 'cart' => $cart]);
        }
        return view('auth.login');
    }

    public function page($id) {
        $id_user = null;
        if (Auth::user() != null) {
            $id_user = Auth::user()->id;
            $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
            $users = DB::select("SELECT * FROM users WHERE id=$id");
            return view('update_profile', ['users' => $users, 'cart' => $cart]);
        }
        return view('auth.login');
    }
}
