<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demands', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', 400);
            $table->integer('patient_id')->index();
            $table->integer('address_id')->index();
            $table->integer('unit_id')->index()->default(0);
            $table->integer('user_id')->index()->default(0);
            $table->boolean('asap')->default(false);
            $table->integer('start_time')->default(0);
            $table->integer('end_time')->default(0);
            $table->smallInteger('status')->default(1);
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
        Schema::dropIfExists('demands');
    }
}
