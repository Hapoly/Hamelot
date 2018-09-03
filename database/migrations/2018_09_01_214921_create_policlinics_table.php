<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliclinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('policlinics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 32);
            $table->string('address', 200)->default('NuLL');
            $table->string('image');
            $table->smallInteger('status')->default(env('POLICLINIC_STATUS_DEFAULT'));
            $table->smallInteger('type')->default(env('POLICLINIC_TYPE_DEFAULT'));
            $table->smallInteger('public')->default(env('POLICLINIC_PUBLIC_DEFAULT'));
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
        Schema::dropIfExists('policlinics');
    }
}
