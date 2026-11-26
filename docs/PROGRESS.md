# Progress — Irisan Owner

Status: ⬜ Belum · 🟡 Berjalan · ✅ Selesai · ⛔ Terhambat

Diperbarui oleh agent di akhir setiap task. Manusia memeriksa dan mengubah status ke ✅ setelah review dan merge.

## Ringkasan

| Task | Judul | Status | Branch | Selesai | Catatan singkat |
|---|---|---|---|---|---|
| T0.1 | Autentikasi (Laravel sudah terpasang) | 🟡 | feat/t0-1-autentikasi | 2026-11-25 | Menunggu review; 24 test lulus |
| T0.2 | Hak akses berbasis peran | 🟡 | feat/t0-2-hak-akses | 2026-11-25 | Menunggu review; 21 test baru lulus |
| T0.3 | Riwayat perubahan (audit trail) | 🟡 | feat/t0-3-audit-trail | 2026-11-25 | Menunggu review; 16 test baru lulus |
| T0.4 | Notifikasi di dalam sistem | 🟡 | feat/t0-4-notifikasi | 2026-11-25 | Menunggu review; 13 test baru lulus |
| T0.5 | Periode penggajian (minimal) dan pola data berversi | 🟡 | feat/t0-5-periode-versi | 2026-11-25 | Menunggu review; 10 test baru lulus |
| T1.1 | Parameter kebijakan berversi (OW-02, AD-27) | ⬜ | | | |
| T1.2 | Komponen honorarium dan tarif berversi (OW-01, AD-27) | ⬜ | | | |
| T1.3 | Tingkatan jarak uang transportasi (OW-01.4) | 🟡 | feat/t1-1-parameter-kebijakan | 2026-11-26 | API saja (UI ditunda); 28 test baru lulus; belum di-commit |
| T1.4 | Daftar alasan penolakan izin (OW-03) | 🟡 | feat/t1-1-parameter-kebijakan | 2026-11-26 | API saja (UI ditunda); test ditulis, **belum dijalankan**; belum di-commit |
| T1.5 | Masa simpan data dan pembersihan otomatis (OW-15) | 🟡 | feat/t1-1-parameter-kebijakan | 2026-11-26 | API saja (UI ditunda); test ditulis, **belum dijalankan**; belum di-commit |
| T1.6 | Beranda dan konsolidasi Fase 1 (dulu T1.5 lama) | 🟡 | feat/t1-1-parameter-kebijakan | 2026-11-26 | API saja (Beranda Blade & E2E ditunda); test ditulis, **belum dijalankan**; belum di-commit |
| T2.0 | (Manual) Perbaiki dan lengkapi desain di Stitch | ⬜ | | | |
| T2.1 | Setup frontend, koneksi Stitch MCP, dan design tokens | ⬜ | | | |
| T2.2 | Login, layout Owner, menu, Beranda, notifikasi | ⬜ | | | |
| T2.3 | Halaman Parameter Kebijakan | ⬜ | | | |
| T2.4 | Halaman Komponen Honor dan Tingkatan Jarak | ⬜ | | | |
| T2.5 | Halaman Alasan Penolakan Izin | ⬜ | | | |
| T2.6 | Halaman Riwayat Perubahan dan uji E2E irisan Owner | ⬜ | | | |

## Log per task

<!-- Salin templat di bawah untuk setiap task yang selesai. Terbaru di atas. -->

### Halaman Blade Owner — Tahap 1: layout, Beranda, Riwayat Perubahan (2026-11-26)
- **Branch:** feat/t1-1-parameter-kebijakan (belum di-commit).
- **Ringkasan:** layout Owner (`components/layouts/owner.blade.php`) dengan sidebar urutan Stitch (Utama, Persetujuan, Pemantauan, Kebijakan + Masa Simpan Data, Pengaturan: Riwayat Perubahan), label grup sentence case, menu tanpa halaman tampil redup; animasi tab cekung saat hover/fokus/aktif (`.nav-item` di `app.css`, warna canvas, mati bila reduced motion); top bar dengan panel notifikasi dan menu akun; drawer di mobile, rail ikon di tablet. Halaman `/owner` (data `OwnerOverview`) dan `/owner/pengaturan/riwayat` (`AuditLogQuery` dipakai bersama API, label `AuditLabels`). Owner di `/beranda` dialihkan ke `/owner`. Rute web notifikasi: `POST /notifikasi/{id}/baca` (hanya tautan internal), `POST /notifikasi/baca-semua`. Komponen `x-chip`; 19 ikon Material Symbols.
- **Perbedaan disengaja dari Stitch:** subjudul/keterangan, kolom cari, tombol bantuan, dropdown periode, Ekspor, label HURUF BESAR, dan kartu berbayang dihapus; tombol "Tinjau Persetujuan" disembunyikan sampai modul persetujuan ada.
- **Test:** `tests/Feature/Web/OwnerPagesTest.php` (ditulis, belum dijalankan).
- **Ditunda (disetujui user):** grafik di Beranda menunggu data nyata dari modul Pembelajaran/Aset/Honorarium (Beranda final, T3.5).

