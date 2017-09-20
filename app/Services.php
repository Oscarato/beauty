<?php

namespace App;

use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{

    const CREATED_AT = 'creation_date';
    const UPDATED_AT = 'last_update';

    //traemos los servicios existentes
    public function create(Request $request){
        $this->name = $request['name_service'];
        $this->promotion = $request['promotion'];
        $this->discount = $request['discount_service'];
        $this->validity = $request['validity_service'];
        $this->value = $request['value_service'];
        $this->payment_url = $request['payment_url'];

        $this->status = 1;
        
        if($this->save()){
            return array('success' => true, 'last_insert_id' => $this->id);
        }else{
            return array('success' => false);
        }
    }

    public function getServices(){

        //para filtro por nombre
        $name = '';
        if(isset($_GET['name_service'])){
            $name = $_GET['name_service'];
        }

        //para las fechas
        $year = date("Y");
        $initDate = $year.'-01-01';
        $endDate = $year.'-12-31';
        if(isset($_GET['date_service'])){
            if($_GET['date_service'] != ''){
                $initDate = $_GET['date_service'];
                $endDate = date('Y-m-d', strtotime("+1 months", strtotime($initDate)));
            }
        }
        
        DB::enableQueryLog();

        /*
        $query = "SELECT `services`.`id` as `service_id`, `images`.`name` as `image_name`, `services`.`name` as `service_name`, `services`.`promotion`, `services`.`payment_url`, `services`.`discount`, `services`.`validity`, `services`.`value`, `services`.`status`, `status_services`.`name` as `status_name` from `services` inner join `images` on `services`.`id` = `images`.`id_associate` inner join `status_services` on `services`.`status` = `status_services`.`id` where `images`.`status` = 1 and `services`.`name` LIKE '%$name%' and `services`.`creation_date` between '$initDate' and '$endDate' order by `services`.`name` asc";
        
        return $results = DB::select($query);
        */

        return DB::table('services')
        ->join('images', 'services.id', '=', 'images.id_associate')
        ->join('status_services', 'services.status', '=', 'status_services.id')
        ->select('services.id as service_id', 'images.name as image_name', 'services.name as service_name', 'services.promotion', 'services.payment_url', 'services.discount', 'services.validity', 'services.value', 'services.status', 'status_services.name as status_name')
        ->where('images.status', 1)
        ->where('services.name', 'LIKE', DB::raw("'%$name%'"))
        ->whereBetween('services.creation_date', array( $initDate, $endDate))
        ->orderBy('services.name', 'ASC')
        ->get();

        $queries = DB::getQueryLog();
        print_r($queries);
        exit;
    }

    public function getServicesById($id=null){
        return DB::table('services')
        ->join('images', 'services.id', '=', 'images.id_associate')
        ->join('status_services', 'services.status', '=', 'status_services.id')
        ->select('services.id as service_id', 'images.name as image_name', 'services.name as service_name', 'services.promotion', 'services.payment_url', 'services.discount', 'services.validity', 'services.value', 'services.status', 'status_services.name as status_name')
        ->where('images.status', 1)
        ->where('services.id', $id)
        ->get();
    }

    public function gerStatusServices(){
        return DB::table('status_services')
        ->select('id', 'name')
        ->get();
    }

    //para actualizar
    public function updateService(Request $request){
        
        $service = $this::find($request['_id']);
        
        $service->name = $request['name_service'];
        $service->promotion = $request['promotion'];
        $service->discount = $request['discount_service'];
        $service->validity = $request['validity_service'];
        $service->value = $request['value_service'];
        $service->payment_url = $request['payment_url'];
        $service->status = $request['status'];
        
        if($service->save()){
            return array('success' => true, 'last_insert_id' => $request['_id']);
        }else{
            return array('success' => false);
        }
    }
}
