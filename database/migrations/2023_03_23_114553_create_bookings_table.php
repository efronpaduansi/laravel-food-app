<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('guest_id')->foreignId('guest_id')->constrained('users')->onDelete('cascade');
            $table->integer('menu_id')->foreignId('menu_id')->constrained('menus')->onDelete('cascade');
            $table->integer('qty');
            $table->integer('total');
            $table->string('status');
            $table->string('note')->nullable();
            $table->string('payment');
            $table->string('payment_status');
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
        Schema::dropIfExists('bookings');
    }
}
