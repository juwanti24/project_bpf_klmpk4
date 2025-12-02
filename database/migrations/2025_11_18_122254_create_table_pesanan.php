<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Jika tabel 'pesanan' sudah ada (karena ada migration lain), jangan coba buat ulang.
        if (Schema::hasTable('pesanan')) {
            return;
        }

        Schema::create('pesanan', function (Blueprint $table) {
            $table->id();

            // foreign key pelanggan
            $table->foreignId('pelanggan_id')
                  ->constrained('pelanggans')
                  ->onDelete('cascade');

            // foreign key menu
            $table->foreignId('menu_id')
                  ->constrained('menus')
                  ->onDelete('cascade');

            $table->integer('jumlah');
            $table->integer('total_harga');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        if (Schema::hasTable('pesanan')) {
            Schema::dropIfExists('pesanan');
        }
    }
};
