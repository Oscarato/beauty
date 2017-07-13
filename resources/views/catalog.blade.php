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
                <div class="panel-heading">Catálogo </div>

                <div class="panel-body">

                    <div class="row center-block">
                        <div class="col-md-12"><b>Servicios Existentes:</b> <span class="bg-info"> {{count($services)}} </span></div>
                        <hr>
                        <br>
                        <div class="col-md-12">
                        
                            <div id="catalog_carousel" class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner center-block" role="listbox">
                                    @foreach($services as $service)
                                        <a href="?show={{$service->service_id}}">
                                            <div class="item {{$services[0]->service_id == $service->service_id ? 'active':''}}">
                                                <img width="350" src="images/{{$service->image_name}}" class="img-rounded">
                                                <div class="carousel-caption">
                                                    <h3>{{$service->service_name}}</h3>
                                                    <p>{{$service->promotion}}</p>
                                                    <p>$ {{formatNumber($service->value)}}</p>
                                                    <p>
                                                        <div class="dropdown">
                                                            <a href="{{ url('/orders').'?service='.$service->service_id }}" class="btn btn-default">
                                                                Solicitar Servicio
                                                            </a>
                                                            <a href="{{$service->payment_url}}" target="_blank" class="btn btn-default">
                                                                Realizar el pago
                                                            </a>
                                                        </div>
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    @endforeach
                                    
                                    <!-- Controls -->
                                    <a class="left carousel-control" href="#catalog_carousel" role="button" data-slide="prev">
                                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                    <a class="right carousel-control" href="#catalog_carousel" role="button" data-slide="next">
                                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </div>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php if(isset($_GET['show'])){ ?>
    <?php if(isset($serviceData[0])){ ?>
        <div class="modal fade" tabindex="-1" id="showProm" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">{{$serviceData[0]->service_name}}</h4>
                </div>
                <div class="modal-body">
                    <p><img width="100%" src="images/{{ $serviceData[0]->image_name }}"></p>
                </div>
                <div class="modal-footer">
                    <a href="{{ url('/orders').'?service='.$serviceData[0]->service_id }}" class="btn btn-primary">Solicitar Servicio</a>
                    <a href="{{$serviceData[0]->payment_url}}" target="_blank" class="btn btn-default">Realizar el pago</a>
                </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <?php } ?>
<?php } ?>


@endsection