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
            $table->integer('user_id')->after('receitaws_id')->unsigned()->nullable();


            $table->foreign('receitaws_id')->references('id')->on('receitaws');
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::$table->dropForeign('contacts_user_id_foreign');
    }
}
