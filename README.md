# Bank Sampah

Aplikasi web **Bank Sampah** berbasis **Laravel** dengan sistem autentikasi & otorisasi berbasis **role** (Superuser, Admin, User), dashboard berbeda per role, dan manajemen akun admin oleh superuser.

## Fitur

- Autentikasi login/registrasi dengan Laravel.
- 3 role: **Superuser**, **Admin**, **User**.
- Redirect otomatis setelah login ke dashboard sesuai role.
- Proteksi route: tiap role tidak bisa membuka area role lain (middleware `role`).
- Superuser dapat melihat, membuat, dan menghapus akun admin.
- Akun awal (superuser/admin/user) otomatis di-seed ke database.

## Struktur Role

| Role | Path Dashboard | Hak |
|------|---------------|-----|
| `superuser` | `/superuser/dashboard` | Kelola akun admin |
| `admin` | `/admin/dashboard` | (fitur ditambahkan nanti) |
| `user` | `/dashboard` | Nasabah Bank Sampah |

## Persyaratan

- PHP **8.3+** (disarankan 8.4) dengan ekstensi `pdo_mysql`
- Composer
- Node.js + npm (untuk build frontend)
- MySQL / MariaDB (untuk database). Di Windows, pakai **XAMPP** agar mudah.
- Git

## Cara Install & Setup

### 1. Clone repository

```bash
git clone https://github.com/PutraEkaJayaSukarta/BankSampah.git
cd BankSampah
```

### 2. Instal dependensi PHP

```bash
composer install
```

### 3. Salin file environment

```bash
copy .env.example .env      # Windows (cmd)
# cp .env.example .env      # Linux / macOS
```

### 4. Generate application key

```bash
php artisan key:generate
```

### 5. Siapkan database MySQL

#### Opsi A — XAMPP (disarankan)

1. Jalankan modul **Apache** dan **MySQL** di XAMPP Control Panel.
2. Buka `http://localhost/phpmyadmin` lalu buat database bernama **`BankSampah`** (charset `utf8mb4`).
3. Sesuaikan bagian database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=BankSampah
DB_USERNAME=root
DB_PASSWORD=
```

> XAMPP default: username `root`, password kosong.

#### Opsi B — SQLite (tanpa server database)

Biarkan nilai default `.env`:

```env
DB_CONNECTION=sqlite
```

lalu buat file `database/database.sqlite`:

```bash
touch database/database.sqlite
```

### 6. Jalankan migrasi dan seeder

```bash
php artisan migrate --seed
```

Perintah ini membuat semua tabel dan mengisi 3 akun awal:

| Role | Email | Password |
|------|-------|----------|
| Superuser | `superuser@banksampah.test` | `password` |
| Admin | `admin@banksampah.test` | `password` |
| User | `user@banksampah.test` | `password` |

### 7. Instal & build frontend

```bash
npm install
npm run build
```

> Saat development, ganti `npm run build` dengan `npm run dev` (jalankan terus).

### 8. Jalankan aplikasi

```bash
php artisan serve
```

Buka browser: **http://localhost:8000/login**

Masuk dengan salah satu akun awal di atas.

## Menjalankan Test

Test suite memakai SQLite in-memory (tidak mengganggu database MySQL Anda):

```bash
php artisan test
```

## Struktur Penting

- `routes/web.php` — definisi route auth + area per role dengan middleware `auth` dan `role:<nama>`.
- `app/Http/Middleware/CheckUserRole.php` — middleware proteksi role (alias `role`).
- `app/Support/Role.php` — enum role & mapping path dashboard.
- `database/seeders/` — `SuperuserSeeder`, `AdminSeeder`, `UserSeeder`.

## Catatan Keamanan

- Ganti password akun awal sebelum digunakan di lingkungan produksi.
- Jangan commit file `.env` (sudah diabaikan oleh `.gitignore`).
