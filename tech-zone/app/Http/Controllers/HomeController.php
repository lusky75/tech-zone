<?php

namespace App\Http\Controllers;

use App\Model\category;
use App\Model\credit_card;
use App\Model\order;
use App\Model\payment_method;
use App\Model\paypal;
use App\Model\review;
use App\Model\product;
use App\Model\users;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('catalogue');
    }
}
