<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class SetupGoogleOAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'google:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup Google OAuth untuk login superadmin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('=== Setup Google OAuth untuk Login Superadmin ===');
        $this->newLine();
        
        $envPath = base_path('.env');
        
        if (!File::exists($envPath)) {
            $this->error('File .env tidak ditemukan!');
            return 1;
        }
        
        $envContent = File::get($envPath);
        
        // Cek apakah sudah ada
        $hasClientId = strpos($envContent, 'GOOGLE_CLIENT_ID') !== false;
        $hasClientSecret = strpos($envContent, 'GOOGLE_CLIENT_SECRET') !== false;
        
        if ($hasClientId && $hasClientSecret) {
            $this->info('✓ Google OAuth sudah dikonfigurasi di file .env');
            $this->newLine();
            $this->info('Jalankan: php artisan config:clear');
            return 0;
        }
        
        $this->warn('Google OAuth belum dikonfigurasi!');
        $this->newLine();
        $this->info('Langkah-langkah:');
        $this->line('1. Buka: https://console.cloud.google.com/');
        $this->line('2. Buat project baru atau pilih project yang ada');
        $this->line('3. Aktifkan Google+ API atau Google Identity');
        $this->line('4. Setup OAuth Consent Screen');
        $this->line('5. Buat OAuth 2.0 Client ID');
        $this->line('6. Set Authorized redirect URI: ' . url('/admin/auth/google/callback'));
        $this->newLine();
        
        $clientId = $this->ask('Masukkan GOOGLE_CLIENT_ID');
        $clientSecret = $this->secret('Masukkan GOOGLE_CLIENT_SECRET');
        
        if (empty($clientId) || empty($clientSecret)) {
            $this->error('Client ID dan Secret tidak boleh kosong!');
            return 1;
        }
        
        // Tambahkan ke .env
        $newLines = "\n# Google OAuth Configuration\n";
        $newLines .= "GOOGLE_CLIENT_ID={$clientId}\n";
        $newLines .= "GOOGLE_CLIENT_SECRET={$clientSecret}\n";
        
        File::append($envPath, $newLines);
        
        $this->info('✓ Google OAuth berhasil ditambahkan ke file .env');
        $this->newLine();
        $this->info('Jalankan: php artisan config:clear');
        
        return 0;
    }
}