### Halaman Blade Owner — Tahap 2–3: Parameter Kebijakan, Komponen Honor (2026-11-26)
- **Parameter:** `/owner/kebijakan/parameter` (per grup, tanpa grup Masa Simpan) dan `/owner/kebijakan/parameter/{key}` (nilai berlaku, perubahan terjadwal + batalkan, form nilai baru dengan input per tipe di `_value-input.blade.php`, riwayat nilai).
- **Komponen Honor:** `/owner/kebijakan/komponen-honor` (daftar + dialog Tambah) dan `/{id}` (ubah besaran atau editor tingkatan jarak dengan validasi langsung + pratinjau ringkasan, info komponen, nonaktifkan/batalkan, riwayat).
- **Teknis:** controller web memakai FormRequest API lewat subkelas di `app/Http/Requests/Web/Owner` (error bag per form + `CastsFormNumbers` karena form mengirim angka sebagai teks; batas km boleh koma); `ApiException` di request web non-GET kembali ke halaman sebelumnya pada bag `_bag`; kelas `.field`/`.btn*`/`.link` di `app.css`; `App\Support\Format::rupiah`; `VersionStatus::tone()`.
- **Test:** `tests/Feature/Web/OwnerPolicyPagesTest.php` (ditulis, belum dijalankan).

### Halaman Blade Owner — Tahap 4: Alasan Penolakan, Masa Simpan Data (2026-11-26)
- **Alasan Penolakan** (`/owner/kebijakan/alasan-penolakan`): penyaring Semua/Aktif/Nonaktif + cari, dialog Tambah/Ubah, urutan naik/turun (hanya saat daftar lengkap; `LeaveRejectionReasons::move`), Nonaktifkan/Aktifkan, Hapus dengan dialog konfirmasi (tombol nonaktif + tooltip bila sudah dipakai), jumlah pemakaian per alasan.
- **Masa Simpan Data** (`/owner/kebijakan/masa-simpan`): 5 jenis data dengan nilai berlaku/terjadwal; "Ubah" membuka halaman parameter yang sama (tautan kembali mengarah ke Masa Simpan); pembersihan terakhir dengan ringkasan per jenis; "Jalankan uji" (dry-run sinkron) menampilkan perkiraan.
- **Perbedaan disengaja dari task:** urutan memakai tombol naik/turun (aksesibel keyboard), bukan drag & drop; banner "tidak dapat dihapus" diganti tooltip pada tombol hapus yang nonaktif.
- **Test:** tambahan di `tests/Feature/Web/OwnerPolicyPagesTest.php` (ditulis, belum dijalankan).

