@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-heading"><strong>{{ __('auth.register') }}</strong></div>
                
                <br>

                <div class="col-md-12">
                    <p>
                        {{__('auth.welcome')}}
                    </p>
                </div>

                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">{{ __('auth.name') }} (*)</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label">{{ __('auth.lastname') }} (*)</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" value="{{ old('lastname') }}" required >

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">{{ __('auth.email') }} (*)</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required >

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('document') ? ' has-error' : '' }}">
                            <label for="document" class="col-md-4 control-label">{{ __('auth.document') }} (*)</label>

                            <div class="col-md-6">
                                <input id="document" type="number" class="form-control" name="document" value="{{ old('document') }}" required>

                                @if ($errors->has('document'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('document') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="col-md-4 control-label">{{ __('auth.phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control" name="phone" value="{{ old('phone') }}"  >

                                @if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('phone_mobile') ? ' has-error' : '' }}">
                            <label for="phone_mobile" class="col-md-4 control-label">{{ __('auth.phone_mobile') }} (*)</label>

                            <div class="col-md-6">
                                <input id="phone_mobile" type="number" class="form-control" name="phone_mobile" value="{{ old('phone_mobile') }}"  required>

                                @if ($errors->has('phone_mobile'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_mobile') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">{{ __('auth.city') }} (*)</label>

                            <div class="col-md-6">
                                
                                <select v-model="city" id="city" name="city" value="{{ old('city') }}" required class="form-control">
                                    <option value="1">Bogotá</option>
                                    <option value="2">Otra</option>
                                </select>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div v-if="city == 2" class="form-group{{ $errors->has('another') ? ' has-error' : '' }}">
                            <label for="another" class="col-md-4 control-label">{{ __('auth.another') }} (*)</label>

                            <div class="col-md-6">
                                
                                <input id="another" type="text" class="form-control" name="another" value="{{ old('another') }}"  required>

                                @if ($errors->has('another'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('another') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">{{ __('auth.address') }} (*)</label>

                            <div class="col-md-6">
                                <input  type="text" class="form-control" name="address" value="{{ old('address') }}" required >

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">{{ __('auth.password') }} (*)</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">{{ __('auth.confirm_password') }} (*)</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
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
                                    {{ __('auth.register') }}
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
