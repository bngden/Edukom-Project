# API Owner — Fase 0–1

Pegangan untuk membangun halaman Blade Owner. Semua endpoint di bawah prefix `/api/v1`, memakai sesi Sanctum
(SPA: kirim `Referer`/`Origin` dari domain aplikasi, ambil cookie CSRF di `/sanctum/csrf-cookie`).
Rincian per endpoint, contoh respons, dan uji coba: `php artisan scribe:generate` → `/docs`.
Matriks akses yang mengikat ada di `tests/Feature/Access/OwnerPhase1AccessTest.php`.

## Format respons dan galat

- Sukses: `{ "data": ... }`. Daftar berpaginasi menambah `links` dan `meta` (`current_page`, `per_page`, `total`, ...).
- Galat: `{ "message": "...", "code": "...", "errors": { "field": ["..."] } }`.

| HTTP | `code` | Kapan |
|---|---|---|
| 401 | `UNAUTHENTICATED` | Belum login |
| 403 | `FORBIDDEN` | Peran tidak berhak (dicatat ke `access_denials` dan audit `access.denied`) |
| 403 | `ACCOUNT_INACTIVE` | Akun nonaktif saat login |
| 404 | `NOT_FOUND` | Data tidak ada / bukan milik sendiri (notifikasi) / tidak sesuai induknya (scoped binding) |
| 405 | `METHOD_NOT_ALLOWED` | Method salah |
| 409 | `CONFLICT` | Tanggal berlaku ≤ versi terakhir, versi tidak dapat dibatalkan, status sudah sama, komponen nonaktif |
| 409 | `REFERENCE_IN_USE` | Hapus alasan penolakan yang sudah pernah dipakai |
| 419 | `CSRF_TOKEN_MISMATCH` | Token CSRF hilang/kedaluwarsa |
| 422 | `VALIDATION_ERROR` | Validasi gagal (pesan bahasa Indonesia per field) |
| 423 | `LOCKED_PERIOD` | Tanggal berlaku jatuh di periode penggajian yang sudah ditutup |
| 429 | `TOO_MANY_REQUESTS` | Batas login per menit terlampaui |

## Daftar endpoint

Peran: **O** = owner, **A** = admin, **semua** = semua peran login, **publik** = tanpa login.

### Autentikasi dan akun
| Method | Rute | Peran | Catatan |
|---|---|---|---|
| GET | `/health` | publik | |
| POST | `/auth/login` | publik | `{ email, password }`; terkunci setelah gagal berturut-turut |
| POST | `/auth/logout` | semua | |
| GET | `/auth/me` | semua | |
| PUT | `/auth/password` | semua | `{ current_password, password, password_confirmation }` |

### Notifikasi (hanya milik sendiri)
| Method | Rute | Peran | Catatan |
|---|---|---|---|
| GET | `/notifications?status=unread\|read\|all` | semua | 20 per halaman |
| GET | `/notifications/unread-count` | semua | |
| POST | `/notifications/{id}/read` | semua | Milik user lain → 404 |
| POST | `/notifications/read-all` | semua | |

### Beranda dan riwayat perubahan
| Method | Rute | Peran | Catatan |
|---|---|---|---|
| GET | `/owner/overview` | O | Blok tahap 1 (lihat di bawah) |
| GET | `/audit-logs` | O, A | Filter `subject_type`, `subject_id`, `actor_id`, `action`, `date_from`, `date_to`; 25 per halaman |

`/owner/overview` → `{ needs_configuration: [{key, label, group, group_label}], scheduled_changes: {policy_parameters,
honor_rates, transport_tiers, retention}, honor_components: {active, inactive}, leave_rejection_reasons: {active, inactive},
unread_notifications, last_retention_run }`. Blok keputusan, pembelajaran, aset, dan laporan belum dikirim; tampilkan
"Tersedia setelah modul terkait aktif".

### Parameter kebijakan (36 parameter, katalog tetap)
| Method | Rute | Peran | Catatan |
|---|---|---|---|
| GET | `/policy-parameters?group=` | O, A | Nilai berlaku hari ini + perubahan terjadwal |
| GET | `/policy-parameters/{key}` | O, A | Detail + 50 versi terbaru |
| POST | `/policy-parameters/{key}/versions` | O | `{ value, effective_from: YYYY-MM-DD, reason? }` → 201 |
| POST | `/policy-parameters/{key}/versions/{version}/cancel` | O | `{ reason }` → 204 |

