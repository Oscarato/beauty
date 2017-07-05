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
                                @foreach($orders as $order)
                                    <tr>
                                        <td >{{$order->order_id}}</td>
                                        <td >{{$order->service_name}}</td>
                                        <td> {{$order->user_name}} </td>
                                        <td >{{$order->client_name}}</td>
                                        <td >{{$order->date_service}}</td>
                                        <td >{{$order->hour_service}}</td>
                                        <td >{{$order->creation_date}}</td>
                                        <td class="{{status_orders($order->status)}}">{{$order->status_name}}</td>
                                        <td >
                                            <div class="dropdown">
                                                <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu{{$order->order_id}}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                    Selecciona
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu{{$order->order_id}}">
                                                    <li><a href="#">Editar</a></li>
                                                    <li><a href="#">Borrar</a></li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>

                                @endforeach
                                
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
