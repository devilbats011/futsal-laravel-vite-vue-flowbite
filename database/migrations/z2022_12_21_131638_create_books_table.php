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
            $table->foreignId('court_id')->nullable()->constrained('courts');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('anonymous_id')->nullable()->constrained('anonymous');
            $table->enum('state',['empty','booked'])->default('empty')->comment('booked|empty');
            $table->string('time_book')->unique()->nullable(); // 9am-11pm times... book eg: 9am.(date) = 09.10-10-21
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
