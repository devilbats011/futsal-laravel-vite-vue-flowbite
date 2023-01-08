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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_method')->nullable();
            $table->string('online_gateway_name')->nullable();
            $table->enum('payment_status', ['counter', 'pending', 'fail', 'success'])->default('pending')->comment('pending|counter|fail|success');
            //? https://laravel.com/docs/9.x/migrations#foreign-key-constraints
            $table->foreignId('book_id')->nullable()->constrained('books')
                ->onUpdate('cascade')
                ->onDelete('cascade');
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
        Schema::dropIfExists('payments');
    }
};
