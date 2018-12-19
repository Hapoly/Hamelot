<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('title');
            $table->string('slug', 64)->index()->unique();
            $table->string('address', 200);
            $table->string('phone', 32)->default('NuLL');
            $table->string('mobile', 32)->default('NuLL');
            $table->string('image')->default('NuLL');
            $table->decimal('lon', 12, 10)->default(0);
            $table->decimal('lat', 12, 10)->default(0);
            $table->uuid('city_id')->default(0)->index();
            $table->smallInteger('group_code');

            $table->smallInteger('status')->default(env('UNIT_STATUS_DEFAULT'));
            $table->smallInteger('type')->default(env('UNIT_TYPE_DEFAULT'));
            $table->smallInteger('public')->default(env('UNIT_PUBLIC_DEFAULT'));

            $table->smallInteger('comission')->default(env('COMISSION_PERCENT'));

            $table->uuid('parent_id')->index()->default(0);
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
        Schema::dropIfExists('units');
    }
}
