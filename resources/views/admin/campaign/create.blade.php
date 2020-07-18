@extends('adminlte::page')

@section('title', 'CRMller')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('campaign.search') }}" method="post" class="form-horizontal">
                        <div class="">
                            {!! csrf_field() !!}
                            <div class="d-flex">
                                <div class="mr-1 col-1 filter-id">
                                    <input type="text" class="form-control" name="id" placeholder="Id" value="{{ isset($dataForm) ? $dataForm['id'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{ isset($dataForm) ? $dataForm['name'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="description" placeholder="Description" value="{{ isset($dataForm) ? $dataForm['description'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="filters" placeholder="Filters" value="{{ isset($dataForm) ? $dataForm['filters'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="active" placeholder="Active" value="{{ isset($dataForm) ? $dataForm['active'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="duration" placeholder="Duration" value="{{ isset($dataForm) ? $dataForm['duration'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="created_at" placeholder="Created_at" value="{{ isset($dataForm) ? $dataForm['created_at'] : '' }}">
                                </div>
                                <div class="mr-1">
                                    <input type="text" class="form-control" name="finished_at" placeholder="Finished_at" value="{{ isset($dataForm) ? $dataForm['finished_at'] : '' }}">
                                </div>
                                <div class="">
                                    <button type="submit" class="ml-2 btn btn-sm btn-info">Pesquisar</button>
                                    <a href="{{ route('campaign.index') }}" class="ml-4 text-dark">Limpar</a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="ml-2 mt-2">
                        <label class="small">Total Registros: {{ $campaigns->total() }} </label>
                    </div>
                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Id</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Name</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Description</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Filters</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Active</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Duration (days)</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Created_at</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Finished_at</th>
                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($campaigns as $campaign)
                            <tr role="row" class="odd">
                                <td tabindex="0" class="sorting_1"> {{ $campaign->id }} </td>
                                <td>{{ $campaign->name }}</td>
                                <td>{{ $campaign->description }}</td>
                                <td>{{ $campaign->filters }}</td>
                                <td>{{ $campaign->active }}</td>
                                <td>{{ $campaign->duration }}</td>
                                <td>{{ $campaign->created_at }}</td>
                                <td>{{ $campaign->finished_at }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('campaign.show', $campaign->id) }}" class="btn btn-xs btn-outline-dark">Detalhes</a>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <p>Nenhum Contato Encontrado!</p>
                        @endforelse
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mt-2">
                        @if(isset($dataForm))
                            {{ $campaigns->appends($dataForm)->links() }}
                        @else
                            {{ $campaigns->links() }}
                        @endif
                    </div>
                </div>
            </div>
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <label class="h4">Contatos Fora de Campanhas</label>--}}
{{--                    <form action="{{ route('campaign.search') }}" method="post" class="form-horizontal">--}}
{{--                        <div class="">--}}
{{--                            @csrf--}}
{{--                            <div class="d-flex">--}}
{{--                                <div class="mr-1 filter-id">--}}
{{--                                    <input type="text" class="form-control" name="id" placeholder="Id" value="{{ isset($dataForm) ? $dataForm['id'] : '' }}">--}}
{{--                                </div>--}}
{{--                                <div class="mr-1">--}}
{{--                                    <input type="text" class="form-control" name="document" placeholder="Document" value="{{ isset($dataForm) ? $dataForm['document'] : '' }}">--}}
{{--                                </div>--}}
{{--                                <div class="mr-1">--}}
{{--                                    <input type="text" class="form-control" name="email" placeholder="Email" value="{{ isset($dataForm) ? $dataForm['email'] : '' }}">--}}
{{--                                </div>--}}
{{--                                <div class="mr-1">--}}
{{--                                    <input type="text" class="form-control" name="phone" placeholder="Phone" value="{{ isset($dataForm) ? $dataForm['phone'] : '' }}">--}}
{{--                                </div>--}}
{{--                                <div class="mr-1">--}}
{{--                                    <input type="text" class="form-control" name="firstname" placeholder="Firstname" value="{{ isset($dataForm) ? $dataForm['firstname'] : '' }}">--}}
{{--                                </div>--}}
{{--                                <div class="mr-1">--}}
{{--                                    <input type="text" class="form-control" name="lastname" placeholder="Lastname" value="{{ isset($dataForm) ? $dataForm['lastname'] : '' }}">--}}
{{--                                </div>--}}
{{--                                <div class="">--}}
{{--                                    <button type="submit" class="btn btn-sm btn-info">Pesquisar</button>--}}
{{--                                    <a href="{{ route('campaign.index') }}" class="text-dark">Limpar</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                    <div class="ml-2 mt-2">--}}
{{--                        <label class="small">Total Registros: {{ $contacts->total() }} </label>--}}
{{--                    </div>--}}
{{--                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">--}}
{{--                        <thead>--}}
{{--                        <tr role="row">--}}
{{--                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Id</th>--}}
{{--                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Document</th>--}}
{{--                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">E-mail</th>--}}
{{--                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Phone</th>--}}
{{--                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Firstname</th>--}}
{{--                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Lastname</th>--}}
{{--                            <th class="sorting" tabindex="0" rowspan="1" colspan="1">Actions</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @forelse($contacts as $contact)--}}
{{--                            <tr role="row" class="odd">--}}
{{--                                <td tabindex="0" class="sorting_1"> {{ $contact->id }} </td>--}}
{{--                                <td>{{ $contact->document }}</td>--}}
{{--                                <td>{{ $contact->email }}</td>--}}
{{--                                <td>{{ sizeof($contact->relContactPhone) == 0 ? '' : $contact->relContactPhone[0]->phone }}</td>--}}
{{--                                <td>{{ $contact->firstname }}</td>--}}
{{--                                <td>{{ $contact->lastname }}</td>--}}
{{--                                <td>--}}
{{--                                    <div class="d-flex">--}}
{{--                                        <a href="{{ route('lead.show', $contact->id) }}" class="btn btn-xs btn-outline-dark">Detalhes</a>--}}
{{--                                    </div>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @empty--}}
{{--                            <p>Nenhum Contato Encontrado!</p>--}}
{{--                        @endforelse--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <div class="d-flex justify-content-center mt-2">--}}
{{--                        @if(isset($dataForm))--}}
{{--                            {{ $contacts->appends($dataForm)->links() }}--}}
{{--                        @else--}}
{{--                            {{ $contacts->links() }}--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@stop
