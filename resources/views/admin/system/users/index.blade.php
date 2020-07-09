@extends('adminlte::page')

@section('title', 'CRMller')

@section('content_header')
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="col-9 text-dark">Leads</h1>
            <button type="button" class="btn btn-info btn-md" data-toggle="modal" data-target="#modalImport">Cadastrar</button>
            @include('admin.system.users.modal.new')
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
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">E-mail</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Role_name</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($users as $user)
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1"> {{ $user->id }} </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $roles[$user->role_id - 1]->name }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('user.show', $user->id) }}" class="btn btn-xs btn-outline-dark">Detalhes</a>
                                        <form action="{{route('user.destroy', $user->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button class="btn btn-xs btn-outline-danger " onclick="return confirm('Você tem certeza que deseja excluir esse Usuário?')"> Apagar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>Nenhum Usuário Cadastrado!</p>
                        @endforelse
                        </tbody>

                    </table>

                </div>
            </div>
        </div>
    </div>
@stop
