<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperimentFieldsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('experiment_fields', function (Blueprint $table) {
      $table->uuid('id');
      $table->primary('id');
      $table->string('value', 500);
      $table->uuid('field_template_id')->index();
      $table->uuid('experiment_id')->index();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('experiment_fields');
  }
}
