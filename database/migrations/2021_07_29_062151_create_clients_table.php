<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('client_id');
            $table->unsignedInteger('client_category_id')->nullable();
            $table->string('client_name')->nullable();
            $table->integer('client_precedence')->nullable();
            $table->text('client_description')->nullable();
            $table->string('client_logo')->nullable();
            $table->timestamps();

            $table->foreign('client_category_id')->references('client_category_id')->on('client_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
