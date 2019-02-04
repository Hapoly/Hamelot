<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationMembersTable extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::create('conversation_members', function (Blueprint $table) {
      $table->uuid('id');
      $table->primary('id');
      $table->uuid('user_id')->index();
      $table->integer('conversation_id')->index();
      $table->integer('last_read')->datetime();
      $table->integer('last_online')->default(0);
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
    Schema::dropIfExists('conversation_members');
  }
}
