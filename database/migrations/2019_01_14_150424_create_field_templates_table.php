<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldTemplatesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('field_templates', function (Blueprint $table) {
      $table->uuid('id');
      $table->primary('id');
      $table->string('title', 45);
      $table->string('description', 1000);
      $table->smallInteger('type');
      $table->string('unit', 32)->default('NuLL');
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
    Schema::dropIfExists('field_templates');
  }
}
