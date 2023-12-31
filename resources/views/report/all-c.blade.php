@extends('layouts.app')

@section('title')
    Reporte de Recaudaciones para todos los Ministerios
@endsection

@section('content')
    <?php
    function issetor(&$var, $default = false)
    {
        return isset($var) ? $var : $default;
    } ?>
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Reporte de Recaudaciones</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->
            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li>
                    <a href="forms-general.html#">
                        <i class="demo-pli-home"></i>
                    </a>
                </li>
                <li>
                    <a href="{{ route('attendance') }}">Reportes</a>
                </li>
                <li class="active">Recaudaciones</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->
        </div>
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">{{ $error }}</div>
                        @endforeach
                    @endif
                </div>
                <?php $currency = \Auth::user()->getCurrencySymbol()->currency_symbol; ?>
                <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
                    <div class="panel" style="background-color: #e8ddd3;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Recaudaciones de todos los Ministerios</strong></h3>
                        </div>
                        <div class="panel-body">
                            <table class="table text-center">
                                <thead class="bg-warning text-center">
                                    <tr>
                                        <th colspan="3" class="bg-light text-center">Total de Recaudaciones </th>
                                    </tr>
                                    <tr>
                                        <th>

                                        </th>
                                        <th class="text-center">
                                            Hasta ahora
                                        </th>
                                        <th class="text-center">
                                            Hoy
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>
                                            Monto total recaudado
                                        </th>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{ $currency }}
                                                {{ number_format($reports->collections['total']) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{ $currency }}
                                                {{ number_format($reports->collections['today']) }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
                    <div class="panel" style="background-color: #e8ddd3;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Recaudacion total por tipo</strong></h3>
                        </div>
                        <div class="panel-body">
                            <table class="table text-center">
                                <thead class="bg-warning text-center">
                                    <tr>
                                        <th class="text-center">
                                            Tipo de recaudación
                                        </th>
                                        <th class="text-center">
                                            Hasta ahora
                                        </th>
                                        <th class="text-center">
                                            Hoy
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($c_types as $collect)
                                        <tr>
                                            <th>
                                                {{ $collect->disFormatString() }}
                                            </th>
                                            <td>
                                                <?php $name = $collect->name; ?>
                                                <span class="badge badge-primary badge-pill">{{ $currency }}
                                                    {{ number_format(issetor($reports->collections[$name]['total'])) }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary badge-pill">{{ $currency }}
                                                    {{ number_format(issetor($reports->collections[$name]['today'])) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-success">
                                    <tr>
                                        <th>
                                            Total
                                        </th>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{ $currency }}
                                                {{ number_format($reports->collections['total']) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{ $currency }}
                                                {{ number_format($reports->collections['today']) }}</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <?php $years = [];
                $CcolumnTotals = [];
                foreach ($c_types as $key => $value) {
                    $totals[$value->name] = 0;
                }
                $i = 3;
                while ($i >= 0) {
                    $years[$i] = date('Y', strtotime("-$i year")); //1 year ago
                    $i--;
                } ?>
                <div class="col-md-12 col-md-offset-0" style="margin-bottom:20px">
                    <div class="panel" style="background-color: #e8ddd3; overflow:scroll">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Reporte <i>de los Últimos</i> 4 años</strong> de Recaudación</h3>
                        </div>
                        <div class="panel-body">
                            <table id="demo-dt-basic" class="table table-striped table-bordered datatable" cellspacing="0"
                                width="100%">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Type</th>
                                        @foreach ($years as $key => $value)
                                            <th>{{ $value }}</th>
                                        @endforeach
                                        <th>Total en el año</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($c_types as $type)
                                        <tr>
                                            <th>{{ ucwords($type->disFormatString()) }}</th>
                                            @foreach ($years as $key => $year)
                                                <?php $typeName = $type->name; ?>
                                                @if (isset($c_years->$typeName->$year))
                                                    <?php if (isset($ColumnTotals[$year])) {
                                                        $ColumnTotals[$year] += $c_years->$typeName->$year;
                                                    } else {
                                                        $ColumnTotals[$year] = $c_years->$typeName->$year;
                                                    }
                                                    if (isset($totals[$typeName])) {
                                                        $totals[$typeName] += $c_years->$typeName->$year;
                                                    } else {
                                                        $totals[$typeName] = $c_years->$typeName->$year;
                                                    }
                                                    echo '<td>' . $currency . number_format($c_years->$typeName->$year) . '</td>'; ?>
                                                @else
                                                    <td>No Record</td>
                                                @endif
                                            @endforeach
                                            <th>{{ $currency . '' . number_format($totals[$type->name]) }}</th>
                                            <!-- <td>0</td> -->
                                        </tr>
                                    @endforeach
                                    <!--th scope="row">3</th-->
                                </tbody>
                                <tfoot class="bg-success text-white">
                                    <tr>
                                        <th>Total</th>
                                        <?php
                                        foreach ($years as $key => $year) {
                                            $total = isset($ColumnTotals[$year]) ? $currency . number_format($ColumnTotals[$year]) : '0';
                                            echo "<th>$total</th>";
                                        } ?>
                                        <th><?php $q = 0;
                                        foreach ($totals as $plus => $v) {
                                            $q += $v;
                                        }
                                        echo $currency . number_format($q); ?></th>
                                        <!-- <td>0</td> -->
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-md-8 col-md-offset-2" style="margin-bottom:20px">
                    <div class="panel" style="background-color: #e8ddd3;">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Recolecciones de Ministerios</strong></h3>
                        </div>
                        <div class="panel-body">
                            <table class="table text-center">
                                <thead class="bg-warning text-center">
                                    <tr>
                                        <th class="text-center">
                                            Nombre del Ministerio
                                        </th>
                                        <th class="text-center">
                                            Hasta Ahora
                                        </th>
                                        <th class="text-center">
                                            Hoy
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalTotal = 0;
                                    $todayTotal = 0; ?>
                                    @foreach ($branchesName as $key => $nameObj)
                                        <?php $name = $nameObj->branchname;
                                        $total = isset($reports->branch_collections[$name]) ? $reports->branch_collections[$name]['total'] : 0;
                                        $today = isset($reports->branch_collections[$name]['today']) ? $reports->branch_collections[$name]['today'] : 0;
                                        $totalTotal += isset($reports->branch_collections[$name]) ? $reports->branch_collections[$name]['total'] : 0;
                                        $todayTotal += isset($reports->branch_collections[$name]) ? $reports->branch_collections[$name]['today'] : 0;
                                        ?>
                                        <tr>
                                            <th>
                                                {{ $name }}
                                            </th>
                                            <td>
                                                <span class="badge badge-primary badge-pill">{{ $currency }}
                                                    {{ number_format($total) }}</span>
                                            </td>
                                            <td>
                                                <span class="badge badge-primary badge-pill">{{ $currency }}
                                                    {{ number_format($today) }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="bg-success">
                                    <tr>
                                        <th>
                                            Total
                                        </th>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{ $currency }}
                                                {{ number_format($totalTotal) }}</span>
                                        </td>
                                        <td>
                                            <span class="badge badge-primary badge-pill">{{ $currency }}
                                                {{ number_format($todayTotal) }}</span>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===================================================-->
        <!--End page content-->
    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection
