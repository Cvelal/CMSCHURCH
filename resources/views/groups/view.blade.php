@extends('layouts.app')

@section('title')
    Todos los miembros del Grupo
@endsection

@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">

            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Miembros del Grupo</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-home"></i><a href="{{ route('dashboard') }}">Tablero</a>
                </li>
                <li>
                    <i class="fa fa-users"></i><a href="{{ url('groups') }}">Grupos</a>
                </li>
                <li class="active">Miembros</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>


        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            @if (session('status'))
                <!-- Line Chart -->
                <!---------------------------------->
                <div class="panel">
                    <div class="panel-heading">
                    </div>
                    <div class="pad-all">
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
                </div>
                <!---------------------------------->
            @endif

            <!-- Line Chart -->
            <!---------------------------------->
            <?php if(isset($members_in_branch)){ ?>
            <div class="panel" style="background-color: #e8ddd3;">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Agregar miembro al Grupo</h3>
                </div>
                <div class="pad-all">
                    <form method="POST" action="<?php echo route('group.add.member', $group->id); ?>">
                        @csrf
                        <input type="text" name="group_id" value="{{ $group->id }}" hidden=hidden />
                        <p>Miembro de <strong>{{ \Auth::user()->branchname }}</strong> No se encuentra en
                            <strong>{{ strtoupper($group->name) }}</strong> </p>
                        <select class="selectpicker" name="member_id" style="outline:none;height:33px">
                            @foreach ($members_in_branch as $member)
                                @if (!$member->InGroup($group->id))
                                    <option value="{{ $member->id }}">{{ $member->getFullname() }}</option>
                                @endif
                            @endforeach

                        </select>
                        <input class="" type="hidden" value="{{ \Auth::user()->branchcode }}" name="branch_id" />
                        <button type="submit" class="btn btn-success btn-md"><i class="fa fa-plus"></i>Agregar miembro</button>
                    </form>
                </div>
            </div>
            <?php }?>
            <!---------------------------------->
            <!-- Basic Data Tables -->
            <!--===================================================-->
            <div class="panel" style="background-color: #e8ddd3;">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Listar miembros en <strong>{{ strtoupper($group->name) }}</strong>
                        </h3>
                </div>
                <div class="panel-body" style="overflow:scroll">
                    <table id="demo-dt-basic" class="table table-striped table-bordered datatable" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>Fotos</th>
                                <th>Posicion</th>
                                <th>Nombre Completo</th>
                                <th>Ocupación</th>
                                <th class="min-tablet">Estado Marital</th>
                                <th class="min-tablet">Numero de Telefono</th>
                                <th class="min-desktop">Cumpleaños</th>
                                <th class="min-desktop">Miembro desde</th>
                                <th class="min-desktop">Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1; ?>

                            @foreach ($members_in_group as $member)
                                <tr>
                                    <th>{{ $count }}</th>
                                    <th><img src="{{ url('images/') }}/{{ $member->photo }}" class="img-md img-circle"
                                            alt="Foto de Perfil"></th>
                                    <td><strong>{{ strtoupper($member->position) }}</strong></td>
                                    <td>{{ $member->getFullname() }}</td>
                                    <td>{{ $member->occupation }}</td>
                                    <td>{{ $member->marital_status }}</td>
                                    <td>{{ $member->phone }}</td>
                                    <td>{{ $member->dob }}</td>
                                    <td>{{ $member->member_since }}</td>
                                    <td>
                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('member.profile', $member->id) }}">Ver Perfil</a>
                                        @if (isset($members_in_branch))
                                            <a class="btn btn-danger btn-sm"
                                                href="{{ route('group.remove.member', [$member->id, $group->id]) }}">Eliminar
                                                Miembro</a>
                                        @endif

                                    </td>
                                </tr>
                                <?php $count++; ?>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!--===================================================-->
            <!-- End Striped Table -->


        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection
