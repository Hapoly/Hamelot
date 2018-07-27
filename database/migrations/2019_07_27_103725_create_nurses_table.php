<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurses', function (Blueprint $table) {
            $table->increments('id')                                        ;
            $table->integer('user_id')      ->index()                       ;
            $table->smallInteger('degree')              ->default(1)        ;
            $table->smallInteger('field')   ->index()   ->default(0)        ;
            $table->string('profile', 64)               ->default('NuLL')   ;
            $table->smallInteger('gender')              ->default(0)        ;
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
        Schema::dropIfExists('nurses');
    }
}
