# SIM-Edukom

ERP untuk CV Edukom Jaya Abadi. Backend Laravel 13 (API JSON `/api/v1`, Sanctum SPA); frontend React menyusul di repo yang sama.
Panduan kerja dan konvensi: [`CLAUDE.md`](CLAUDE.md) · daftar task: [`docs/tasks/README.md`](docs/tasks/README.md).

## Kebutuhan

- PHP 8.3+ (dikembangkan di 8.4), Composer 2
- Database MySQL 8 / MariaDB 11 dengan `utf8mb4_unicode_ci`

## Setup lokal

```bash
composer install
cp .env.example .env
php artisan key:generate
# isi DB_*, SEED_OWNER_PASSWORD, SEED_ADMIN_PASSWORD di .env
php artisan migrate
php artisan db:seed        # hanya di APP_ENV=local: owner@edukom.test & admin@edukom.test
php artisan serve
```

Akun tambahan: `php artisan edukom:create-user {role} {email} {name}` (kata sandi diminta interaktif).
Peran: `owner`, `admin`, `tentor`, `kurir`, `teknisi`.

Cek layanan: `GET /api/v1/health`. Frontend SPA memanggil `GET /sanctum/csrf-cookie` lebih dulu, lalu `POST /api/v1/auth/login`.
Domain frontend diatur di `SANCTUM_STATEFUL_DOMAINS` dan `CORS_ALLOWED_ORIGINS`.

## Tampilan web (Blade)

```bash
npm install
npm run build      # atau npm run dev saat mengubah tampilan
php artisan serve  # buka http://127.0.0.1:8000/login
```

Halaman: `/login`, `/beranda`, `/akun/kata-sandi`. Warna, font (Poppins, disimpan lokal), ikon (Material Symbols),
dan logo diambil dari design system Stitch "Edukom ERP Operations".

## Database test

Test memakai koneksi database dari `.env` (saat ini `db_edukom` di server remote).
`RefreshDatabase` menjalankan `migrate:fresh`, jadi **semua isi database itu dihapus setiap kali test berjalan**.
Jangan arahkan `.env` ke database yang datanya perlu disimpan saat menjalankan test.

## Menjalankan test dan format kode

```bash
php artisan test              # atau ./vendor/bin/pest
./vendor/bin/pint --test      # cek format; tanpa --test untuk merapikan
```

## Dokumentasi API

```bash
php artisan scribe:generate   # hasil: /docs
```
