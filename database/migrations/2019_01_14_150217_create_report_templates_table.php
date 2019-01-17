<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportTemplatesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('report_templates', function (Blueprint $table) {
      $table->uuid('id');
      $table->primary('id');
      $table->string('title', 100);
      $table->string('description', 500);
      $table->smallInteger('status')->default(1);
      $table->smallInteger('public')->default(1);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('report_templates');
  }
}
