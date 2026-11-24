# Rencana Task dan Prompt Agent — Role Owner (SIM-Edukom)

Sumber: SRS Edukom revisi (kebutuhan fungsional per peran) + rincian dari SRS lama yang hilang di revisi (SET-01, SET-02, PAY-01, Lampiran B–E).

Strategi: bangun **satu irisan utuh (fullstack) untuk role Owner**, mulai dari fondasi dan **data master milik Owner**. Backend dulu (Laravel, API JSON), lalu frontend diambil dari desain **Google Stitch lewat MCP**. Fitur Owner lain yang bergantung pada data peran lain (izin, presensi, laporan, aset) dikerjakan belakangan sesuai urutan ketergantungan di Fase 3.

---

## 0. Cara memakai dokumen ini

1. File ini disimpan di repo sebagai `docs/TASK_OWNER.md`, dan tiap task juga tersedia terpisah di `docs/tasks/`.
2. Kerjakan task **berurutan**. Satu task = satu sesi agent (misalnya Claude Code). Jangan menggabungkan beberapa task dalam satu sesi.
3. Salin isi blok **PROMPT** apa adanya ke agent. Setiap prompt sudah memuat konteks, ruang lingkup, aturan bisnis, endpoint, test wajib, dan Definition of Done (DoD).
4. File `CLAUDE.md` di root berisi konvensi proyek dan dibaca otomatis oleh agent. Semua task wajib mengikutinya.
5. Setelah setiap task, jalankan `php artisan test`, lalu commit dengan pesan `feat(<kode-task>): ...`. Lanjut ke task berikutnya hanya bila semua test lulus.
6. Bagian **"Perlu dikonfirmasi Owner"** (bagian 2) sebaiknya dijawab sebelum Fase 1. Kalau belum ada jawaban, agent memakai nilai awal yang tertulis di sini.

---

## 1. Keputusan teknis (asumsi dasar)

| Hal | Keputusan | Alasan / sumber |
|---|---|---|
| Backend | Laravel versi stabil terbaru, PHP ≥ 8.3 | Permintaan user; BAB V menyebut Laravel |
| Gaya API | REST JSON di `/api/v1`, BE dan FE terpisah secara logis (FE nanti di repo yang sama) | BAB V: *Decoupled Client Server*, React SPA |
| Autentikasi | Laravel Sanctum mode SPA (cookie session + CSRF) | SEC-03: cookie HttpOnly/Secure/SameSite |
| Basis data | MySQL 8, InnoDB, foreign key wajib, soft-deactivate (bukan hapus) | BAB V, INT-08, INT-09, KU-10.3 |
| Zona waktu | `Asia/Jakarta` (WIB) untuk aplikasi dan tampilan | USA-10, Lampiran D |
| Uang | Integer rupiah penuh (`BIGINT UNSIGNED`), tanpa float | INT-03 |
| Test | Pest, minimal feature test per endpoint + unit test aturan bisnis | MNT-07 |
| Hak akses | 5 role tetap (enum) + Policy per resource; Owner dan Admin masing-masing 1 akun | KU-09 |
| Audit | Tabel `audit_logs` append-only (dilarang diubah/dihapus) | KU-05, INT-06, INT-07 |
| Notifikasi | Notifikasi web saja (database notification) | KU-03, Lampiran E no. 5 |
| Frontend (Fase 2) | React + TypeScript + Vite + Tailwind di dalam repo Laravel, data via TanStack Query, desain dari project Stitch "Owner Dashboard - Edukom ERP" lewat MCP | BAB V: React SPA; Stitch menghasilkan HTML + Tailwind |
| Acuan bila desain dan SRS berbeda | SRS menang; desain hanya untuk tampilan (lihat bagian 4) | Hasil review Stitch |
| Bahasa | Kode, nama tabel, dan enum dalam bahasa Inggris (snake_case). Label dan pesan ke pengguna dalam bahasa Indonesia | Konsistensi kode, USA-10 |

> Kalau frontend ingin memakai Blade/Livewire atau Inertia, prompt Fase 0–1 tetap berlaku karena backend berupa API JSON. Yang berubah hanya prompt Fase 2.

---

## 2. Perlu dikonfirmasi Owner (default yang dipakai bila belum dijawab)

| No | Pertanyaan | Default yang dipakai agent |
|---|---|---|
| K1 | Nilai awal tarif honorarium. Revisi SRS menghapus angkanya; SRS lama: uang kehadiran Rp10.000/sesi sah, honor mengajar Rp10.000/sesi sah, bonus Rp20.000/sekolah/periode, transport ≤10 km Rp10.000, >10 km Rp15.000 | Pakai angka SRS lama |
| K2 | Tanggal mulai berlaku awal untuk seluruh nilai bawaan (seeder) | `.env` `EDUKOM_POLICY_BASE_DATE=2026-01-01` |
| K3 | Apakah Owner boleh menetapkan tanggal berlaku mundur (ke masa lalu) selama periodenya belum ditutup? | Boleh, asal tidak jatuh di periode yang sudah ditutup |
| K4 | Apakah komponen honorarium yang sudah dinonaktifkan boleh diaktifkan lagi? | Tidak. Yang boleh hanya membatalkan penonaktifan yang belum berlaku |
| K5 | Tenggat materi rencana (tidak ada di Lampiran D) | H-1 pukul 23.59 WIB (SRS lama ADM-11) |
| K6 | Jam layanan Admin, ambang frekuensi izin, batas ekspor, jendela peringatan kesiapan | Kosong → tampil "Belum Dikonfigurasi" (OW-02.3) |
| K7 | Siapa yang membuat akun Kurir dan Teknisi? (SRS tidak mengatur) | Ditunda; akun Owner dan Admin dibuat lewat seeder/command |

---

## 3. Peta fitur Owner, layar Stitch, dan urutan pengerjaan

Project Stitch: **Owner Dashboard - Edukom ERP** (`https://stitch.google.com/projects/199635054751937416`).

| Kode | Fitur Owner | Layar Stitch | Fase | Prasyarat dari peran lain |
|---|---|---|---|---|
| KU-03, KU-05, KU-09 | Notifikasi, riwayat perubahan, login, hak akses | **Belum ada** (lonceng notifikasi hanya di header) | 0 | — |
| OW-02 (+AD-27) | Parameter kebijakan berversi | Parameter Kebijakan (2 versi) | 1 | — |
| OW-01 (+AD-27) | Komponen honorarium, tarif, tingkatan jarak transport | Komponen Honor | 1 | — |
| OW-03 | Daftar alasan penolakan izin | Alasan Penolakan (2 versi) | 1 | — |
| — | Beranda Owner (kerangka + ringkasan data master) | Beranda Owner | 2 | — |
| OW-09 | Keputusan pengadaan aset | Pengadaan Aset | 3a | AD-33, AD-28, KU-04 |
| OW-06 | Buka kembali laporan terverifikasi | Pemantauan Pembelajaran (dialog Buka Kembali Laporan) | 3b | AD-01–AD-07, TN-07, AD-13 |
| OW-04, OW-05 | Izin mendesak di luar jam layanan, eskalasi tanpa pengganti | Eskalasi & Izin Mendesak | 3c | TN-09–TN-12, AD-15–AD-17 |
| OW-07, OW-08, OW-13 | Persetujuan honorarium, penyesuaian, pemantauan pembayaran | Persetujuan Honorarium, Penyesuaian Honor, Pembayaran Honor | 3d | TN-14–TN-17, AD-19–AD-26 |
| OW-10, OW-11, OW-12 | Dashboard pembelajaran, aset, izin | Pemantauan Pembelajaran, Aset & Perangkat, Izin & Penggantian, Beranda Owner | 3e | Hampir seluruh modul |

---

## 4. Hasil review desain Stitch (wajib dibaca sebelum Fase 2)

**Aturan utama untuk agent: SRS menang atas desain.** Stitch dipakai untuk tata letak, gaya visual, dan komponen. Angka, satuan, aturan bisnis, nama status, dan teks penjelasan aturan **mengikuti SRS dan backend**, bukan teks contoh di Stitch. Bila teks Stitch bertentangan dengan daftar di bawah, ikuti kolom "Seharusnya".

### 4.1 Isi desain yang bertentangan dengan SRS

