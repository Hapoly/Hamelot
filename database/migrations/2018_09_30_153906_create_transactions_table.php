<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->smallInteger('type')->index();
            $table->uuid('src_id')->index();
            $table->uuid('dst_id')->index();
            $table->uuid('target')->index();
            $table->integer('amount');
            $table->string('authority');
            $table->string('currency', 3);
            $table->smallInteger('pay_type');
            $table->smallInteger('status')->default(1);
            $table->integer('date');
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
        Schema::dropIfExists('transactions');
    }
}
