<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //booking -- refer to schema laravel docs
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('court_id')->constrained('courts');
            $table->foreignId('user_id')->constrained('users');
            $table->string('state')->default('empty'); //Booked|Empty
            $table->string('time_book')->unique()->nullable(); // 9am-11pm times... book eg: 9am = 09
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
        Schema::dropIfExists('books');
    }
};
