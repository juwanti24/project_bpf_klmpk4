<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            if (!Schema::hasColumn('pesanan', 'nama_pelanggan')) {
                $table->string('nama_pelanggan')->nullable()->after('meja_id');
            }
            if (!Schema::hasColumn('pesanan', 'no_hp')) {
                $table->string('no_hp')->nullable()->after('nama_pelanggan');
            }
            if (!Schema::hasColumn('pesanan', 'menu_id')) {
                $table->unsignedBigInteger('menu_id')->nullable()->after('no_hp');
                // don't add FK to avoid migration errors if menu table differs
            }
            if (!Schema::hasColumn('pesanan', 'jumlah')) {
                $table->integer('jumlah')->default(1)->after('menu_id');
            }
            if (!Schema::hasColumn('pesanan', 'catatan')) {
                $table->text('catatan')->nullable()->after('jumlah');
            }
            if (!Schema::hasColumn('pesanan', 'total_harga')) {
                $table->decimal('total_harga', 12, 2)->default(0)->after('catatan');
            }
            if (!Schema::hasColumn('pesanan', 'status')) {
                $table->string('status')->default('Menunggu')->after('total_harga');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pesanan', function (Blueprint $table) {
            $cols = ['status','total_harga','catatan','jumlah','menu_id','no_hp','nama_pelanggan'];
            foreach ($cols as $c) {
                if (Schema::hasColumn('pesanan', $c)) {
                    $table->dropColumn($c);
                }
            }
        });
    }
};
