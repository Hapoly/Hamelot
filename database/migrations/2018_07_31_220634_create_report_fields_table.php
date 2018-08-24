<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_fields', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 32);
            $table->string('description', 200);
            $table->string('label', 16);
            $table->integer('report_template_id')->index();
            $table->smallInteger('type');
            $table->string('quantity', 32)->default('NuLL');
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
        Schema::dropIfExists('report_fields');
    }
}