| Layar | Di Stitch | Seharusnya (SRS) |
|---|---|---|
| Komponen Honor | Transport 3 tingkat (0–7, 7–15, >15 km), satuan "/hari" | Tingkatan mengikuti data backend (nilai awal ≤10 km Rp10.000, >10 km Rp15.000); satuan "per kunjungan sekolah" = sekali per sekolah per hari kunjungan |
| Komponen Honor | Bonus: "100% tepat waktu", unggah sebelum tanggal 5, "/sekolah/bulan" | Bonus diberikan per sekolah per periode bila status kelengkapan administrasi tentor pada sekolah itu **Lengkap** (AD-10). Tanpa syarat lain |
| Komponen Honor | Honor mengajar "45 menit tatap muka" | Per sesi sah; durasi sesi diambil dari parameter (nilai awal 70 menit) |
| Komponen Honor | Uang kehadiran "Geotag GPS radius 100 m" | Per sesi sah. Radius bukan bagian komponen honor (diatur per sekolah) |
| Komponen Honor | Grafik "Distribusi Anggaran per Sesi" | Tidak ada di SRS; boleh dihilangkan atau jadi informasi tambahan |
| Persetujuan Honorarium | Kehadiran "28 hari sah × Rp25.000" | Jumlah **sesi sah** × tarif yang berlaku pada tanggal sesi |
| Persetujuan Honorarium | Transport "28 trip penugasan × Rp15.000" | Jumlah pasangan sekolah-hari × tarif tingkat jarak |
| Persetujuan Honorarium | "Bonus Kinerja (ketepatan laporan & jurnal 100%)" | Bonus kelengkapan administrasi per sekolah |
| Persetujuan Honorarium | "Penyesuaian Khusus Pengganti / insentif pengganti mendadak", "SK Penugasan Pengganti" | Tidak ada. Pengganti dibayar per sesi biasa (Lampiran C). Penyesuaian hanya dari AD-23 (dengan alasan) atau hasil sanggahan (OW-08) |
| Persetujuan Honorarium | "Memicu status Siap Bayar untuk tim Bendahara" | Tidak ada peran Bendahara/Keuangan. Setelah disetujui, slip terbit dan Admin mencatat pembayaran |
| Persetujuan Honorarium | Panel detail hanya "Tandai Catatan" dan "Setujui Tentor Ini" | Wajib ada **Setujui** dan **Tolak (alasan wajib)**, per tentor maupun seluruh periode; serta **Batalkan Persetujuan** bila belum ada pembayaran |
| Eskalasi & Izin Mendesak | Pilihan "Batalkan & Kompensasi" | "Batalkan Pertemuan". Sistem tidak mengelola kompensasi/penalti ke sekolah (OW-05.5) |
| Eskalasi & Izin Mendesak | "Dikirim via notifikasi WhatsApp bot ke Admin dan PIC Sekolah" | Notifikasi hanya di dalam sistem ke Admin (dan tentor terkait). Sekolah dihubungi Admin |
| Eskalasi & Izin Mendesak | Catatan Owner "opsional" | Catatan **wajib** (AC-OW-05.2) |
| Eskalasi & Izin Mendesak | Tombol "Hubungi Koordinator Sekolah" | Tidak ada di SRS; hapus |
| Parameter Kebijakan | Parameter "Wajib Foto Selfie Lapangan" dan "Validasi Wi-Fi (BSSID)" | Tidak ada di SRS; hapus |
| Parameter Kebijakan | "Batas koreksi presensi mandiri 24 jam" di grup Presensi | "Batas pengajuan koreksi presensi" 60 hari, grup Penggajian |
| Parameter Kebijakan | "Radius maksimal geotag 100 m" (berlaku global) | "Batas area awal sekolah baru" 150 m; radius tiap sekolah diatur Admin |
| Parameter Kebijakan | Toleransi keterlambatan 15 menit | Nilai dari backend (nilai awal 30 menit) |
| Parameter Kebijakan | Satu "Tanggal Mulai Berlaku" untuk seluruh perubahan dalam form | Boleh dipertahankan, tetapi setiap parameter yang diubah disimpan sebagai versi sendiri; tambahkan isian alasan |
| Parameter Kebijakan | Daftar parameter tidak lengkap | Tampilkan seluruh 32 parameter dari backend (tabel T1.1), termasuk status "Belum Dikonfigurasi" |
| Alasan Penolakan | Kategori pemakaian: Presensi & Honor, Administrasi, Izin & Penggantian, Pengadaan Aset | Daftar ini **hanya** untuk penolakan izin dan calon pengganti (OW-03). Hapus kolom/tab kategori. Penolakan honorarium dan pengadaan memakai alasan ketik bebas |
| Alasan Penolakan | Tidak ada aksi hapus | Hapus tersedia untuk alasan yang belum pernah dipakai; yang sudah dipakai hanya Nonaktifkan |
| Pengadaan Aset | "Ditolak — dikembalikan ke Admin" | "Ditolak" bersifat final, alasan wajib; Admin membuat pengajuan baru |
| Pembayaran Honor | Label "Lunas / Sebagian / Belum" | "Dibayar / Dibayar Sebagian / Belum Dibayar / Tertunda" |
| Komponen Honor | Menu sidebar yang aktif "Pembayaran Honor" | "Komponen Honor" |

### 4.2 Layar atau bagian yang belum ada di Stitch

1. **Login** (termasuk pesan akun terkunci dan akun nonaktif).
2. **Panel notifikasi** dari ikon lonceng (Belum dibaca/Semua, Tandai dibaca, Tandai semua dibaca).
3. **Menu profil + dialog Ganti Kata Sandi**.
4. **Riwayat Perubahan** (KU-05): halaman tabel waktu, pelaku, aksi, objek, sebelum → sesudah, alasan, dengan filter. Tambahkan menu "Riwayat Perubahan" di grup Kebijakan.
5. **Parameter Kebijakan:** panel "Riwayat versi" (Terjadwal/Berlaku/Berakhir/Dibatalkan + tombol Batalkan versi terjadwal) yang dibuka dari "Lihat Riwayat".
6. **Komponen Honor:** dialog Tambah Komponen, dialog Ubah Besaran (nominal + tanggal mulai berlaku + alasan), dialog Nonaktifkan (tanggal nonaktif + alasan), editor tingkatan jarak transport, riwayat versi tarif.
7. **Aset & Perangkat:** tombol Pindai QR untuk membuka profil singkat unit (OW-11.5).
8. **State umum:** kosong, memuat (skeleton), galat, dan halaman 403.

### 4.3 Struktur menu (ikuti Stitch, ditambah Riwayat Perubahan)

- **Utama:** Beranda
- **Persetujuan:** Honorarium, Penyesuaian Honor, Pengadaan Aset, Eskalasi & Izin Mendesak
- **Pemantauan:** Pembelajaran, Aset & Perangkat, Izin & Penggantian, Pembayaran Honor
- **Kebijakan:** Komponen Honor, Parameter Kebijakan, Alasan Penolakan, Riwayat Perubahan (baru)

Rute FE yang dipakai di task: `/owner`, `/owner/persetujuan/honorarium`, `/owner/persetujuan/penyesuaian`, `/owner/persetujuan/pengadaan`, `/owner/persetujuan/eskalasi`, `/owner/pemantauan/pembelajaran`, `/owner/pemantauan/aset`, `/owner/pemantauan/izin`, `/owner/pemantauan/pembayaran`, `/owner/kebijakan/komponen-honor`, `/owner/kebijakan/parameter`, `/owner/kebijakan/alasan-penolakan`, `/owner/kebijakan/riwayat`.

---

# FASE 0 — Fondasi Bersama

Semua fitur Owner (dan peran lain nanti) bergantung pada fase ini.

## T0.1 — Autentikasi (Laravel sudah terpasang)

Laravel sudah terpasang, jadi task ini **tidak membuat proyek baru**. Agent hanya memeriksa konfigurasi yang ada, menambahkan yang kurang untuk autentikasi, lalu menulis `CLAUDE.md` supaya semua task berikutnya memakai konvensi yang sama.

```text
PROMPT T0.1 — Autentikasi Owner/Admin di proyek Laravel yang sudah ada (Sanctum SPA)

Konteks:
Kita membangun SIM-Edukom, ERP untuk CV Edukom Jaya Abadi (layanan pembelajaran TIK di SD mitra).
Peran: Owner, Admin, Tentor, Kurir, Teknisi. Pengembangan dimulai dari backend role Owner.
Backend berupa API JSON di /api/v1. Frontend React akan ditambahkan nanti di repo yang sama.
Sumber: KU-09, SEC-01, SEC-02, SEC-03, SEC-13.

PENTING: Laravel SUDAH terpasang. Jangan membuat proyek baru, jangan menjalankan laravel new /
composer create-project, dan jangan menimpa file yang sudah ada tanpa alasan.

Langkah 0 — Periksa dan lengkapi (sebelum menulis fitur):
1. Laporkan versi Laravel dan PHP (php artisan --version, php -v), isi composer.json, dan apakah routes/api.php sudah ada.
   Bila belum ada → php artisan install:api (ini juga memasang Sanctum).
2. Pasang hanya yang belum ada: laravel/sanctum, pestphp/pest + pest-plugin-laravel, laravel/pint,
   knuckleswtf/scribe (dev). Jangan meng-upgrade paket lain.
3. Konfigurasi .env dan .env.example: APP_TIMEZONE=Asia/Jakarta, APP_LOCALE=id, APP_FAKER_LOCALE=id_ID,
   SESSION_LIFETIME=30, DB MySQL 8 (utf8mb4_unicode_ci). Siapkan database test MySQL terpisah di phpunit.xml
   (bukan sqlite, karena nanti dipakai trigger dan kolom JSON).
4. Sanctum mode SPA: statefulApi() di bootstrap/app.php, SANCTUM_STATEFUL_DOMAINS dan SESSION_DOMAIN untuk
   domain lokal, config/cors.php supports_credentials = true.
5. Format respons API standar (atur di bootstrap/app.php → withExceptions):
   - Sukses tunggal: { "data": {...} }; daftar: { "data": [...], "meta": {current_page, per_page, total} }
   - Galat: { "message": "<pesan Indonesia>", "code": "<KODE>", "errors": {...} }
     401 UNAUTHENTICATED, 403 FORBIDDEN, 404 NOT_FOUND, 409 CONFLICT, 422 VALIDATION_ERROR, 423 LOCKED.
   - Jangan tampilkan stack trace atau detail teknis ke klien.
6. Pesan validasi bahasa Indonesia di lang/id/validation.php. Middleware RequestId (header X-Request-Id,
   buat ULID bila tidak ada, ikut dalam log dan response).
7. CLAUDE.md SUDAH ADA di root (berisi konvensi proyek). Jangan menulis ulang. Bila setup ini menghasilkan
   perintah penting (cara menjalankan test, membuat DB test, menjalankan Scribe), tambahkan di bagian
   "Perintah" pada CLAUDE.md.

Langkah 1 — Autentikasi:
Data:
- Sesuaikan tabel users bawaan lewat migration baru (jangan ubah migration lama yang sudah dijalankan):
  tambah role (string: owner, admin, tentor, kurir, teknisi), is_active (bool, default true),
  failed_login_attempts (int, default 0), locked_until (datetime null), last_login_at (datetime null).
- Enum App\Enums\Role dengan label(): "Owner", "Admin", "Tentor", "Kurir", "Teknisi".
- Password di-hash (bcrypt atau argon2id).

Endpoint (prefix /api/v1; FE memanggil /sanctum/csrf-cookie dulu):
- GET /health → { status: "ok", time: <ISO WIB> } (tanpa login).
- POST /auth/login {email, password}
  - 5 kali gagal berturut-turut → akun terkunci 15 menit (423 ACCOUNT_LOCKED, pesan menyebut sisa waktu).
  - Akun nonaktif → 403 ACCOUNT_INACTIVE.
  - Sukses: reset hitungan gagal, isi last_login_at, regenerate session, kembalikan {id, name, email, role, role_label}.
  - Percobaan gagal dicatat di log channel 'security' (email, ip, waktu). Rate limit 10/menit per IP.
- POST /auth/logout → akhiri sesi.
- GET /auth/me → user yang sedang login (401 bila belum login).
- PUT /auth/password {current_password, password, password_confirmation}: minimal 8 karakter;
  setelah berhasil, sesi lain user diputus.

Akun:
- Command: php artisan edukom:create-user {role} {email} {name} (password diminta interaktif).
- DatabaseSeeder (hanya env local): owner@edukom.test dan admin@edukom.test, password dari .env
  SEED_OWNER_PASSWORD / SEED_ADMIN_PASSWORD. Jangan hardcode password.

Jangan kerjakan: hak akses per fitur (T0.2), audit (T0.3), notifikasi (T0.4).

Test wajib (Pest):
- health 200 + header X-Request-Id; route tidak ada → 404 format standar.
- login sukses; password salah; terkunci setelah 5 kali; terbuka lagi setelah 15 menit (Carbon::setTestNow);
  akun nonaktif ditolak; logout; /auth/me tanpa login → 401; ganti password memutus sesi lain;
  password < 8 karakter → 422 dengan pesan Indonesia.

DoD:
- Test dan pint lulus; README singkat (setup lokal, DB test, menjalankan test).
- Laporan akhir: versi Laravel/PHP, paket yang ditambahkan, file konfigurasi yang diubah, asumsi.
```

