# Progress — Irisan Owner

Status: ⬜ Belum · 🟡 Berjalan · ✅ Selesai · ⛔ Terhambat

Diperbarui oleh agent di akhir setiap task. Manusia memeriksa dan mengubah status ke ✅ setelah review dan merge.

## Ringkasan

| Task | Judul | Status | Branch | Selesai | Catatan singkat |
|---|---|---|---|---|---|
| T0.1 | Autentikasi (Laravel sudah terpasang) | 🟡 | feat/t0-1-autentikasi | 2026-11-25 | Menunggu review; 24 test lulus |
| T0.2 | Hak akses berbasis peran | 🟡 | feat/t0-2-hak-akses | 2026-11-25 | Menunggu review; 21 test baru lulus |
| T0.3 | Riwayat perubahan (audit trail) | 🟡 | feat/t0-3-audit-trail | 2026-11-25 | Menunggu review; 16 test baru lulus |
| T0.4 | Notifikasi di dalam sistem | ⬜ | | | |
| T0.5 | Periode penggajian (minimal) dan pola data berversi | ⬜ | | | |
| T1.1 | Parameter kebijakan berversi (OW-02, AD-27) | ⬜ | | | |
| T1.2 | Komponen honorarium dan tarif berversi (OW-01, AD-27) | ⬜ | | | |
| T1.3 | Tingkatan jarak uang transportasi (OW-01.4) | ⬜ | | | |
| T1.4 | Daftar alasan penolakan izin (OW-03) | ⬜ | | | |
| T1.5 | Konsolidasi Fase 1: akses Admin, riwayat, dokumentasi, data demo | ⬜ | | | |
| T2.0 | (Manual) Perbaiki dan lengkapi desain di Stitch | ⬜ | | | |
| T2.1 | Setup frontend, koneksi Stitch MCP, dan design tokens | ⬜ | | | |
| T2.2 | Login, layout Owner, menu, Beranda, notifikasi | ⬜ | | | |
| T2.3 | Halaman Parameter Kebijakan | ⬜ | | | |
| T2.4 | Halaman Komponen Honor dan Tingkatan Jarak | ⬜ | | | |
| T2.5 | Halaman Alasan Penolakan Izin | ⬜ | | | |
| T2.6 | Halaman Riwayat Perubahan dan uji E2E irisan Owner | ⬜ | | | |

## Log per task

<!-- Salin templat di bawah untuk setiap task yang selesai. Terbaru di atas. -->

### T0.3 — Riwayat perubahan / audit trail (2026-11-25)
- **Branch:** feat/t0-3-audit-trail (dari feat/t0-2-hak-akses)
- **Acuan:** spesifikasi task lama `T0.3-audit-trail.md` (commit e11be7d), skema API. Atas keputusan user, set task baru SRS v3 (Livewire, `spatie/laravel-activitylog`, ekspor, halaman Riwayat) **tidak** dipakai; tidak ada paket baru.
- **Ringkasan perubahan:** tabel `audit_logs` append-only (model menolak update/delete, trigger MariaDB menolak UPDATE dan DELETE kecuali `@edukom_audit_purge = 1`). `Audit::record()` menyimpan pelaku (user atau `system`), hanya atribut yang berubah, alasan, IP, user agent, request_id; key berisi `password`/`token`/`secret` disamarkan. Integrasi `access.denied` (setiap 403 otorisasi) dan `auth.account_locked`. Command `edukom:purge-audit --before=YYYY-MM-DD` (hapus per 1.000 baris, mencatat `audit.purged`). Endpoint `GET /api/v1/audit-logs` (owner, admin) dengan filter dan paginasi 25.
- **File/migration utama:** `2026_11_25_000003_create_audit_logs_table` (+ 2 trigger); `app/Models/AuditLog.php`; `app/Domain/Audit/Audit.php`; `app/Console/Commands/PurgeAudit.php`; `app/Http/Controllers/Api/V1/AuditLogController.php`; `app/Http/Requests/Api/V1/AuditLogIndexRequest.php`; `app/Http/Resources/V1/AuditLogResource.php`; diubah: `RecordAccessDenial`, `LoginUser`, `routes/api.php`, `CLAUDE.md` (bagian "Riwayat perubahan").
- **Endpoint baru:** `GET /api/v1/audit-logs`.
- **Test:** 16 test baru lulus (`tests/Feature/Audit/*`).
- **Asumsi yang diambil:**
  - Owner dan Admin melihat seluruh riwayat (task lama). Pembatasan Admin hanya ke data operasional (AD-38 di SRS v3) belum diterapkan.
  - Label subjek dari kolom `name` model, kalau tidak ada dari ID. Untuk `access.denied` subjeknya `route` (id = nama route, label = "METHOD /path").
  - Penguncian akun dicatat dengan pelaku `system` (pengguna belum login saat terkunci).
  - `date_from`/`date_to` dalam format YYYY-MM-DD, zona waktu aplikasi (WIB), `date_to` inklusif.
- **Perlu dikonfirmasi (pindahkan ke DECISIONS.md bila sudah dijawab):**
  - Isi `docs/tasks/` di working tree sudah diganti set SRS v3 (Livewire) tetapi belum di-commit; user memutuskan coding tetap memakai skema API lama. `CLAUDE.md`/`DECISIONS.md` belum mencatat keputusan ini secara resmi.
  - Masa simpan riwayat (purge belum dijadwalkan; menunggu parameter di T1.1).
- **Catatan untuk task berikutnya:** setiap Action yang mengubah data penting memanggil `Audit::record` di dalam transaksinya.

### T0.2 — Hak akses berbasis peran (2026-11-25)
- **Branch:** feat/t0-2-hak-akses (dari feat/ui-autentikasi, karena T0.1 dan UI login belum di-merge ke main)
- **Ringkasan perubahan:** middleware alias `role` (`role:owner,admin`): belum login → 401, peran tidak cocok → 403 `FORBIDDEN`, nama peran salah ketik → exception. Semua 403 dari middleware `role` dan Policy/Gate dicatat ke `access_denials` lewat satu callback di penangan exception. Tidak ada `Gate::before` (Owner tidak otomatis boleh semua hal). Helper test `actingAsRole()` dan `rolesExcept()`, dataset Pest `all_roles`, `all_roles_except_owner`, `all_roles_except_owner_admin`.
- **File/migration utama:** `2026_11_25_000002_create_access_denials_table` (id, user_id null, role, method, path, route_name, ip, occurred_at DATETIME(6); indeks occurred_at dan user_id); `app/Models/AccessDenial.php`; `app/Domain/Access/Actions/RecordAccessDenial.php`; `app/Http/Middleware/EnsureUserHasRole.php`; `bootstrap/app.php`; `tests/Pest.php`; `tests/Datasets/Roles.php`; `tests/Feature/Access/RoleAccessTest.php`; `tests/Unit/RolesDatasetTest.php`; `CLAUDE.md` (bagian "Hak akses").
- **Endpoint baru:** tidak ada (route dummy hanya didaftarkan di dalam test).
- **Test:** 21 test baru lulus (132 assertion); Pint lulus.
- **Asumsi yang diambil:**
  - Yang dicatat hanya penolakan otorisasi (`AuthorizationException` dari middleware/Policy/Gate, yang diubah Laravel menjadi `AccessDeniedHttpException`). Galat bisnis 403 (`ApiException::forbidden`, misalnya `ACCOUNT_INACTIVE` saat login) dan `abort(403)` tidak dicatat.
  - Bila penulisan `access_denials` gagal, kegagalan dicatat di log dan respons tetap 403 (tidak berubah jadi 500).
  - 403 pada halaman web (Blade) juga dicatat dengan cara yang sama.
  - Path disimpan dengan awalan `/` tanpa query string.
- **Perlu dikonfirmasi (pindahkan ke DECISIONS.md bila sudah dijawab):**
  - Pengguna yang dinonaktifkan saat masih login belum otomatis diputus sesinya (atas keputusan user, tidak dikerjakan di T0.2).
  - Matriks peran rinci per endpoint (SEC-04: "menunggu K1, Q8") diterapkan per task fitur.
- **Catatan untuk task berikutnya:** T0.3 menambahkan pencatatan audit `access.denied` di `RecordAccessDenial::handle()`. Setiap feature test endpoint memakai `actingAsRole()` dan dataset peran untuk menguji akses semua peran.