### T1.6 — Beranda dan konsolidasi Fase 1 (2026-11-26)
- **Branch:** feat/t1-1-parameter-kebijakan (belum di-commit).
- **Acuan:** `docs/tasks/T1.6-beranda-konsolidasi-fase1.md` (SRS v3) digabung dengan T1.5 Konsolidasi versi API di `HEAD`. Halaman Beranda Livewire, uji browser E2E, cek responsif, dan axe ditunda ke tahap halaman Blade.
- **Ringkasan perubahan:** `GET /api/v1/owner/overview` (`App\Domain\Owner\OwnerOverview`); alias `subject_type` lewat `Relation::morphMap` (tanpa enforce, tanpa `User`); hook `versionSubject()` sehingga audit versi parameter/tarif/set tingkatan dicatat dengan subjek induknya (parameter / komponen honor); matriks akses 36 endpoint × 5 peran × tamu + test pengaman rute baru; `DemoSeeder` (local, manual, idempoten); `docs/API_OWNER.md`; CLAUDE.md (alias riwayat, perintah demo & masa simpan).
- **File utama:** `app/Domain/Owner/OwnerOverview.php`; `OwnerOverviewController`; `app/Providers/AppServiceProvider.php`; `app/Domain/Versioning/{HasEffectiveDating,VersionTimeline}.php`; `app/Models/{PolicyParameterVersion,HonorComponentRate,TransportTierSet}.php`; `database/seeders/DemoSeeder.php`; `docs/API_OWNER.md`; test `tests/Feature/Access/OwnerPhase1AccessTest.php`, `tests/Feature/Owner/OwnerOverviewTest.php`, `tests/Feature/Audit/ObjectHistoryTest.php`.
- **Endpoint baru:** `GET /api/v1/owner/overview` (owner).
- **Test:** ditulis, belum dijalankan (dijalankan user bersama T1.2–T1.5). Matriks akses ±37 test; perkiraan 15–30 menit di DB remote.
- **Asumsi yang diambil (disetujui user):**
  - Audit versi memakai subjek induk; alias `retention_policy` dan `admin_account` dari task tidak dibuat (masa simpan = parameter; modul akun Admin belum ada).
  - Matriks: peran yang boleh hanya diperiksa "bukan 401/403" (bisa 404/409/422 karena payload kosong).
  - `DemoSeeder` tidak ikut `db:seed`; dijalankan manual. Periode bulan lalu ditutup terakhir agar versi demo tidak tertolak.
  - `last_retention_run` di Beranda hanya pembersihan sungguhan (bukan uji).
- **Perlu dikonfirmasi:**
  - Data audit lama di DB dev yang memakai nama kelas penuh (`App\Models\...`) tidak ikut alias; DB test selalu bersih. Bila DB dev perlu konsisten, kosongkan dengan `migrate:fresh`.
  - `scribe:generate` belum dijalankan ulang: response call GET butuh tabel T1.2–T1.5 sudah di-migrate.
  - Entri log T1.1 dan T1.2 di file ini belum ditulis.

### T1.5 — Masa simpan data dan pembersihan otomatis (2026-11-26)
- **Branch:** feat/t1-1-parameter-kebijakan (belum di-commit; di-commit bersama T1.1–T1.4 setelah diuji).
- **Acuan:** `docs/tasks/T1.5-masa-simpan.md` (set SRS v3, OW-15), versi API; disetujui user dikerjakan sebelum konsolidasi (T1.6). Halaman Livewire, tangkapan layar, dan uji browser ditunda.
- **Ringkasan perubahan:** parameter `data_retention_months` (T1.1) diganti 5 parameter per jenis `retention_*_months` (nilai awal 6 bulan, 1–120), sehingga katalog jadi 36 parameter; `RetentionCatalog`; registry `edukom.retention_targets`; `RetentionPurger::run($dryRun)` (berkas dihapus + kolom dikosongkan, baris tetap; galat per jenis tidak menghentikan jenis lain); logika hapus audit dipindah ke `AuditPurger` dan dipakai bersama `edukom:purge-audit`; command `edukom:purge-retention [--dry-run]` terjadwal 02.00 WIB; tabel `retention_runs`; audit `retention.purged` (pelaku Sistem) + notifikasi `retention.purged` ke Owner; catatan "Masa simpan data" di CLAUDE.md.
- **File/migration utama:** `2026_11_26_000005_create_retention_runs_table`; `app/Domain/Retention/{RetentionCatalog,RetentionPurger}.php`; `app/Domain/Audit/AuditPurger.php`; `app/Console/Commands/{PurgeRetention,PurgeAudit}.php`; `app/Models/RetentionRun.php`; `RetentionController`, `RetentionRunResource`; `routes/{api,console}.php`; `app/Domain/Policy/ParameterCatalog.php`; `config/edukom.php`; test `tests/database/migrations/2026_11_26_900001_create_test_evidence_files_table.php`, `tests/Fixtures/TestEvidenceFile.php`.
- **Endpoint baru (owner):** `GET /api/v1/retention`, `GET /retention-runs` (25 per halaman), `POST /retention-runs/dry-run`. Ubah/batal masa simpan memakai endpoint parameter T1.1.
- **Test:** `tests/Feature/Retention/RetentionTest.php` (ditulis, belum dijalankan); `PolicyParameterTest` disesuaikan 32 → 36.
- **Asumsi yang diambil (disetujui user):**
  - Masa simpan disimpan sebagai parameter kebijakan, bukan tabel `retention_policies` terpisah. Akibatnya tanggal berlaku tetap diperiksa terhadap periode penggajian tertutup (task menyebut tidak perlu); Admin dapat melihat nilainya lewat daftar parameter (read-only).
  - Hanya berkas yang dihapus (kolom berkas dikosongkan); baris data tidak dihapus. `audit_log` dihapus barisnya.
  - Dry-run dijalankan langsung (sinkron), bukan lewat job antrean.
  - Batas = hari ini dikurangi N bulan (tanpa overflow akhir bulan); data dengan tanggal < batas dibersihkan.
  - Jenis tanpa sumber terdaftar → status `skipped`; masa simpan belum dikonfigurasi → `skipped`.
