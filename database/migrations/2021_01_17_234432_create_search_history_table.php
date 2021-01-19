<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearchHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_history', function (Blueprint $table) {
            $table->id();
            $table->string('visitor', 100)->nullable('false');
            $table->string('location', 50)->nullable('true');
            $table->string('temperature', 6)->nullable('true');
            $table->string('zipCode', 5)->nullable('false');
            $table->string('dayTime', 100)->nullable('true');
            $table->dateTime('created_at')->nullable('false');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('search_history');
    }
}
