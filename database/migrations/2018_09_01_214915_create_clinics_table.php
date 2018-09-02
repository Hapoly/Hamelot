<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('address', 200)->default('NuLL');
            $table->smallInteger('type')->default(1);
            $table->string('image');
            $table->smallInteger('status')->default(1);
            $table->integer('doctor_id')->index();
            $table->string('phone', 32)->default('NuLL');
            $table->string('mobile', 32)->default('NuLL');
            $table->integer('city_id')->default(0)->index();
            $table->decimal('lon', 12, 10)->default(0);
            $table->decimal('lat', 12, 10)->default(0);
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
        Schema::dropIfExists('clinics');
    }
}