- **Perlu dikonfirmasi:**
  - Kolom berkas diasumsikan satu path per baris. Bila modul nanti menyimpan beberapa berkas per baris (JSON), purger perlu diperluas.
  - Scheduler butuh `php artisan schedule:run` tiap menit (cron/Task Scheduler) di server.
- **Catatan untuk task berikutnya:** modul presensi, izin, serah terima, dan slip mendaftarkan sumber berkasnya di `edukom.retention_targets`.

### T1.4 — Daftar alasan penolakan izin (2026-11-26)
- **Branch:** feat/t1-1-parameter-kebijakan (belum di-commit; di-commit bersama T1.1–T1.3 setelah diuji).
- **Acuan:** versi API `docs/tasks/T1.4-alasan-penolakan.md` di `HEAD` (aturan sama dengan versi SRS v3 di working tree). Halaman Livewire, `<livewire:shared.rejection-reason-select>`, tangkapan layar, dan uji browser ditunda ke tahap halaman Blade.
- **Ringkasan perubahan:** tabel `leave_rejection_reasons`; model `LeaveRejectionReason implements TracksUsage`; `ReferenceUsage::countsFor()` (registry `edukom.reference_usage`, satu query per tabel terdaftar); `LeaveRejectionReasons::create/update/reorder/activate/deactivate/delete` (transaksi + audit `leave_rejection_reason.*`); `ApiException::conflict()` menerima kode galat opsional (`REFERENCE_IN_USE`); seeder contoh 4 alasan (hanya local); catatan "Data referensi" di CLAUDE.md.
- **File/migration utama:** `2026_11_26_000004_create_leave_rejection_reasons_table`; `app/Domain/Reference/{TracksUsage,ReferenceUsage,LeaveRejectionReasons}.php`; `app/Models/LeaveRejectionReason.php`; `LeaveRejectionReasonController`; requests `{LeaveRejectionReasonIndex,StoreLeaveRejectionReason,UpdateLeaveRejectionReason,ReorderLeaveRejectionReasons}Request` + `LeaveRejectionReasonRules`; `LeaveRejectionReasonResource`; `LeaveRejectionReasonSeeder`; `config/edukom.php`; test `tests/database/migrations/2026_11_26_900000_create_test_reason_usages_table.php`.
- **Endpoint baru:** `GET /api/v1/leave-rejection-reasons` (owner, admin); `POST /leave-rejection-reasons`, `PUT /leave-rejection-reasons/order`, `PATCH|DELETE /leave-rejection-reasons/{id}`, `POST /leave-rejection-reasons/{id}/deactivate|activate` (owner).
- **Test:** `tests/Feature/Reference/LeaveRejectionReasonTest.php` (ditulis, belum dijalankan; dijalankan bersama T1.2–T1.3).
- **Asumsi yang diambil:**
  - `PUT /order` wajib memuat semua id alasan (aktif dan nonaktif) tepat satu kali; selain itu 422.
  - Admin yang mengirim `status=all|inactive` tetap menerima alasan aktif saja (parameter diabaikan, bukan ditolak).
  - Alasan belum pernah dipakai dihapus permanen (pengecualian dari aturan umum "data induk tidak dihapus", sesuai task); audit `deleted` menyimpan nama dan isinya.
  - Nonaktifkan yang sudah nonaktif / aktifkan yang sudah aktif → 409. Status tidak dapat diubah lewat PATCH (422).
  - Daftar tanpa paginasi (jumlah kecil), urut `sort_order` lalu `id`.
- **Perlu dikonfirmasi:**
  - Halaman Blade Alasan Penolakan belum ada.
  - Daftar resmi alasan disusun Owner (Lampiran E no. 14); seeder hanya contoh untuk local.
