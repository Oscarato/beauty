@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Tus Logros</div>

                <div class="panel-body">

                    <div class="row center-block">
                        <div class="col-md-6"><b>Comisión:</b> <span class="bg-success"> $ 500.000 </span> </div>
                        <div class="col-md-6"><b>Servicios Registrados:</b> <span class="bg-info"> {{count($orders)}}</span></div>
                        <hr>
                        <br>
                        <div class="col-md-12">
                            <form >
                                <div class="col-md-4">
                                    <label>Fecha Inicial</label>
                                    <input type="date" name="date_init" >
                                </div>
                                <div class="col-md-4">
                                    <label>Fecha Final</label>
                                    <input type="date" name="date_end" >
                                </div>
                                <div class="col-md-4">
                                    <input class="btn" type="submit" value="Filtrar" >
                                </div>
                            </form>
                        </div>
                        <br>
                        <hr>
                        <br>
                        <div class="col-md-12">
                        
                            <!-- Table -->
                            <table class="table table-hover">
                                <tr>
                                    <th>ID</th>
                                    <th>Servicio</th>
                                    <th>Asociado</th>
                                    <th>Cliente</th>
                                    <th>Fecha del Servicio</th>
                                    <th>Hora del Servicio</th>
                                    <th>Fecha de Solicitud</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                
                                <tr v-for="order in ordersData">
                                    <td > @{{order.order_id}}</td>
                                    <td > @{{order.service_name}}</td>
                                    <td>  @{{order.user_name}} </td>
                                    <td > @{{order.client_name}}</td>
                                    <td > @{{order.date_service}}</td>
                                    <td > @{{order.hour_service}}</td>
                                    <td > @{{order.creation_date}}</td>
                                    <td  v-bind:class="status_orders(order.status)"> @{{order.status_name}} </td>
                                    <td >
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" :id="'dropdownMenu' + order.order_id" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Selecciona
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" :aria-labelledby="'dropdownMenu' + order.order_id">
                                                <li><a href="#" data-toggle="modal" @click="setEditOrder(order)" data-target="#modalStatus">Cambiar de Estado</a></li>
                                                <!--<li><a href="#">Editar</a></li>-->
                                                <!--<li><a href="#">Borrar</a></li>-->
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

<!-- Modal para cambiar el estado del servicio -->
<div class="modal fade" id="modalStatus" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Cambiar Estado de Servicio</h4>
            </div>
            <form id="updateForm" action="update_service" method="post" enctype="multipart/form-data">

                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="_id" :value="selectOrder.service_id">

                <div class="modal-body">

                    <div class="form-group">
                        <label for="name_service">Nombre del servicio y/o promoción</label>
                        <input type="text" readonly  name="name_service" :value="selectOrder.service_name" class="form-control" id="name_service" placeholder="Nombre del servicio y/o promoción">
                    </div>
                    
                    <div class="form-group bg-info">
                        <label for="status">Estado del Servicio</label>
                        <select class="form-control" name="status" :value="selectOrder.status" required>
                            @foreach($statusOrders as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
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

<!-- Modal para editar -->
<div class="modal fade" id="modalEdit" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Editar Orden</h4>
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
                            @foreach($statusOrders as $status)
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

@endsection
