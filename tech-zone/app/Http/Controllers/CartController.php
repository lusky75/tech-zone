<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Model\orders;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index($id) {
        $id_user = null;
        $carts = DB::select("SELECT * FROM cart where id_user=$id ORDER BY created_at ASC");
        $product = DB::select("SELECT * FROM cart, product WHERE id_user= ? AND cart.id_product=product.id ORDER BY cart.created_at ASC", [$id]);
        if (Auth::user() != null)
            $id_user = Auth::user()->id;
        $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
        return view('cart', ['carts' => $carts, 'product' => $product, 'cart' => $cart]);
    }

    public function pay($total) {
        if(Auth::user()->address) {
            $id_user = Auth::user()->id;
            $cart = DB::select("SELECT * FROM cart WHERE id_user=$id_user");
            $order = new orders();
            $order->cart = serialize($cart);
            $order->id_user = $id_user;
            $order->total_price=$total;
            $order->address = "pas d'addresse";
            $order->id_payment = 1;
            $order->save();
            foreach($cart as $tab) {
                DB::table('product')->where('id', $tab->id_product)->decrement('quantity', $tab->quantity);
                DB::table('cart')->where('id_user', $id_user)->delete();
            }
            return redirect()->action('ProductController@catalogue');
        }
        $message = "Add your address on your profile to pay !";
        return redirect()->back()->with('message', $message);
    }

    public function remove($id, $id_user) {
        $count = DB::table('cart')->count();
        DB::table('cart')->where('id', $id)->delete();
        DB::statement("ALTER TABLE cart AUTO_INCREMENT = $count;");
        return redirect()->action('CartController@index', ['id' => $id_user]);
    }

    public function update_quantity(Request $request) {
        $amount = $request->amount;
        $id_user = $request->id_user;
        $id_product = $request->id_product;
        $id = $request->id;
        DB::update('update cart set quantity = ?, id_user = ?, id_product = ? where id = ?',
            [$amount, $id_user, $id_product, $id]);
        return redirect()->action('CartController@index', ['id' => $id_user]);
    }

    public function SaveData(Request $request) {
        $id_user = Auth::user()->id;
        $obj = json_decode($request->request->get('myData'));
        $total = json_decode($request->request->get('total'));
        foreach($obj as $table) {
            DB::table('product')->where('id', $table->id)
            ->decrement('quantity', $table->quantity);
        }
        $order = new orders();
        $order->cart = serialize($obj);
        $order->id_user = $id_user;
        $order->total_price=$total;
        $order->address = "Pas d'addresse";
        $order->id_payment = 1;
        $order->save();
    }

}