## T0.2 — Hak akses berbasis peran

```text
PROMPT T0.2 — RBAC: middleware peran, Policy, pencatatan akses ditolak

Ikuti CLAUDE.md. Sumber: KU-09, SEC-04, SEC-05, Lampiran A.

Kerjakan:
1. Middleware alias 'role' → contoh pemakaian: ->middleware('role:owner,admin'). Role tidak cocok → 403 FORBIDDEN.
2. Gate::before tidak boleh memberi Owner akses otomatis ke semua hal. Owner hanya boleh melakukan yang diatur
   (contoh: Owner hanya melihat dashboard, tidak mencatat pembayaran).
3. Trait/helper untuk test: actingAsRole(Role $role) yang membuat user dengan role tersebut lalu login.
4. Setiap respons 403 (dari middleware maupun Policy) dicatat ke tabel access_denials:
   id, user_id (null bila tidak login), role, method, path, route_name, ip, occurred_at.
   (Catatan: setelah T0.3 selesai, catatan ini juga dikirim ke audit_logs. Sekarang cukup tabel ini.)
5. Buat dataset Pest 'all_roles' agar setiap feature test endpoint dapat menguji matriks akses dengan mudah:
   it('menolak role selain owner', fn (Role $r) => ...)->with('all_roles_except_owner').

Test wajib:
- Route dummy khusus test (owner-only, owner+admin): role lain → 403 dan tercatat di access_denials.
- Belum login → 401 (tidak dicatat sebagai access denial).

DoD: test lulus; tulis di CLAUDE.md bagian "Hak akses" cara memakai middleware role dan dataset test.
```

## T0.3 — Riwayat perubahan (audit trail)

```text
PROMPT T0.3 — Audit trail append-only (KU-05)

Ikuti CLAUDE.md. Sumber: KU-05, KU-09.4, KU-10.4, INT-06, INT-07, MNT-01.

Data:
- Tabel audit_logs:
  id (ULID), occurred_at DATETIME(6), actor_type ('user'|'system'), actor_id (null untuk system), actor_role,
  action (string, contoh: 'policy_parameter.version_created'), subject_type, subject_id, subject_label
  (teks ringkas agar tetap terbaca walau subjek berubah nama), before JSON null, after JSON null, reason TEXT null,
  ip, user_agent, request_id.
  Index: (subject_type, subject_id), (actor_id), (occurred_at), (action).
- Append-only:
  a) Model AuditLog melempar exception pada update/delete.
  b) Migration membuat trigger MySQL BEFORE UPDATE → SIGNAL SQLSTATE '45000' (selalu ditolak).
     Trigger BEFORE DELETE → ditolak kecuali variabel sesi @edukom_audit_purge = 1
     (dipakai command pembersihan masa simpan, KU-10.4).

Service App\Domain\Audit\Audit:
- record(string $action, Model|array $subject, ?array $before, ?array $after, ?string $reason = null): AuditLog
- Pelaku otomatis dari Auth::user(); bila tidak ada (job, scheduler, command) → actor_type='system'.
- Field sensitif (password, remember_token, token) selalu disamarkan "***".
- Pencatatan audit memakai koneksi DB yang sama dan berada di dalam transaksi pemanggil
  (bila transaksi gagal, audit ikut batal).
- Helper diff: hanya simpan atribut yang berubah pada before/after.

Integrasi:
- Ubah pencatatan access_denials dari T0.2 agar juga menulis audit action 'access.denied'.
- Login sukses/gagal tidak perlu masuk audit (sudah ada di log security), kecuali penguncian akun → 'auth.account_locked'.

Command: php artisan edukom:purge-audit --before=YYYY-MM-DD (belum dijadwalkan; masa simpan dibaca dari parameter
nanti di T1.1). Command mencatat audit 'audit.purged' berisi jumlah baris yang dihapus.

Endpoint:
- GET /api/v1/audit-logs (owner, admin), filter: subject_type, subject_id, actor_id, action, date_from, date_to;
  urutan terbaru dulu; paginate 25.
- Tidak ada endpoint ubah/hapus.

Test wajib:
- record() menyimpan before/after dan pelaku; field sensitif disamarkan.
- Update dan delete lewat Eloquent ditolak; update lewat query builder ditolak oleh trigger.
- Delete tanpa @edukom_audit_purge ditolak; command purge berhasil dan tercatat.
- Endpoint: owner dan admin boleh, role lain 403.
- Audit ikut batal bila transaksi rollback.

DoD: test lulus; dokumentasikan cara memakai Audit::record di CLAUDE.md.
```

## T0.4 — Notifikasi di dalam sistem

```text
PROMPT T0.4 — Notifikasi web (KU-03)

Ikuti CLAUDE.md. Sumber: KU-03, Lampiran E no. 5 (notifikasi web saja).

Kerjakan:
1. Pakai Laravel database notifications (tabel notifications).
2. Kelas dasar App\Notifications\EdukomNotification (channel 'database' saja) dengan payload wajib:
   event (kode jenis kejadian), title, message, subject_type, subject_id, action_url (path FE, contoh
   '/owner/pengadaan/12'), created_at. Jangan memuat data kesehatan atau data pribadi yang tidak perlu (KU-03.3).
3. Service App\Domain\Notification\Notifier::send($users, EdukomNotification $n):
   - dijalankan afterCommit;
   - bila gagal → log warning, tidak melempar exception, proses pemicu tetap sukses (KU-03.4).
4. Endpoint (semua role yang login):
   - GET /api/v1/notifications?status=unread|read|all (paginate 20)
   - GET /api/v1/notifications/unread-count
   - POST /api/v1/notifications/{id}/read
   - POST /api/v1/notifications/read-all
   - User hanya dapat melihat dan menandai notifikasinya sendiri (cek kepemilikan → 404 bila bukan miliknya).

Test wajib: kirim dan daftar, hitung belum dibaca, tandai dibaca, notifikasi user lain → 404,
kegagalan notifikasi tidak menggagalkan transaksi pemicu (mock agar melempar exception).

DoD: test lulus, dokumentasi Scribe.
```

## T0.5 — Periode penggajian (minimal) dan pola data berversi

```text
PROMPT T0.5 — Periode penggajian minimal + pola "nilai berversi dengan tanggal berlaku"

Ikuti CLAUDE.md. Sumber: OW-01.7, OW-02.2, Lampiran B (Periode), INT-04.
Catatan: pengelolaan periode oleh Admin (tutup/buka, AD-22) BUKAN bagian task ini. Di sini hanya struktur dan
penjaga tanggal yang dipakai fitur Owner.

Bagian A — Periode penggajian
- Tabel payroll_periods: id, year, month, starts_on DATE, ends_on DATE, status, timestamps; unique(year, month).
- Enum PayrollPeriodStatus: open (Terbuka), closed (Ditutup), awaiting_approval (Menunggu Persetujuan),
  partially_approved (Disetujui Sebagian), approved (Disetujui), rejected (Ditolak). Sediakan method label().
- Satu periode = satu bulan kalender; cut-off = hari terakhir bulan.
- Service App\Domain\Payroll\PeriodGuard:
  - isLocked(CarbonInterface $date): bool → true bila ada periode yang mencakup tanggal itu dengan status selain open.
  - assertNotLocked($date, string $field = 'effective_from') → lempar exception yang di-render 423 LOCKED_PERIOD
    dengan pesan: "Tanggal berlaku jatuh pada periode penggajian {Bulan Tahun} yang sudah ditutup."
- Factory dan state: ->closed(), ->approved().

Bagian B — Pola nilai berversi (dipakai parameter, tarif, tingkatan jarak)
- Buat trait App\Domain\Versioning\HasEffectiveDating untuk model "versi" dengan kolom:
  effective_from DATE, effective_to DATE NULL, cancelled_at DATETIME NULL, cancelled_by NULL, cancel_reason NULL,
  created_by, reason NULL.
- Service App\Domain\Versioning\VersionTimeline dengan aturan:
  1. Versi aktif pada tanggal D = versi tidak dibatalkan dengan effective_from <= D dan (effective_to null atau >= D).
  2. Menambah versi baru dengan effective_from = F:
     a) F tidak boleh jatuh di periode terkunci (PeriodGuard).
     b) F harus lebih besar dari effective_from versi terakhir yang tidak dibatalkan. Bila tidak → 409 CONFLICT,
        pesan menyebut tanggal versi terakhir. (Ini mencegah versi tumpang tindih; SET-01.4.)
     c) Versi terakhir sebelumnya diberi effective_to = F - 1 hari (PAY-01.3).
  3. Membatalkan versi: hanya versi terakhir yang effective_from > hari ini (belum berlaku). Alasan wajib.
     Setelah batal, versi sebelumnya effective_to dikembalikan null.
  4. Semua langkah dalam satu transaksi dan dicatat audit (versi dibuat / dibatalkan).
- Status turunan per versi: 'scheduled' (Terjadwal), 'active' (Berlaku), 'ended' (Berakhir), 'cancelled' (Dibatalkan).

Test wajib (unit + feature dengan model dummy khusus test):
- Penentuan versi aktif per tanggal, termasuk batas effective_to.
- Tambah versi → versi lama tertutup H-1.
- Tolak versi dengan tanggal <= versi terakhir (409).
- Tolak tanggal di periode closed/approved (423); boleh di periode open atau bulan tanpa periode.
- Batalkan versi terjadwal; tolak membatalkan versi yang sudah berlaku.

DoD: test lulus; dokumentasikan pola ini di CLAUDE.md bagian "Data berversi".
```

