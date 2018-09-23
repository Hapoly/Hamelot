<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demand_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id')->index();
            $table->integer('experiment_id')->index();
            $table->integer('price')->default(0);
            $table->smallInteger('status')->default(1);
            $table->smallInteger('pay_type');
            $table->string('authority');
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
        Schema::dropIfExists('demand_events');
    }
}
