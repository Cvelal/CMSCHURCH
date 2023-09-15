@extends('layouts.app')

@section('title')
    Estado de Pago
@endsection

@section('link')
@endsection

@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">

            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Estado de Pago</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->

            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i><a href="{{ route('dashboard') }}"> Tablero</a>
                </li>
                <li class="active">Estado</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <div class="panel rounded-top text-center">
                <!-- <div class="panel-heading card">
            <h1 class="display-1 text-center"><i class="fa fa-{{ session('status') ? 'mark' : 'close' }}"></i> {{ session('message') }}ggfg</h1>
          </div> -->
                <div class="panel-body">
                    <div
                        class="text-xs-center bg-{{ session('status') ? 'success' : 'danger' }} card border border-light col-md-6 col-md-offset-2">
                        <div class="card-block">
                            <h1 class="display-3 mb-0">Gracias!</h1>
                            <h1 class="display-1 text-center"><i
                                    class="fa fa-{{ session('status') ? 'mark' : 'close' }}"></i> {{ session('message') }}
                            </h1>
                            @if (session('status'))
                                <p class="lead"><strong>Por favor, verifica tu correo</strong> para el recibo de pago.</p>
                                <hr>
                            @endif
                            <p>
                                Having trouble? <a href="">Contactanos</a>
                            </p>
                            <p class="lead  mb-0">
                                <a class="btn btn-primary btn-sm" href="{{ Route('dashboard') }}" role="button">Continua a la pagina principal</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
