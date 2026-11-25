# Graph Report - Edukom-Project  (2026-11-25)

## Corpus Check
- 131 files · ~125,777 words
- Verdict: corpus is large enough that graph structure adds value.
- Unclassified: 10 file(s) not represented in the graph (top: (none) 6, .example 1, .xml 1)

## Summary
- 1005 nodes · 1284 edges · 119 communities (67 shown, 52 thin omitted)
- Extraction: 95% EXTRACTED · 5% INFERRED · 0% AMBIGUOUS · INFERRED: 66 edges (avg confidence: 0.9)
- Token cost: 52,587 input · 0 output

## Graph Freshness
- Built from commit: `adca1773`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- Frontend Build Dependencies
- Graphify & Task Logging Docs
- Database Migrations
- User Model & Seeding
- Controller
- Composer Scripts
- bootstrap/app.php
- Composer Plugin Settings
- LoginTest.php
- Unit Tests
- 1.3 Ruang Lingkup Sistem
- 3.4 Kebutuhan Fungsional Tentor (TN)
- Robots Crawl Policy
- Frontend Design
- Q: TASK 2026-11-25: Pemetaan dokumen ke graph (/graphify .)
- BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)
- Daftar Task — Irisan Owner (SRS v3)
- 3.3 Kebutuhan Fungsional Admin (AD)
- FASE 2 — Frontend Owner dari Desain Stitch (lewat MCP)
- 3.2 Modul Administrasi Pembelajaran (ADM)
- LoginRequest
- 3.1 Ketentuan Umum dan Layanan Bersama
- 3.1 Ketentuan Umum dan Layanan Bersama
- SessionTest.php
- ApiException
- Role
- UserFactory.php
- require-dev
- 3.5 Modul Manajemen Aset dan Ekspedisi (AST)
- LoginUser.php
- 3.3 Modul Izin dan Penggantian Tentor (IZN)
- 3.4 Modul Presensi dan Penggajian Tentor IT (PAY)
- BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)
- psr-4
- require
- Keputusan Proyek
- autoload-dev
- extra
- GRAPHIFY.md
- stitch/README.md
- 2026-11-25-graphify-semantic-docs.md
- 2026-11-25-setup-graphify.md
- EnsureUserHasRole.php
- Illuminate\Http\Request
- AppServiceProvider.php
- Log per task
- AuditTest.php
- RecordAccessDenial.php
- 3.2 Kebutuhan Fungsional Owner (OW)
- App\Http\Controllers\Api\V1\AuthController
- LoginRequest
- .record
- Role
- 2.3 Karakteristik dan Pemetaan Pengguna
- Illuminate\Support\Str
- BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)
- BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)
- T2.5 — Izin Mendesak di luar jam layanan Admin + Keputusan Eskalasi
- T3.1 — Pemantauan Pembelajaran + Buka Kembali Laporan Terverifikasi
- AuditLogController.php
- LAMPIRAN
- T0.2 — Autentikasi, layout Owner, profil, dan pengelolaan akun Admin
- T0.5 — Notifikasi di dalam sistem + panel notifikasi
- T1.1 — Parameter Kebijakan berversi + halaman Parameter Kebijakan
- T1.2 — Komponen Honorarium dan tarif berversi + halaman Komponen Honor
- T1.3 — Tingkatan jarak uang transportasi + editor Tingkatan Jarak
- T1.4 — Daftar Alasan Penolakan Izin + halaman Alasan Penolakan
- T1.5 — Masa Simpan Data dan pembersihan otomatis + halaman Masa Simpan Data
- T2.2 — Persetujuan Honorarium Periode + slip honorarium
- T2.3 — Keputusan Penyesuaian Honorarium
- T2.4 — Keputusan Pengadaan Aset
- T3.2 — Pemantauan Aset dan Perangkat + Pindai QR
- T3.3 — Pemantauan Rekap Izin dan Penggantian
- T3.4 — Pemantauan Honorarium dan Pembayaran
- T0.0 — (Manual) Lengkapi dan koreksi desain Owner di Stitch
- T0.1 — Setup Laravel fullstack (Livewire), design tokens, dan pengambilan desain Stitch
- T0.3 — Hak akses berbasis peran (middleware, Policy, pencatatan akses ditolak)
- T0.6 — Periode penggajian (minimal) dan pola data berversi
- T1.6 — Beranda Owner tahap 1 + konsolidasi Fase 1 (akses, data demo, E2E)
- T2.1 — Kerangka data operasional untuk fitur Owner (kontrak dengan modul Admin)
- T3.5 — Beranda Owner final, badge menu, Tinjau Persetujuan, dan E2E irisan Owner
- 3.5 Kebutuhan Fungsional Kurir (KR)
- tasks/README.md
- DatabaseSeeder.php
- Peta Layar Stitch — Irisan Owner

