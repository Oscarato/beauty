@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 ">
            <div class="panel panel-default">
                <div class="panel-heading">Servicios / Promociones</div>

                <div class="panel-body">

                    <div class="row center-block">
                        <div class="col-md-12"><b>Servicios Existentes:</b> <span class="bg-info"> 10 </span></div>
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
                                    <th>Descuento</th>
                                    <th>Valor</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                                <tr>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td ><img width="50" src=""></td>
                                    <td class="active">...</td>
                                    <td >
                                        <div class="dropdown">
                                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Selecciona
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                                <li><a href="#" data-toggle="modal" data-target="#myModal">Editar</a></li>
                                                <li><a href="#">Borrar</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td ><img width="50" src=""></td>
                                    <td class="success">...</td>
                                    <td >...</td>
                                </tr>
                                <tr>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td ><img width="50" src=""></td>
                                    <td class="active">...</td>
                                    <td >...</td>
                                </tr>
                                <tr>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td ><img width="50" src=""></td>
                                    <td class="active">...</td>
                                    <td >...</td>
                                </tr>
                                <tr>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td >...</td>
                                    <td ><img width="50" src=""></td>
                                    <td class="success">...</td>
                                    <td >...</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Agregar Servicio</h4>
            </div>
             <form>
                <div class="modal-body">
                   
                    <div class="form-group">
                        <label for="name_service">Nombre del servicio y/o promoción</label>
                        <input type="text" name="name_service" class="form-control" id="name_service" placeholder="Nombre del servicio y/o promoción">
                    </div>
                    <div class="form-group">
                        <label for="text_prom">Promoción</label>
                        <textarea class="form-control" id="text_prom" ></textarea>
                    </div>
                    <div class="form-group">
                        <label for="discount_service">Descuento en %</label>
                        <input type="number" name="discount_service" class="form-control" id="discount_service" placeholder="Descuento en %">
                    </div>
                    <div class="form-group">
                        <label for="validity_service">Vigencia</label>
                        <input type="date" name="validity_service" class="form-control" id="validity_service" placeholder="Vigencia">
                    </div>
                    <div class="form-group">
                        <label for="value_service">Valor</label>
                        <input type="number" name="value_service" class="form-control" id="value_service" placeholder="Valor">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputFile">Imagen de Promoción</label>
                        <input type="file" id="exampleInputFile">
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit"  class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
