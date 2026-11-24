# Daftar Task — Irisan Owner

Kerjakan berurutan. Satu task = satu branch = satu sesi agent.

Prompt untuk agent:

```text
Baca CLAUDE.md dan docs/tasks/<file-task>.md. Buat rencana dulu, tunggu persetujuan saya, baru kerjakan.
```


## Fase 0 — Fondasi Bersama

| Task | Judul | File |
|---|---|---|
| T0.1 | Autentikasi (Laravel sudah terpasang) | [T0.1-autentikasi.md](T0.1-autentikasi.md) |
| T0.2 | Hak akses berbasis peran | [T0.2-hak-akses.md](T0.2-hak-akses.md) |
| T0.3 | Riwayat perubahan (audit trail) | [T0.3-audit-trail.md](T0.3-audit-trail.md) |
| T0.4 | Notifikasi di dalam sistem | [T0.4-notifikasi.md](T0.4-notifikasi.md) |
| T0.5 | Periode penggajian (minimal) dan pola data berversi | [T0.5-periode-dan-data-berversi.md](T0.5-periode-dan-data-berversi.md) |

## Fase 1 — Data Master Owner (Backend)

| Task | Judul | File |
|---|---|---|
| T1.1 | Parameter kebijakan berversi (OW-02, AD-27) | [T1.1-parameter-kebijakan.md](T1.1-parameter-kebijakan.md) |
| T1.2 | Komponen honorarium dan tarif berversi (OW-01, AD-27) | [T1.2-komponen-honorarium.md](T1.2-komponen-honorarium.md) |
| T1.3 | Tingkatan jarak uang transportasi (OW-01.4) | [T1.3-tingkatan-jarak-transport.md](T1.3-tingkatan-jarak-transport.md) |
| T1.4 | Daftar alasan penolakan izin (OW-03) | [T1.4-alasan-penolakan.md](T1.4-alasan-penolakan.md) |
| T1.5 | Konsolidasi Fase 1: akses Admin, riwayat, dokumentasi, data demo | [T1.5-konsolidasi-fase1.md](T1.5-konsolidasi-fase1.md) |

## Fase 2 — Frontend Owner dari Desain Stitch

| Task | Judul | File |
|---|---|---|
| T2.0 | (Manual) Perbaiki dan lengkapi desain di Stitch | [T2.0-perbaikan-desain-stitch.md](T2.0-perbaikan-desain-stitch.md) |
| T2.1 | Setup frontend, koneksi Stitch MCP, dan design tokens | [T2.1-setup-frontend.md](T2.1-setup-frontend.md) |
| T2.2 | Login, layout Owner, menu, Beranda, notifikasi | [T2.2-login-layout-beranda.md](T2.2-login-layout-beranda.md) |
| T2.3 | Halaman Parameter Kebijakan | [T2.3-halaman-parameter.md](T2.3-halaman-parameter.md) |
| T2.4 | Halaman Komponen Honor dan Tingkatan Jarak | [T2.4-halaman-komponen-honor.md](T2.4-halaman-komponen-honor.md) |
| T2.5 | Halaman Alasan Penolakan Izin | [T2.5-halaman-alasan-penolakan.md](T2.5-halaman-alasan-penolakan.md) |
| T2.6 | Halaman Riwayat Perubahan dan uji E2E irisan Owner | [T2.6-riwayat-dan-e2e.md](T2.6-riwayat-dan-e2e.md) |

## Fase 3 — Fitur Owner berikutnya

Belum dipecah menjadi task. Lihat bagian *FASE 3* di `docs/TASK_OWNER.md`. Rekomendasi berikutnya: **3a Pengadaan aset (OW-09)**.
