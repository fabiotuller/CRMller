<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceitawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receitaws', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status')->nullable();
            $table->string('message')->nullable();
            $table->string('billing_free')->nullable();
            $table->string('billing_database')->nullable();
            $table->string('cnpj')->nullable();
            $table->string('tipo')->nullable();
            $table->string('abertura')->nullable();
            $table->string('nome')->nullable();
            $table->string('fantasia')->nullable();
            $table->string('atividade_principal_code')->nullable();
            $table->string('atividade_principal_text')->nullable();
            $table->string('atividades_secundarias_code')->nullable();
            $table->string('atividades_secundarias_text')->nullable();
            $table->string('natureza_juridica')->nullable();
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('complemento')->nullable();
            $table->string('cep')->nullable();
            $table->string('bairro')->nullable();
            $table->string('municipio')->nullable();
            $table->string('uf')->nullable();
            $table->string('email')->nullable();
            $table->string('telefone')->nullable();
            $table->string('efr')->nullable();
            $table->string('situacao')->nullable();
            $table->string('data_situacao')->nullable();
            $table->string('motivo_situacao')->nullable();
            $table->string('situacao_especial')->nullable();
            $table->string('data_situacao_especial')->nullable();
            $table->string('capital_social')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('create_receitaws_tables');
    }
}