---

# FASE 1 — Data Master Owner (Backend)

## T1.1 — Parameter kebijakan berversi (OW-02, AD-27)

**Daftar parameter (katalog tetap di kode; Owner hanya mengubah nilainya):**

| key | Grup | Label | Tipe nilai | Nilai awal | Dipakai oleh |
|---|---|---|---|---|---|
| session_duration_minutes | pembelajaran | Durasi satu sesi | integer menit (1–600) | 70 | AD-07, TN-14 |
| lesson_plan_deadline | pembelajaran | Tenggat materi rencana | relative_deadline {days_before, time} | {1, "23:59"} (K5) | TN-03 |
| meeting_report_deadline_hours | pembelajaran | Tenggat laporan Pertemuan | integer jam | 48 | TN-07 |
| inter_school_gap_warning_minutes | pembelajaran | Peringatan jeda antarsekolah | integer menit | 30 | TN-11, AD-07 |
| checkin_open_minutes_before_start | presensi | Presensi masuk dibuka sebelum jam mulai | integer menit | 15 | TN-14 |
| checkout_open_minutes_before_end | presensi | Presensi pulang dibuka sebelum jam selesai | integer menit | 15 | TN-14 |
| late_tolerance_minutes | presensi | Toleransi keterlambatan | integer menit | 30 | TN-14, AD-21 |
| max_location_accuracy_meters | presensi | Ketelitian lokasi maksimal | integer meter | 50 | KU-02 |
| default_school_radius_meters | presensi | Batas area awal sekolah baru | integer meter | 150 | AD-01 |
| checkout_reminder_time | presensi | Pengingat presensi pulang (selain jam selesai sesi) | time HH:MM | "20:00" | TN-14 |
| absent_marking_time | presensi | Waktu penandaan Tidak Hadir | time | "23:59" | AD-21 |
| planned_leave_deadline | izin | Batas izin terencana | relative_deadline | {3, "23:59"} | TN-09 |
| substitute_response_hours | izin | Batas respons calon pengganti | by_leave_type {planned, urgent} jam | {24, 1} | TN-12 |
| admin_leave_decision_minutes | izin | Batas keputusan Admin sebelum jam mulai | integer menit | 120 | AD-15 |
| escalation_deadline | izin | Batas eskalasi | {planned: relative_deadline, urgent_hours_before} | {planned:{1,"23:59"}, urgent_hours_before:3} | AD-17 |
| retroactive_leave_correction_days | izin | Batas koreksi penggantian setelah sesi | integer hari | 3 | AD-15 |
| admin_service_hours | izin | Jam layanan Admin | service_hours {days[1–7], start, end} | kosong | OW-04 |
| leave_frequency_threshold | izin | Ambang frekuensi izin per periode | integer | kosong | OW-12 |
| attendance_correction_deadline_days | penggajian | Batas pengajuan koreksi presensi | integer hari | 60 | TN-15 |
| correction_reupload_limit | penggajian | Batas unggah ulang koreksi | {max_times, within_days} | {3, 3} | AD-20 |
| clarification_reminder_days_before_cutoff | penggajian | Pengingat Perlu Klarifikasi | integer hari | 3 | AD-21 |
| payroll_cutoff_time | penggajian | Jam cut-off (hari terakhir bulan) | time | "23:59" | AD-22 |
| unusual_honorarium_threshold_percent | penggajian | Ambang honorarium tidak lazim | integer persen | 30 | AD-23 |
| owner_approval_reminder_days | penggajian | Pengingat keputusan Owner | integer hari | 2 | OW-07 |
| objection_deadline_days | penggajian | Batas sanggahan setelah slip terbit | integer hari | 14 | TN-16 |
| objection_admin_response_workdays | penggajian | Tanggapan Admin atas sanggahan | integer hari kerja | 3 | AD-25 |
| readiness_warning_window_days | operasional | Jendela peringatan kesiapan perangkat | integer hari | kosong | AD-09 |
| export_row_limit | operasional | Batas ekspor langsung | integer baris | kosong | KU-08 |
| procurement_reminder_workdays | operasional | Pengingat keputusan pengadaan | integer hari kerja | 3 | OW-09 |
| damage_report_verification_workdays | operasional | Batas verifikasi laporan kendala | integer hari kerja | 2 | AD-32 |
| evidence_file_rule | operasional | Aturan berkas bukti | {extensions[], max_size_mb, max_files} | {[jpg,png,pdf], 5, 5} | KU-04 |
| data_retention_months | masa_simpan | Masa simpan bukti, lampiran, slip, audit | integer bulan | 6 | KU-10 |

```text
PROMPT T1.1 — Parameter kebijakan berversi (OW-02) + akses lihat Admin (AD-27)

Ikuti CLAUDE.md. Prasyarat: T0.1–T0.5 selesai.
Sumber: OW-02, AD-27, SET-01 (SRS lama), Lampiran D, KU-05, MNT-05.

Konsep:
- Katalog parameter TETAP di kode (Owner tidak menambah key baru karena tiap key dipakai oleh logika program).
  Owner hanya membuat versi nilai baru. Sumber kebenaran katalog: app/Domain/Policy/ParameterCatalog.php.
- Setiap nilai berversi memakai VersionTimeline dari T0.5.

Data:
- policy_parameters: id, key (unique), group (enum: learning, attendance, leave, payroll, operational, retention),
  label, description, value_type, unit (null|'menit'|'jam'|'hari'|'hari kerja'|'meter'|'persen'|'baris'|'bulan'),
  sort_order, timestamps. Diisi/disinkronkan oleh seeder dari ParameterCatalog (idempoten).
- policy_parameter_versions: id, policy_parameter_id (FK), value JSON, + kolom HasEffectiveDating.

Katalog: ikuti PERSIS tabel "Daftar parameter" di file task ini (sama dengan docs/TASK_OWNER.md bagian T1.1) (key, grup, label Indonesia,
tipe, unit, nilai awal). Tulis seluruh barisnya ke ParameterCatalog beserta aturan validasinya.
Tipe nilai dan validasinya:
- integer: bilangan bulat; minimal 1 kecuali dinyatakan lain; batas atas wajar per key (misal menit <= 1440).
- time: string "HH:MM" 24 jam.
- relative_deadline: { days_before: int >= 0, time: "HH:MM" } → dibaca "H-{days_before} pukul {time} WIB".
- by_leave_type: { planned: int >= 1, urgent: int >= 1 } (jam).
- escalation: { planned: relative_deadline, urgent_hours_before: int >= 1 }.
- service_hours: { days: int[1..7] unik tidak kosong (1=Senin), start: "HH:MM", end: "HH:MM" } dengan start < end.
- reupload_limit: { max_times: int >= 1, within_days: int >= 1 }.
- file_rule: { extensions: subset dari [jpg,jpeg,png,pdf], max_size_mb: 1..20, max_files: 1..10 }.
Parameter dengan default "kosong" tidak diberi versi oleh seeder → statusnya "Belum Dikonfigurasi".

Service App\Domain\Policy\PolicyParameters (dipakai modul lain nanti):
- get(string $key, ?CarbonInterface $date = null): mixed → nilai yang berlaku pada tanggal (default hari ini);
  bila tidak ada versi → lempar ParameterNotConfigured (berisi key dan label).
- getOrNull(...), isConfigured(...).
- Cache per request (bukan cache permanen) agar hasil selalu konsisten dengan DB.

Seeder: versi awal effective_from = env EDUKOM_POLICY_BASE_DATE (default 2026-01-01), created_by = system.

Endpoint (/api/v1):
- GET /policy-parameters?group= (owner, admin)
  → per item: key, group + group_label, label, description, unit, value_type, current_value, current_effective_from,
    status ('configured' | 'not_configured' → label "Belum Dikonfigurasi"), scheduled_version (bila ada versi terjadwal),
    display_value (teks Indonesia siap tampil, contoh "H-3 pukul 23.59 WIB", "70 menit").
- GET /policy-parameters/{key} (owner, admin) → detail + seluruh versi (terbaru dulu) beserta status versi,
  pembuat, alasan, dan info pembatalan.
- POST /policy-parameters/{key}/versions (owner) { value, effective_from, reason? }
  → validasi sesuai tipe, aturan VersionTimeline (409/423), audit 'policy_parameter.version_created'
    (before = nilai lama, after = nilai baru), 201.
- POST /policy-parameters/{key}/versions/{version}/cancel (owner) { reason wajib } → aturan pembatalan T0.5, audit.
- Admin dan role lain tidak boleh POST (403). Tentor, Kurir, Teknisi tidak boleh GET (403).
  (Nanti modul lain membaca nilai lewat service, bukan endpoint ini.)

Catatan aturan:
- Perubahan default_school_radius_meters TIDAK mengubah radius sekolah yang sudah ada (OW-02.4); hanya dipakai
  sebagai nilai awal sekolah baru. Tulis komentar di katalog.
- Hasil periode tertutup tidak berubah: dijamin oleh PeriodGuard dan oleh modul lain yang membaca nilai pada tanggal
  kejadian (bukan nilai hari ini).

Test wajib:
- Seeder idempoten; jumlah parameter sesuai katalog; parameter kosong berstatus not_configured.
- get() mengembalikan nilai sesuai tanggal; get() parameter kosong melempar ParameterNotConfigured.
- POST valid untuk setiap value_type (gunakan dataset) dan contoh invalid per tipe (422 berpesan Indonesia).
- POST di periode tertutup → 423; tanggal <= versi terakhir → 409.
- Batalkan versi terjadwal; tolak membatalkan versi yang sudah berlaku.
- Matriks akses: owner (GET/POST), admin (GET saja), tentor/kurir/teknisi (403 semua).
- Audit tercatat dengan before/after.
- display_value benar untuk relative_deadline, service_hours, file_rule.

DoD: test lulus, Scribe terbarui, laporan asumsi.
```

