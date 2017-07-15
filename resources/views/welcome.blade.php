<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="favicon.ico">

        <title>Be - Beauty</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!-- bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff0e9;
                color: #f01f1f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                margin: 0;
                padding: 1rem;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
                padding: 30px 0 0 0;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #b00000;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .nav, .nav-tabs{
                font-family: -webkit-pictograph;
            }

            .nav-tabs>li.active>a{
                color: #f01f1f;
            }

            .nav-tabs>li.active>a:focus{
                color: #f01f1f;
            }
            
            a{
                color: #b00000;
            }

            .fix{
                width: 600px;
            }

            p{
                padding: 30px
            }

            .carousel-inner {
                position: relative;
                width: 150px;
                overflow: hidden;
                margin: 0 0 0 40%;
            }

            .carousel{
                height: 150px;
            }
        </style>

        <script>
            $('.carousel').carousel({
                interval: 1000
            })
        </script>
    </head>
    <body>
        <div class="logo">
            <img width="80" src="img/531.png">
        </div>
        
        <div class="flex-center">

            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Logros</a>
                    @else
                        <a href="{{ url('/login') }}">{{ __('auth.login') }} </a>
                        <a href="{{ url('/register') }}">{{ __('auth.register') }}</a>
                    @endif

                    <a href="{{ url('/catalog') }}">Catálogo</a>
                    <a href="{{ url('/orders') }}">{{ __('auth.add_order') }}</a>
                    
                </div>
            @endif
            
            <div class="content">

                <div class="row">
                    <div class="col-md-12">
                        
                        <br>

                        <div class="title m-b-md">

                            <div class="carousel slide" data-ride="carousel">

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img width="150" src="img/mujer.PNG" class="img-circle">
                                    </div>
                                    <div class="item">
                                        <img width="150" src="img/mujer2.PNG" class="img-circle" >
                                    </div>
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 text-capitalize">
                        <h1><strong>Bienvenido a nuestro portal</strong></h1>
                    </div>
                </div>

                <hr>
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="links fix">

                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">¿Qué es?</a></li>
                                <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">¿Cómo funciona?</a></li>
                                <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">¿Dónde me inscribo?</a></li>
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="home">
                                    <div class="col-md-12">
                                        <p><strong>Queremos invitarte a ser parte de nuestra red de asociados, con el que podrás generar ingresos de manera <br> fácil y rápida.</strong></p>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="profile">
                                    <div class="col-md-12">
                                        <p><strong>Con tan sólo registrarte en nuestro portal, (<a href="register">aquí</a>) y referir nuestros servicios ya podras generar comision  de alguno <br> de los servicios que se adquirieron .</strong></p>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="messages">
                                    <div class="col-md-12">
                                        <p><strong>En la parte superior izquierda hay un botón que dice 'Registrarse', solo llena los datos y podrás ya inscribir los servicios que se adquieran <br> con tu ayuda y la comisión que obtienes. <br> o también puedes dar clic <a href="register">aquí</a></strong></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        
    </body>
</html>
