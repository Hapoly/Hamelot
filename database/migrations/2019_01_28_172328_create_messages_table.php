<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('messages', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('member_id')->index();
      $table->integer('conversation_id')->index();
      $table->smallInteger('type')->default(1);
      $table->string('body', 1000);
      $table->smallInteger('status');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::dropIfExists('messages');
  }
}
