<?php

namespace App\Http\Controllers;

use App\Services;
use App\Images;
use App\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ServicesController extends Controller
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
    public function services()
    {   
        $services = new Services;
        $servicesData = $services->getServices();

        $statusServices = $services->gerStatusServices();
        return view('service', ['services' => json_encode($servicesData), 'statusServices' => $statusServices]);
    }

    /**
     * Permite registrar un pedido.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_service()
    {   
        
        $file = $this->request->file('image_service')->getClientOriginalName();
        $extension = \File::extension($file);
        $img_name = md5($file).'.'.$extension;
        
        $service = new Services;
        $created = $service->create($this->request);
        
        if($created['success'] ){
            
            $updir = 'images/';
            $img_name = md5($file).'.'.$extension;
            $this->request->file('image_service')->move($updir, $img_name);

            $image = new Images;
            if( $image->create( array(
                'name' => $img_name,
                'id_associate' => $created['last_insert_id'],
            ) ) ){
                //aqui agregamos la imagen
                session(['status' => 'success']);
                return redirect("services")->with('message','El servicio fue agregado correctamente');
            }else{
                //aqui agregamos la imagen
                session(['status' => 'error']);
                return redirect("services")->with('message','El servicio fue agregado, pero sucedio un error al subir la imagen');
            }

        }else{
            session(['status' => 'error']);
        }
    }

    public function update_service(){
        $file = $this->request->file('image_service');
        $file = $file ? $file : null;
        
        //instanciamos el modelo de servicios
        $service = new Services;

        //para actualizar
        $update = $service->updateService($this->request);

        if($update['success']){
            //vemos si quieren cambiar la imagen
            if($file){
                $image = new Images;
                
                //cambiamos todos los estados de lsa imagenes de acuerdo al id del servicio a 0
                $image->UpdateByService($this->request['_id']);
                
                //helper para movel la imagen
                if($newImage = moveImage($file) ){
                    if(
                        $image->create( array(
                        'name' => $newImage->name,
                        'id_associate' => $update['last_insert_id'],
                    ) ) ){
                        //aqui agregamos la imagen
                        session(['status' => 'success']);
                        return redirect("services")->with('message','El servicio fue actualizado correctamente');
                    }else{
                        //aqui agregamos la imagen
                        session(['status' => 'success']);
                        return redirect("services")->with('message','El servicio fue actualizado, pero sucedio un error al registrar la imagen');
                    }   
                    
                }else{
                    //aqui agregamos la imagen
                    session(['status' => 'error']);
                    return redirect("services")->with('message','El servicio fue actualizado, pero sucedio un error al cambiar la imagen');
                }
                
            }else{
                //aqui agregamos la imagen
                session(['status' => 'success']);
                return redirect("services")->with('message','El servicio fue actualizado correctamente');
            }
        }else{
            //aqui agregamos la imagen
            session(['status' => 'error']);
            return redirect("services")->with('message','No se pudo actualizar el servicio');
        }
    }
}
