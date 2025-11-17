<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('stok_menu', function (Blueprint $table) {
        $table->id('stok_id');
        $table->foreignId('menu_id')->constrained('menu', 'menu_id');
        $table->integer('jumlah_stok');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_menu');
    }
};
