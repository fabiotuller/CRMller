@extends('adminlte::page')
@section('content')
    <div class=" w-100 d-flex justify-content-between align-items-center">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('lead.index') }}"><i class="fa fa-dashboard"></i> Leads</a></li>
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> {{ $lead->firstname . ' ' . $lead->lastname}}</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form action="{{route('lead.destroy', $lead->id)}}" method="post">
            @csrf
            @method('delete')
            <div class="d-flex">
                <input type="hidden" name="id" value="{{ $lead->id }}">
                <button class="btn btn-outline-danger btn-sm m-1" onclick="return confirm('Você tem certeza que deseja excluir esse Lead?')"> Apagar</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#home"> Dados Principais</a>
                        </li>
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" data-toggle="pill" href="#menu1"> Outros Contatos</a>--}}
{{--                        </li>--}}
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#menu2"> Receita WS</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade active show">
                            <form action="{{route('lead.update', $lead->id)}}" method="post" class="form-horizontal">
                                <div class="card-body">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Firstname</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="firstname" value="{{ $lead->firstname }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Lastname</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="lastname" value="{{ $lead->lastname }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Document</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="document" value="{{ $lead->document }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Email</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $lead->email }}">
                                            @if($errors->has('email'))
                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Phone</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="phone1" value="{{ $lead->phone1 }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Stage</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" readonly name="stage" value="{{ $lead->stage }}">
                                        </div>
                                    </div>
                                    <hr>

                                    <label class="h4">Outros Contatos</label>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Phone2</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="phone2" value="{{ $lead->phone2 }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Phone3</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="phone3" value="{{ $lead->phone3 }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Others Phones</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="phones_extra" value="{{ $lead->phones_extra }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Alternatives Emails</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control {{ $errors->has('emails_extra') ? 'is-invalid' : '' }}" name="emails_extra" value="{{ $lead->emails_extra }}">
                                            @if($errors->has('emails_extra'))
                                                <div class="text-danger">{{ $errors->first('emails_extra') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="pull-right float-right">
                                            <button type="submit" class="btn btn-info">Atualizar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
{{--                        <div id="menu1" class="tab-pane fade">--}}
{{--                            <form action="{{route('lead.update', $lead->id)}}" method="post" class="form-horizontal">--}}
{{--                                <div class="card-body">--}}
{{--                                    @csrf--}}
{{--                                    @method('put')--}}

{{--                                    <div class="card-footer">--}}
{{--                                        <div class="pull-right float-right">--}}
{{--                                            <button type="submit" class="btn btn-info">Atualizar</button>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
                        <div id="menu2" class="tab-pane fade">
                            <form action="" method="post" class="form-horizontal">
                                <div class="card-body">
                                    @csrf
                                    @method('put')

                                    <div class="{{ $receitaws->status == 'OK' ? 'btn-success' : 'btn-danger' }} row float-right btn mb-3 bg-gradient-light">
                                        <label class="mr-3">Consulta: {{ $receitaws->status }}</label>

                                        <label class="{{ $receitaws->status == 'OK' ? 'd-none' : '' }} mr-3">Mensagem: {{ $receitaws->message }}</label>

                                        <label class="mr-3">Dt Última Consulta: {{ $receitaws->updated_at }}</label>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label">Razão Social</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->nome }}">
                                        </div>

                                        <label class="col-1 col-form-label">Nome Fantasia</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->fantasia }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label">CNPJ</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->cnpj }}">
                                        </div>

                                        <label class="col-1 col-form-label">Tipo</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->tipo }}">
                                        </div>

                                        <label class="col-1 col-form-label">Dt de Abertura</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->abertura }}">
                                        </div>

                                    </div>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label">Situação</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->situacao }}">
                                        </div>

                                        <label class="col-1 col-form-label">Dt Situação</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->data_situacao }}">
                                        </div>

                                        <label class="col-1 col-form-label">Email</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->email }}">
                                        </div>

                                        <label class="col-1 col-form-label">Telefone</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->telefone }}">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Natureza Jurídica</label>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->natureza_juridica }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Capital Social</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ isset($receitaws->capital_social) ? 'R$ ' . $receitaws->capital_social : '' }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Atividade Principal</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->atividade_principal_code }}">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->atividade_principal_text }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Atividade Secundária</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->atividades_secundarias_code }}">
                                        </div>
                                        <div class="col-md-8">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->atividades_secundarias_text }}">
                                        </div>
                                    </div>
                                    <hr>
                                    <label class="h4 mb-3">Endereço</label>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label">Rua</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->logradouro }}">
                                        </div>

                                        <label class="col-1 col-form-label">Número</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->numero }}">
                                        </div>

                                        <label class="col-1 col-form-label">Complemento</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->complemento }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-1 col-form-label">Bairro</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->bairro }}">
                                        </div>

                                        <label class="col-1 col-form-label">Município</label>
                                        <div class="col-md-2">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->municipio }}">
                                        </div>

                                        <label class="col-1 col-form-label">UF</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="nome" readonly value="{{ $receitaws->uf }}">
                                        </div>
                                    </div>

                                    <div class="card-footer">

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
