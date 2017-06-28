<?php

namespace App;

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
    
}
