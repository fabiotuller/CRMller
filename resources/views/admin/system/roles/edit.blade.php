@extends('adminlte::page')
@section('content')

    <div class=" w-100 d-flex justify-content-between align-items-center">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('role.index') }}"><i class="fa fa-dashboard"></i> Roles</a></li>
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> {{ $role->name }}</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form action="{{route('user.destroy', $role->id)}}" method="post">
            @csrf
            @method('delete')
            <div class="d-flex">
                <input type="hidden" name="id" value="{{ $role->id }}">
                <button class="btn btn-outline-danger btn-sm m-1" onclick="return confirm('Você tem certeza que deseja excluir essa Função?')"> Apagar</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#home"> Dados Cadastrais</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" data-toggle="pill" href="#menu1"> Aba 2</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" data-toggle="pill" href="#menu2"> Aba 3</a>--}}
{{--                        </li>--}}
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade active show">
                            <form action="{{route('role.update', $role->id)}}" method="post" class="form-horizontal">
                                <div class="card-body">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="name" value="{{ $role->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Label</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="label" value="{{ $role->label }}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="pull-right float-right">
                                            <button type="submit" class="btn btn-outline-info">Atualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <h3>Menu 1</h3>
                            <p>Some content in menu 1.</p>
                        </div>
                        <div id="menu2" class="tab-pane fade">
                            <h3>Menu 2</h3>
                            <p>Some content in menu 2.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
