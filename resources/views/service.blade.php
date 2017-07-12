@extends('layouts.app')

@section('content')

@if(session('message'))
    @if(session('status') == 'success')
        <div class="alert alert-success">{{session('message')}}</div>
    @else
        <div class="alert alert-danger">{{session('message')}}</div>
    @endif
@endif

<div class="container" id="serv" >
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Servicios / Promociones </div>

                <div class="panel-body">

                    <div class="row center-block">
                        <div class="col-md-12"><b>Servicios Existentes:</b> <span class="bg-info"> {{count($services)}} </span></div>
                        <hr>
                        <br>
                        <div class="col-md-12">
                            <div class="col-md-9">
                                <form >
                                    <div class="col-md-4">
                                        <label>Nombre</label>
                                        <input type="text" name="name_service" >
                                    </div>
                                    <div class="col-md-4">
                                        <label>Fecha</label>
                                        <input type="date" name="date_service" >
                                    </div>
                                    <div class="col-md-4">
                                        <input class="btn" type="submit" value="Filtrar" >
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                                    Agregar Servicio
                                </button>
                            </div>

                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="col-md-12">
                            <!-- Table -->
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Promoción</th>
                                    <th>Vigencia</th>
                                    <th>Descuento (%)</th>
                                    <th>Valor</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                
                                <tr v-for="service in servicesData">
                                    <td > @{{service.service_id}} </td>
                                    <td > @{{service.service_name}} </td>
                                    <td > @{{service.promotion}} </td>
                                    <td > @{{service.validity}} </td>
                                    <td > @{{service.discount}} </td>
                                    <td >$ @{{service.value | formatNumber}} </td>
                                    <td ><img width="50" :src="'images/' + service.image_name"></td>
                                    <td v-bind:class="status_services(service.status)" > @{{service.status_name}} </td>
                                    <td >
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" :id="'dropdownMenu' + service.service_id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Selecciona
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" :aria-labelledby="'dropdownMenu'+ service.service_id">
                                                <li><a href="#" data-toggle="modal" @click="setEditService(service)" data-target="#modalEdit">Editar</a></li>
                                                <li><a href="#">Borrar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>                               
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para editar -->
<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Servicio</h4>
            </div>
            <form id="updateForm" action="update_service" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_id" :value="selectedData.service_id">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="name_service">Nombre del servicio y/o promoción</label>
                        <input type="text"  name="name_service" :value="selectedData.service_name" class="form-control" id="name_service" placeholder="Nombre del servicio y/o promoción">
                    </div>
                    <div class="form-group">
                        <label for="text_prom">Promoción</label>
                        <textarea class="form-control" id="text_prom" name="promotion" :value="selectedData.promotion" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="discount_service">Descuento en %</label>
                        <input type="number" name="discount_service" v-model="discount_service_edit"  class="form-control" id="discount_service" placeholder="Descuento en %">
                    </div>
                    <div class="form-group">
                        <label for="validity_service">Vigencia</label>
                        <input type="date" name="validity_service" :value="selectedData.validity" class="form-control" id="validity_service" placeholder="Vigencia">
                    </div>
                    <div class="form-group">
                        <label for="value_service">Valor</label>
                        <input type="number" name="value_service" v-model="value_service_edit" class="form-control" id="value_service" placeholder="Valor">
                    </div>
                    
                    <div class="form-group bg-info">
                        <label for="status">Estado del Servicio</label>
                        <select class="form-control" name="status" :value="selectedData.status" required>
                            @foreach($statusServices as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="real">Valor Real</label>
                        <input type="text" readonly class="form-control" id="real" :value="value_service_edit - ((discount_service_edit * value_service_edit) / 100)" placeholder="Valor Real">
                    </div>

                    <div class="form-group">
                        <label for="payment_url">Url de Pago</label>
                        <input type="text" class="form-control" name="payment_url" :value="selectedData.payment_url"  id="payment_url" placeholder="URL de Pago">
                    </div>

                    <div class="form-group">
                        <label for="image_service">Imagen de Promoción</label>
                        <input type="file" accept="image/*" name="image_service" value="selectedData.name" id="image_service">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para agregar -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Servicio</h4>
            </div>
             <form action="add_service" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="modal-body">
                   
                    <div class="form-group">
                        <label for="name_service">Nombre del servicio y/o promoción</label>
                        <input type="text" name="name_service" class="form-control" id="name_service" placeholder="Nombre del servicio y/o promoción">
                    </div>
                    <div class="form-group">
                        <label for="text_prom">Promoción</label>
                        <textarea class="form-control" id="text_prom" name="promotion" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="discount_service">Descuento en %</label>
                        <input type="number" name="discount_service"  v-model="discount_service" class="form-control" id="discount_service" placeholder="Descuento en %">
                    </div>
                    <div class="form-group">
                        <label for="validity_service">Vigencia</label>
                        <input type="date" name="validity_service" class="form-control" id="validity_service" placeholder="Vigencia">
                    </div>
                    <div class="form-group">
                        <label for="value_service">Valor</label>
                        <input type="number" name="value_service" v-model="value_service" class="form-control" id="value_service" placeholder="Valor">
                    </div>

                    <div class="form-group">
                        <label for="real">Valor Real</label>
                        <input type="number" readonly class="form-control" id="real" :value="value_service - ((value_service *discount_service) / 100)" placeholder="Valor Real">
                    </div>

                    <div class="form-group">
                        <label for="payment_url">Url de Pago</label>
                        <input type="text" name="payment_url" class="form-control" id="payment_url" placeholder="URL de Pago">
                    </div>

                    <div class="form-group">
                        <label for="image_service">Imagen de Promoción</label>
                        <input type="file" accept="image/*" name="image_service" id="image_service" required>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                    <button type="submit"  class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
