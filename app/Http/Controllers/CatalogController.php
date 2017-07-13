<?php

namespace App\Http\Controllers;

use App\Services;
use App\Images;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class CatalogController extends Controller
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

    public function catalog(){

        $services = new Services;
        $servicesData = $services->getServices();
        $service = array();
        if(isset($_GET['show'])){
            $service = json_decode($services->getServicesById($_GET['show'])) ;
        }

        return view('catalog', ['services' => $servicesData, 'serviceData' => $service]);
    }


}
