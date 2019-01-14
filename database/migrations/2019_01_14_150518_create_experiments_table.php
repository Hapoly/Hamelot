<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperimentsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('experiments', function (Blueprint $table) {
      $table->uuid('id');
      $table->primary('id');
      $table->uuid('demand_id')->index();
      $table->uuid('report_template_id')->index();
      $table->uuid('patient_id')->index();
      $table->uuid('unit_id')->index()->default('NuLL');
      $table->string('unit_title', 45);
      $table->smallInteger('status')->default(1);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('experiments');
  }
}
