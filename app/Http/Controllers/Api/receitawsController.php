<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Contact_history;
use App\Http\Controllers\Controller;
use App\Receitaws;
use Illuminate\Http\Request;

class receitawsController extends Controller
{
    private $urlApi = 'https://www.receitaws.com.br/v1/';
    private $token = 'f95f46e1647098d498495fc6536bdd12f2baa2bf7e8e840b7014b4d8a9bb6030';
    private $days = 180;

    public function getApiReceitaws(Receitaws $receitaws)
    {
        $urlApi = $this->urlApi;
        $token = $this->token;
        $days = $this->days;

        $contact = Contact::where('receitaws_id',NULL)->first();
        if (!isset($contact)){

            return view('admin.home');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $urlApi . "cnpj/". $contact->document ."/days/" . $days,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $token
            ),
        ));

        $response = curl_exec($curl);
        $json = json_decode($response);
        curl_close($curl);

        //dd($json);

        $receitaws = new Receitaws();

        if ($json->status == 'ERROR'){
            $receitaws->status = $json->status;
            $receitaws->message = $json->message;
            $receitaws->cnpj = $contact->document;

            $receitaws->save();

            Contact::where('id',$contact->id)->update([
                'receitaws_id' => $receitaws->id
            ]);


            /**
             * Atualizar Ação no History.
             **/
            $history = new Contact_history();
            $history->action = 'Consult_ReceitaWS';
            $history->description = ($json->status == 'ERROR') ? 'Error: ' . $json->message . '!' : 'Consulta Realizada com Sucesso!';
            $history->contact_id = $contact->id;

            $history->save();

            return redirect()->route('lead.index');

        }

        $receitaws->status = $json->status;
        if (isset($json->message)){
            $receitaws->message = $json->message;
        }
        $receitaws->billing_free = $json->billing->free;
        if ($json->billing->database == 1){
            $receitaws->billing_database = 'database'; //true (resolvida pelo banco de dados)
        }else{
            $receitaws->billing_database = 'realtime'; //false (resolvida em tempo real)
        }
        $receitaws->cnpj = $json->cnpj;
        $receitaws->tipo = $json->tipo;
        $receitaws->abertura = $json->abertura;
        $receitaws->nome = $json->nome;
        $receitaws->fantasia = $json->fantasia;
        $receitaws->atividade_principal_code = $json->atividade_principal[0]->code;
        $receitaws->atividade_principal_text = $json->atividade_principal[0]->text;
        $receitaws->atividades_secundarias_code = $json->atividades_secundarias[0]->code;
        $receitaws->atividades_secundarias_text = $json->atividades_secundarias[0]->text;
        $receitaws->natureza_juridica = $json->natureza_juridica;
        $receitaws->logradouro = $json->logradouro;
        $receitaws->numero = $json->numero;
        $receitaws->complemento = $json->complemento;
        $receitaws->cep = $json->cep;
        $receitaws->bairro = $json->bairro;
        $receitaws->municipio = $json->municipio;
        $receitaws->uf = $json->uf;
        $receitaws->email = $json->email;
        $receitaws->telefone = $json->telefone;
        $receitaws->efr = $json->efr;
        $receitaws->situacao = $json->situacao;
        $receitaws->data_situacao = $json->data_situacao;
        $receitaws->motivo_situacao = $json->motivo_situacao;
        $receitaws->situacao_especial = $json->situacao_especial;
        $receitaws->data_situacao_especial = $json->data_situacao_especial;
        $receitaws->capital_social = $json->capital_social;

        $receitaws->save();

        Contact::where('id',$contact->id)->update([
            'receitaws_id' => $receitaws->id
            ]);

        /**
         * Adicionando Ação no History.
         **/
        $history = new Contact_history();
        $history->action = 'Consult_ReceitaWS';
        $history->description = ($json->status == 'ERROR') ? 'Error: ' . $json->message . '!' : 'Consulta Realizada com Sucesso!';
        $history->contact_id = $contact->id;

        $history->save();

        return redirect()->route('lead.index');

    }

    public function store(Request $request)
    {
        $request->urlapi == $this->urlApi;
        $request->token == $this->token;
        $request->days == $this->days;

        return redirect()->route('receitaws.index');

    }

    public function repeat()
    {

    }

}
