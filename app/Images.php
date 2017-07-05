<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';
    protected $guarded = ['document', 'service'];

    public function create($data){
        
        $this->name = $data['name'];
        $this->id_associate = $data['id_associate'];
        
        if($this->save()){
            return true;
        }else{
            return false;
        }
    }

    public function findByService($idService){
        return DB::table('images')
        ->select('id', 'name')
        ->where('id_associate', $idService)
        ->get();
    }

    public function UpdateByService($idService){
        return DB::table('images')
        ->where('id_associate', $idService)
        ->update(['status' => '0']);
    }
}
