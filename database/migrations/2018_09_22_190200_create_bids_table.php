<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('demand_id')->index();
            $table->integer('date');
            $table->integer('unit_id')->index();
            $table->integer('user_id')->index();
            $table->string('description')->default('NuLL');
            $table->integer('price');
            $table->integer('deposit');
            $table->smallInteger('unit_accepted')->default(0);
            $table->smallInteger('user_accepted')->default(0);
            $table->smallInteger('patient_accepted')->default(0);
            $table->smallInteger('status')->default(1);
            $table->smallInteger('pay_type')->default(0);
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
        Schema::dropIfExists('bids');
    }
}
