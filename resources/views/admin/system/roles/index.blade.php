@extends('adminlte::page')

@section('title', 'CRMller')

@section('content_header')
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="col-9 text-dark">Roles</h1>
            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalImport">Cadastrar</button>
            @include('admin.system.roles.modal.new')
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
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Name</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Label</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($roles as $role)
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1">{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->label }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('role.show', $role->id) }}" class="btn btn-xs btn-outline-dark">Detalhes</a>
                                        <form action="{{route('role.destroy', $role->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{ $role->id }}">
                                            <button class="btn btn-xs btn-outline-danger " onclick="return confirm('Você tem certeza que deseja excluir essa Função?')"> Apagar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>Nenhuma Função Cadastrada!</p>
                        @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@stop
