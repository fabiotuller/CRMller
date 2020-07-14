<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Receitaws extends Model
{
    protected $fillable = [
        'status','message','billing','billing_free','billing_database','cnpj','tipo','abertura','nome','fantasia','atividade_principal','atividade_principal_code','atividade_principal_text','atividades_secundarias','atividades_secundarias_code','atividades_secundarias_text','natureza_juridica','logradouro','numero','complemento','cep','bairro','municipio','uf','email','telefone','efr','situacao','data_situacao','motivo_situacao','situacao_especial','data_situacao_especial','capital_social','qsa','qsa_nome','qsa_qual','qsa_pais_origem','qsa_nome_rep_legal','qsa_qual_rep_legal','extra'
    ];
}
