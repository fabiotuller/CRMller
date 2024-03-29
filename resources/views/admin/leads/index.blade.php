@extends('adminlte::page')

@section('title', 'CRMller')

@section('content_header')
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="col-2 text-dark">Leads</h1>
            @if(session()->has('message'))
                <div class="col-4 alert alert-default-dark">
                    {{ session()->get('message') }}
                </div>
            @endif
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

                    <form action="{{ route('lead.search') }}" method="post" class="form-horizontal">
                        <div class="">
                            {!! csrf_field() !!}
                            <div class="d-flex">
                                <div class="mr-1 filter-id">
                                    <input type="text" class="form-control" name="id" placeholder="Id" value="{{ isset($dataForm) ? $dataForm['id'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="document" placeholder="Document" value="{{ isset($dataForm) ? $dataForm['document'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{ isset($dataForm) ? $dataForm['email'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ isset($dataForm) ? $dataForm['phone'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="{{ isset($dataForm) ? $dataForm['firstname'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="{{ isset($dataForm) ? $dataForm['lastname'] : '' }}">
                                </div>
                                <div class="">
                                    <button type="submit" class="btn btn-sm btn-info">Pesquisar</button>
                                    <a href="{{ route('lead.index') }}" class="text-dark">Limpar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="ml-2 mt-2">
                        <label class="small">Total Registros: {{ $leads->total() }} </label>
                    </div>
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
{{--                        {{dd($leads)}}--}}
                        @forelse($leads as $lead)
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1"> {{ $lead->id }} </td>
                                <td>{{ $lead->document }}</td>
                                <td>{{ $lead->email }}</td>
                                <td>{{ sizeof($lead->relContactPhone) == 0 ? '' : $lead->relContactPhone[0]->phone }}</td>
                                <td>{{ $lead->firstname }}</td>
                                <td>{{ $lead->lastname }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('lead.show', $lead->id) }}" class="btn btn-xs btn-outline-dark">Detalhes</a>
                                        <form action="{{route('lead.destroy', $lead->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                                <input type="hidden" name="id" value="{{ $lead->id }}">
                                                <button class="btn btn-xs btn-outline-danger " onclick="return confirm('Você tem certeza que deseja excluir esse Lead?')"> Apagar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>Nenhum Lead Encontrado!</p>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2">
                        @if(isset($dataForm))
                            {{ $leads->appends($dataForm)->links() }}
                        @else
                            {{ $leads->links() }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