## T1.2 — Komponen honorarium dan tarif berversi (OW-01, AD-27)

```text
PROMPT T1.2 — Komponen honorarium dan tarif berversi (OW-01) + lihat Admin (AD-27)

Ikuti CLAUDE.md. Prasyarat: T0.x, T1.1.
Sumber: OW-01, AD-27, PAY-01 (SRS lama), INT-03, INT-04.

Aturan bisnis:
- Dasar perhitungan (enum HonorBasis):
  per_valid_session ("Per sesi sah"), per_school_visit ("Per kunjungan sekolah" = sekali per sekolah per hari kunjungan),
  per_school_per_period ("Per sekolah per periode"), fixed_per_period ("Tetap per periode").
- Jenis tarif (enum RateType): flat (satu nominal) atau distance_tiers (tingkatan jarak; KHUSUS uang transportasi,
  dikerjakan di T1.3).
- Empat komponen bawaan (is_system = true, kode tetap, tidak dapat diganti dasar perhitungannya):
  1. attendance  "Uang kehadiran"   per_valid_session      flat   Rp10.000
  2. teaching    "Honor mengajar"   per_valid_session      flat   Rp10.000
  3. transport   "Uang transportasi" per_school_visit      distance_tiers (T1.3)
  4. completeness_bonus "Uang bonus kelengkapan administrasi" per_school_per_period flat Rp20.000
     Syarat bonus tetap: status kelengkapan administrasi tentor pada sekolah = Lengkap (dari AD-10).
     Tidak ada pengaturan syarat lain (PAY-01.10).
- Tarif berlaku seragam untuk semua tentor dan semua sekolah (tanpa pembedaan per tentor/sekolah).
- Owner dapat menambah komponen baru (is_system = false): rate_type selalu flat; dasar perhitungan dipilih dari enum.
- Nominal: integer rupiah >= 0.
- Komponen tidak dapat dihapus. Penonaktifan memakai tanggal nonaktif (deactivated_from):
  komponen tidak dipakai untuk kejadian pada tanggal >= deactivated_from; tanggal tidak boleh di periode terkunci;
  alasan wajib. Penonaktifan yang belum berlaku boleh dibatalkan (alasan wajib). Komponen yang sudah nonaktif
  tidak diaktifkan kembali (asumsi K4).
- Perubahan nominal = versi tarif baru (VersionTimeline T0.5). Versi lama tetap tersimpan.

Data:
- honor_components: id, code (unique, slug), name (unique case-insensitive), description null, basis, rate_type,
  is_system, sort_order, deactivated_from DATE null, deactivation_reason null, deactivated_by null, timestamps.
- honor_component_rates: id, honor_component_id FK, amount BIGINT UNSIGNED, + kolom HasEffectiveDating.
- Seeder: 4 komponen bawaan; tarif awal (selain transport) effective_from = EDUKOM_POLICY_BASE_DATE.

Service App\Domain\Honorarium\HonorRates:
- activeComponentsOn(CarbonInterface $date): Collection
- flatAmountFor(HonorComponent|string $codeOrModel, CarbonInterface $date): ?int
  (null bila tidak ada tarif berlaku atau komponen nonaktif pada tanggal itu)
- (Fungsi transport ditambahkan di T1.3.)

Endpoint (/api/v1):
- GET /honor-components?date= (owner, admin): daftar beserta basis + label, rate_type, status (Aktif / Nonaktif /
  Akan Nonaktif per tanggal X), tarif yang berlaku pada tanggal, tanggal mulai berlaku tarif, tarif terjadwal bila ada.
- GET /honor-components/{id} (owner, admin): detail + riwayat versi tarif (flat).
- POST /honor-components (owner) { name, description?, basis, amount, effective_from, reason? }
  → buat komponen flat + versi tarif pertama, 201, audit.
- PATCH /honor-components/{id} (owner) { name?, description?, sort_order? } → basis dan rate_type tidak dapat diubah;
  nama komponen bawaan boleh diubah; audit.
- POST /honor-components/{id}/rates (owner) { amount, effective_from, reason? } → hanya untuk rate_type flat
  (transport → 422 dengan pesan arahkan ke tingkatan jarak), audit.
- POST /honor-components/{id}/rates/{rate}/cancel (owner) { reason }.
- POST /honor-components/{id}/deactivate (owner) { deactivated_from, reason }.
- POST /honor-components/{id}/cancel-deactivation (owner) { reason } → hanya bila deactivated_from > hari ini.
- Tidak ada endpoint DELETE.

Test wajib:
- Seeder: 4 komponen bawaan dengan basis dan nominal benar.
- Tambah komponen baru; tolak nama duplikat (beda huruf besar/kecil); tolak basis di luar enum; tolak nominal negatif.
- Revisi tarif → versi lama berakhir H-1; flatAmountFor sebelum dan sesudah tanggal berlaku.
- Tolak tanggal di periode tertutup (423) dan tanggal <= versi terakhir (409).
- Nonaktifkan → activeComponentsOn tidak memuat komponen sejak tanggal itu; batalkan penonaktifan terjadwal.
- Tolak ubah basis lewat PATCH; tolak POST rates untuk transport.
- Matriks akses: owner (semua), admin (GET saja), lainnya 403.
- Audit tercatat untuk setiap perubahan.

DoD: test lulus, Scribe, laporan asumsi.
```

## T1.3 — Tingkatan jarak uang transportasi (OW-01.4)

```text
PROMPT T1.3 — Tingkatan jarak uang transportasi berversi (OW-01.4)

Ikuti CLAUDE.md. Prasyarat: T1.2.
Sumber: OW-01.4, PAY-01.6–PAY-01.8 dan PAY-01.11 (SRS lama), KU-01.

Aturan:
- Satu "set tingkatan" berlaku sebagai satu versi (VersionTimeline), milik komponen transport.
- Input berupa daftar tingkatan berurutan: [{ max_km: number|null, amount: int }, ...]
  - Jarak dalam km dengan maksimal 1 desimal (jarak hasil KU-01 juga dibulatkan 1 desimal).
  - Tingkatan pertama mulai dari 0 km. Tingkatan ke-n mencakup jarak > max_km tingkat sebelumnya sampai <= max_km
    tingkat itu (batas atas inklusif).
  - Hanya tingkatan terakhir yang max_km = null (tanpa batas atas). max_km wajib naik ketat. Minimal 1 tingkatan.
  - Dengan bentuk ini tidak mungkin ada celah atau tumpang tindih; tetap validasi urutan dan null hanya di akhir.
  - amount integer rupiah >= 0.
- Nilai awal (seeder, effective_from = EDUKOM_POLICY_BASE_DATE): [{max_km: 10, amount: 10000}, {max_km: null, amount: 15000}].

Data:
- transport_tier_sets: id, honor_component_id FK (transport), + kolom HasEffectiveDating.
- transport_tiers: id, transport_tier_set_id FK, position, min_km_exclusive DECIMAL(6,1) (0 untuk tingkat pertama,
  disimpan untuk keterbacaan), max_km_inclusive DECIMAL(6,1) null, amount BIGINT UNSIGNED.

Service (tambahkan ke HonorRates):
- transportAmountFor(float $distanceKm, CarbonInterface $date): ?int
  → bulatkan jarak ke 1 desimal (half up, pakai pembulatan desimal yang aman seperti BCMath/string, bukan
    perbandingan float mentah), cari set yang berlaku pada tanggal, kembalikan nominal tingkatannya;
    null bila komponen transport nonaktif atau tidak ada set berlaku.
- transportTiersOn(CarbonInterface $date): array (untuk tampilan).

Endpoint (/api/v1):
- GET /honor-components/transport/tier-sets (owner, admin) → semua versi + tingkatannya + status versi.
- POST /honor-components/transport/tier-sets (owner) { effective_from, tiers: [...], reason? } → 201, audit
  (before = tingkatan lama, after = tingkatan baru).
- POST /honor-components/transport/tier-sets/{set}/cancel (owner) { reason }.
- GET /honor-components (dari T1.2) untuk transport menampilkan ringkasan tingkatan yang berlaku,
  contoh "≤ 10 km: Rp10.000; > 10 km: Rp15.000".

Test wajib:
- Validasi: max_km tidak naik, null di tengah, null tidak di akhir, desimal > 1 digit, nominal negatif, daftar kosong.
- transportAmountFor: 0 km, 9,96 km (dibulatkan 10,0 → tingkat 1), 10,0 km (tingkat 1), 10,04 km (dibulatkan 10,0
  → tingkat 1), 10,05 km (dibulatkan 10,1 → tingkat 2), 37 km (tingkat terakhir).
- Versi baru mengganti versi lama pada tanggal berlaku; tanggal di periode tertutup → 423.
- Komponen transport nonaktif → transportAmountFor null.
- Matriks akses dan audit.

DoD: test lulus, Scribe, laporan asumsi.
```

## T1.4 — Daftar alasan penolakan izin (OW-03)

