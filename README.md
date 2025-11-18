# Project BPF KLMPK4 - Sistem Manajemen UMKM

Sistem manajemen untuk UMKM dengan fitur Super Admin yang dapat mengelola menu, stok, laporan penjualan, dan akun admin.

## 🚀 Fitur Utama

- **Super Admin Dashboard** - Panel kontrol lengkap untuk super admin
- **Manajemen Menu** - Create, Edit, Delete menu makanan dan minuman
- **Manajemen Stok** - Kelola stok barang dengan status real-time
- **Laporan Penjualan** - Tracking dan analisis penjualan
- **Manajemen Admin** - Buat, edit, dan hapus akun admin
- **Autentikasi** - Sistem login dengan role-based access

## 📋 Persyaratan Sistem

- PHP >= 8.2
- Composer
- MySQL/MariaDB (atau database lain yang didukung)
- Node.js & NPM (untuk assets)
- Laragon (disarankan untuk Windows)

## 🛠️ Instalasi & Setup

### 1. Clone atau Download Project

```bash
cd project_bpf_klmpk4
```

### 2. Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies
npm install
```

### 3. Setup Environment

```bash
# Copy file .env.example ke .env
copy .env.example .env

# Atau di Linux/Mac:
# cp .env.example .env
```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Konfigurasi Database

Edit file `.env` dan sesuaikan konfigurasi database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_bpf_klmpk4
DB_USERNAME=root
DB_PASSWORD=
```

**Untuk Laragon:**
- Buat database baru dengan nama `project_bpf_klmpk4` di phpMyAdmin
- Atau gunakan database yang sudah ada

### 6. Jalankan Migrasi & Seeder

```bash
# Jalankan migrasi
php artisan migrate

# Jalankan seeder untuk membuat super admin
php artisan db:seed --class=AdminSeeder
```

### 7. Buat Storage Link (untuk upload gambar)

```bash
php artisan storage:link
```

### 8. Build Assets (Optional)

```bash
npm run build
```

## 🎯 Menjalankan Aplikasi

### Development Mode

```bash
# Jalankan server Laravel
php artisan serve

# Di terminal terpisah, jalankan Vite untuk assets (jika diperlukan)
npm run dev
```

Aplikasi akan berjalan di: **http://localhost:8000**

### Production Mode

```bash
# Optimize aplikasi
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Build assets
npm run build
```

## 🔐 Login Credentials

Setelah menjalankan seeder, gunakan kredensial berikut:

**Super Admin:**
- Username: `superadmin`
- Password: `superadmin123`

**Admin (Regular):**
- Username: `admin`
- Password: `admin123`

## 📁 Struktur Project

```
project_bpf_klmpk4/
├── app/
│   ├── Http/Controllers/
│   │   ├── AdminAuthController.php
│   │   ├── AdminMenuController.php
│   │   ├── LaporanPenjualanController.php
│   │   ├── StokController.php
│   │   └── SuperAdminController.php
│   └── Models/
│       ├── Admin.php
│       ├── Menu.php
│       ├── StokMenu.php
│       └── LaporanPenjualan.php
├── database/
│   ├── migrations/
│   └── seeders/
│       └── AdminSeeder.php
├── resources/
│   └── views/
│       └── admin/
│           ├── menu/
│           ├── stok/
│           ├── laporan/
│           └── superadmin/
└── routes/
    └── web.php
```

## 🎨 Fitur Super Admin

1. **Manajemen Menu**
   - Tambah menu baru (makanan/minuman)
   - Edit menu
   - Hapus menu
   - Upload gambar menu

2. **Manajemen Stok**
   - Tambah stok barang
   - Update stok
   - Lihat status stok (Tersedia/Menipis/Habis)
   - Hapus stok

3. **Laporan Penjualan**
   - Tambah laporan penjualan
   - Edit laporan
   - Lihat total pesanan dan penjualan
   - Hapus laporan

4. **Manajemen Admin**
   - Buat akun admin baru
   - Edit akun admin
   - Hapus akun admin
   - Atur role (admin/super_admin)

## 🔧 Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: "Storage link tidak ada"
```bash
php artisan storage:link
```

### Error: "Database connection failed"
- Pastikan database sudah dibuat
- Cek konfigurasi di file `.env`
- Pastikan MySQL/MariaDB berjalan

### Error: "Migration table not found"
```bash
php artisan migrate:install
php artisan migrate
```

### Clear Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## 📝 Catatan Penting

- Pastikan folder `storage/app/public` memiliki permission write
- Untuk upload gambar, pastikan folder `storage/app/public/menu_images` ada
- Semua fitur super admin hanya bisa diakses oleh user dengan role `super_admin`

## 🆘 Support

Jika ada masalah, pastikan:
1. Semua dependencies sudah terinstall
2. Database sudah dikonfigurasi dengan benar
3. Migrasi dan seeder sudah dijalankan
4. Storage link sudah dibuat

## 📄 License

MIT License

---

**Selamat menggunakan! 🎉**
