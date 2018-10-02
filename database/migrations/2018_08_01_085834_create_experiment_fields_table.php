<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperimentFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiment_fields', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->uuid('report_field_id')->index();
            $table->uuid('experiment_id')->index();
            // values
            $table->integer('value_integer')->default(0);
            $table->string('value_string', 500)->default('NuLL');
            $table->decimal('value_decimal', 12, 4)->default(0);
            $table->boolean('value_boolean')->default(false);
            $table->string('value_image', 64)->default('NuLL');
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
        Schema::dropIfExists('experiment_fields');
    }
}