```text
PROMPT T1.4 — Daftar alasan baku penolakan izin dan calon pengganti (OW-03)

Ikuti CLAUDE.md. Prasyarat: Fase 0.
Sumber: OW-03, SET-02 (SRS lama), KU-05, KU-10.3.

Aturan:
- Dikelola hanya oleh Owner: tambah, ubah nama, nonaktifkan, aktifkan kembali.
- Admin hanya melihat dan memilih alasan aktif (dipakai nanti di AD-15 dan OW-04). Admin tidak dapat mengubah daftar.
- Daftar yang sama dipakai untuk menolak izin dan menolak calon pengganti.
- Alasan yang sudah pernah dipakai tidak dapat dihapus, hanya dinonaktifkan. Alasan yang belum pernah dipakai boleh dihapus.
- Alasan nonaktif tidak muncul pada pilihan baru, tetapi tetap tampil pada data lama.
- Nama unik (tanpa membedakan huruf besar/kecil), 3–150 karakter.

Data:
- leave_rejection_reasons: id, name, description null, is_active, sort_order, deactivated_at null, timestamps.
- Kontrak pemakaian: buat interface App\Domain\Reference\TracksUsage dan registry sederhana
  (config/edukom.php → 'reference_usage' => [LeaveRejectionReason::class => [ [table, column], ... ]]).
  Sekarang daftarnya kosong. Method isUsed() memeriksa semua tabel terdaftar.
  (Modul izin nanti mendaftarkan tabelnya sendiri. Modul pemakai juga WAJIB menyimpan salinan nama alasan saat dipakai
  agar perubahan nama tidak mengubah data lama; tulis catatan ini di CLAUDE.md.)

Endpoint (/api/v1):
- GET /leave-rejection-reasons?status=active|inactive|all&search= (owner: default all; admin: hanya active,
  parameter status diabaikan/ditolak). Setiap item memuat usage_count (jumlah pemakaian dari tabel terdaftar;
  0 selama belum ada modul pemakai) dan can_delete (usage_count = 0).
- PUT /leave-rejection-reasons/order (owner) { ids: [...] } → simpan sort_order sesuai urutan, satu audit
  'leave_rejection_reason.reordered'.
- POST /leave-rejection-reasons (owner) { name, description?, sort_order? } → 201, audit.
- PATCH /leave-rejection-reasons/{id} (owner) { name?, description?, sort_order? } → audit.
- POST /leave-rejection-reasons/{id}/deactivate dan /activate (owner) → audit.
- DELETE /leave-rejection-reasons/{id} (owner) → 409 REFERENCE_IN_USE bila isUsed(); bila belum dipakai,
  hapus permanen + audit (subject_label menyimpan nama).
- Seeder contoh (dev saja, bukan produksi): "Bukti tidak memadai", "Melewati batas waktu pengajuan",
  "Calon pengganti tidak memenuhi syarat", "Bentrok jadwal calon pengganti". Daftar resmi disusun Owner
  (Lampiran E no. 14).

Test wajib:
- CRUD sesuai aturan; nama duplikat beda huruf → 422.
- Admin hanya menerima alasan aktif dan tidak bisa POST/PATCH/DELETE (403).
- Hapus ditolak bila dipakai (daftarkan tabel dummy khusus test di registry).
- Role lain 403; audit tercatat.

DoD: test lulus, Scribe, laporan asumsi.
```

## T1.5 — Konsolidasi Fase 1: akses Admin, riwayat, dokumentasi, data demo

```text
PROMPT T1.5 — Konsolidasi backend Owner Fase 1

Ikuti CLAUDE.md. Prasyarat: T1.1–T1.4.
Sumber: AD-27, KU-05.3, SEC-04, SEC-05.

Kerjakan:
1. Endpoint ringkasan untuk halaman awal Owner:
   GET /api/v1/owner/overview (owner) → {
     parameters: { total, not_configured: [ {key, label} ], scheduled_changes: n },
     honor_components: { active, inactive, scheduled_changes: n },
     leave_rejection_reasons: { active, inactive },
     unread_notifications: n
   }
2. Riwayat per objek (KU-05.3) memakai audit-logs: pastikan subject_type dan subject_id konsisten untuk
   policy_parameter, honor_component, transport_tier_set, leave_rejection_reason. Tambahkan alias pendek subject_type
   (morph map) agar FE dapat memfilter: 'policy_parameter', 'honor_component', 'transport_tier_set',
   'leave_rejection_reason'.
3. Test matriks akses lengkap (satu file tests/Feature/Access/OwnerMasterAccessTest.php): untuk setiap endpoint Fase 1
   × 5 role × (tidak login), periksa status yang diharapkan. Tulis tabel harapan sebagai dataset agar mudah dibaca.
4. Seeder demo (DemoSeeder, hanya env local): beberapa versi terjadwal, satu komponen tambahan nonaktif,
   satu periode closed bulan lalu, beberapa notifikasi untuk Owner.
5. Scribe: kelompokkan endpoint per grup (Auth, Notifikasi, Riwayat, Parameter, Honorarium, Alasan Penolakan), sertakan
   contoh request/response. Generate ke public/docs.
6. Buat docs/API_OWNER.md berisi daftar endpoint Fase 0–1, contoh payload, kode galat, dan aturan versi
   (untuk dipakai saat membangun frontend Fase 2).

DoD: seluruh test lulus; docs/API_OWNER.md lengkap; laporan daftar endpoint final.
```

---

# FASE 2 — Frontend Owner dari Desain Stitch (lewat MCP)

Fase ini membangun kerangka aplikasi Owner (login, layout, menu lengkap, notifikasi) dan tiga halaman Kebijakan yang backend-nya sudah selesai di Fase 1. Halaman Persetujuan dan Pemantauan dibangun di Fase 3 bersama backend-nya; di Fase 2 menunya sudah tampil tetapi membuka halaman "Segera hadir".

## T2.0 — (Manual) Perbaiki dan lengkapi desain di Stitch

Kerjakan di project Stitch sebelum T2.1. Satu prompt per perubahan. Prompt ditulis dalam bahasa Inggris supaya hasil Stitch lebih stabil; teks UI tetap bahasa Indonesia.

**A. Perbaikan layar yang sudah ada**

1. *Komponen Honor:* "Edit the Komponen Honor screen. Keep the layout. Change Uang Transportasi to 2 distance tiers: '≤ 10 km → Rp10.000' and '> 10 km → Rp15.000', unit label 'per kunjungan sekolah'. Change Bonus Kelengkapan Administrasi to Rp20.000 'per sekolah per periode', description: 'Diberikan per sekolah bila status kelengkapan administrasi tentor pada sekolah tersebut Lengkap.' Remove the '100% tepat waktu' threshold. Uang Kehadiran Rp10.000 and Honor Mengajar Rp10.000, both 'per sesi sah'; remove GPS radius and '45 menit' text. Make 'Komponen Honor' the active sidebar item. Remove the budget distribution chart."
2. *Persetujuan Honorarium:* "Edit the Persetujuan Honorarium screen. In the detail panel, rename lines to: 'Uang Kehadiran — 28 sesi sah × Rp10.000', 'Honor Mengajar — 28 sesi sah × Rp10.000', 'Uang Transportasi — 20 kunjungan sekolah (tingkat jarak)', 'Bonus Kelengkapan Administrasi — 2 sekolah Lengkap × Rp20.000'. Remove 'Penyesuaian Khusus Pengganti' and the 'SK Penugasan Pengganti' link; show instead a 'Penyesuaian oleh Admin' row with reason. Replace the footer with two buttons: 'Tolak' (opens a dialog with required reason) and 'Setujui Tentor Ini'. In the page header add 'Tolak Periode' and 'Setujui Semua'. Replace the Bendahara text with 'Setelah disetujui, slip honorarium terbit dan Admin mencatat pembayaran.'"
3. *Eskalasi & Izin Mendesak:* "Edit the Eskalasi screen. Decision options: 'Tetapkan Pengganti', 'Jadwalkan Ulang', 'Batalkan Pertemuan'. Make 'Catatan Owner' required. Remove the 'Hubungi Koordinator Sekolah' button. Replace the WhatsApp text with 'Keputusan dikirim sebagai notifikasi sistem kepada Admin dan tentor terkait. Admin menyampaikan ke sekolah.'"
4. *Parameter Kebijakan (pilih satu versi, hapus yang lain):* "Edit the Parameter Kebijakan screen. Remove 'Wajib Foto Selfie Lapangan' and 'Validasi Wi-Fi Sekolah (BSSID)'. Presensi group items: Presensi masuk dibuka (15 menit sebelum jam mulai), Presensi pulang dibuka (15 menit sebelum jam selesai), Toleransi keterlambatan (30 menit), Ketelitian lokasi maksimal (50 meter), Batas area awal sekolah baru (150 meter), Pengingat presensi pulang (20.00), Waktu penandaan Tidak Hadir (23.59). Move 'Batas pengajuan koreksi presensi (60 hari)' to the Penggajian group. Each row shows status badge: Berlaku, Terjadwal, or Belum Dikonfigurasi. Add an optional 'Alasan perubahan' field next to the effective date in the footer."
5. *Alasan Penolakan (pilih satu versi, hapus yang lain):* "Edit the Alasan Penolakan screen. Title 'Alasan Penolakan Izin'. Subtitle: 'Dipakai Admin saat menolak pengajuan izin atau calon tentor pengganti.' Remove the category column and category tabs. Keep: urutan, nama alasan, frekuensi dipakai, status Aktif/Nonaktif toggle, actions Ubah, Nonaktifkan, and Hapus (disabled with tooltip 'Sudah pernah dipakai' when frequency > 0)."
6. *Pengadaan Aset:* "Change 'Ditolak — dikembalikan ke Admin' to 'Ditolak — alasan wajib, bersifat final'. Add a required 'Alasan penolakan' textarea shown when Ditolak is selected."
7. *Pembayaran Honor:* "Use status labels 'Dibayar', 'Dibayar Sebagian', 'Belum Dibayar', 'Tertunda'."

**B. Layar baru (gaya sama dengan layar yang ada)**

