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
        Schema::create('menu_makanans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_makan');
            $table->string('menu_pagi');
            $table->string('menu_siang');
            $table->string('menu_malam');
            $table->string('menu_makan');
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
        Schema::dropIfExists('menu_makanans');
    }
};