## God Nodes (most connected - your core abstractions)
1. `3.3 Kebutuhan Fungsional Admin (AD)` - 35 edges
2. `Role` - 29 edges
3. `3.2 Modul Administrasi Pembelajaran (ADM)` - 21 edges
4. `3.4 Kebutuhan Fungsional Tentor (TN)` - 19 edges
5. `User` - 18 edges
6. `actingAsRole()` - 16 edges
7. `AuditLog` - 14 edges
8. `3.2 Kebutuhan Fungsional Owner (OW)` - 14 edges
9. `3.1 Ketentuan Umum dan Layanan Bersama` - 14 edges
10. `3.1 Ketentuan Umum dan Layanan Bersama` - 14 edges

## Surprising Connections (you probably didn't know these)
- `T0.3 — Riwayat perubahan / audit trail (2026-11-25)` --references--> `LoginUser`  [INFERRED]
  docs/PROGRESS.md → app/Domain/Auth/Actions/LoginUser.php
- `Tambahan (di luar daftar task) — UI autentikasi sementara, Blade (2026-11-25)` --references--> `LoginUser`  [INFERRED]
  docs/PROGRESS.md → app/Domain/Auth/Actions/LoginUser.php
- `T0.2 — Hak akses berbasis peran (2026-11-25)` --references--> `actingAsRole()`  [INFERRED]
  docs/PROGRESS.md → tests/Pest.php
- `T0.2 — Hak akses berbasis peran (2026-11-25)` --references--> `rolesExcept()`  [INFERRED]
  docs/PROGRESS.md → tests/Pest.php
- `Tambahan (di luar daftar task) — UI autentikasi sementara, Blade (2026-11-25)` --references--> `ChangePassword`  [INFERRED]
  docs/PROGRESS.md → app/Domain/Auth/Actions/ChangePassword.php

## Import Cycles
- None detected.

## Communities (119 total, 52 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.22
Nodes (8): description, keywords, license, minimum-stability, name, prefer-stable, $schema, type

### Community 1 - "Frontend Build Dependencies"
Cohesion: 0.12
Nodes (21): devDependencies, axios@^1.11.0, concurrently@^9.0.1, @fontsource/poppins@^5.3.0, laravel-vite-plugin@^2.0.0, tailwindcss@^4.0.0, @tailwindcss/vite@^4.0.0, vite@^7.0.7 (+13 more)

### Community 2 - "Graphify & Task Logging Docs"
Cohesion: 0.18
Nodes (7): graphify (CLAUDE.md section), graphify reflect (LESSONS.md), graphify save-result memory step, Log task (WAJIB), python -m graphify invocation, Task log file format (docs/tasks/YYYY-MM-DD-slug.md), Memory: TASK 2026-11-25 Setup graphify knowledge graph

### Community 3 - "Database Migrations"
Cohesion: 0.09
Nodes (13): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}() (+5 more)

### Community 5 - "Controller"
Cohesion: 0.21
Nodes (5): HealthController, Controller, BerandaController, LoginController, PasswordController

### Community 6 - "Composer Scripts"
Cohesion: 0.22
Nodes (9): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+1 more)

