<?php

use App\Images;

/**
* change plain number to formatted currency
*
* @param $number
* @param $currency
*/
function formatNumber($number, $currency = 'CO')
{
   if($currency == 'USD') {
        return number_format($number, 2, '.', ',');
   }
   return number_format($number, 0, '.', '.');
}

function status_services($status){
    switch ($status) {
        case '1':
            $status = 'active';
            break;
        case '2':
            $status = 'danger';
            break;
        default:
            $status = 'active';
            break;
    }

    return $status;
}

function status_orders($status){
    switch ($status) {
        case '1':
            $status = 'active';
            break;
        case '2':
            $status = 'warning';
            break;
        case '3':
            $status = 'danger';
            break;
        case '4':
            $status = 'success';
            break;
        default:
            $status = 'active';
            break;
    }

    return $status;
}

function moveImage($file){
    
    $extension = \File::extension($file);
    $img_name = md5($file->getClientOriginalName()).'.'.$extension;
    $updir = 'images/';

    $res = new stdClass();
    if($file->move($updir, $img_name)){
        $res->name = $img_name;
        $res->extension = $extension;
        return $res;
    }else{
        return false;
    }
    
}