### Tambahan (di luar daftar task) — UI autentikasi sementara, Blade (2026-11-25)
- **Branch:** feat/ui-autentikasi (dari feat/t0-1-autentikasi)
- **Alasan:** diminta user agar autentikasi T0.1 bisa dipakai lewat browser sebelum Fase 2. Mendahului sebagian T2.2.
- **Keputusan user:** Blade bawaan Laravel (bukan React seperti D2/T2.1) untuk sementara; ikon mengikuti HTML Stitch (Material Symbols, bukan Phosphor seperti DESIGN.md); desain disaring dengan skill `frontend-design` (anthropics/skills, dipasang di `.claude/skills/`) untuk membuang ciri AI slop dan komentar berlebihan.
- **Ringkasan perubahan:** halaman `/login`, `/beranda` (Owner: belum ada modul aktif; peran lain: modul belum tersedia), `/akun/kata-sandi`, `POST /logout`. Controller web memakai ulang `LoginUser` dan `ChangePassword` (aturan kunci 5x/15 menit dan pemutusan sesi lain sama dengan API). Rate limit login web 10/menit/IP dengan pesan Indonesia. Tombol kirim menampilkan "Memproses…"/"Menyimpan…" dan mencegah kirim ganda.
- **File utama:** `app/Http/Controllers/Web/*`, `routes/web.php`, `resources/views/{auth/login,beranda,akun/kata-sandi}.blade.php`, `resources/views/components/{layouts/base,layouts/app,field,alert,icon,brand}.blade.php`, `resources/css/app.css` (token Stitch), `resources/js/app.js`, `resources/svg/` (ikon + logo dari Stitch), `public/favicon.svg`.
- **Dihapus:** `welcome.blade.php`, `resources/js/bootstrap.js`, `tests/Feature/ExampleTest.php` (bawaan Laravel, tidak dipakai).
- **Paket ditambahkan:** `@fontsource/poppins` (dev, font disimpan lokal).
- **Test:** 11 test web baru; total 34 lulus (135 assertion), Pint lulus, `npm run build` sukses. Diuji manual di Chrome 1280 px: login salah, login owner, ganti kata sandi (halaman), keluar.
- **Asumsi:** belum ada layar Login di Stitch (dijadwalkan di T2.0), jadi login disusun dari design system + motif shell Beranda. Label huruf kapital, bayangan kartu, dan teks contoh Stitch tidak dipakai.
- **Keputusan user (2026-11-25):** frontend berlanjut dengan **Blade**, bukan React. D2 dan T2.1 (React, react-query, Vitest) perlu disesuaikan; mohon dicatat di `docs/DECISIONS.md` oleh Owner/analis.
- **Catatan:** tampilan < 768 px belum dicek visual (viewport browser uji tidak bisa dikecilkan); layout responsif sudah ditulis (top bar + menu di HP, icon rail di tablet). Respons login ±6–9 detik karena DB remote dan sesi tersimpan di DB.

