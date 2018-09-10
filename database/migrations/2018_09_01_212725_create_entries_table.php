<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 64)->index()->default('NuLL');
            $table->decimal('lon', 12, 10)->index()->default(0);
            $table->decimal('lat', 12, 10)->index()->default(0);
            $table->integer('city_id')->index()->default(0);
            $table->integer('province_id')->index()->default(0);
            
            $table->integer('field_id')->index()->default(0);
            $table->integer('degree_id')->index()->default(0);

            $table->smallInteger('type')->index();
            $table->integer('target_id')->index();
            $table->smallInteger('group_code')->index();
            $table->smallInteger('public')->index();
            $table->smallInteger('status')->indext()->default(1);
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
        Schema::dropIfExists('entries');
    }
}
