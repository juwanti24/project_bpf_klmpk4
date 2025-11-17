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
    Schema::create('laporan_penjualan', function (Blueprint $table) {
        $table->id('laporan_id');
        $table->string('bulan');
        $table->integer('total_pesanan');
        $table->decimal('total_penjualan', 12, 2);
        $table->timestamps();
    });
}



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_penjualan');
    }
};
