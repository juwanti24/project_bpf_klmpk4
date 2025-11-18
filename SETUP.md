# 🚀 Panduan Setup Cepat Project BPF KLMPK4

## Langkah-langkah Setup (Laragon)

### 1. Pastikan Laragon Berjalan
- Buka Laragon
- Pastikan Apache dan MySQL sudah running (hijau)

### 2. Buat Database
- Buka phpMyAdmin (http://localhost/phpmyadmin)
- Buat database baru dengan nama: `project_bpf_klmpk4`
- Atau gunakan terminal:
  ```sql
  CREATE DATABASE project_bpf_klmpk4;
  ```

### 3. Setup Project di Terminal

Buka terminal di folder project, lalu jalankan:

```bash
# 1. Install dependencies
composer install
npm install

# 2. Copy .env
copy .env.example .env

# 3. Generate key
php artisan key:generate

# 4. Edit .env (sesuaikan database jika perlu)
# DB_DATABASE=project_bpf_klmpk4
# DB_USERNAME=root
# DB_PASSWORD=

# 5. Jalankan migrasi
php artisan migrate

# 6. Jalankan seeder
php artisan db:seed --class=AdminSeeder

# 7. Buat storage link
php artisan storage:link
```

### 4. Jalankan Server

```bash
php artisan serve
```

Atau gunakan Laragon untuk auto-start.

### 5. Akses Aplikasi

- Buka browser: **http://localhost:8000**
- Login dengan:
  - Username: `superadmin`
  - Password: `superadmin123`

## ✅ Checklist Setup

- [ ] Composer install selesai
- [ ] NPM install selesai
- [ ] File .env sudah dibuat
- [ ] APP_KEY sudah di-generate
- [ ] Database sudah dibuat
- [ ] Migrasi berhasil
- [ ] Seeder berhasil
- [ ] Storage link sudah dibuat
- [ ] Server berjalan
- [ ] Bisa login sebagai superadmin

## 🐛 Jika Ada Error

### Error: "SQLSTATE[HY000] [1045] Access denied"
- Cek username dan password di `.env`
- Default Laragon: username=`root`, password=(kosong)

### Error: "SQLSTATE[42S02] Base table or view not found"
- Jalankan: `php artisan migrate`

### Error: "Class 'App\Models\Admin' not found"
- Jalankan: `composer dump-autoload`

### Error: "The stream or file could not be opened"
- Pastikan folder `storage/logs` ada dan writable
- Jalankan: `php artisan storage:link`

---

**Selamat! Project siap digunakan! 🎉**