- **Catatan untuk task berikutnya:** modul izin (T2.5/AD-15) mendaftarkan `[tabel, kolom]` di `edukom.reference_usage`, menyimpan salinan nama alasan, dan hanya menerima alasan `is_active`.

### T1.3 — Tingkatan jarak uang transportasi (2026-11-26)
- **Branch:** feat/t1-1-parameter-kebijakan (belum di-commit; rencananya di-commit bersama T1.1 dan T1.2 setelah diuji, commit terpisah per task).
- **Acuan:** `docs/tasks/T1.3-tingkatan-jarak.md` (OW-01.4, AC-OW-01.4), hanya bagian backend. Bagian Livewire/editor/tangkapan layar/uji browser ditunda ke tahap halaman Blade.
- **Ringkasan perubahan:** tabel `transport_tier_sets` (berversi) + `transport_tiers`; model `TransportTierSet` (`HasEffectiveDating`, audit `transport_tier_set.*`) dan `TransportTier`; `TransportTierSets::add` (transaksi, 422 bila komponen bukan tingkatan jarak, 409 bila komponen nonaktif); `HonorRates::transportAmountFor/transportTiersOn/transportSummary/summarizeTiers/roundKm` (pembulatan half up 1 desimal dengan BCMath); hook `versionContent()` di `HasEffectiveDating` agar audit before/after memuat daftar tingkatan; seeder set awal `[≤10 km Rp10.000, >10 km Rp15.000]` mulai `EDUKOM_POLICY_BASE_DATE`; `HonorComponentResource` menampilkan `current_tier_set` dan `scheduled_tier_set` untuk komponen tingkatan jarak.
- **File/migration utama:** `2026_11_26_000003_create_transport_tier_tables`; `app/Models/{TransportTierSet,TransportTier}.php`; `app/Domain/Honorarium/{TransportTierSets,HonorRates}.php`; `app/Domain/Versioning/{HasEffectiveDating,VersionTimeline}.php`; `app/Http/Requests/Api/V1/StoreTransportTierSetRequest.php`; `app/Http/Resources/V1/{TransportTierSetResource,HonorComponentResource}.php`; `HonorComponentController`; `routes/api.php`; `HonorComponentSeeder`.
- **Endpoint baru:** `GET /api/v1/honor-components/{id}/tier-sets` (owner, admin; 50 versi terbaru); `POST /honor-components/{id}/tier-sets` (owner); `POST /honor-components/{id}/tier-sets/{tierSet}/cancel` (owner).
- **Test:** 28 test baru lulus (`tests/Feature/Honorarium/TransportTierTest.php`).
- **Asumsi yang diambil:**
  - Tingkatan terakhir wajib tanpa batas atas (`max_km` null) agar setiap jarak pasti punya tingkatan; maksimal 20 tingkatan; `max_km` > 0 dan ≤ 99999,9.
  - Tingkatan pertama mencakup 0 km (`min_km_exclusive` 0,0 hanya penanda; pencarian memakai batas atas).
  - Jarak negatif ke `transportAmountFor` melempar `InvalidArgumentException` (galat program, bukan input pengguna).
  - Format ringkasan tingkatan tengah: `> 10–20 km: Rp12.000`; satu tingkatan saja: `Semua jarak: Rp…`.
- **Perlu dikonfirmasi:**
  - Halaman Blade (kartu Uang Transportasi + editor tingkatan) belum ada; dikerjakan bersama halaman Komponen Honor.
  - Entri log T1.1 dan T1.2 di file ini belum ditulis.
- **Catatan untuk task berikutnya:** penggajian (AD-23) memakai `HonorRates::transportAmountFor($jarakKm, $tanggalKunjungan)`; jarak AD-36 cukup dikirim apa adanya karena pembulatan dilakukan di service.