### Community 7 - "bootstrap/app.php"
Cohesion: 0.13
Nodes (6): {closure#1}(), {closure#2}(), {closure#5}(), {closure#7}(), {closure#8}(), {closure#9}()

### Community 8 - "Composer Plugin Settings"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 10 - "LoginTest.php"
Cohesion: 0.31
Nodes (8): {closure#10}(), {closure#2}(), {closure#3}(), {closure#5}(), {closure#6}(), {closure#7}(), {closure#8}(), login()

### Community 15 - "1.3 Ruang Lingkup Sistem"
Cohesion: 0.18
Nodes (11): 1.1 Latar Belakang, 1.2 Tujuan Penyusunan Dokumen, 1.3.1 Modul Administrasi Pembelajaran, 1.3.2 Modul Izin dan Penggantian Tentor, 1.3.3 Modul Presensi dan Penggajian Tentor IT, 1.3.4 Modul Manajemen Aset dan Ekspedisi, 1.3.5 Modul Pelaporan dan Dashboard serta Pengaturan Sistem, 1.3.6 Integrasi Antarmodul (+3 more)

### Community 16 - "3.4 Kebutuhan Fungsional Tentor (TN)"
Cohesion: 0.11
Nodes (19): 3.4 Kebutuhan Fungsional Tentor (TN), TN-01 \| Pengisian Ketersediaan Waktu Mengajar, TN-02 \| Melihat Jadwal Mengajar dan Penugasan, TN-03 \| Pengisian Materi Rencana, TN-04 \| Pengunggahan Lampiran Kurikulum Sekolah, TN-05 \| Pengunggahan dan Perbaikan Dokumen Administrasi, TN-06 \| Pencatatan Nilai dan Portofolio Siswa, TN-07 \| Pengisian dan Pengiriman Laporan Pertemuan (+11 more)

### Community 23 - "Frontend Design"
Cohesion: 0.29
Nodes (6): Design principles, Frontend Design, Ground your designs in the subject matter, More on writing in design, Process: plan, review against the brief, build, critique, Restraint and self-critique

### Community 25 - "Q: TASK 2026-11-25: Pemetaan dokumen ke graph (/graphify .)"
Cohesion: 0.40
Nodes (4): Answer, Outcome, Q: TASK 2026-11-25: Pemetaan dokumen ke graph (/graphify .), Source Nodes

### Community 26 - "BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)"
Cohesion: 0.05
Nodes (42): 1.1 Latar Belakang, 1.2 Tujuan Penyusunan Dokumen, 1.3.1 Modul Administrasi Pembelajaran, 1.3.2 Modul Izin dan Penggantian Tentor, 1.3.3 Modul Presensi dan Penggajian Tentor IT, 1.3.4 Modul Manajemen Aset dan Ekspedisi, 1.3.5 Modul Pelaporan dan Dashboard serta Pengaturan Sistem, 1.3.6 Integrasi Antarmodul (+34 more)

### Community 27 - "Daftar Task — Irisan Owner (SRS v3)"
Cohesion: 0.25
Nodes (8): Bila task versi lama sudah dikerjakan, Cakupan kebutuhan Owner SRS v3, Daftar Task — Irisan Owner (SRS v3), Fase 0 — Fondasi Bersama, Fase 1 — Kebijakan Owner, Fase 2 — Keputusan Owner, Fase 3 — Pemantauan Owner, Perubahan dibanding daftar task sebelumnya

### Community 28 - "3.3 Kebutuhan Fungsional Admin (AD)"
Cohesion: 0.06
Nodes (35): 3.3 Kebutuhan Fungsional Admin (AD), AD-01 \| Pengelolaan Data Sekolah Mitra dan Kerja Sama, AD-02 \| Pengelolaan Formulir, Kelas, dan Peserta, AD-03 \| Pengelolaan Program Pembelajaran, AD-04 \| Pembagian Kelompok dan Perencanaan Sesi, AD-05 \| Pengelolaan Data dan Status Keaktifan Tentor, AD-06 \| Pencatatan Kesepakatan Jadwal, Jam Sekolah, dan Tanggal Tidak Efektif, AD-07 \| Penyusunan dan Penerbitan Jadwal (+27 more)

### Community 29 - "FASE 2 — Frontend Owner dari Desain Stitch (lewat MCP)"
Cohesion: 0.06
Nodes (31): 0. Cara memakai dokumen ini, 1. Keputusan teknis (asumsi dasar), 2. Perlu dikonfirmasi Owner (default yang dipakai bila belum dijawab), 3. Peta fitur Owner, layar Stitch, dan urutan pengerjaan, 4.1 Isi desain yang bertentangan dengan SRS, 4.2 Layar atau bagian yang belum ada di Stitch, 4.3 Struktur menu (ikuti Stitch, ditambah Riwayat Perubahan), 4. Hasil review desain Stitch (wajib dibaca sebelum Fase 2) (+23 more)

### Community 30 - "3.2 Modul Administrasi Pembelajaran (ADM)"
Cohesion: 0.10
Nodes (21): 3.2 Modul Administrasi Pembelajaran (ADM), ADM-01 \| Pengelolaan Data Sekolah Mitra dan Kerja Sama, ADM-02 \| Pengelolaan Peserta Berdasarkan Formulir Sekolah, ADM-03 \| Katalog Program dan Penetapan Program per Semester, ADM-04 \| Perhitungan Kapasitas, Pembagian Kelompok, dan Rencana Sesi, ADM-05 \| Pengelolaan Data dan Status Keaktifan Tentor, ADM-06 \| Pengisian dan Konfirmasi Ketersediaan Waktu Mengajar, ADM-07 \| Kesepakatan Jadwal, Jam Sekolah, dan Tanggal Tidak Efektif (+13 more)

### Community 32 - "3.1 Ketentuan Umum dan Layanan Bersama"
Cohesion: 0.14
Nodes (14): 3.1 Ketentuan Umum dan Layanan Bersama, Istilah Baku, Kode Modul, KU-01 \| Perhitungan Jarak Domisili dan Sekolah, KU-02 \| Validasi Lokasi dan Geofence, KU-03 \| Notifikasi, KU-04 \| Penyimpanan dan Aturan Berkas, KU-05 \| Riwayat Perubahan (Audit Trail) (+6 more)

### Community 33 - "3.1 Ketentuan Umum dan Layanan Bersama"
Cohesion: 0.14
Nodes (14): 3.1 Ketentuan Umum dan Layanan Bersama, Istilah Baku, Kode Peran, KU-01 \| Penentuan Jarak Domisili Tentor ke Sekolah, KU-02 \| Pemeriksaan Lokasi Kehadiran dan Serah Terima, KU-03 \| Pemberitahuan, KU-04 \| Lampiran dan Berkas Bukti, KU-05 \| Riwayat Perubahan Data (+6 more)

### Community 36 - "Role"
Cohesion: 0.07
Nodes (32): {closure#1}(), {closure#2}(), {closure#3}(), {closure#4}(), {closure#1}(), {closure#10}(), {closure#11}(), {closure#12}() (+24 more)

### Community 38 - "require-dev"
Cohesion: 0.20
Nodes (10): require-dev, fakerphp/faker, knuckleswtf/scribe, laravel/pail, laravel/pint, mockery/mockery, nunomaduro/collision, pestphp/pest (+2 more)

### Community 39 - "3.5 Modul Manajemen Aset dan Ekspedisi (AST)"
Cohesion: 0.20
Nodes (10): 3.5 Modul Manajemen Aset dan Ekspedisi (AST), AST-01 \| Pengajuan Kebutuhan Pengadaan Aset, AST-02 \| Otorisasi dan Persetujuan Pengadaan Aset, AST-03 \| Manajemen Data Master Inventaris Aset dan QR Code, AST-04 \| Penugasan Distribusi Perangkat Terpusat, AST-05 \| Serah Terima Perangkat Berbasis Geofencing (Pengantaran dan Penjemputan), AST-06 \| Pelaporan Kendala Perangkat via QR Code, AST-07 \| Verifikasi Laporan Kendala Perangkat dan Tindak Lanjut (+2 more)

### Community 41 - "3.3 Modul Izin dan Penggantian Tentor (IZN)"
Cohesion: 0.22
Nodes (9): 3.3 Modul Izin dan Penggantian Tentor (IZN), IZN-01 \| Pengajuan Izin Terencana, IZN-02 \| Izin Mendesak, IZN-03 \| Pemilihan Tentor Pengganti dan Rekomendasi Calon, IZN-04 \| Konfirmasi Pengganti, IZN-05 \| Peninjauan dan Pengesahan Tentor Pengganti, IZN-06 \| Penggantian Pertemuan karena Tentor Nonaktif, IZN-07 \| Eskalasi Izin tanpa Pengganti (+1 more)

### Community 42 - "3.4 Modul Presensi dan Penggajian Tentor IT (PAY)"
Cohesion: 0.22
Nodes (9): 3.4 Modul Presensi dan Penggajian Tentor IT (PAY), PAY-01 \| Pengelolaan Komponen dan Tarif Honorarium, PAY-02 \| Pencatatan Presensi Berbasis Lokasi (Check-In dan Check-Out), PAY-03 \| Pengajuan Koreksi Presensi dan Sanggahan Honorarium, PAY-04 \| Validasi dan Pencocokan Presensi, PAY-05 \| Rekap Presensi dan Penutupan Periode, PAY-06 \| Perhitungan Honorarium, PAY-07 \| Persetujuan Owner dan Penerbitan Slip Honorarium (+1 more)

### Community 43 - "BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)"
Cohesion: 0.25
Nodes (8): 3.6 Modul Pelaporan dan Dashboard (RPT), 3.7 Modul Pengaturan Sistem (SET), BAB III KEBUTUHAN FUNGSIONAL (USER STORIES), RPT-01 \| Dashboard Monitoring Administrasi Pembelajaran bagi Owner, RPT-02 \| Dashboard Pemantauan dan Rekapitulasi Aset bagi Owner, RPT-03 \| Pencarian dan Ekspor Laporan Administrasi, SET-01 \| Pengelolaan Parameter Kebijakan Sistem, SET-02 \| Pengelolaan Daftar Rujukan

### Community 45 - "psr-4"
Cohesion: 0.40
Nodes (5): autoload, psr-4, App\\, Database\\Factories\\, Database\\Seeders\\

### Community 46 - "require"
Cohesion: 0.40
Nodes (5): require, laravel/framework, laravel/sanctum, laravel/tinker, php

### Community 48 - "Keputusan Proyek"
Cohesion: 0.40
Nodes (4): Keputusan baru, Keputusan Proyek, Keputusan teknis yang sudah ditetapkan, Keputusan yang menunggu konfirmasi Owner

### Community 49 - "autoload-dev"
Cohesion: 0.67
Nodes (3): autoload-dev, psr-4, Tests\\

### Community 50 - "extra"
Cohesion: 0.67
Nodes (3): extra, laravel, dont-discover

### Community 75 - "EnsureUserHasRole.php"
Cohesion: 0.24
Nodes (3): {closure#1}(), EnsureUserHasRole, RequestId

### Community 76 - "Illuminate\Http\Request"
Cohesion: 0.26
Nodes (3): AuditLogResource, UserResource, {closure#6}()

### Community 78 - "Log per task"
Cohesion: 0.20
Nodes (9): RecordAccessDenial, Log per task, Progress — Irisan Owner, Ringkasan, T0.1 — Autentikasi (2026-11-25), T0.2 — Hak akses berbasis peran (2026-11-25), T0.3 — Riwayat perubahan / audit trail (2026-11-25), Tambahan (di luar daftar task) — UI autentikasi sementara, Blade (2026-11-25) (+1 more)

### Community 79 - "AuditTest.php"
Cohesion: 0.09
Nodes (8): AccessDenial, AuditLog, auditSample(), {closure#10}(), {closure#11}(), {closure#2}(), {closure#3}(), {closure#6}()

### Community 81 - "3.2 Kebutuhan Fungsional Owner (OW)"
Cohesion: 0.14
Nodes (14): 3.2 Kebutuhan Fungsional Owner (OW), OW-01 \| Penetapan dan Pengelolaan Komponen Honorarium, OW-02 \| Penetapan Parameter Kebijakan Operasional, OW-03 \| Pengelolaan Daftar Alasan Penolakan Izin, OW-04 \| Pemrosesan Izin Mendesak di Luar Jam Layanan Admin, OW-05 \| Keputusan atas Pertemuan tanpa Tentor Pengganti, OW-06 \| Pembukaan Kembali Laporan Pertemuan Terverifikasi, OW-07 \| Persetujuan Honorarium Periode (+6 more)

### Community 82 - "App\Http\Controllers\Api\V1\AuthController"
Cohesion: 0.24
Nodes (3): ChangePassword, AuthController, ChangePasswordRequest

### Community 84 - ".record"
Cohesion: 0.22
Nodes (8): Audit, 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-14 | Penelusuran Riwayat Perubahan Data, T0.4 — Riwayat perubahan data (audit trail) + halaman Riwayat Perubahan + layanan ekspor

### Community 85 - "Role"
Cohesion: 0.22
Nodes (9): Role, Admin, Kurir, Owner, Teknisi, Tentor, {closure#3}(), {closure#1}() (+1 more)

### Community 86 - "2.3 Karakteristik dan Pemetaan Pengguna"
Cohesion: 0.18
Nodes (11): 1. Admin, 2.1 Analisis Sistem Berjalan, 2.2 Analisis Masalah Pokok, 2.3 Karakteristik dan Pemetaan Pengguna, 2.4 Usulan Solusi Arsitektur Sistem Baru (ERP), 2. Tentor, 3. Kurir atau Tim Ekspedisi, 4. Teknisi (+3 more)

### Community 88 - "BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)"
Cohesion: 0.20
Nodes (9): 3.6 Kebutuhan Fungsional Teknisi (TK), 5.1 Infrastruktur Komponen dan Perangkat Keras, 5.2 Fondasi Arsitektur Perangkat Lunak dan Bahasa Pemrograman, 5.3 Modul Integrasi Pihak Ketiga (Oracles), BAB III KEBUTUHAN FUNGSIONAL (USER STORIES), BAB V ARSITEKTUR DAN LINGKUNGAN TEKNOLOGI, TK-01 \| Melihat Tiket Perbaikan dan Riwayat Perangkat, TK-02 \| Pencatatan Penanganan Perbaikan (+1 more)

### Community 89 - "BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)"
Cohesion: 0.22
Nodes (9): 4.1 Performa (PRF), 4.2 Keamanan (SEC), 4.3 Keandalan dan Ketersediaan (REL), 4.4 Kapasitas dan Skalabilitas (CAP), 4.5 Integritas dan Audit Data (INT), 4.6 Backup dan Pemulihan (BCK), 4.7 Kompatibilitas dan Usability (USA), 4.8 Pemeliharaan dan Monitoring (MNT) (+1 more)

### Community 90 - "T2.5 — Izin Mendesak di luar jam layanan Admin + Keputusan Eskalasi"
Cohesion: 0.22
Nodes (8): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-04 | Pemrosesan Izin Mendesak di Luar Jam Layanan Admin, OW-05 | Keputusan atas Pertemuan tanpa Tentor Pengganti, T2.5 — Izin Mendesak di luar jam layanan Admin + Keputusan Eskalasi

### Community 91 - "T3.1 — Pemantauan Pembelajaran + Buka Kembali Laporan Terverifikasi"
Cohesion: 0.22
Nodes (8): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-06 | Pembukaan Kembali Laporan Pertemuan Terverifikasi, OW-10 | Pemantauan Administrasi Pembelajaran, T3.1 — Pemantauan Pembelajaran + Buka Kembali Laporan Terverifikasi

### Community 93 - "LAMPIRAN"
Cohesion: 0.25
Nodes (8): LAMPIRAN, Lampiran A \| Matriks Peran, Lampiran B \| Master Status dan Transisi, Lampiran C \| Tabel Keputusan Honorarium, Lampiran D \| Daftar Parameter, Lampiran E \| Daftar Keputusan dan Hal yang Perlu Diisi, Lampiran F \| Pemetaan Kode Lama ke Kode Baru, Lampiran G \| Pemetaan Kode Fungsi Modul ke Kebutuhan Fungsional per Peran

### Community 94 - "T0.2 — Autentikasi, layout Owner, profil, dan pengelolaan akun Admin"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-16 | Akun, Profil, dan Notifikasi Owner, T0.2 — Autentikasi, layout Owner, profil, dan pengelolaan akun Admin

### Community 95 - "T0.5 — Notifikasi di dalam sistem + panel notifikasi"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-16 | Akun, Profil, dan Notifikasi Owner, T0.5 — Notifikasi di dalam sistem + panel notifikasi

### Community 96 - "T1.1 — Parameter Kebijakan berversi + halaman Parameter Kebijakan"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-02 | Penetapan Parameter Kebijakan Operasional, T1.1 — Parameter Kebijakan berversi + halaman Parameter Kebijakan

### Community 97 - "T1.2 — Komponen Honorarium dan tarif berversi + halaman Komponen Honor"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-01 | Penetapan dan Pengelolaan Komponen Honorarium, T1.2 — Komponen Honorarium dan tarif berversi + halaman Komponen Honor

### Community 98 - "T1.3 — Tingkatan jarak uang transportasi + editor Tingkatan Jarak"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-01 | Penetapan dan Pengelolaan Komponen Honorarium, T1.3 — Tingkatan jarak uang transportasi + editor Tingkatan Jarak

### Community 99 - "T1.4 — Daftar Alasan Penolakan Izin + halaman Alasan Penolakan"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-03 | Pengelolaan Daftar Alasan Penolakan Izin, T1.4 — Daftar Alasan Penolakan Izin + halaman Alasan Penolakan

### Community 100 - "T1.5 — Masa Simpan Data dan pembersihan otomatis + halaman Masa Simpan Data"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-15 | Penetapan Masa Simpan Data, T1.5 — Masa Simpan Data dan pembersihan otomatis + halaman Masa Simpan Data

### Community 101 - "T2.2 — Persetujuan Honorarium Periode + slip honorarium"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-07 | Persetujuan Honorarium Periode, T2.2 — Persetujuan Honorarium Periode + slip honorarium

### Community 102 - "T2.3 — Keputusan Penyesuaian Honorarium"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-08 | Keputusan Penyesuaian Honorarium, T2.3 — Keputusan Penyesuaian Honorarium

### Community 103 - "T2.4 — Keputusan Pengadaan Aset"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-09 | Keputusan Pengadaan Aset, T2.4 — Keputusan Pengadaan Aset

### Community 104 - "T3.2 — Pemantauan Aset dan Perangkat + Pindai QR"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-11 | Pemantauan Aset dan Perangkat, T3.2 — Pemantauan Aset dan Perangkat + Pindai QR

### Community 105 - "T3.3 — Pemantauan Rekap Izin dan Penggantian"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-12 | Pemantauan Rekap Izin dan Penggantian, T3.3 — Pemantauan Rekap Izin dan Penggantian

### Community 106 - "T3.4 — Pemantauan Honorarium dan Pembayaran"
Cohesion: 0.25
Nodes (7): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, OW-13 | Pemantauan Honorarium dan Pembayaran, T3.4 — Pemantauan Honorarium dan Pembayaran

### Community 108 - "T0.0 — (Manual) Lengkapi dan koreksi desain Owner di Stitch"
Cohesion: 0.29
Nodes (6): A. Sidebar Owner (terapkan ke SEMUA layar Owner), B. Koreksi layar yang sudah ada (SRS v3 menang atas desain), C. Layar baru (gaya sama persis dengan layar yang ada), Checklist selesai, D. Penamaan, T0.0 — (Manual) Lengkapi dan koreksi desain Owner di Stitch

### Community 109 - "T0.1 — Setup Laravel fullstack (Livewire), design tokens, dan pengambilan desain Stitch"
Cohesion: 0.29
Nodes (6): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, T0.1 — Setup Laravel fullstack (Livewire), design tokens, dan pengambilan desain Stitch

### Community 110 - "T0.3 — Hak akses berbasis peran (middleware, Policy, pencatatan akses ditolak)"
Cohesion: 0.29
Nodes (6): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, T0.3 — Hak akses berbasis peran (middleware, Policy, pencatatan akses ditolak)

### Community 111 - "T0.6 — Periode penggajian (minimal) dan pola data berversi"
Cohesion: 0.29
Nodes (6): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, T0.6 — Periode penggajian (minimal) dan pola data berversi

### Community 112 - "T1.6 — Beranda Owner tahap 1 + konsolidasi Fase 1 (akses, data demo, E2E)"
Cohesion: 0.29
Nodes (6): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, T1.6 — Beranda Owner tahap 1 + konsolidasi Fase 1 (akses, data demo, E2E)

### Community 113 - "T2.1 — Kerangka data operasional untuk fitur Owner (kontrak dengan modul Admin)"
Cohesion: 0.29
Nodes (6): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, T2.1 — Kerangka data operasional untuk fitur Owner (kontrak dengan modul Admin)

### Community 114 - "T3.5 — Beranda Owner final, badge menu, Tinjau Persetujuan, dan E2E irisan Owner"
Cohesion: 0.29
Nodes (6): 1. Kebutuhan SRS v3 yang dipenuhi, 2. Acuan tampilan Stitch, 3. Penjelasan dan prompt untuk agent, 4. Aturan umum (berlaku untuk setiap task), Checklist selesai, T3.5 — Beranda Owner final, badge menu, Tinjau Persetujuan, dan E2E irisan Owner

### Community 115 - "3.5 Kebutuhan Fungsional Kurir (KR)"
Cohesion: 0.33
Nodes (6): 3.5 Kebutuhan Fungsional Kurir (KR), KR-01 \| Melihat Tugas Distribusi, KR-02 \| Serah Terima Pengantaran Perangkat, KR-03 \| Serah Terima Penjemputan Perangkat, KR-04 \| Pelaporan Kendala Perangkat, KR-05 \| Melihat Profil Perangkat melalui Label QR

### Community 116 - "tasks/README.md"
Cohesion: 0.33
Nodes (5): Agentic Development, Laracasts, Laravel framework, Laravel Boost, MIT license

## Knowledge Gaps
- **12 isolated node(s):** `Admin`, `Kurir`, `Owner`, `Teknisi`, `Tentor` (+7 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 584 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **52 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `Role` connect `Role` to `SessionTest.php`, `User Model & Seeding`, `UserFactory.php`, `Role`, `Controller`, `LoginUser.php`, `AuthPagesTest.php`, `LoginTest.php`, `DatabaseSeeder.php`, `LoginRequest`?**
  _High betweenness centrality (0.053) - this node is a cross-community bridge._
- **What connects `Admin`, `Kurir`, `Owner` to the rest of the system?**
  _12 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Frontend Build Dependencies` be split into smaller, more focused modules?**
  _Cohesion score 0.1225296442687747 - nodes in this community are weakly interconnected._
- **Why does `AuditLog` connect `AuditTest.php` to `Role`, `Illuminate\Http\Request`, `.record`, `AuditLogController.php`, `LoginRequest`?**
  _High betweenness centrality (0.040) - this node is a cross-community bridge._
- **Should `Database Migrations` be split into smaller, more focused modules?**
  _Cohesion score 0.0915915915915916 - nodes in this community are weakly interconnected._
- **Why does `{closure#3}()` connect `Role` to `.record`, `Role`?**
  _High betweenness centrality (0.034) - this node is a cross-community bridge._
- **Should `bootstrap/app.php` be split into smaller, more focused modules?**
  _Cohesion score 0.13450292397660818 - nodes in this community are weakly interconnected._