8. *Login:* "Create a login screen for Edukom ERP matching the existing design system: logo, email, kata sandi, 'Masuk' button, error message area, locked-account message 'Akun terkunci. Coba lagi dalam 12 menit.'"
9. *Panel notifikasi + profil:* "On the Beranda Owner screen, show the bell dropdown panel: tabs 'Belum dibaca' and 'Semua', notification items (judul, pesan singkat, waktu), 'Tandai semua dibaca'. Also show the profile menu with 'Ganti Kata Sandi' and 'Keluar', and the Ganti Kata Sandi dialog (kata sandi lama, baru, konfirmasi)."
10. *Riwayat Perubahan:* "Create 'Riwayat Perubahan' screen under the Kebijakan menu: filters (jenis objek, pelaku, rentang tanggal), table columns Waktu, Pelaku (nama + peran or 'Sistem'), Aksi, Objek, Perubahan (before → after), Alasan. Read-only, with pagination."
11. *Dialog Kebijakan:* "Create overlay variants for Komponen Honor: (a) 'Tambah Komponen' dialog: nama, deskripsi, dasar perhitungan (Per sesi sah / Per kunjungan sekolah / Per sekolah per periode / Tetap per periode), nominal Rp, tanggal mulai berlaku; (b) 'Ubah Besaran' dialog: nominal baru, tanggal mulai berlaku, alasan; (c) 'Ubah Tingkatan Jarak' editor: rows 'sampai [x] km → Rp[y]', last row 'di atas [x] km → Rp[y]', add/remove row, tanggal mulai berlaku, alasan; (d) 'Riwayat Versi' side panel with timeline badges Terjadwal/Berlaku/Berakhir/Dibatalkan and 'Batalkan' on scheduled versions; (e) 'Nonaktifkan Komponen' dialog: tanggal nonaktif, alasan."
12. *Aset & Perangkat:* "Add a 'Pindai QR' button in the header of the Aset & Perangkat screen that opens a camera scan dialog and then the unit profile panel."

Setelah selesai, beri nama layar sesuai daftar di bagian 4.3 agar mudah dicari lewat MCP.

## T2.1 — Setup frontend, koneksi Stitch MCP, dan design tokens

```text
PROMPT T2.1 — Setup frontend React di repo Laravel + koneksi Stitch MCP + design tokens

Ikuti CLAUDE.md. Prasyarat: Fase 0–1 selesai, T2.0 selesai. Baca docs/API_OWNER.md dan bagian 4 docs/TASK_OWNER.md.

Bagian A — Stitch MCP
1. Pastikan MCP server Stitch tersambung (endpoint resmi https://stitch.googleapis.com/mcp dengan kredensial
   sesuai dokumentasi Stitch). Verifikasi dengan tool list_projects.
2. Buka project "Owner Dashboard - Edukom ERP" (id 199635054751937416). Panggil list_screens, lalu get_screen
   untuk setiap layar. Simpan HTML mentah ke design/stitch/<slug-layar>.html dan screenshot ke
   design/stitch/<slug-layar>.png. Bila ada dua versi layar yang sama, ambil yang terbaru dan catat di laporan.
3. Ambil juga DESIGN.md dan design system project (warna, tipografi, radius, spacing) bila tersedia lewat MCP,
   simpan ke design/stitch/DESIGN.md.
4. Buat design/stitch/INDEX.md: daftar layar → slug → rute FE (bagian 4.3) → kebutuhan SRS.

Bagian B — Setup frontend
1. React + TypeScript + Vite (laravel-vite-plugin) di resources/js, Tailwind CSS.
   Library: react-router, @tanstack/react-query, axios, react-hook-form + zod, date-fns (locale id), lucide-react.
2. Route web catch-all: semua path selain /api, /sanctum, /docs → view 'app' yang memuat SPA.
3. Klien API (resources/js/lib/api.ts): withCredentials, /sanctum/csrf-cookie sebelum login, tangani 401
   (ke /login), 403 (halaman "Tidak berwenang"), 409/422/423 (tampilkan pesan server apa adanya).
4. Design tokens dari Stitch (DESIGN.md + HTML) ke tailwind config / CSS variables. Jangan mengarang token.
5. Komponen UI dasar di resources/js/components/ui, diturunkan dari HTML Stitch: Button, Input, NumberInput,
   MoneyInput (Rp, integer), TimeInput, DateInput, Select, Textarea, Toggle, Table (state kosong + skeleton),
   Badge status (ikon + teks, bukan hanya warna), Tabs, SidePanel, Dialog + Dialog konfirmasi (alasan wajib opsional),
   Toast, Pagination, Timeline versi, StatCard, Banner info/peringatan.
6. Utilitas format: formatRupiah (Rp10.000), formatTanggal (21 Nov 2026), formatWaktu (… WIB).
7. Halaman /ui-kit (hanya env local) yang menampilkan seluruh komponen dasar.

ATURAN: Stitch hanya acuan tampilan. Teks contoh, angka, dan aturan di HTML Stitch TIDAK boleh disalin sebagai
data/aturan; semua data diambil dari API. Lihat tabel 4.1 di docs/TASK_OWNER.md.

Test: Vitest + Testing Library untuk formatRupiah, formatTanggal, MoneyInput, Badge.
DoD: `npm run build` sukses, test FE lulus, design/stitch/INDEX.md lengkap, /ui-kit sesuai screenshot Stitch.
```

## T2.2 — Login, layout Owner, menu, Beranda, notifikasi

```text
PROMPT T2.2 — Login, layout Owner (menu lengkap), Beranda, notifikasi, ganti kata sandi

Ikuti CLAUDE.md. Acuan desain: design/stitch (login, beranda-owner + panel notifikasi + menu profil).
Endpoint: /auth/*, /owner/overview, /notifications/*.

Kerjakan:
- /login sesuai Stitch; pesan galat server (akun terkunci menampilkan sisa waktu); redirect owner → /owner,
  role lain → halaman "Modul belum tersedia".
- Guard: belum login → /login; bukan owner di /owner/* → halaman 403.
- Layout Owner sesuai Stitch dengan menu bagian 4.3 docs/TASK_OWNER.md (4 grup, termasuk Riwayat Perubahan).
  Menu Persetujuan dan Pemantauan membuka halaman "Segera hadir" (dibangun di Fase 3). Badge angka di menu
  Persetujuan TIDAK ditampilkan dulu (belum ada datanya).
- Tombol "Tinjau Persetujuan" di sidebar: sembunyikan dulu (Fase 3).
- Header: pencarian disembunyikan dulu; ikon notifikasi dengan angka belum dibaca (polling 60 detik), panel notifikasi
  (Belum dibaca/Semua, tandai dibaca, tandai semua, klik membuka action_url), menu profil (Ganti Kata Sandi, Keluar).
- /owner (Beranda): pakai layout Beranda Stitch, tetapi di Fase 2 hanya tampilkan blok yang datanya sudah ada dari
  /owner/overview: parameter Belum Dikonfigurasi (dengan tautan), perubahan terjadwal, komponen aktif, alasan aktif,
  notifikasi belum dibaca. Blok "Menunggu Keputusan Anda", "Pembelajaran", grafik laporan, "Sekolah dengan kendala",
  dan "Aset" ditampilkan sebagai placeholder "Tersedia setelah modul terkait aktif" (bukan angka palsu).
- Responsif 360–1920 px tanpa scroll horizontal (Owner terutama memakai tablet 768–1280 px).

Test: Vitest guard route dan badge notifikasi; Playwright: login owner → beranda → buka notifikasi → ganti kata sandi
→ logout; login dengan akun admin → halaman "Modul belum tersedia".
DoD: build dan test lulus; screenshot halaman vs Stitch.
```

## T2.3 — Halaman Parameter Kebijakan

```text
PROMPT T2.3 — Halaman Parameter Kebijakan (OW-02) di /owner/kebijakan/parameter

Ikuti CLAUDE.md. Acuan desain: layar Stitch "Parameter Kebijakan" (versi terpilih di INDEX.md).
Endpoint: /policy-parameters*. WAJIB baca tabel 4.1 bagian "Parameter Kebijakan" di docs/TASK_OWNER.md.

Kerjakan:
- Tata letak Stitch: daftar kategori di kiri (Pembelajaran, Presensi, Izin & Ganti, Penggajian, Operasional,
  Masa Simpan Data) dengan jumlah parameter per kategori; daftar parameter di kanan.
- Daftar parameter SEPENUHNYA dari API (32 parameter). Jangan menampilkan parameter yang tidak ada di API
  (misalnya foto selfie atau Wi-Fi BSSID dari desain).
- Tiap baris: label, deskripsi, nilai berlaku (display_value), "Berlaku sejak", badge status
  (Berlaku / Terjadwal / Belum Dikonfigurasi), tautan "Lihat Riwayat".
- Edit langsung di baris (seperti Stitch) dengan input sesuai value_type:
  integer + unit, time, relative_deadline (H-[n] pukul [HH:MM]), by_leave_type (terencana/mendesak),
  escalation, service_hours (hari + jam mulai/selesai), reupload_limit, file_rule (ekstensi, MB, jumlah berkas).
- Footer seperti Stitch: "Tanggal mulai berlaku" (default besok), "Alasan perubahan" (opsional), Batal,
  Simpan Perubahan. Simpan = satu POST /versions per parameter yang berubah, dijalankan berurutan.
  Bila sebagian gagal (409/423/422), tampilkan daftar mana yang berhasil dan mana yang gagal beserta pesan server;
  yang berhasil tidak dibatalkan.
- Panel "Riwayat versi" (dari "Lihat Riwayat"): timeline Terjadwal/Berlaku/Berakhir/Dibatalkan, pembuat, alasan;
  tombol Batalkan hanya pada versi terjadwal, dialog alasan wajib.
- Banner info "Perubahan dicatat dalam log audit dan berlaku sejak tanggal yang dipilih. Periode penggajian yang
  sudah ditutup tidak berubah." (sesuai Stitch, teks disesuaikan SRS).
- Tautan "Log Perubahan Kategori" → /owner/kebijakan/riwayat dengan filter subject_type=policy_parameter.

Test: Vitest input per value_type dan logika simpan sebagian; Playwright: ubah toleransi keterlambatan untuk besok →
badge Terjadwal → batalkan di Riwayat versi → kembali Berlaku.
DoD: build dan test lulus; screenshot vs Stitch; laporan perbedaan yang disengaja (karena SRS).
```

## T2.4 — Halaman Komponen Honor dan Tingkatan Jarak

