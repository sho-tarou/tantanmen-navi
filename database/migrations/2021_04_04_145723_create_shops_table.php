<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('yahoo_api_id')->nullable();
            $table->string('name')->nullable();
            $table->string('yomi')->nullable();
            $table->string('address')->nullable();
            $table->string('prefecture')->nullable();
            $table->string('station1')->nullable();
            $table->string('railway1')->nullable();
            $table->integer('walking_time1')->nullable();
            $table->string('station2')->nullable();
            $table->string('railway2')->nullable();
            $table->integer('walking_time2')->nullable();
            $table->string('station3')->nullable();
            $table->string('railway3')->nullable();
            $table->integer('walking_time3')->nullable();
            $table->string('parking')->nullable();
            $table->string('tel')->nullable();
            $table->string('pc_url')->nullable();
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
        Schema::dropIfExists('shops');
    }
}
