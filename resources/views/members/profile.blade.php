@extends('layouts.app')

@section('title')
    Perfil del miembro
@endsection

@section('link')
    <link href="{{ URL::asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet">
    <style media="screen">
        .adaptive-color {
            width: auto;
        }
    </style>
@endsection

@section('content')
    <?php
    $dataPoints = [['label' => 'No', 'y' => $attendance->no, 'color' => 'red'], ['label' => 'Yes', 'y' => $attendance->yes, 'color' => 'green']];
    ?>

    @include('layouts.helpers.colors')
    <?php
    $colors = colo(); //$generateColor($c_types);
    ?>
    <!--Contenedor del contenido-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">

            <!--Titulo de la pagina-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Miembro</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--Fin del titulo-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i><a href="{{ route('dashboard') }}"> Tablero</a>
                </li>
                <li>
                    <i class="fa fa-users"></i><a href="{{ route('members.all') }}"> Miembros</a>
                </li>
                <li class="active">Perfil</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>


        <!--Contenido de la pagina-->
        <!--===================================================-->
        <div id="page-content">
            <div class="col-md-12 col-md-offset-0 col-lg-12 col-lg-offset-0">
                <div class="panel" style="background-color: #e8ddd3;">
                    <div class="panel-body">
                        <div class="row row-broken" data-height>
                            <div class="col-sm-12 col-md-4" style="border-right:1pt solid rgba(0, 0, 0, 0.1)">
                                <div class="text-center">
                                    <div class="pad-ver">
                                        <img src="{{ url('images/') }}/{{ $member->photo }}" class="img-lg img-circle"
                                            alt="Foto de Perfil">
                                    </div>
                                    <h4 class="text-lg text-overflow mar-no">{{ $member->title }}.
                                        {{ $member->getFullname() }}</h4>
                                    <p class="text-sm text-muted">{{ $member->occupation }}</p>
                                    <div class="pad-ver btn-groups">
                                        <a href="app-profile.html#" class="btn btn-icon fa fa-facebook icon-lg add-tooltip"
                                            data-original-title="Facebook" data-container="body"></a>
                                        <a href="app-profile.html#" class="btn btn-icon fa fa-twitter icon-lg add-tooltip"
                                            data-original-title="Twitter" data-container="body"></a>
                                        <a href="app-profile.html#"
                                            class="btn btn-icon fa fa-google-plus icon-lg add-tooltip"
                                            data-original-title="Google+" data-container="body"></a>
                                        <a href="app-profile.html#" class="btn btn-icon fa fa-instagram icon-lg add-tooltip"
                                            data-original-title="Instagram" data-container="body"></a>
                                    </div>
                                    <a href="tel:{{ $member->phone }}" class="btn  btn-success btn-md">Llamar</a>
                                    <a href="{{ route('email') }}?mail={{ $member->email }}"
                                        class="btn  btn-primary btn-md">Correo</a>
                                </div>
                                <br><br>
                                <div class="col-md-12">
                                    <div class="text-center">
                                        <p class=" text-center text-sm text-uppercase text-bold">Detalle</p>
                                        <hr>
                                        <p class="text-align-right">Direccion: <i
                                                class="fa fa-map-marker icon-lg icon-fw"></i>{{ $member->address }}</p>
                                        <p>Correo: <a href="app-profile.html#" class="btn-link">
                                                <i class="fa fa-inbox icon-lg icon-fw"></i>{{ $member->email }}</a>
                                        </p>
                                        <p>Telefono: <i class="fa fa-phone icon-lg icon-fw"></i>{{ $member->phone }}</p>
                                        <p>Ciudad: <i class="fa fa-home icon-lg icon-fw"></i>{{ $member->city }}</p>
                                        <p>Estado: <i class="fa fa-home icon-lg icon-fw"></i>{{ $member->state }}</p>
                                        <p>Pais: <i class="fa fa-home icon-lg icon-fw"></i>{{ $member->country }}</p>
                                        <p class="text-sm text-center"></p>
                                    </div>
                                    <hr>
                                    <div class="col-md-6 col-md-offset-2">
                                        <p class="pad-ver text-main text-sm text-capitalize text-bold">Posicion: <span
                                                class="pull-right">{{ $member->position }}</span></p>

                                        <p class="pad-ver text-main text-sm text-capitalize text-bold">Parientes:
                                            <span class="pull-right">
                                                <?php if (!empty($member->relative) || strlen($member->relative)>0){?>
                                                <?php $relatives = json_decode($member->relative); ?>
                                                <?php
                            foreach ($relatives as $relative){
                              if($rel = App\Member::where('id',$relative->id)->get()->first()){
                          ?>
                                                <li class="tag tag-sm"><a
                                                        href="{{ route('member.profile', $rel->id) }}">{{ $rel->getFullname() }}</a>
                                                    - {{ $relative->relationship }}</li><br />
                                                <?php
                              }
                              }
                            } else {echo 'No tiene parientes<br/>';}
                          ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-8">
                                <div class="row" style="height: 250px">
                                    <div class="col-md-12">
                                        <div class="panel rounded-top">
                                            <div class="panel-heading bg-dark">
                                                <div class="co" style="padding-top:7px;">
                                                    <h2 class="text-center text-white" style="color:white;">Analisis de la asistencia - {{ date('Y') }}</h2>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12" id="chartContainer" style="height: 250px;"></div>
                                    </div>
                                </div>
                                <br>
                                <hr>
                                <div class="row" style="margin-top:100px">
                                    <div class="col-md-12">
                                        <div class="panel rounded-top">
                                            <div class="text-center">
                                                <div class="col-xs-12">
                                                    <?php $i = 0; ?>
                                                    @foreach ($c_types as $type)
                                                        <span style="background-color:{{ $colors[$i] }}"
                                                            class="badge badge-pill">{{ $type->disFormatString() }}</span>
                                                        <?php $i++; ?>
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div id="manual-analysis-hd" class="bg-primary text-center"></div>
                                            <div class="panel-heading bg-dark">
                                                <div id="" class="col-xs-12 text-center" style="padding-top:7px;">
                                                    <h2 class="text-center text-white">
                                                        <p style="color:white;">Recopilacion del analisis</p>
                                                    </h2>
                                                </div>
                                            </div>
                                            <div class="pad-all" style="background-color: #e8ddd3;"
                                                style="overflow: scroll">
                                                <div class="row">
                                                    <div class="col-xs-6">
                                                        <label for="group" class="">Agrupar por</label>
                                                        <select id="group" required style="outline:none;"
                                                            name="sort" class="selectpicker col-md-12"
                                                            data-style="btn-primary">
                                                            <option value="1">Dias</option>
                                                            <option value="2">Semana</option>
                                                            <option selected value="3">Meses</option>
                                                            <option value="4">Años</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <label for="range" class="">Seleccionar Rango</label>
                                                        <select id="m-i" required style="outline:none;"
                                                            name="range"
                                                            class="selectpicker col-md-12 nav nav-pills ranges"
                                                            data-style="btn-primary">
                                                            <option selected disabled value="">Escoger numero de meses</option>
                                                            @for ($i = 1; $i < 13; $i++)
                                                                <option value="{{ $i }}">
                                                                    Ultimos {{ $i }} Meses</option>
                                                            @endfor
                                                        </select>
                                                    </div>
                                                </div>
                                                <div id="member-analysis" class="legendInline" style="height: 250px">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!--===================================================-->
    <!--Fin del contenido-->

    <!--===================================================-->
    <!--Fin del contenedor de contenido-->
