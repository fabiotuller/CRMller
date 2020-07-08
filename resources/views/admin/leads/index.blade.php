@extends('adminlte::page')

@section('title', 'CRMller')

@section('content_header')
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="col-9 text-dark">Leads</h1>
            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalImport">Importar</button>
            @include('admin.leads.modal.import')
        </div>
    </div>
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

                        @forelse($leads as $lead)
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1"> {{ $lead->id }} </td>
                                <td>{{ $lead->document }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ $lead->phone1 }}</td>
                                <td>{{ $lead->firstname }}</td>
                                <td>{{ $lead->lastname }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('formEditLead', $lead->id) }}" class="btn btn-xs btn-outline-dark">Detalhes</a>
                                        <form action="{{route('destroyLead', $lead->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                                <input type="hidden" name="id" value="{{ $lead->id }}">
                                                <button class="btn btn-xs btn-outline-danger " onclick="return confirm('Você tem certeza que deseja excluir esse Lead?')"> Apagar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>nenhum lead cadastrado!</p>
                        @endforelse
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