### Komponen honorarium dan tingkatan jarak
| Method | Rute | Peran | Catatan |
|---|---|---|---|
| GET | `/honor-components?date=` | O, A | Komponen transport menambah `current_tier_set`, `scheduled_tier_set` |
| GET | `/honor-components/{id}` | O, A | Detail + 50 versi tarif |
| POST | `/honor-components` | O | `{ name, description?, basis, amount, effective_from, reason? }` → 201 (tarif flat) |
| PATCH | `/honor-components/{id}` | O | `{ name?, description?, sort_order? }`; `basis`/`rate_type` → 422 |
| POST | `/honor-components/{id}/rates` | O | `{ amount, effective_from, reason? }`; transport → 422 |
| POST | `/honor-components/{id}/rates/{rate}/cancel` | O | `{ reason }` |
| GET | `/honor-components/{id}/tier-sets` | O, A | 50 set terbaru beserta tingkatan dan ringkasan |
| POST | `/honor-components/{id}/tier-sets` | O | `{ tiers: [{max_km, amount}], effective_from, reason? }` |
| POST | `/honor-components/{id}/tier-sets/{tierSet}/cancel` | O | `{ reason }` |
| POST | `/honor-components/{id}/deactivate` | O | `{ deactivated_from, reason }` |
| POST | `/honor-components/{id}/cancel-deactivation` | O | `{ reason }`; hanya bila belum berlaku |

Contoh set tingkatan jarak:

```json
{
  "tiers": [
    { "max_km": 10, "amount": 10000 },
    { "max_km": 20.5, "amount": 15000 },
    { "max_km": null, "amount": 20000 }
  ],
  "effective_from": "2027-01-01",
  "reason": "Penyesuaian BBM"
}
```

Aturan: minimal 1, maksimal 20 baris; `max_km` > 0, maksimal 1 desimal, naik ketat; hanya baris terakhir `null`
(tanpa batas atas); `amount` integer rupiah ≥ 0. Ringkasan: `≤ 10 km: Rp10.000 · > 10–20,5 km: Rp15.000 · > 20,5 km: Rp20.000`.

### Alasan penolakan izin
| Method | Rute | Peran | Catatan |
|---|---|---|---|
| GET | `/leave-rejection-reasons?status=active\|inactive\|all&search=` | O, A | Admin selalu menerima alasan aktif saja; item memuat `usage_count`, `can_delete` |
| POST | `/leave-rejection-reasons` | O | `{ name (3–150, unik tanpa beda huruf), description?, sort_order? }` |
| PUT | `/leave-rejection-reasons/order` | O | `{ ids: [...] }` memuat semua alasan tepat satu kali |
| PATCH | `/leave-rejection-reasons/{id}` | O | `{ name?, description?, sort_order? }` |
| POST | `/leave-rejection-reasons/{id}/deactivate` | O | Sudah nonaktif → 409 |
| POST | `/leave-rejection-reasons/{id}/activate` | O | Sudah aktif → 409 |
| DELETE | `/leave-rejection-reasons/{id}` | O | Sudah dipakai → 409 `REFERENCE_IN_USE` |

### Masa simpan data
| Method | Rute | Peran | Catatan |
|---|---|---|---|
| GET | `/retention` | O | Per jenis: `months`, `effective_from`, `scheduled`, `parameter_key`; `last_run` |
| GET | `/retention-runs` | O | 25 per halaman, termasuk uji |
| POST | `/retention-runs/dry-run` | O | Uji tanpa menghapus → 201 dengan perkiraan jumlah |

Ubah masa simpan = buat versi parameter `retention_<jenis>_months` (1–120 bulan) lewat endpoint parameter.

## Aturan data berversi (parameter, tarif, tingkatan jarak, masa simpan)

- Nilai tidak pernah ditimpa. Setiap perubahan = versi baru dengan `effective_from`; versi sebelumnya otomatis berakhir H-1.
- `effective_from` harus setelah tanggal berlaku versi terakhir (409) dan tidak di periode penggajian tertutup (423).
- Status versi: `scheduled` (Terjadwal), `active` (Berlaku), `ended` (Berakhir), `cancelled` (Dibatalkan).
- Hanya versi terakhir yang belum berlaku yang dapat dibatalkan (`reason` wajib); versi sebelumnya kembali tanpa tanggal akhir.

## Riwayat per objek

Tautan "Lihat Riwayat" mengisi `GET /audit-logs?subject_type=<alias>&subject_id=<id>`:

| Objek | `subject_type` | `subject_id` | Aksi yang muncul |
|---|---|---|---|
| Parameter | `policy_parameter` | id parameter | `policy_parameter.version_created/version_cancelled` |
| Komponen honor | `honor_component` | id komponen | `honor_component.created/updated/deactivated/deactivation_cancelled/version_created/version_cancelled`, `transport_tier_set.version_created/version_cancelled` |
| Alasan penolakan | `leave_rejection_reason` | id alasan | `leave_rejection_reason.created/updated/deactivated/activated/deleted` |
| Urutan alasan | `leave_rejection_reason` | (kosong) | `leave_rejection_reason.reordered` |
| Pembersihan masa simpan | `retention_run` | id run | `retention.purged` |

## Kode audit dan notifikasi

- Audit lain: `access.denied`, `auth.account_locked`, `audit.purged`.
- Notifikasi: `retention.purged` (ke Owner setelah pembersihan terjadwal). Kode event lain ditambah oleh task pemicunya.
