<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('document');
            $table->string('email')->nullable();
            $table->string('alternative_email')->nullable();
            $table->string('phone1',15)->nullable();
            $table->string('phone2',15)->nullable();
            $table->string('phone3',15)->nullable();
            $table->string('phone4',15)->nullable();
            $table->string('phone5',15)->nullable();
            $table->string('firstname',100)->nullable();
            $table->string('lastname',100)->nullable();
            $table->integer('ecommerce_id')->nullable();
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
        Schema::dropIfExists('leads');
    }
}
