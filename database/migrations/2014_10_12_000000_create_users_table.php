<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('first_name')->default('NuLL');
            $table->string('last_name')->default('NuLL');
            $table->string('phone')->unique();
            $table->smallInteger('status')->default(1);
            $table->smallInteger('group_code')->default(1);
            $table->smallInteger('public')->default(1);
            $table->string('email', 32)->default('NuLL');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
