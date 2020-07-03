@extends('adminlte::page')

@section('title', 'CRMller')

@section('content_header')
    <h1 class="m-0 text-dark">Leads</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Id</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Document</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">E-mail</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Phone</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Firstname</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Lastname</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 0; $i < 50; $i++)
                        <tr role="row" class="odd">
                            <td tabindex="0" class="sorting_1"> {{ $i + 1 }} </td>
                            <td>{{ mt_rand() }}</td>
                            <td>{{ str_shuffle('fabiomonique') . '@gmail.com' }}</td>
                            <td>{{ '(11) 9' . mt_rand(9000,9999) . mt_rand(1000,9999) }}</td>
                            <td>Fábio e Monique</td>
                            <td>Tuller</td>
                            <td><a href="#" class="btn btn-xs btn-outline-dark">Detalhes</a><a href="#" class="btn btn-xs btn-outline-danger ml-2">Apagar</a></td>
                        </tr>
                        @endfor
                        </tbody>
                        <tfoot>
                        <tr>
                            <th rowspan="1" colspan="1">Id</th>
                            <th rowspan="1" colspan="1">Document</th>
                            <th rowspan="1" colspan="1">E-mail</th>
                            <th rowspan="1" colspan="1">Phone</th>
                            <th rowspan="1" colspan="1">Firstname</th>
                            <th rowspan="1" colspan="1">Lastname</th>
                            <th rowspan="1" colspan="1">Actions</th>
                        </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
        </div>
    </div>
@stop
