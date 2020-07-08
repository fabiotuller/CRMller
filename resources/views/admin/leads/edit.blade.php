@extends('adminlte::page')
@section('content')
    <div class=" w-100 d-flex justify-content-between align-items-center">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('leads') }}"><i class="fa fa-dashboard"></i> Leads</a></li>
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> {{ $lead->firstname . ' ' . $lead->lastname}}</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form action="{{route('destroyLead', $lead->id)}}" method="post">
            @csrf
            @method('delete')
            <div class="d-flex">
                <input type="hidden" name="id" value="{{ $lead->id }}">
                <button class="btn btn-outline-danger btn-sm m-1" onclick="confirm('Você tem certeza que deseja excluir esse Lead?')"> Apagar</button>
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
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#menu1"> Aba 2</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#menu2"> Aba 3</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade active show">
                            <form action="{{route('editLead', $lead->id)}}" method="post" class="form-horizontal">
                                <div class="card-body">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Firstname</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="firstname" value="{{ $lead->firstname }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Lastname</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="lastname" value="{{ $lead->lastname }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Document</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="document" value="{{ $lead->document }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="email" value="{{ $lead->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Alternative Email</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="alternative_email" value="{{ $lead->alternative_email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Phone</label>
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="phone1" value="{{ $lead->phone1 }}">
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="pull-right float-right">
                                            <button type="submit" class="btn btn-outline-danger">Atualizar</button>
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
