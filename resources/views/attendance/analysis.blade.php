@extends('layouts.app')

@section('title')
    Analisis de Asistencias
@endsection

@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">

            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Analisis de Asistencias</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i><a href="{{ route('dashboard') }}"> Tablero</a>
                </li>
                <li class="active">Análisis</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <div class="row">

                <div class="col-md-6">

                    <!-- Line Chart -->
                    <!---------------------------------->
                    <div class="panel rounded-top">
                        <div class="panel-heading bg-dark">
                            <div class="col-xs-6">
                                <h3 class="panel-title text-right">{{ date('Y') }} Asistencia Mensual</h3>
                            </div>
                            <div class="col-xs-6 panel-title">
                                <div class="col-xs-4 small" style="background-color:#8c0e0e">Hombres</div>
                                <div class="col-xs-4 small bg-success">Mujeres</div>
                                <div class="col-xs-4 small bg-warning">Niños</div>
                            </div>
                        </div>
                        <div class="pad-all" style="background-color: #e8ddd3;">
                            <div id="demo-morris-bar-month" class="legendInline" style="height:250px"></div>
                        </div>
                    </div>
                    <!---------------------------------->
                </div>
                <!-- week -->
                <div class="col-md-6">

                    <!-- Line Chart -->
                    <!---------------------------------->
                    <div class="panel rounded-top">
                        <div class="panel-heading bg-dark">
                            <div class="col-xs-6">
                                <h3 class="panel-title text-right">{{ date('Y') }} Ultimos 10 dias de asistencia</h3>
                            </div>
                            <div class="col-xs-6 panel-title">
                                <div class="col-xs-4  small" style="background-color:#8c0e0e">Hombres</div>
                                <div class="col-xs-4  small bg-success">Mujeres</div>
                                <div class="col-xs-4  small bg-warning">Niños</div>
                            </div>
                        </div>
                        <div class="pad-all" style="background-color: #e8ddd3;">
                            <div id="demo-morris-bar-week" class="legendInline" style="height:250px"></div>
                        </div>
                    </div>
                    <!---------------------------------->
                </div>

                <!-- day -->
                <div class="col-md-6">

                    <!-- Line Chart -->
                    <!---------------------------------->
                    <div class="panel rounded-top">
                        <div class="panel-heading bg-dark">
                            <div class="col-xs-6">
                                <h3 class="panel-title text-right">{{ date('Y') }} Últimos 7 dias de asistencia</h3>
                            </div>
                            <div class="col-xs-6 panel-title">
                                <div class="col-xs-4  small" style="background-color:#8c0e0e">Hombres</div>
                                <div class="col-xs-4  small bg-success">Mujeres</div>
                                <div class="col-xs-4  small bg-warning">Niños</div>
                            </div>
                        </div>
                        <div class="pad-all" style="background-color: #e8ddd3;">
                            <div id="demo-morris-bar-day" class="legendInline" style="height:250px"></div>
                        </div>
                    </div>
                    <!---------------------------------->
                </div>

                <!-- year -->
                <div class="col-md-6">

                    <!-- Line Chart -->
                    <!---------------------------------->
                    <div class="panel rounded-top">
                        <div class="panel-heading bg-dark">
                            <div class="col-xs-6">
                                <h3 class="panel-title text-right">Asistencia anual</h3>
                            </div>
                            <div class="col-xs-6 panel-title">
                                <div class="col-xs-4  small" style="background-color:#8c0e0e">Hombres</div>
                                <div class="col-xs-4  small bg-success">Mujeres</div>
                                <div class="col-xs-4  small bg-warning">Niños</div>
                            </div>
                        </div>
                        <div class="pad-all" style="background-color: #e8ddd3;">
                            <div id="demo-morris-bar-year" class="legendInline" style="height:250px"></div>
                        </div>
                    </div>
                    <!---------------------------------->
                </div>
            </div>


        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection
