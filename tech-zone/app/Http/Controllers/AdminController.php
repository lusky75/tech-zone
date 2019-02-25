<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\Model\product;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function add_product(Request $request)
    {
        $produit = new product();

        $produit->picture = $request->get('picture');
        $produit->name = $request->get('name');
        $produit->description = $request->get('description');
        $produit->price = $request->get('price');
        $produit->quantity = $request->get('amount');
        $produit->category = $request->get('category');

        $produit->save();

        return redirect()->action('AdminController@add_product');
    }

    public function change_right($admin, $id) {
        $user = DB::select("SELECT * FROM users where id=$id");
        if ($admin == 1)
            DB::update('update users set admin = ? where id = ?', [0, $id]);
        else
            DB::update('update users set admin = ? where id = ?', [1, $id]);
        return redirect()->action('AdminController@index');
    }

    public function delete($id) {
        $count = DB::table('product')->count();
        DB::table('product')->where('id', $id)->delete();
        DB::table('cart')->where('id_product', $id)->delete();
        DB::statement("ALTER TABLE product AUTO_INCREMENT = $count;");
        return redirect()->action('AdminController@index');
    }

    public function index() {
        $id_user = null;
        $users = DB::select("SELECT * FROM users");
        $product = DB::select("SELECT * FROM product");
        if (Auth::user() != null) {
            $id_user = Auth::user()->id;
            $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
            return view('admin', ['users' => $users, 'product' => $product, 'cart' => $cart]);
        }
        return view('auth.login');

    }

    public function update_quantity(Request $request) {
        $id = $request->input('id_product');
        $quantity = $request->input('quantity');
        DB::update('update product set quantity = ? where id = ?', [$quantity, $id]);
        return redirect()->action('ProductController@product', ['id' => $id]);
    }
}
