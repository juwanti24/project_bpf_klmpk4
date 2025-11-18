# ⚡ Quick Start Guide

## Setup Cepat (5 Menit)

### 1. Buat Database
```sql
CREATE DATABASE project_bpf_klmpk4;
```

### 2. Buat File .env
Buat file `.env` di root project dengan isi:

```env
APP_NAME="UMKM Admin"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=project_bpf_klmpk4
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database
QUEUE_CONNECTION=database
CACHE_STORE=database
FILESYSTEM_DISK=local
```

### 3. Jalankan Setup
```bash
# Install dependencies
composer install
npm install

# Generate key
php artisan key:generate

# Migrate & Seed
php artisan migrate
php artisan db:seed --class=AdminSeeder

# Storage link
php artisan storage:link

# Run server
php artisan serve
```

### 4. Login
- URL: http://localhost:8000
- Username: `superadmin`
- Password: `superadmin123`

## 🎯 Atau Gunakan Script Otomatis

**Windows:**
```bash
setup.bat
```

Script akan melakukan semua setup otomatis!

---

**Done! 🚀**

