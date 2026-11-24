# Graph Report - Edukom-Project  (2026-11-25)

## Corpus Check
- 97 files · ~103,399 words
- Verdict: corpus is large enough that graph structure adds value.
- Unclassified: 10 file(s) not represented in the graph (top: (none) 6, .example 1, .xml 1)

## Summary
- 696 nodes · 785 edges · 65 communities (29 shown, 36 thin omitted)
- Extraction: 98% EXTRACTED · 2% INFERRED · 0% AMBIGUOUS · INFERRED: 12 edges (avg confidence: 0.87)
- Token cost: 52,587 input · 0 output

## Graph Freshness
- Built from commit: `79c17723`
- Run `git rev-parse HEAD` and compare to check if the graph is stale.
- Run `graphify update .` after code changes (no API cost).

## Community Hubs (Navigation)
- composer.json
- Frontend Build Dependencies
- Graphify & Task Logging Docs
- Database Migrations
- User Model & Seeding
- Illuminate\Support\Str
- Composer Scripts
- bootstrap/app.php
- Composer Plugin Settings
- Service Providers
- LoginTest.php
- Unit Tests
- BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)
- 3.4 Kebutuhan Fungsional Tentor (TN)
- Robots Crawl Policy
- DatabaseSeeder.php
- Q: TASK 2026-11-25: Pemetaan dokumen ke graph (/graphify .)
- BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)
- tasks/README.md
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

## God Nodes (most connected - your core abstractions)
1. `3.3 Kebutuhan Fungsional Admin (AD)` - 35 edges
2. `3.2 Modul Administrasi Pembelajaran (ADM)` - 21 edges
3. `User` - 20 edges
4. `Role` - 19 edges
5. `3.4 Kebutuhan Fungsional Tentor (TN)` - 19 edges
6. `3.1 Ketentuan Umum dan Layanan Bersama` - 14 edges
7. `3.1 Ketentuan Umum dan Layanan Bersama` - 14 edges
8. `3.2 Kebutuhan Fungsional Owner (OW)` - 14 edges
9. `require-dev` - 10 edges
10. `3.5 Modul Manajemen Aset dan Ekspedisi (AST)` - 10 edges

## Surprising Connections (you probably didn't know these)
- `T0.1 — Autentikasi (2026-11-25)` --references--> `ApiException`  [INFERRED]
  docs/PROGRESS.md → app/Exceptions/ApiException.php
- `T0.1 — Autentikasi (2026-11-25)` --references--> `RequestId`  [INFERRED]
  docs/PROGRESS.md → app/Http/Middleware/RequestId.php
- `T0.1 — Autentikasi (2026-11-25)` --references--> `spaHeaders()`  [INFERRED]
  docs/PROGRESS.md → tests/Pest.php
- `{closure#1}()` --calls--> `spaHeaders()`  [INFERRED]
  tests/Feature/Api/V1/HealthTest.php → tests/Pest.php
- `Memory: TASK 2026-11-25 Setup graphify knowledge graph` --implements--> `graphify save-result memory step`  [INFERRED]
  graphify-out/memory/query_20261124_181742_110e102b_task_2026_11_25__setup_graphify_knowledge_graph.md → CLAUDE.md

## Import Cycles
- None detected.

## Communities (65 total, 36 thin omitted)

### Community 0 - "composer.json"
Cohesion: 0.22
Nodes (8): description, keywords, license, minimum-stability, name, prefer-stable, $schema, type

### Community 1 - "Frontend Build Dependencies"
Cohesion: 0.12
Nodes (19): devDependencies, axios@^1.11.0, concurrently@^9.0.1, laravel-vite-plugin@^2.0.0, tailwindcss@^4.0.0, @tailwindcss/vite@^4.0.0, vite@^7.0.7, private (+11 more)

### Community 2 - "Graphify & Task Logging Docs"
Cohesion: 0.12
Nodes (12): graphify (CLAUDE.md section), graphify reflect (LESSONS.md), graphify save-result memory step, Log task (WAJIB), python -m graphify invocation, Task log file format (docs/tasks/YYYY-MM-DD-slug.md), Memory: TASK 2026-11-25 Setup graphify knowledge graph, Agentic Development (+4 more)

