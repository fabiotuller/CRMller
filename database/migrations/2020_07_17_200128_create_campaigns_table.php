<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->string('filters');
            $table->timestamps();
        });

        Schema::create('campaigns_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('campaigns_id')->unsigned();
            $table->integer('contacts_id')->unsigned();

            $table->foreign('campaigns_id')->references('id')->on('campaigns');
            $table->foreign('contacts_id')->references('id')->on('contacts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::$table->dropForeign('campaigns_contacts_campaigns_id_foreign');
        Schema::$table->dropForeign('campaigns_contacts_contacts_id_foreign');
        Schema::dropIfExists('campaigns_contacts');
        Schema::dropIfExists('campaigns');
    }
}
