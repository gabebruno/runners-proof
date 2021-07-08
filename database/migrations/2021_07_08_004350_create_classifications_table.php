<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('classifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('runner_id');
            $table->unsignedBigInteger('race_id');
            $table->int('position');
            $table->timestamps();

            $table->foreign('runner_id')->references('id')->on('runners');
            $table->foreign('race_id')->references('id')->on('races');

            $table->unique(['race_id', 'runner_id'], 'race_runner_unique');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('classifications');
    }
}