```text
PROMPT T2.4 — Halaman Komponen Honor (OW-01) di /owner/kebijakan/komponen-honor

Ikuti CLAUDE.md. Acuan desain: layar Stitch "Komponen Honor" + dialog-dialognya (T2.0 no. 11).
Endpoint: /honor-components*. WAJIB baca tabel 4.1 bagian "Komponen Honor" di docs/TASK_OWNER.md.

Kerjakan:
- Tata letak kartu seperti Stitch: satu kartu per komponen berisi nama, kode, badge Aktif/Nonaktif/Akan Nonaktif,
  label "Bawaan" untuk komponen sistem, dasar perhitungan (label Indonesia dari API), nominal berlaku atau ringkasan
  tingkatan jarak, "Berlaku sejak", perubahan terjadwal, aksi Ubah Besaran / Nonaktifkan / Riwayat.
- Banner "Prinsip Audit & Kebijakan Pemilik" seperti Stitch, teks: "Perubahan nominal berlaku sejak tanggal yang dipilih
  dan tidak mengubah periode penggajian yang sudah ditutup. Riwayat perubahan tercatat."
- Kartu bonus menampilkan teks tetap: "Diberikan per sekolah bila status kelengkapan administrasi tentor pada sekolah
  tersebut Lengkap." Jangan tampilkan syarat ketepatan waktu.
- Kartu transport menampilkan tingkatan dari API, satuan "per kunjungan sekolah".
- Jangan menampilkan grafik "Distribusi Anggaran" (tidak ada di SRS).
- Tombol "+ Tambah Komponen" → dialog (nama, deskripsi, dasar perhitungan dengan penjelasan singkat, nominal,
  tanggal mulai berlaku).
- Dialog Ubah Besaran (komponen flat), Editor Tingkatan Jarak (komponen transport: baris "sampai [x] km → Rp[y]",
  baris terakhir "di atas [x] km → Rp[y]", validasi naik ketat dan 1 desimal, pratinjau ringkasan),
  dialog Nonaktifkan (tanggal + alasan), Batalkan Penonaktifan bila terjadwal, panel Riwayat Versi.
- Filter "Berlaku pada tanggal" untuk melihat tarif per tanggal.

Test: Vitest editor tingkatan; Playwright: ubah tarif uang kehadiran bulan depan → Terjadwal; tambah set tingkatan
baru; tambah komponen baru; nonaktifkan komponen tambahan.
DoD: build dan test lulus; screenshot vs Stitch; laporan perbedaan yang disengaja.
```

## T2.5 — Halaman Alasan Penolakan Izin

```text
PROMPT T2.5 — Halaman Alasan Penolakan Izin (OW-03) di /owner/kebijakan/alasan-penolakan

Ikuti CLAUDE.md. Acuan desain: layar Stitch "Alasan Penolakan" (versi terpilih).
Endpoint: /leave-rejection-reasons*. WAJIB baca tabel 4.1 bagian "Alasan Penolakan".

Kerjakan:
- Judul "Alasan Penolakan Izin", subjudul "Dipakai Admin saat menolak pengajuan izin atau calon tentor pengganti."
- Kartu ringkas seperti Stitch: jumlah alasan aktif, nonaktif, total pemakaian (dari usage_count; bernilai 0 sampai
  modul izin aktif). Tombol Hapus dinonaktifkan bila can_delete = false (tooltip "Sudah pernah dipakai").
- Tabel: urutan (drag untuk mengubah sort_order), nama + deskripsi, status Aktif/Nonaktif (toggle), aksi Ubah,
  Nonaktifkan/Aktifkan, Hapus. TANPA kolom/tab kategori.
- Filter Semua / Aktif / Nonaktif, pencarian nama.
- Hapus: dialog konfirmasi; bila server membalas 409 REFERENCE_IN_USE tampilkan "Alasan sudah pernah dipakai, hanya
  dapat dinonaktifkan" dan tawarkan tombol Nonaktifkan.
- Banner "Alasan yang sudah pernah dipakai tidak dapat dihapus agar riwayat keputusan tetap utuh."

Test: Playwright tambah → ubah → urutkan → nonaktifkan → aktifkan → hapus.
DoD: build dan test lulus; screenshot vs Stitch.
```

## T2.6 — Halaman Riwayat Perubahan dan uji E2E irisan Owner

```text
PROMPT T2.6 — Riwayat Perubahan (KU-05) di /owner/kebijakan/riwayat + uji E2E irisan Owner

Ikuti CLAUDE.md. Acuan desain: layar Stitch "Riwayat Perubahan" (T2.0 no. 10). Endpoint: /audit-logs.

Kerjakan:
- Tabel: waktu, pelaku (nama + peran, atau "Sistem"), aksi (label Indonesia; buat peta action → label), objek
  (subject_label), perubahan (diff before → after yang mudah dibaca), alasan. Filter jenis objek, pelaku, rentang
  tanggal. Paginasi.
- Tautan "Lihat Riwayat"/"Log Perubahan" dari halaman Parameter, Komponen Honor, dan Alasan Penolakan membuka halaman
  ini dengan filter objek terisi.
- E2E Playwright irisan Owner (data DemoSeeder):
  login → Beranda → ubah parameter → ubah tarif → tambah alasan → Riwayat Perubahan memuat ketiganya →
  notifikasi terbaca → logout.
- Checklist manual responsif (360, 768, 1280 px) dan kontras (axe).

DoD: seluruh test BE + FE + E2E lulus; laporan perbedaan dengan Stitch (disengaja karena SRS vs belum dikerjakan).
```

> **Catatan Admin (AD-27):** Admin boleh melihat parameter dan komponen. Tampilan Admin dibuat nanti saat irisan Admin dikerjakan; backend-nya sudah siap sejak Fase 1.

---

# FASE 3 — Fitur Owner Berikutnya (peta jalan)

Fitur-fitur ini butuh data dari peran lain. Prompt rinci sebaiknya dibuat ketika prasyaratnya mulai dikerjakan, supaya isinya sesuai struktur data yang sudah ada. Desain Stitch untuk semua fitur ini **sudah ada**; saat membuat prompt-nya, sertakan baris yang relevan dari tabel 4.1 sebagai koreksi wajib.

| Urutan | Irisan fullstack | Fitur Owner | Layar Stitch | Ikut dibangun (peran lain) | Inti aturan Owner | Koreksi desain wajib (tabel 4.1) |
|---|---|---|---|---|---|---|
| 3a | Pengadaan aset | OW-09 | Pengadaan Aset | AD-33, AD-28, KU-04, progres penerimaan dari AD-29 | Setuju/Tolak (alasan wajib); bila setuju isi spesifikasi, jumlah, perkiraan anggaran per item; keputusan tidak dapat diubah, pembatalan oleh Owner dengan alasan; pengingat setelah `procurement_reminder_workdays` | Ditolak bersifat final, alasan wajib |
| 3b | Laporan Pertemuan | OW-06 (+sebagian OW-10) | Pemantauan Pembelajaran | AD-01–AD-07, TN-07, AD-13 | Hanya Owner membuka kembali laporan Terverifikasi; alasan wajib; versi baru Perlu Perbaikan; notifikasi ke tentor dan Admin | — (dialog di Stitch sudah sesuai) |
| 3c | Izin dan penggantian | OW-04, OW-05 | Eskalasi & Izin Mendesak | TN-09–TN-12, AD-15–AD-17 | OW-04 aktif hanya di luar `admin_service_hours`, pemeriksaan kelayakan sama dengan AD-15, alasan tolak dari OW-03; OW-05: Tetapkan Pengganti / Jadwalkan Ulang / Batalkan Pertemuan dengan catatan wajib | Hapus "Kompensasi", WhatsApp, tombol Hubungi Koordinator; catatan wajib |
| 3d | Presensi dan honorarium | OW-07, OW-08, OW-13 | Persetujuan Honorarium, Penyesuaian Honor, Pembayaran Honor | TN-14–TN-17, AD-19–AD-26 | Setuju/tolak per periode atau per tentor (tolak wajib alasan); Owner tidak mengubah nilai; slip terbit setelah setuju; batal setuju hanya bila belum ada pembayaran; penyesuaian tambah dibayar periode berjalan, kurang di periode berikutnya | Rincian komponen per sesi sah dan per kunjungan sekolah; hapus insentif pengganti, Bonus Kinerja, Bendahara; tambah tombol Tolak; label status pembayaran |
| 3e | Dashboard | OW-10, OW-11, OW-12 (+blok Beranda) | Pemantauan Pembelajaran, Aset & Perangkat, Izin & Penggantian, Beranda Owner | Semua di atas | Hanya lihat; tampilkan waktu pengambilan data; Pertemuan dan laporan dihitung terpisah; siswa dihitung unik; penanda ambang frekuensi izin tanpa sanksi; pindai QR profil unit | Tambah tombol Pindai QR di Aset & Perangkat |

**Rekomendasi irisan berikutnya: 3a (Pengadaan aset).** Prasyaratnya paling sedikit (jenis perangkat, pengajuan, unggah berkas), desainnya hampir sesuai, dan alurnya langsung menghasilkan kerja sama Admin ↔ Owner yang lengkap.

---

## Lampiran — Templat prompt untuk fitur berikutnya

Pakai templat ini supaya prompt baru tetap konsisten dengan Fase 0–2:

```text
PROMPT <KODE> — <Judul fitur> (<kode SRS>)

Ikuti CLAUDE.md. Prasyarat: <task yang harus selesai>.
Sumber: <kode kebutuhan revisi> + <kode SRS lama bila butuh rincian> + <lampiran>.

Aturan bisnis (wajib, bisa diuji):
- <aturan 1, dengan angka/parameter: PolicyParameters::get('<key>')>
- ...

Data:
- <tabel: kolom, tipe, FK, index, status enum + label>

Service/Action:
- <nama, input, output, transaksi, audit, notifikasi>

Endpoint (/api/v1):
- <METHOD path (role)> → <aturan, kode galat>

Jangan kerjakan: <batas ruang lingkup>

Test wajib:
- <kasus normal, batas, galat, matriks akses, audit, notifikasi>

DoD: test lulus, Scribe, docs/API_<PERAN>.md diperbarui, laporan asumsi.
```