@endsection

@section('js')
    <script src="{{ URL::asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
    <script src="{{ URL::asset('js/canvasjs.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/morris-js/morris.min.js') }}"></script>
    <script src="{{ URL::asset('plugins/morris-js/raphael-js/raphael.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('ul.ranges a').click(function(e) {
                e.preventDefault();

                // Obtener el numero de dias desde el atributo de dato
                var el = $(this);
                // Remover las clases de todo
                $('ul li').not(this).removeClass('active');
                $(el).parent().toggleClass('active');
                days = el.attr('data-range');

                // Solicite los datos y renderice el gráfico utilizando nuestra práctica función
                requestData(days, chart, group);
            })

            $('#m-i').change((e) => {
                var el = e.target;
                requestData(el.value, chart, group);
            })

            $('#group').change((e) => {
                let value = e.target.value;
                switchSelect(value)
            })

            var chart = Morris.Bar({
                // ID del elemento en el que dibujar el gráfico.
                element: 'member-analysis',
                data: [0, 0], 
                xkey: 'y', 
                ykeys: [<?php yKeys2($c_types); ?>],
                labels: [<?php labels($c_types); ?>],
                hideHover: 'auto',
                xLabelAngle: 25,
                barColors: [<?php barColors($colors); ?>],
            });

            // Solicitar datos iniciales de los últimos 7 días:
            requestData(8, chart, group);

        })

        // Cree una función que maneje las solicitudes AJAX
        function requestData(days, chart, group) {
            $.ajax({
                    type: "GET",
                    dataType: 'json',
                    url: "{{ route('member.analysis') }}", // URL de la API
                    data: {
                        interval: days,
                        group,
                        id: "{{ $member->id }}"
                    }
                })
                .done(function(data) {
                    // Cuando llegue la respuesta a la solicitud AJAX, renderice el gráfico con nuevos datos.
                    $('#manual-analysis-hd').html(manual_analysis_hd({
                        group,
                        interval: days,
                        data,
                        c_types: <?php echo json_encode($c_types); ?>
                    }))
                    chart.setData(data);
                })
                .fail(function() {
                    // Si no hay comunicación entre el servidor muestra un error.
                    alert("Ocurrio un error");
                });
        }

        var group = 'mese';
        var switchSelect = (to) => {
            let rangeMin = 1;
            let rangeMax = 7
            if (to == 1) {
                group = 'dia';
                rangeMin = 1;
                rangeMax = 7
            }
            if (to == 3) {
                group = 'mese';
                rangeMin = 1;
                rangeMax = 12
            }
            if (to == 2) {
                group = 'semana';
                rangeMin = 10;
                rangeMax = 30
            }
            if (to == 4) {
                group = 'año';
                rangeMin = 1;
                rangeMax = 10
            }
            $('#m-i').html($('<option>', {
                value: 0,
                text: 'Seleccione el rango',
                selected: 'selected',
                disabled: true,
            }, '</option>'))
            for (let i = rangeMin; i < rangeMax + rangeMin; i = i + rangeMin) {
                $('#m-i').append($('<option>', {
                    value: i,
                    text: `Ultimos  ${i} ${group}s`,
                }, '</option>'));
                $('#m-i').selectpicker('refresh');
            }
        }

        var manual_analysis_hd = (data) => {
            let collection = data.data
            let middle = '';
            nameTotal = []
            let total = 0;
            data.c_types.forEach((i, v) => {
                let name = i.name;
                collection.forEach((c) => {
                    nameTotal[name] = (parseInt(nameTotal[name]) + parseInt(c[name])) || parseInt(c[
                        name])
                    total += parseInt(c[name])
                })
                middle += '<div  id="' + name + '" class="col-xs-2 small adaptive-color" style="">' + name +
                    ': ' + (parseInt(nameTotal[name]) || 0) + '</div>';
            })
            return `
  <marquee>
  <div id="manual-analysis-hd" class="panel-heading bg-primary">
    <div class="col-xs-12 text-center">
      <div class="col-xs-12 panel-title">
        <div  id="specifier" class="col-xs-2 small adaptive-color" style="">Con los ultimos ${data.interval} ${data.group}s  </div>
        ${middle}
        <div  id="total" class="col-xs-2 small adaptive-color" style="">Total: ${total}</div>
      </div>
    </div>
  </div>
  </marquee>
  `
        }

        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            exportEnabled: true,
            title: {
                text: "Calificación general de asistencia"
            },
            subtitles: [{
                text: ""
            }],
            data: [{
                type: "pie",
                showInLegend: "true",
                legendText: "{label}",
                indexLabelFontSize: 16,
                indexLabel: "{label} - #percent%",
                // yValueFormatString: "฿#,##0",
                dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
            }]
        });
        chart.render();
    </script>
@endsection