### Community 3 - "Database Migrations"
Cohesion: 0.12
Nodes (11): {closure#1}(), {closure#2}(), {closure#3}(), {closure#1}(), {closure#2}(), {closure#1}(), {closure#2}(), {closure#3}() (+3 more)

### Community 6 - "Composer Scripts"
Cohesion: 0.22
Nodes (9): scripts, dev, post-autoload-dump, post-create-project-cmd, post-root-package-install, post-update-cmd, pre-package-uninstall, setup (+1 more)

### Community 7 - "bootstrap/app.php"
Cohesion: 0.05
Nodes (13): ChangePassword, AuthController, HealthController, Controller, RequestId, ChangePasswordRequest, UserResource, {closure#1}() (+5 more)

### Community 8 - "Composer Plugin Settings"
Cohesion: 0.29
Nodes (7): pestphp/pest-plugin, php-http/discovery, config, allow-plugins, optimize-autoloader, preferred-install, sort-packages

### Community 10 - "LoginTest.php"
Cohesion: 0.10
Nodes (18): Log per task, Progress — Irisan Owner, Ringkasan, T0.1 — Autentikasi (2026-11-25), Templat, {closure#1}(), {closure#10}(), {closure#2}() (+10 more)

### Community 15 - "BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)"
Cohesion: 0.05
Nodes (43): 1.1 Latar Belakang, 1.2 Tujuan Penyusunan Dokumen, 1.3.1 Modul Administrasi Pembelajaran, 1.3.2 Modul Izin dan Penggantian Tentor, 1.3.3 Modul Presensi dan Penggajian Tentor IT, 1.3.4 Modul Manajemen Aset dan Ekspedisi, 1.3.5 Modul Pelaporan dan Dashboard serta Pengaturan Sistem, 1.3.6 Integrasi Antarmodul (+35 more)

### Community 16 - "3.4 Kebutuhan Fungsional Tentor (TN)"
Cohesion: 0.05
Nodes (44): 3.2 Kebutuhan Fungsional Owner (OW), 3.4 Kebutuhan Fungsional Tentor (TN), 3.5 Kebutuhan Fungsional Kurir (KR), 3.6 Kebutuhan Fungsional Teknisi (TK), BAB III KEBUTUHAN FUNGSIONAL (USER STORIES), KR-01 \| Melihat Tugas Distribusi, KR-02 \| Serah Terima Pengantaran Perangkat, KR-03 \| Serah Terima Penjemputan Perangkat (+36 more)

### Community 25 - "Q: TASK 2026-11-25: Pemetaan dokumen ke graph (/graphify .)"
Cohesion: 0.40
Nodes (4): Answer, Outcome, Q: TASK 2026-11-25: Pemetaan dokumen ke graph (/graphify .), Source Nodes

### Community 26 - "BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)"
Cohesion: 0.05
Nodes (42): 1.1 Latar Belakang, 1.2 Tujuan Penyusunan Dokumen, 1.3.1 Modul Administrasi Pembelajaran, 1.3.2 Modul Izin dan Penggantian Tentor, 1.3.3 Modul Presensi dan Penggajian Tentor IT, 1.3.4 Modul Manajemen Aset dan Ekspedisi, 1.3.5 Modul Pelaporan dan Dashboard serta Pengaturan Sistem, 1.3.6 Integrasi Antarmodul (+34 more)

### Community 27 - "tasks/README.md"
Cohesion: 0.05
Nodes (22): Daftar Task — Irisan Owner, Fase 0 — Fondasi Bersama, Fase 1 — Data Master Owner (Backend), Fase 2 — Frontend Owner dari Desain Stitch, Fase 3 — Fitur Owner berikutnya, T0.1 — Autentikasi (Laravel sudah terpasang), T0.2 — Hak akses berbasis peran, T0.3 — Riwayat perubahan (audit trail) (+14 more)

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
Cohesion: 0.21
Nodes (8): Role, Admin, Kurir, Owner, Teknisi, Tentor, {closure#1}(), {closure#2}()

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

## Knowledge Gaps
- **13 isolated node(s):** `Owner`, `Admin`, `Tentor`, `Kurir`, `Teknisi` (+8 more)
  These have ≤1 connection - possible missing edges or undocumented components. (Counts symbols only; 453 node(s) total have ≤1 connection when file, concept and rationale nodes are included.)
- **36 thin communities (<3 nodes) omitted from report** — run `graphify query` to explore isolated nodes.

## Suggested Questions
_Questions this graph is uniquely positioned to answer:_

- **Why does `BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)` connect `3.4 Kebutuhan Fungsional Tentor (TN)` to `3.1 Ketentuan Umum dan Layanan Bersama`, `3.3 Kebutuhan Fungsional Admin (AD)`, `BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)`?**
  _High betweenness centrality (0.030) - this node is a cross-community bridge._
- **What connects `Owner`, `Admin`, `Tentor` to the rest of the system?**
  _13 weakly-connected nodes found - possible documentation gaps or missing edges._
- **Should `Frontend Build Dependencies` be split into smaller, more focused modules?**
  _Cohesion score 0.11857707509881422 - nodes in this community are weakly interconnected._
- **Why does `User` connect `User Model & Seeding` to `SessionTest.php`, `ApiException`, `UserFactory.php`, `bootstrap/app.php`, `LoginUser.php`, `LoginTest.php`, `DatabaseSeeder.php`, `LoginRequest`?**
  _High betweenness centrality (0.029) - this node is a cross-community bridge._
- **Should `Graphify & Task Logging Docs` be split into smaller, more focused modules?**
  _Cohesion score 0.125 - nodes in this community are weakly interconnected._
- **Why does `BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)` connect `BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)` to `3.1 Ketentuan Umum dan Layanan Bersama`, `3.5 Modul Manajemen Aset dan Ekspedisi (AST)`, `3.3 Modul Izin dan Penggantian Tentor (IZN)`, `3.4 Modul Presensi dan Penggajian Tentor IT (PAY)`, `BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)`, `3.2 Modul Administrasi Pembelajaran (ADM)`?**
  _High betweenness centrality (0.021) - this node is a cross-community bridge._
- **Should `Database Migrations` be split into smaller, more focused modules?**
  _Cohesion score 0.11576354679802955 - nodes in this community are weakly interconnected._