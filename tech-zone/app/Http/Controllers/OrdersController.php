<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Model\orders;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function display_orders($id){
        if (Auth::user() != null) {
            $id_user = Auth::user()->id;
            $products = array();
            $quantity = array();
            $orders = DB::select("SELECT * FROM orders WHERE id=$id AND id_user=$id_user");
            $total_price = 0;
            $date = "";
            if ($orders != null) {
                $order = unserialize($orders[0]->cart);
                $total_price = $orders[0]->total_price;
                $date = $orders[0]->created_at;
                foreach ($order as $tab) {
                    $quantity[] = $tab->quantity;
                    $products[] = DB::select("SELECT * FROM product WHERE id=$tab->id");
                }
            }
            $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
            return view('orders', ['products' => $products, 'cart' => $cart, 'quantity' => $quantity,
                'total_price' => $total_price, 'date' => $date]);
        }
        return view('auth.login');
    }

    public function show_orders($id) {
        if (Auth::user() != null) {
            if (Auth::user()->id == $id) {
                $orders = DB::select("SELECT * FROM orders WHERE id_user=$id ORDER BY created_at");
                $cart = DB::table('cart')->where('id_user', $id)->sum('quantity');
                return view('page_orders', ['orders' => $orders, 'cart' => $cart]);
            }
            return back();
        }
        return view('auth.login');
    }
}
