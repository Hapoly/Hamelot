<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_times', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->smallInt('day_of_week');
            $table->integer('start_time');
            $table->integer('finish_time');
            $table->uuid('unit_user_id')->index();
            $table->smallInteger('status');
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
        Schema::dropIfExists('activity_times');
    }
}
