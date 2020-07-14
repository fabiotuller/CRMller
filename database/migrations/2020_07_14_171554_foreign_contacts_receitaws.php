<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignContactsReceitaws extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('contacts',function ($table){
            $table->integer('receitaws_id')->after('id')->unsigned()->nullable();
            $table->foreign('receitaws_id')->references('id')->on('receitaws');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::$table->dropForeign('contacts_receitaws_id_foreign');
    }
}
