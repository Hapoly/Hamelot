<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFieldRangesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('field_ranges', function (Blueprint $table) {
      $table->uuid('id');
      $table->primary('id');
      $table->smallInteger('mode');
      $table->string('value', 500);
      $table->integer('min_age')->default(0);
      $table->integer('max_age')->default(0);
      $table->integer('min_weight')->default(0);
      $table->integer('max_weight')->default(0);
      $table->smallInteger('gender')->default(1);
      $table->uuid('field_template_id')->index();
      $table->string('description', 1000);
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('field_ranges');
  }
}
