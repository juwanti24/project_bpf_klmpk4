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
    Schema::create('menu', function (Blueprint $table) {
        $table->id('menu_id');
        $table->string('nama_menu');
        $table->enum('kategori', ['makanan', 'minuman']);
        $table->text('deskripsi')->nullable();
        $table->decimal('harga', 10, 2);
        $table->string('gambar_menu')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
