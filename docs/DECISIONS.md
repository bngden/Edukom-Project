# Keputusan Proyek

Diisi oleh manusia (Owner/analis). Agent membaca file ini dan **mengutamakannya** di atas file task dan SRS.
Status: ⏳ Menunggu konfirmasi (default dipakai) · ✅ Dikonfirmasi · ✏️ Diubah

## Keputusan yang menunggu konfirmasi Owner

| No | Pertanyaan | Default yang dipakai | Status | Jawaban / tanggal |
|---|---|---|---|---|
| K1 | Nilai awal tarif honorarium (revisi SRS menghapus angkanya) | Uang kehadiran Rp10.000/sesi sah, honor mengajar Rp10.000/sesi sah, bonus kelengkapan Rp20.000/sekolah/periode, transport ≤10 km Rp10.000 dan >10 km Rp15.000 (SRS lama PAY-01) | ⏳ | |
| K2 | Tanggal mulai berlaku awal untuk semua nilai bawaan (seeder) | `EDUKOM_POLICY_BASE_DATE=2026-01-01` | ⏳ | |
| K3 | Boleh menetapkan tanggal berlaku mundur selama periodenya belum ditutup? | Boleh | ⏳ | |
| K4 | Komponen honorarium nonaktif boleh diaktifkan lagi? | Tidak; hanya membatalkan penonaktifan yang belum berlaku | ⏳ | |
| K5 | Tenggat materi rencana | H-1 pukul 23.59 WIB (SRS lama ADM-11) | ⏳ | |
| K6 | Jam layanan Admin, ambang frekuensi izin, batas ekspor, jendela peringatan kesiapan | Kosong → "Belum Dikonfigurasi" | ⏳ | |
| K7 | Siapa yang membuat akun Kurir dan Teknisi? | Ditunda; akun Owner/Admin lewat seeder/command | ⏳ | |

## Keputusan teknis yang sudah ditetapkan

| No | Keputusan | Sumber |
|---|---|---|
| D1 | Backend Laravel (sudah terpasang), API JSON `/api/v1`, Sanctum SPA | Permintaan user, BAB V |
| D2 | Frontend React + TypeScript + Vite + Tailwind di repo yang sama | BAB V (React SPA) |
| D3 | Desain dari Stitch "Owner Dashboard - Edukom ERP" (id 199635054751937416); SRS menang atas desain | Review Stitch, `docs/TASK_OWNER.md` bagian 4 |
| D4 | MySQL 8 InnoDB, uang integer rupiah, zona waktu Asia/Jakarta | BAB V, INT-03, USA-10 |
| D5 | Notifikasi hanya di dalam sistem (web) | Lampiran E no. 5 |
| D6 | Satu akun Owner dan satu akun Admin, tanpa peran Keuangan | KU-09.2 |

## Keputusan baru

<!-- Tambahkan di sini: tanggal, keputusan, alasan, task yang terdampak. -->