### T0.5 — Periode penggajian dan data berversi (2026-11-25)
- **Branch:** feat/t0-5-periode-versi (dari feat/t0-4-notifikasi)
- **Acuan:** task lama `T0.5-periode-dan-data-berversi.md` (setara T0.6 SRS v3, tanpa Bagian C komponen Livewire).
- **Ringkasan perubahan:** tabel `payroll_periods` + enum `PayrollPeriodStatus` (label Indonesia) + factory `month()/closed()/approved()`; `PeriodGuard` (423 `LOCKED_PERIOD`); macro migration `$table->effectiveDating()`; trait `HasEffectiveDating` (scope `activeOn`, `versionStatus()`, wajib `versionSeries()`); enum `VersionStatus`; `VersionTimeline::add/cancel` (transaksi + kunci baris + audit).
- **File/migration utama:** `2026_11_25_000004_create_payroll_periods_table`; `app/Enums/{PayrollPeriodStatus,VersionStatus}.php`; `app/Models/PayrollPeriod.php`; `database/factories/PayrollPeriodFactory.php`; `app/Domain/Payroll/PeriodGuard.php`; `app/Domain/Versioning/{HasEffectiveDating,VersionTimeline}.php`; `app/Providers/AppServiceProvider.php` (macro); `tests/TestCase.php`, `tests/database/migrations/*`, `tests/Fixtures/TestVersion.php`.
- **Endpoint baru:** tidak ada.
- **Test:** 10 test baru lulus (`tests/Feature/Versioning/VersionTimelineTest.php`).
- **Asumsi yang diambil:**
  - Bulan tanpa baris periode dianggap terbuka. Periode dicari lewat `(year, month)` dari tanggal.
  - Tanggal ≤ versi terakhir → 409 `CONFLICT` (pesan menyebut tanggal versi terakhir, format "1 Desember 2026"); pembatalan tidak sah (sudah berlaku, bukan versi terakhir, sudah batal) → 409; alasan kosong → 422.
  - `created_by` boleh kosong (nilai bawaan dari seeder/command dicatat sebagai sistem).
  - Audit `version_created` menyimpan seluruh atribut versi baru; penutupan H-1 versi lama tidak dicatat terpisah.
- **Perlu dikonfirmasi:**
  - Tabel test `test_versions` ikut terbuat di `db_edukom` saat test dijalankan (DB dev = DB test). Tidak dipakai aplikasi.
  - Service `Periods::current()/next()/forDate()` (T0.6 SRS v3) belum dibuat; ditambah saat ada pemakainya.
- **Catatan untuk task berikutnya:** T1.1–T1.3 cukup membuat tabel dengan `effectiveDating()`, model dengan `HasEffectiveDating` + `versionSeries()`, lalu memanggil `VersionTimeline` dari Action.

### T0.4 — Notifikasi di dalam sistem (2026-11-25)
- **Branch:** feat/t0-4-notifikasi (dari feat/t0-3-audit-trail)
- **Acuan:** task lama `T0.4-notifikasi.md` (skema API) + helper `Recipients` dari T0.5 SRS v3. Lonceng/panel Livewire dan `export.ready` tidak dikerjakan.
- **Ringkasan perubahan:** tabel `notifications` bawaan Laravel; `EdukomNotification` (channel database, payload event/title/message/subject_type/subject_id/action_url; kolom `type` berisi kode event); `Notifier::send` (afterCommit, gagal → log warning); `Recipients::owners()/admins()`; 4 endpoint notifikasi milik sendiri; anotasi Scribe `@group` untuk notifikasi dan riwayat perubahan.
- **File/migration utama:** `2026_11_25_134017_create_notifications_table`; `app/Notifications/EdukomNotification.php`; `app/Domain/Notification/{Notifier,Recipients}.php`; `app/Http/Controllers/Api/V1/NotificationController.php`; `app/Http/Requests/Api/V1/NotificationIndexRequest.php`; `app/Http/Resources/V1/NotificationResource.php`; `routes/api.php`; `CLAUDE.md` (bagian "Notifikasi").
- **Endpoint baru:** `GET /api/v1/notifications`, `GET /api/v1/notifications/unread-count`, `POST /api/v1/notifications/{id}/read`, `POST /api/v1/notifications/read-all`.
- **Test:** 13 test baru lulus (`tests/Feature/Notification/NotificationTest.php`).
- **Asumsi yang diambil:**
  - Notifikasi dikirim sinkron (tanpa antrean) setelah commit; cukup untuk jumlah penerima yang kecil (1 Owner, 1 Admin).
  - Tandai dibaca mengembalikan 204; menandai notifikasi yang sudah dibaca tetap 204.
  - Daftar kode event dibuat di task pemicunya (belum ada konstanta).
- **Perlu dikonfirmasi:** —
- **Catatan untuk task berikutnya:** panggil `Notifier::send(Recipients::owners(), new EdukomNotification(...))` di Action pemicu.

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
