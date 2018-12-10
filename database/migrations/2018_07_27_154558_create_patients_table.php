<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('id_number', 16)->default('NuLL');
            $table->integer('gender')->index()->default(0);
            $table->uuid('user_id')->index()->default(0);
            $table->string('profile', 64)->default('NuLL');
            $table->integer('birth_date')->default(0);
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
        Schema::dropIfExists('patients');
    }
}
