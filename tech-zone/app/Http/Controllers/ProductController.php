<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Model\orders;
use App\Model\cart;
use App\Model\product;
use App\Model\review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    public function catalogue() {
        $id_user = null;
        $product = DB::select("SELECT * FROM product");
        if (Auth::user() != null)
            $id_user = Auth::user()->id;
        $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
        return view('catalogue', ['product' => $product, 'cart' => $cart]);
    }

    public function buy($quantity, $amount, $id_user, $id_product) {
        if ($quantity - $amount >= 0) {
            $product = new product();
            $product = DB::select("select * from product where id=$id_product");
            $panier = DB::select("select * from cart");
            foreach($panier as $tab) {
                if (Auth::user()->id == $tab->id_user && $tab->id_product == $id_product) {
                    DB::table('cart')->where('id_product', $tab->id_product)
                        ->where('id_user', $id_user)
                        ->increment('quantity', $amount);
                    return redirect()->action('CartController@index', ['id_user' => $id_user]);
                }
            }
            $cart = new cart();
            $cart->id_user = $id_user;
            $cart->quantity = $amount;
            $cart->id_product = $product[0]->id;
            $cart->save();
            $cart=DB::select("SELECT * FROM cart where id_user=$id_user");
        }
        return redirect()->action('CartController@index', ['id_user' => $id_user]);
    }

    public function buy_product(Request $request) {
        $quantity = $request->input('quantity');
        $amount = $request->input('amount');
        $id_user = $request->input('id');
        $id_product = $request->input('id_product');
        return redirect()->action('ProductController@buy',['quantity' => $quantity,
            'amount' => $amount,'id_user' => $id_user, 'id_product' => $id_product]);
    }

    public function product($id) {
        $id_user = null;
        $product = DB::select("SELECT * FROM product where id=$id");
        $review = DB::select("SELECT users.admin, review.id, review.id_user, users.name, review.stars, review.created_at, review.comment
            FROM review, users WHERE users.id = review.id_user AND review.id_product = $id");
        $count = DB::table('review')->where('id_product', $id)->count();
        if (Auth::user() != null)
            $id_user = Auth::user()->id;
        $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
        return view('product',['product' => $product, 'review' => $review, 'count' => $count, 'cart' => $cart]);
    }

    public function display($category) {
        $id_user = null;
        $product = DB::select("SELECT * FROM product WHERE category=\"$category\"");
        if (Auth::user() != null)
            $id_user = Auth::user()->id;
        $cart = DB::table('cart')->where('id_user', $id_user)->sum('quantity');
        return view('catalogue', ['product' => $product, 'cart' => $cart]);
    }

    public function search(Request $request) {
        $id_user = null;
        $name = $request->input('name');
        $product = DB::select("SELECT * FROM product WHERE name LIKE \"%$name%\"");
        if (Auth::user() != null)
            $id_user = Auth::user()->id;
        $cart = DB::table('cart')->where('id_user', $id_user)->count();
        return view('search', ['product' => $product, 'name' => $name, 'cart' => $cart]);
    }

    public function review(Request $request) {
        $id = $request->id_user;
        $review = new review();
        $review->comment = $request->comment;
        $review->stars = $request->stars;
        $review->id_product = $request->id_product;
        $review->id_user = $request->id_user;
        $review->save();

        return back();
    }

    public function delete_comment($id) {
        DB::table('review')->where('id', $id)->delete();
        return back();
    }
}
