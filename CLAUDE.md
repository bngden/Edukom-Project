# SIM-Edukom — Panduan untuk Agent

SIM-Edukom adalah ERP untuk CV Edukom Jaya Abadi (layanan pembelajaran TIK di SD mitra).
Peran: Owner, Admin, Tentor, Kurir, Teknisi. Pengembangan saat ini: **irisan role Owner**, backend dulu
(Laravel, API JSON `/api/v1`), lalu frontend React di repo yang sama dengan desain dari Stitch.

## Peta dokumen

| File | Isi | Boleh diubah agent? |
|---|---|---|
| `CLAUDE.md` | Panduan ini | Hanya menambah bagian yang diminta task (misal "Perintah", "Hak akses", "Data berversi") |
| `docs/tasks/T*.md` | Satu task per file: konteks, aturan bisnis, endpoint, test wajib, DoD | **Tidak** |
| `docs/TASK_OWNER.md` | Rencana lengkap: keputusan teknis, peta fitur, hasil review Stitch (bagian 4), semua task | **Tidak** |
| `docs/srs/SRS_Edukom_Revisi.md` | SRS terbaru (kebutuhan per peran: OW, AD, TN, KR, TK, KU) | **Tidak** |
| `docs/srs/SRS_Edukom_Lama.md` | SRS lama per modul (ADM, IZN, PAY, AST, RPT, SET) — rincian angka/aturan yang hilang di revisi | **Tidak** |
| `docs/DECISIONS.md` | Keputusan Owner dan default yang dipakai | Tidak (diisi manusia) |
| `docs/PROGRESS.md` | Status task, asumsi, hal yang perlu dikonfirmasi | **Ya** (wajib diisi di akhir task) |
| `design/stitch/` | HTML + screenshot dari Stitch MCP (diisi di T2.1) | Ya, hanya di T2.1 |

Urutan prioritas bila ada yang bertentangan: **DECISIONS.md → file task → SRS revisi → SRS lama → desain Stitch**.
Desain Stitch hanya acuan tampilan, bukan acuan aturan bisnis.

## Cara kerja per task

1. Kerjakan **hanya** task yang diminta (misalnya `docs/tasks/T0.2-hak-akses.md`). Jangan mengerjakan task lain.
2. Mulai dengan rencana singkat: file yang akan dibuat/diubah, migration, endpoint, dan daftar test. Tunggu persetujuan.
3. Bila ada hal yang tidak diatur di task, cari di SRS (kode kebutuhan disebut di task). Bila tetap tidak ada,
   **berhenti dan tanya**, atau ambil asumsi paling sederhana dan catat di laporan. Jangan mengarang fitur.
4. Selesai bila semua butir Definition of Done terpenuhi, `php artisan test` dan `./vendor/bin/pint --test` lulus.
5. Perbarui `docs/PROGRESS.md`: status, ringkasan perubahan, asumsi, hal yang perlu dikonfirmasi.
6. Jangan commit atau push kecuali diminta. Usulkan pesan commit: `feat(T0.2): <ringkasan>`.

## Konvensi kode

- Bahasa kode Inggris (kelas, tabel, kolom, nilai enum snake_case). Label dan pesan ke pengguna bahasa Indonesia.
- Uang: integer rupiah (`BIGINT UNSIGNED`). Dilarang float untuk uang.
- Zona waktu `Asia/Jakarta`. Tanggal berlaku bertipe `DATE`; waktu kejadian `DATETIME(6)`.
- Data induk dan riwayat tidak dihapus; pakai status aktif/nonaktif.
- Perubahan data penting dicatat lewat `App\Domain\Audit\Audit::record(...)` (tersedia setelah T0.3).
- Setiap endpoint dilindungi middleware `role` / Policy di server; setiap feature test menguji akses semua role.
- Validasi lewat FormRequest. Aturan bisnis di `app/Domain/<Konteks>/` (Actions/Services), bukan di Controller.
- Struktur: `app/Enums`, `app/Domain/<Konteks>`, `app/Http/Controllers/Api/V1`, `app/Http/Requests/Api/V1`,
  `app/Http/Resources/V1`.
- Respons API: `{ "data": ... }`, daftar dengan `meta` paginasi; galat `{ "message", "code", "errors" }`
  (401 UNAUTHENTICATED, 403 FORBIDDEN, 404 NOT_FOUND, 409 CONFLICT, 422 VALIDATION_ERROR, 423 LOCKED).
- Operasi tulis lintas tabel dibungkus `DB::transaction`.
- Nilai kebijakan (durasi, toleransi, tarif, batas waktu) tidak di-hardcode; ambil dari `PolicyParameters`
  / `HonorRates` (tersedia setelah T1.1–T1.3).
- Migration lama yang sudah dijalankan tidak diubah; buat migration baru.
- Jangan memasang atau meng-upgrade paket di luar yang disebut task tanpa bertanya.

## Perintah

