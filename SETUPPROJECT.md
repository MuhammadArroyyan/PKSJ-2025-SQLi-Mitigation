# 📚 Panduan Setup Aplikasi Kuisioner

## 📋 Daftar Isi
1. [Persyaratan Sistem](#persyaratan-sistem)
2. [Instalasi Awal](#instalasi-awal)
3. [Konfigurasi Database](#konfigurasi-database)
4. [Setup Aplikasi](#setup-aplikasi)
5. [Verifikasi Instalasi](#verifikasi-instalasi)
6. [Akun Demo & Testing](#akun-demo--testing)
7. [Troubleshooting](#troubleshooting)

---

## 🔧 Persyaratan Sistem

### Minimum Requirements:
- **PHP**: 8.1 atau lebih tinggi
- **MySQL/MariaDB**: 8.0 atau lebih tinggi
- **Composer**: versi terbaru
- **Node.js**: 14.x atau lebih tinggi (untuk asset compilation)
- **Web Server**: Apache/Nginx (atau gunakan Laravel Artisan server)

### Software yang Direkomendasikan:
- **Laragon** (untuk Windows) - includes PHP, MySQL, Apache
- **XAMPP** (alternative untuk Windows)
- **LAMP Stack** (untuk Linux)
- **MAMP** (untuk macOS)

---

## ⚡ Instalasi Awal

### Step 1: Clone/Download Project
```bash
# Asumsikan project sudah ada di folder aplikasi-kuisioner
cd c:\laragon\www\aplikasi-kuisioner
# atau
cd /var/www/html/aplikasi-kuisioner
```

### Step 2: Install PHP Dependencies
```bash
composer install
```

### Step 3: Install Node Dependencies
```bash
npm install
# atau
yarn install
```

### Step 4: Setup Environment File
```bash
# Copy file .env.example ke .env
cp .env.example .env
# atau di Windows
copy .env.example .env
```

### Step 5: Generate Application Key
```bash
php artisan key:generate
```

---

## 🗄️ Konfigurasi Database

### Step 1: Buat Database Baru di MySQL

**Option A: Menggunakan MySQL CLI**
```sql
mysql -u root -p
CREATE DATABASE aplikasi_kuisioner CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
EXIT;
```

**Option B: Menggunakan PhpMyAdmin**
1. Buka `http://localhost/phpmyadmin`
2. Login dengan username: `root` (tanpa password)
3. Klik "New" atau "Buat Database Baru"
4. Masukkan nama: `aplikasi_kuisioner`
5. Pilih Collation: `utf8mb4_unicode_ci`
6. Klik "Create"

### Step 2: Update File .env
Buka file `.env` di root project dan ubah bagian database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aplikasi_kuisioner
DB_USERNAME=root
DB_PASSWORD=
```

**Catatan**: 
- Jika menggunakan Laragon, `DB_PASSWORD` kosong
- Jika menggunakan XAMPP dengan password, masukkan password Anda
- `DB_HOST` bisa juga `localhost` tergantung konfigurasi

### Step 3: Import Database Dump

**Option A: Menggunakan PhpMyAdmin**
1. Buka `http://localhost/phpmyadmin`
2. Pilih database `aplikasi_kuisioner`
3. Klik tab "Import"
4. Upload file SQL dump yang disediakan: `aplikasi_kuisioner.sql`
5. Klik "Go" untuk import

**Option B: Menggunakan MySQL CLI**
```bash
mysql -u root -p aplikasi_kuisioner < aplikasi_kuisioner.sql
# atau tanpa password
mysql -u root aplikasi_kuisioner < aplikasi_kuisioner.sql
```

**Option C: Menggunakan Laragon UI**
1. Klik kanan pada Laragon tray icon
2. Pilih "MySQL" → "Open MySQL Console"
3. Jalankan:
```sql
USE aplikasi_kuisioner;
SOURCE /path/to/aplikasi_kuisioner.sql;
```

---

## 🚀 Setup Aplikasi

### Step 1: Jalankan Database Migrations (Optional - Data sudah ada di dump)
```bash
# Database sudah ter-setup dari dump, tapi bisa verify dengan:
php artisan migrate:status
```

### Step 2: Compile Assets (CSS/JS)
```bash
# Development
npm run dev

# Production
npm run build
```

### Step 3: Generate Storage Link
```bash
php artisan storage:link
```

### Step 4: Clear Cache
```bash
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Step 5: Mulai Development Server
```bash
# Option 1: Menggunakan Laragon (Recommended)
# Cukup start Laragon dan buka http://localhost/aplikasi-kuisioner

# Option 2: Menggunakan Artisan Serve
php artisan serve
# Akses di http://localhost:8000
```

---

## ✅ Verifikasi Instalasi

### Test 1: Akses Halaman Login
```
URL: http://localhost/aplikasi-kuisioner
atau
URL: http://localhost:8000
```

Anda harus melihat:
- Halaman login dengan desain **Dark Mode Indigo**
- Input fields untuk Email dan Password
- Tombol login gradient indigo

### Test 2: Database Connection
Jalankan command berikut untuk verify database connection:
```bash
php artisan tinker
>>> DB::connection()->getPdo()
# Jika tidak error, database sudah terkoneksi
```

### Test 3: Jalankan Seeder (Optional - Data sudah ada)
```bash
# Jika perlu reset dan seed ulang
php artisan migrate:fresh --seed
```

---

## 👥 Akun Demo & Testing

Setelah database berhasil di-import, Anda bisa login dengan akun-akun berikut:

### 1️⃣ Admin Account
```
Email: admin@admin.com
Password: admin
Role: Admin
```
**Akses**: Kelola semua entity (Fakultas, Jurusan, Prodi, Mahasiswa, Users)

### 2️⃣ Kaprodi Accounts
```
Email: kaprodi.ti@umrah.co.id
Password: kaprodi
Role: Kaprodi (Teknik Informatika)
---
Email: kaprodi.tp@umrah.co.id
Password: kaprodi
Role: Kaprodi (Teknik Perkapalan)
```
**Akses**: Kelola Periode, Pertanyaan, Jawaban Mahasiswa, Summary untuk prodi mereka

### 3️⃣ Pimpinan Account
```
Email: pimpinan@umrah.co.id
Password: pimpinan
Role: Pimpinan Fakultas
```
**Akses**: Lihat summary dan laporan dari semua prodi

### 4️⃣ Mahasiswa Account
```
Email: 2301020002@umrah.ac.id
Password: 2301020002
Nama: Rizqi Amanullah
NIM: 2301020002
```
**Akses**: Isi kuisioner yang tersedia

---

## 📊 Struktur Database

### Tabel Utama:
1. **users** - Akun pengguna (4 roles: admin, kaprodi, mahasiswa, pimpinan)
2. **fakultas** - Daftar fakultas
3. **jurusan** - Daftar jurusan
4. **prodi** - Program studi
5. **mahasiswa** - Data mahasiswa
6. **periode_kuisioner** - Periode survei (2 data: Ganjil active, Genap draft)
7. **pertanyaan** - Pertanyaan kuisioner (5 pertanyaan)
8. **pilihan_jawaban_pertanyaan** - Opsi jawaban (22 pilihan)
9. **pertanyaan_periode_kuisioner** - Mapping periode dengan pertanyaan
10. **jawaban** - Jawaban mahasiswa terhadap pertanyaan

### Relasi Foreign Key:
- `jurusan` → `fakultas` (cascade delete)
- `prodi` → `jurusan` (cascade delete)
- `mahasiswa` → `prodi` (cascade delete)
- `jawaban` → `pertanyaan`, `periode_kuisioner`, `mahasiswa`

---

## 🎨 Fitur Aplikasi

### Admin Dashboard
- ✅ CRUD Fakultas
- ✅ CRUD Jurusan
- ✅ CRUD Prodi
- ✅ CRUD Mahasiswa (auto-create user dengan email NIM@umrah.ac.id)
- ✅ CRUD Users

### Kaprodi Dashboard
- ✅ CRUD Periode Kuisioner
- ✅ CRUD Pertanyaan
- ✅ Lihat Jawaban Mahasiswa
- ✅ Summary/Report per Periode dengan Percentage

### Mahasiswa Dashboard
- ✅ List Periode Kuisioner yang Aktif
- ✅ Isi Kuisioner
- ✅ Edit Jawaban (jika periode masih aktif)

### Pimpinan Dashboard
- ✅ Lihat Summary semua Prodi
- ✅ Detail Report per Prodi

### Fitur Umum
- ✅ Dark Mode Indigo Color Scheme
- ✅ Password Reset/Change dari Dashboard
- ✅ Session Management (File-based)
- ✅ CSRF Protection
- ✅ Role-based Authorization

---

## 🔐 Keamanan

### Implemented Security:
- ✅ Password hashing dengan bcrypt
- ✅ CSRF token protection
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ XSS protection dengan Blade escaping
- ✅ Role-based middleware protection
- ✅ Session-based authentication

### Best Practices Applied:
- ✅ Password default untuk mahasiswa adalah NIM mereka (harus diganti)
- ✅ Cascade delete untuk menjaga referential integrity
- ✅ File-based session driver untuk production
- ✅ Email validation dan unique constraints

---

## 🛠️ Troubleshooting

### Issue 1: "Connection refused" saat Database Connection
**Solusi**:
```bash
# Pastikan MySQL/MariaDB sudah running
# Laragon: Click "Start All" atau double-click icon
# XAMPP: Jalankan MySQL dari control panel
# Linux: sudo systemctl start mysql
```

### Issue 2: "Column count doesn't match value count at row 1"
**Solusi**:
```bash
# Database sudah ada dan ada conflict
# Drop database lama:
mysql -u root -p
DROP DATABASE aplikasi_kuisioner;
# Buat yang baru dan import ulang
```

### Issue 3: "No such table: users"
**Solusi**:
```bash
# Migrations belum jalan atau database belum di-import
# Verify database:
php artisan tinker
>>> DB::table('users')->count()

# Jika tidak ada data, import SQL dump ulang
```

### Issue 4: "Class 'PDO' not found"
**Solusi**:
```bash
# PHP PDO extension tidak terinstall
# Laragon: Klik menu → Preferences → bahasa PHP → ensure PDO checked
# XAMPP: Edit php.ini dan uncomment extension=pdo_mysql
```

### Issue 5: "Session not persisting"
**Solusi**:
Pastikan di `.env`:
```env
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### Issue 6: "CORS/CSRF token mismatch"
**Solusi**:
```bash
# Clear cache
php artisan cache:clear
php artisan view:clear
php artisan config:clear
```

### Issue 7: Asset CSS/JS tidak load
**Solusi**:
```bash
# Compile ulang assets
npm run dev

# Atau clear browser cache (Ctrl+Shift+Delete)
```

---

## 📞 Support & Testing

### Periksa Health Status
```bash
# Check database
php artisan tinker
>>> DB::table('users')->count()  // Harus 5

# Check routes
php artisan route:list

# Check migrations
php artisan migrate:status
```

### Generate Test Data (Optional)
```bash
# Jika perlu tambah mahasiswa baru, bisa lewat Admin Panel
# Atau jalankan seeder:
php artisan db:seed --class=_2301020095_DatabaseSeeder
```

### Reset Seluruh Database
```bash
# HATI-HATI! Ini akan menghapus semua data
php artisan migrate:fresh --seed
```

---

## 📝 Environment Variables Penting

Pastikan `.env` file memiliki:

```env
APP_NAME="Aplikasi Kuisioner"
APP_ENV=local
APP_KEY=base64:xxxxx (auto-generated)
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=aplikasi_kuisioner
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
SESSION_LIFETIME=120
```

---

## ✨ Customization Tips

### Ubah Warna Primary
Edit file: `resources/views/layouts/app.blade.php`
Cari: `#6366f1` (Indigo)
Ganti dengan warna pilihan Anda

### Ubah Judul Aplikasi
Edit `.env`:
```env
APP_NAME="Nama Aplikasi Baru"
```

### Setup Email (Optional)
Edit `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS=your-email@gmail.com
```

---

## 📖 Dokumentasi Tambahan

- **Laravel Documentation**: https://laravel.com/docs
- **Eloquent ORM**: https://laravel.com/docs/eloquent
- **Blade Templating**: https://laravel.com/docs/blade
- **Database Migrations**: https://laravel.com/docs/migrations

---

## 🎉 Selesai!

Jika semua langkah berhasil, aplikasi siap digunakan. Silakan login dengan akun demo yang tersedia dan explore fitur-fiturnya.

**Happy coding! 🚀**

---

**Last Updated**: December 14, 2025  
**Version**: 1.0  
**Framework**: Laravel 11
