<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('user_id')         ->index()                       ;
            $table->uuid('degree_id')                   ->default(1)        ;
            $table->uuid('field_id')        ->index()   ->default(0)        ;
            $table->string('profile', 64)               ->default('NuLL')   ;
            $table->smallInteger('gender')              ->default(0)        ;
            $table->string('msc', 16)                   ->default('NuLL')   ;
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
        Schema::dropIfExists('doctors');
    }
}
