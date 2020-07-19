@extends('adminlte::page')

@section('title', 'CRMller')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <label class="h4">Nova Campanha</label>
                    <form id="newCampaign" action="{{ route('campaign.store') }}" method="post" class="form-horizontal">
                        @csrf
                        @method('put')
                    </form>
                    <form id="searchContacts" action="{{ route('campaign.search.create') }}" method="post" class="form-horizontal">
                        @csrf
                        @method('put')
                    </form>

                        <div class="form-group row">
                            <label class="col-sm-1 col-form-label">Name</label>
                            <div class="col-md-5">
                                <input form="newCampaign" type="text" class="form-control" name="name" value="">
                            </div>

                            <label class="col-sm-1 col-form-label">Description</label>
                            <div class="col-md-5">
                                <input form="newCampaign" type="text" class="form-control" name="description" value="">
                            </div>

                            <label class="col-sm-1 col-form-label">Duration</label>
                            <div class="col-md-5">
                                <input form="newCampaign" type="text" class="form-control" name="duration" value="">
                            </div>
                        </div>

                        <hr>
                        <label class="h5">Filtros</label>
                        <div class="d-flex">
                            <div class="mr-1 form-group">
                                <select form="searchContacts" class="form-control" name="stage" id="stage">
                                    <option selected value="">Stage</option>
                                    @foreach($stages as $stage)
                                        <option {{ request()->session()->has('campaign_create_filter_stage') ? (request()->session()->get('campaign_create_filter_stage') == $stage->label ? 'selected' : '' ): '' }} value="{{ $stage->label }}">{{ $stage->label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mr-1 form-group">
                                <select form="searchContacts" class="form-control" name="region" id="region">
                                        <option selected value="">Region</option>
                                    @for($i=0; $i < $region->count() ; $i++)
                                        <option {{ request()->session()->has('campaign_create_filter_region') ? (request()->session()->get('campaign_create_filter_region') == $region[$i]->uf ? ' selected ' : '' ): '' }} value="{{ $region[$i]->uf }}">{{ $region[$i]->uf }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="mr-1 form-group">
                                <select form="searchContacts" class="form-control" name="city" id="city">
                                    <option selected value="">City</option>
                                    @for($i=0; $i < $city->count() ; $i++)
                                        <option {{ request()->session()->has('campaign_create_filter_city') ? (request()->session()->get('campaign_create_filter_city') == $city[$i]->municipio ? ' selected ' : '' ): '' }} {{ $city[$i]->municipio == NULL ? ' disabled ' : '' }} value="{{ $city[$i]->municipio }}">{{ $city[$i]->municipio }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="">
                                <button form="searchContacts" type="submit" class="btn btn-sm btn-info">Pesquisar</button>
                                <a href="{{ route('campaign.create') }}" {{ request()->session()
                                                                                     ->put(['campaign_create_filter_stage'  => '',
                                                                                            'campaign_create_filter_region' => '',
                                                                                            'campaign_create_filter_city'   => ''
                                                                                     ]) }} class="text-dark">Limpar</a>
                            </div>
                        </div>
                        <div class="">
                            <div class="pull-right float-right">
                                <button form="newCampaign" type="submit" class="btn btn-info">Atualizar</button>
                            </div>
                        </div>
                    <div>
                        <label>{{ $contacts->total() }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
