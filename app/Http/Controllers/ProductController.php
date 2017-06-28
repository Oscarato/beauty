<?php

namespace App\Http\Controllers;

use App\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
         $this->request = $request;
    }

    /**
     * Permite ver el formulario para un pedido.
     *
     * @return \view template
     */
    public function order()
    {   
        return view('order', ['user' => 1]);
    }

    /**
     * Permite registrar un pedido.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_order()
    {   
        session()->regenerate();
        $order = new Orders;
        if($order->create($this->request)){
            session(['status' => 'success']);
            return redirect("orders")->with('message','La orden fue agregada correctamente');;
        }else{
            session(['status' => 'error']);
        }
    }

}