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
        // https://laravel.com/docs/9.x/migrations#foreign-key-constraints
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('court_id')->nullable()->constrained('courts');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('anonymous_id')->nullable()->constrained('anonymous');
            // $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('cascade');
            $table->enum('state',['empty','pending','booked'])->default('empty')->comment('booked|pending|empty');
            $table->string('book_number')->nullable();
            $table->string('book_date')->nullable();
            $table->string('time_book_start')->nullable();
            $table->string('time_book_end')->nullable();
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
