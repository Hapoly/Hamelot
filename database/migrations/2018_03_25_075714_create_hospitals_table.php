<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHospitalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hospitals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('address');
            $table->string('phone', 32)->default('NuLL');
            $table->string('mobile', 32)->default('NuLL');
            $table->string('image')->default('NuLL');
            $table->decimal('lon', 12, 10)->default(0);
            $table->decimal('lat', 12, 10)->default(0);
            $table->integer('city_id')->default(0)->index();
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
        Schema::dropIfExists('hospitals');
    }
}