### T0.1 — Autentikasi (2026-11-25)
- **Branch:** feat/t0-1-autentikasi
- **Versi:** Laravel 13.44.1, PHP 8.4.13, database MariaDB 11.8.9 (remote).
- **Paket ditambahkan:** laravel/sanctum ^4.0 (lewat `install:api`); dev: pestphp/pest ^4.7, pestphp/pest-plugin-laravel ^4.1, knuckleswtf/scribe ^5.11. laravel/pint sudah ada. **phpunit/phpunit turun 12.5.45 → 12.5.33** (dikunci Pest 4.7.8; disetujui user).
- **Ringkasan perubahan:** API `/api/v1` dengan Sanctum SPA (`statefulApi`), format galat standar `{message, code, errors}` untuk semua request API (tanpa stack trace), middleware `RequestId` (ULID, masuk log lewat `Context`), pesan validasi bahasa Indonesia, log channel `security`, penguncian akun 5x gagal → 15 menit, rate limit login 10/menit/IP, ganti password memutus sesi lain, command `edukom:create-user`, seeder Owner/Admin (local saja).
- **File/migration utama:** `2026_11_25_000001_add_auth_columns_to_users_table` (role, is_active, failed_login_attempts, locked_until, last_login_at + indeks `role,is_active`); `app/Enums/Role.php`; `app/Domain/Auth/Actions/{LoginUser,ChangePassword}.php`; `app/Http/Controllers/Api/V1/{Health,Auth}Controller.php`; `app/Http/Requests/Api/V1/*`; `app/Http/Resources/V1/UserResource.php`; `app/Http/Middleware/RequestId.php`; `app/Exceptions/ApiException.php`; `app/Console/Commands/CreateUser.php`; `config/edukom.php`; `lang/id/*`.
- **Konfigurasi diubah:** `bootstrap/app.php`, `config/app.php` (timezone/locale dari env), `config/cors.php` (supports_credentials, origin dari env), `config/logging.php` (channel security), `phpunit.xml` (MySQL + session database), `.env.example`, `.env`, `README.md`, `CLAUDE.md` (bagian Perintah).
- **Endpoint baru:** `GET /api/v1/health`, `POST /api/v1/auth/login`, `POST /api/v1/auth/logout`, `GET /api/v1/auth/me`, `PUT /api/v1/auth/password`.
- **Test:** 24 lulus (91 assertion), Pint lulus. Durasi ±3 menit karena DB remote (±4 detik/test; migrate:fresh ±30 detik).
- **Asumsi yang diambil:**
  - Test memakai `db_edukom` (bukan DB test terpisah) atas keputusan user; DB dikosongkan tiap test.
  - Login salah (email tidak terdaftar atau password salah) → 422 `VALIDATION_ERROR` dengan pesan sama "Email atau kata sandi salah." agar email tidak bisa ditebak.
  - Percobaan ke-5 yang gagal langsung mengembalikan 423 `ACCOUNT_LOCKED`. Selama terkunci, percobaan tidak menambah hitungan. Setelah masa kunci lewat, hitungan mulai dari 0.
  - Status nonaktif diperiksa setelah password terbukti benar (password salah pada akun nonaktif tetap dihitung gagal).
  - `GET /health` mengembalikan `{status, time}` persis seperti di task (tanpa pembungkus `data`).
  - Logout dan ganti password mengembalikan 204 tanpa isi. Sesi aktif tetap login setelah ganti password, dengan ID sesi baru.
  - Memutus sesi lain = menghapus baris di tabel `sessions` (butuh `SESSION_DRIVER=database`) + menghapus token Sanctum + mengganti `remember_token`.
  - Galat tambahan di luar daftar task: 419 `CSRF_TOKEN_MISMATCH`, 429 `TOO_MANY_REQUESTS`, 405 `METHOD_NOT_ALLOWED`, 500 `SERVER_ERROR`.
  - `SESSION_DOMAIN=null` (cookie per host), karena domain lokal lebih dari satu (localhost, localhost:5173, edukom-project.test).
  - Email disimpan huruf kecil (command dan login menormalkan).
  - Angka 5 kali / 15 menit / 10 per menit ada di `config/edukom.php`; dipindah ke `PolicyParameters` bila T1.1 memintanya.
- **Perlu dikonfirmasi (pindahkan ke DECISIONS.md bila sudah dijawab):**
  - Server database adalah **MariaDB 11.8**, bukan MySQL 8 seperti D4. Berpengaruh ke task yang memakai trigger dan kolom JSON (di MariaDB, JSON = LONGTEXT dengan CHECK).
  - Pengguna nonaktif yang sedang login tidak otomatis diputus sesinya (belum diminta; cocok untuk T0.2).
- **Catatan untuk task berikutnya:** feature test API memakai `spaHeaders()` dari `tests/Pest.php`. Lempar `App\Exceptions\ApiException` untuk galat bisnis (tidak masuk laravel.log). Semua query harus terparsial (paginasi/kolom terpilih/indeks).

### Templat

```markdown
### T0.0 — <judul> (YYYY-MM-DD)
- **Branch:** feat/t0-0-<slug>
- **Ringkasan perubahan:** ...
- **File/migration utama:** ...
- **Endpoint baru:** ...
- **Test:** <jumlah> lulus
- **Asumsi yang diambil:** ...
- **Perlu dikonfirmasi (pindahkan ke DECISIONS.md bila sudah dijawab):** ...
- **Catatan untuk task berikutnya:** ...
```
