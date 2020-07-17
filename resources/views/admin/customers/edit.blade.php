@extends('adminlte::page')
@section('content')
    <div class=" w-100 d-flex justify-content-between align-items-center">
        <ol class="breadcrumb small">
            <li class="breadcrumb-item"><a href="{{ route('customer.index') }}"><i class="fa fa-dashboard"></i> Customer</a></li>
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> {{ $customer->firstname . ' ' . $customer->lastname}}</a></li>
            <li class="breadcrumb-item active">Editar</li>
        </ol>
        <form action="{{route('customer.destroy', $customer->id)}}" method="post">
            @csrf
            @method('delete')
            <div class="d-flex">
                <input type="hidden" name="id" value="{{ $customer->id }}">
                <button class="btn btn-outline-danger btn-sm m-1" onclick="return confirm('Você tem certeza que deseja excluir esse Cliente?')"> Apagar</button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-danger card-outline card-outline-tabs">
                <div class="card-header p-0 border-bottom-0">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#home"> Dados Cadastrais</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#menu2"> Receita WS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#menu3"> Histórico</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <div id="home" class="tab-pane fade active show">
                            <form action="{{route('customer.update', $customer->id)}}" method="post" class="form-horizontal">
                                <div class="card-body">
                                    @csrf
                                    @method('put')
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Firstname</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="firstname" value="{{ $customer->firstname }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Lastname</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="lastname" value="{{ $customer->lastname }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Document</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" name="document" value="{{ $customer->document }}">
                                        </div>

                                        <label class="col-sm-1 col-form-label">Email</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ $customer->email }}">
                                            @if($errors->has('email'))
                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Phone</label>
                                        <div class="col-md-3">
                                            <input type="text" class="form-control" name="{{ sizeof($contactPhone) == 0 ? 'phoneid' : 'phoneid' . $contactPhone[0]->id }}" value="{{ sizeof($contactPhone) == 0 ? '' : $contactPhone[0]->phone }}">
                                        </div>
                                        <label class="col-form-label">Rating</label>
                                        <div class="col-md-1 mr-4">
                                            <input type="text" class="form-control" name="{{ sizeof($contactPhone) == 0 ? 'ratingid' : 'ratingid' . $contactPhone[0]->id }}" value="{{ sizeof($contactPhone) == 0 ? '' : $contactPhone[0]->rating }}">
                                        </div>

                                        <label class="ml-md-5 col-sm-1 col-form-label">Stage</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control" readonly name="stage" value="{{ $customer->stage }}">
                                        </div>
                                    </div>
                                    <hr>

                                    <label class="h4">Outros Contatos</label>
                                    @php($i = 0)
                                    @foreach($contactPhone as $phone)
                                        @if($i <> 0 AND $i < 5)
                                            <div class="form-group row">
                                                <label class="col-sm-1 col-form-label">{{ 'Phone ' . $i}}</label>
                                                <div class="col-md-3">
                                                    <input type="text" class="form-control" name="{{ 'phoneid' . $phone->id }}" value="{{ $phone->phone }}">
                                                </div>
                                                <label class="col-form-label">Rating</label>
                                                <div class="col-md-1 mr-4">
                                                    <input type="text" class="form-control" name="{{ 'ratingid' . $phone->id }}" value="{{ $phone->rating }}">
                                                </div>
                                            </div>
                                        @endif()
                                        @php($i++)
                                    @endforeach
                                    <div class="form-group row">
                                        <label class="col-sm-1 col-form-label">Alternatives Emails</label>
                                        <div class="col-md-5">
                                            <input type="text" class="form-control {{ $errors->has('emails_extra') ? 'is-invalid' : '' }}" name="emails_extra" value="{{ $customer->emails_extra }}">
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


                                </div>
                            </form>
                        </div>
                        <div id="menu3" class="tab-pane fade card-body">
                            <table id="" class="table table-bordered table-hover dataTable dtr-inline col-6" role="grid" aria-describedby="">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Action</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Description</th>
                                    <th class="sorting" tabindex="0" rowspan="1" colspan="1">Created_at</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($histories as $history)
                                    <tr role="row" class="odd">
                                        <td>{{ $history->action }}</td>
                                        <td>{{ $history->description }}</td>
                                        <td>{{ $history->created_at->format('d-m-Y H:i:s') }}</td>
                                    </tr>
                                @empty
                                    <p>Nenhum Histórico Encontrado!</p>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
