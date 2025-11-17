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
    Schema::create('pesanan', function (Blueprint $table) {
        $table->id('pesanan_id');
        $table->foreignId('user_id')->constrained('pelanggan', 'pelanggan_id');
        $table->foreignId('meja_id')->constrained('meja', 'meja_id');
        $table->date('tanggal_pesanan');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanan');
    }
};
