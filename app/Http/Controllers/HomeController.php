<?php

namespace App\Http\Controllers;

use App\Orders;
use App\Services;
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
        $ordersClass = new Orders;
        $statusOrders = $ordersClass->getStatusOrders();

        //analisamos las posibles comisiones
        $commission = $ordersClass->getCommission();
        
        return view('home', ['statusOrders' => $statusOrders, 'commission' => $commission]);
    }

}