| Keperluan | Perintah |
|---|---|
| Setup lokal | `composer install` → `cp .env.example .env` → `php artisan key:generate` → isi `DB_*` dan `SEED_*` → `php artisan migrate` |
| Akun bawaan (hanya `APP_ENV=local`) | `php artisan db:seed` → owner@edukom.test, admin@edukom.test (kata sandi dari `SEED_OWNER_PASSWORD` / `SEED_ADMIN_PASSWORD`) |
| Membuat akun | `php artisan edukom:create-user {role} {email} {name}` (kata sandi interaktif) |
| Menjalankan test | `php artisan test` (Pest). Filter: `php artisan test --filter=Login` |
| Database test | Memakai DB dari `.env` (`db_edukom`, MariaDB 11.8 remote). `RefreshDatabase` = `migrate:fresh`, isi DB terhapus tiap test. Tidak ada DB test terpisah. |
| Format kode | `./vendor/bin/pint --test` (cek), `./vendor/bin/pint` (rapikan) |
| Tampilan web | `npm install` → `npm run build` (atau `npm run dev`) → `php artisan serve` → `/login`. Desain: skill `.claude/skills/frontend-design` |
| Dokumentasi API | `php artisan scribe:generate` → `/docs` |
| Peta kode (graphify) | `python -m graphify query "<pertanyaan>"`; setelah mengubah kode: `python -m graphify update .` |

Catatan:
- Query harus terparsial: jangan `Model::all()` / `get()` tanpa batas; pakai paginasi/`chunk`/`lazy`, pilih kolom yang perlu, eager load, dan indeks untuk kolom filter.
- Feature test API mengirim `spaHeaders()` (Referer `http://localhost`) agar Sanctum memakai sesi.

## Hak akses

- Setiap route API yang dilindungi memakai `auth:sanctum` lalu `role:<peran,...>`, misalnya
  `Route::middleware(['auth:sanctum', 'role:owner,admin'])`. Nilai peran sama dengan `App\Enums\Role`
  (`owner`, `admin`, `tentor`, `kurir`, `teknisi`). Bila nama peran salah ketik, aplikasi langsung melempar exception.
- Belum login → 401 `UNAUTHENTICATED`. Peran tidak cocok → 403 `FORBIDDEN`.
- Pembatasan per objek (data milik sendiri, SEC-05) memakai Policy/Gate (`Gate::authorize`, `$this->authorize`).
- **Tidak ada `Gate::before`.** Owner tidak otomatis boleh melakukan semua hal; setiap kemampuan Owner harus diatur jelas.
- Setiap 403 dari middleware `role` atau Policy/Gate dicatat otomatis ke tabel `access_denials`
  (`App\Domain\Access\Actions\RecordAccessDenial`, dipanggil dari `bootstrap/app.php`). Galat bisnis 403 lewat
  `ApiException::forbidden()` (misalnya `ACCOUNT_INACTIVE`) dan `abort(403)` tidak dicatat.
- Test: `actingAsRole(Role::Owner)` membuat user dengan peran tersebut lalu login, dan mengembalikan `User`.
  Dataset matriks akses (`tests/Datasets/Roles.php`): `all_roles`, `all_roles_except_owner`,
  `all_roles_except_owner_admin`, atau `->with(rolesExcept(Role::Owner, Role::Admin))` untuk kombinasi lain.

```php
it('menolak role selain owner', function (Role $role) {
    actingAsRole($role);
    $this->withHeaders(spaHeaders())->getJson('/api/v1/...')->assertForbidden();
})->with('all_roles_except_owner');
```

## Riwayat perubahan (audit)

- Catat setiap perubahan data penting dengan `App\Domain\Audit\Audit::record($action, $subject, $before, $after, $reason)`
  **di dalam** `DB::transaction` yang sama dengan perubahannya (bila transaksi batal, catatan ikut batal).
- `$action`: `<subjek>.<kejadian>` snake_case, misalnya `policy_parameter.version_created`.
- `$subject`: model Eloquent (label diambil dari kolom `name`, kalau tidak ada dari ID) atau
  `['type' => ..., 'id' => ..., 'label' => ...]` untuk subjek non-model.
- Bila `$before` dan `$after` diisi, hanya atribut yang berubah yang disimpan. Key yang mengandung
  `password`, `token`, atau `secret` disamarkan `***`.
- Pelaku diambil otomatis dari user login; tanpa login (command, job) → pelaku `system`.
- Tabel `audit_logs` append-only: model melempar exception saat update/delete, dan trigger DB menolak
  UPDATE/DELETE. Penghapusan hanya lewat `php artisan edukom:purge-audit --before=YYYY-MM-DD`.
- Sudah tercatat otomatis: `access.denied` (setiap 403 otorisasi), `auth.account_locked`, `audit.purged`.
- API: `GET /api/v1/audit-logs` (owner, admin), filter `subject_type`, `subject_id`, `actor_id`, `action`,
  `date_from`, `date_to` (YYYY-MM-DD), 25 per halaman, terbaru dulu.
