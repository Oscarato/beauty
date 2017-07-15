<?php

namespace App;

use DB;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;


class Orders extends Model
{
    
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    protected $guarded = ['document', 'service'];

    public function create(Request $request){
        
        $this->document = $request['document'];
        $this->service = $request['service'];
        $this->name = $request['name'];
        $this->email = $request['email'];
        $this->phone_mobile = $request['phone_mobile'];
        $this->phone = $request['phone'];
        $this->phone = $request['phone'];
        $this->address = $request['address'];
        $this->address_service = $request['address_service'];
        $this->date_service = $request['date'];
        $this->hour_service = $request['hour_service'];
        $this->status = 1;
        
        if($this->save()){
            return true;
        }else{
            return false;
        }
    }

    public function getOrders($data = null){

        if($data->profile == 1){
            return DB::table('orders')
            ->join('users', 'orders.document', '=', 'users.document')
            ->join('services', 'orders.service', '=', 'services.id')
            ->join('status_orders', 'orders.status', '=', 'status_orders.id')
            ->select('orders.id as order_id', 'users.name as user_name', 'orders.name as client_name', 'orders.email as client_email', 'orders.phone_mobile', 'orders.phone', 'orders.address', 'orders.status', 'orders.address_service', 'status_orders.name as status_name', 'services.name as service_name', 'orders.date_service', 'orders.hour_service', 'orders.creation_date')
            ->get();
        }else{
            return DB::table('orders')
            ->join('users', 'orders.document', '=', 'users.document')
            ->join('services', 'orders.service', '=', 'services.id')
            ->join('status_orders', 'orders.status', '=', 'status_orders.id')
            ->select('orders.id as order_id', 'users.name as user_name', 'orders.name as client_name', 'orders.email as client_email', 'orders.phone_mobile', 'orders.phone', 'orders.address', 'orders.status', 'orders.address_service', 'status_orders.name as status_name', 'services.name as service_name', 'orders.date_service', 'orders.hour_service', 'orders.creation_date')
            ->where('users.document', $data->document)
            ->get();
        }

    }

    public function getStatusOrders(){
        return DB::table('status_orders')
        ->select('id', 'name')
        ->get();
    }

    public function getCommission(){
        return DB::select("select sum( ((services.value - ((services.value * services.discount)/100))*5)/100) value from orders inner join services on services.id = orders.service where orders.status = 2 AND orders.document = ". Auth::user()->document);
    }

    public function updateStatus($data){

        $order = $this::find($data['_id']);
        $order->status = $data['status'];
        
        if($order->save()){
            return array('success' => true, 'last_insert_id' => $data['_id']);
        }else{
            return array('success' => false);
        }
    }
    
}
