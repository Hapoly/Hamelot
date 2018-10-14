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
            $table->smallInteger('day_of_week');
            $table->integer('start_time');
            $table->integer('finish_time');
            $table->uuid('unit_user_id')->index();
            $table->smallInteger('status')->default(1);
            $table->boolean('auto_fill')->default(false);
            $table->smallInteger('just_in_unit_visit')->default(1);
            $table->smallInteger('demand_limit')->default(0);
            $table->integer('default_price')->default(0);
            $table->integer('default_deposit')->default(0);
            $table->integer('default_demand_time')->default(0);
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
