@extends('layouts.app')

@section('content')

@if(session('message'))
    @if(session('status') == 'success')
        <div class="alert alert-success">{{session('alert-success')}}</div>
    @else
        <div class="alert alert-danger">{{session('alert-success')}}</div>
    @endif
@endif

<?php echo $user; ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading"><strong>{{ __('service.get_service') }}</strong></div>
                
                <br>

                <div class="col-md-12">
                    <p>
                        Relación  de servicios por Asociado
                    </p>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" method="post" action="add_order">
                        {{ csrf_field() }}

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <label for="document" class="col-md-4 control-label">{{ __('service.document') }} (*)</label>

                            <div class="col-md-6">
                            
                                @if (Auth::guest())
                                    <input id="document" type="number" class="form-control" name="document" value="{{ old('document') }}" required>
                                @else
                                
                                    <input id="document" readonly type="number" class="form-control" name="document" value="{{ Auth::user()->document }}" required>
                                @endif
                                

                                @if ($errors->has('document'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Servicio adquirido (*)</label>

                            <div class="col-md-6">
                                <select id="service" name="service" value="{{ old('service') }}" required class="form-control">
                                    <option value="1">Servicio 1</option>
                                    <option value="2">Servicio 2</option>
                                    <option value="3">Servicio 3</option>
                                </select>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Nombre completo del cliente (*)</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required >

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo electrónico del cliente (*)</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"  required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_mobile') ? ' has-error' : '' }}">
                            <label for="phone_mobile" class="col-md-4 control-label">No. de teléfono móvil del cliente  (*)</label>

                            <div class="col-md-6">
                                
                                <input id="phone_mobile" type="number" class="form-control" name="phone_mobile" value="{{ old('phone_mobile') }}"  required>

                                @if ($errors->has('phone_mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">No de teléfono fijo del cliente (*)</label>

                            <div class="col-md-6">
                                
                                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}"  required>

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">Dirección del cliente  (*)</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="address" value="{{ old('address') }}" required >

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address_service') ? ' has-error' : '' }}">
                            <label for="address_service" class="col-md-4 control-label">Dirección prestación servicio al cliente (*)</label>

                            <div class="col-md-6">
                                <input id="address_service" type="text" class="form-control" name="address_service" value="{{ old('address_service') }}"  required>

                                @if ($errors->has('address_service'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_service') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="date" class="col-md-4 control-label">Fecha de prestación de servicio al cliente (*)</label>

                            <div class="col-md-6">
                                <input id="date" type="date" name="date" value="{{ old('date') }}" class="form-control"   required>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="hour_service" class="col-md-4 control-label">Hora de prestación de servicio al cliente (*)</label>

                            <div class="col-md-6">
                                <input id="hour_service" type="time" name="hour_service" value="{{ old('hour_service') }}" class="form-control"   required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <p>
                               (*) Campos obligatorios
                            </p>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Agregar Pedido
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
