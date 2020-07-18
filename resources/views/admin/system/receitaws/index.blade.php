@extends('adminlte::page')

@section('title', 'CRMller')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <label class="h3 m-3 col-6">ReceitaWS Integration</label>
                    <label class="h3 m-3 col-4 text-bold">Config</label>

                    <div class="d-flex d-inline">
                        <table id="example2" class="col-6 table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Id</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Contact_id</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Status</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Message</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Created_at</th>
                                <th class="sorting" tabindex="0" rowspan="1" colspan="1">Updated_at</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            </tbody>

                        </table>
                        <div class="col-6">
                            <form action="{{ route('receitaws.store') }}" method="post" class="form-horizontal">
                                <div class="card-body">
                                    @csrf

                                    <div class="custom-control custom-switch ml-5 mb-5">
                                        <input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
                                        <label class="custom-control-label" for="customSwitch1">Enable API</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Url API</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="urlapi" value="https://www.receitaws.com.br/v1/">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Token</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="token" value="f95f46e1647098d498495fc6536bdd12f2baa2bf7e8e840b7014b4d8a9bb6030">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Days</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="days" value="180">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <a href="{{ route('receitaws.api') }}" class="col-sm-1 col-form-label">Run</a>
                                    </div>
                                    <div class="">
                                        <div class="pull-right float-right">
                                            <button type="submit" class="btn btn-info">Atualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
