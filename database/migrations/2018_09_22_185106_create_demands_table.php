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
            $table->uuid('id');
            $table->primary('id');
            $table->string('description', 400);
            $table->uuid('patient_id')->index();
            $table->uuid('address_id')->index();
            $table->uuid('unit_id')->index()->default(0);
            $table->uuid('user_id')->index()->default(0);
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
