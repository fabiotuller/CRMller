@extends('adminlte::page')

@section('title', 'CRMller')

@section('content_header')
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="col-2 text-dark">Customers</h1>
            @if(session()->has('message'))
                <div class="col-4 alert alert-default-dark">
                    {{ session()->get('message') }}
                </div>
            @endif
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
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Stage</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                        </tr>
                        </thead>
                        <tbody>

                        @forelse($customers as $customer)
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1"> {{ $customer->id }} </td>
                                <td>{{ $customer->document }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->phone1 }}</td>
                                <td>{{ $customer->firstname }}</td>
                                <td>{{ $customer->lastname }}</td>
                                <td>{{ $customer->stage }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-xs btn-outline-dark">Detalhes</a>
                                        <form action="{{route('customer.destroy', $customer->id)}}" method="post">
                                            @csrf
                                            @method('delete')
                                                <input type="hidden" name="id" value="{{ $customer->id }}">
                                                <button class="btn btn-xs btn-outline-danger " onclick="return confirm('Você tem certeza que deseja excluir esse Cliente?')"> Apagar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>Nenhum Cliente Cadastrado!</p>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2">
                        {{ $customers->render() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
