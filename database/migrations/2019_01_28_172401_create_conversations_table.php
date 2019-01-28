<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('conversations', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title', 100)->default('DEFAULT');
      $table->string('description', 500)->default('DEFAULT');
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
    Schema::dropIfExists('conversations');
  }
}
