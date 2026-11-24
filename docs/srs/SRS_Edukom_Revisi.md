**Dokumen Spesifikasi Kebutuhan Perangkat Lunak (Software Requirements Specification)**

Sistem Informasi Manajemen Terintegrasi

| **Di susun Oleh :**           |                                    |
|-------------------------------|------------------------------------|
| **Choiruddin Effendi**        | **5230311068 ( Project Manager )** |
| **Agis Maulana**              | **5230311042 (Developer)**         |
| **Ramaditya Naufal Ramadhan** | **(Developer)**                    |

<img src="media/image2.png" style="width:4.01111in;height:4.01111in" />

# BAB I PENDAHULUAN

## 1.1 Latar Belakang

CV Edukom Jaya Abadi merupakan perusahaan yang bergerak di bidang layanan pendidikan dan pelatihan Teknologi Informasi dan Komunikasi (TIK), khususnya melalui penyelenggaraan pembelajaran di sekolah mitra. Dalam menjalankan kegiatan operasionalnya, perusahaan bekerja sama dengan 37 sekolah mitra pada jenjang pendidikan dasar yang tersebar di wilayah Kabupaten Kulon Progo dan Kabupaten Sleman. Aktivitas operasional tersebut melibatkan berbagai pihak, antara lain pimpinan perusahaan, staf administrasi, Tentor IT, serta Tim Ekspedisi yang bertanggung jawab atas distribusi dan pengambilan perangkat pembelajaran.

Berdasarkan analisis proses bisnis yang berjalan (*as-is*), pengelolaan kegiatan operasional CV Edukom Jaya Abadi masih memanfaatkan berbagai media yang belum terintegrasi. Pengelolaan data sekolah, siswa, kelas, dan jadwal pembelajaran dilakukan menggunakan Microsoft Excel atau dokumen digital lainnya. Sementara itu, penyampaian informasi penugasan, koordinasi perubahan jadwal, serta pelaporan kendala operasional masih bergantung pada komunikasi melalui WhatsApp, email, dan media komunikasi lainnya. Dokumen administrasi pembelajaran juga disimpan dan dikumpulkan melalui beragam media, seperti Google Drive, dokumen digital pribadi, serta berkas fisik.

Permasalahan serupa ditemukan dalam pengelolaan presensi dan penggajian Tentor IT. Proses presensi masih menggabungkan pencatatan pada lembar presensi fisik yang disediakan sekolah dengan pengisian Google Form. Pada akhir bulan, staf administrasi harus mencocokkan kedua sumber data tersebut, termasuk memperhatikan informasi izin dan pergantian tentor sebelum menghitung honorarium. Proses tersebut meningkatkan beban administratif dan berpotensi menimbulkan ketidaksesuaian antara data kehadiran, identitas tentor yang benar-benar mengajar, dan hasil perhitungan penggajian.

Pada aspek manajemen aset, pencatatan distribusi perangkat masih berorientasi pada jumlah barang yang dibawa dan dikembalikan, belum pada identitas setiap unit secara konsisten. Pelaporan penyelesaian distribusi dan kerusakan perangkat juga masih mengandalkan komunikasi melalui grup WhatsApp. Selain itu, penggunaan *sticky notes* sebagai penanda kerusakan serta belum tersedianya pencatatan pemeliharaan yang terpusat menyebabkan riwayat kondisi dan perbaikan perangkat sulit ditelusuri secara berkelanjutan. Kondisi tersebut menimbulkan risiko ketidaksesuaian inventaris, keterlambatan penanganan kerusakan, dan kesulitan dalam memantau ketersediaan perangkat untuk kegiatan pembelajaran.

Abadi tidak hanya berkaitan dengan penggunaan media pencatatan yang berbeda, tetapi juga dengan belum terintegrasinya aliran data antarkegiatan bisnis. Informasi yang seharusnya saling berkaitan, seperti jadwal pembelajaran, penugasan tentor, kebutuhan perangkat, realisasi pembelajaran, presensi, dan penggajian, masih memerlukan proses pencocokan secara manual. Akibatnya, perubahan pada satu bagian dapat meningkatkan beban koordinasi dan memengaruhi ketepatan informasi pada bagian lainnya.

Sebagai upaya mengatasi permasalahan tersebut, diusulkan pengembangan Sistem Informasi Manajemen Terintegrasi, yaitu sistem informasi berbasis web yang dirancang untuk mengintegrasikan pengelolaan administrasi pembelajaran, presensi dan penggajian Tentor IT, serta manajemen aset dan ekspedisi dalam satu platform. Sistem ini diharapkan mampu menyediakan penyimpanan data terpusat, memvalidasi konsistensi informasi, mengotomatisasi perhitungan berdasarkan aturan perusahaan, serta mendukung pemantauan kegiatan operasional melalui dashboard sesuai hak akses pengguna.

Pada modul administrasi pembelajaran, sistem mendukung pengelolaan data sekolah, siswa, kelas, kelompok belajar, jadwal, dan dokumen administrasi. Pada modul izin dan penggantian tentor, sistem mengelola pengajuan izin dan pergantian pelaksana. Pada modul presensi dan penggajian, sistem menyediakan presensi berbasis geolocation dan geofencing serta perhitungan honorarium berdasarkan data kehadiran yang tervalidasi. Sementara itu, modul manajemen aset dan ekspedisi mendukung identifikasi setiap unit perangkat menggunakan Quick Response Code (QR Code), pencatatan distribusi dan pengambilan perangkat, pelaporan kerusakan, serta dokumentasi riwayat pemeliharaan.

Dengan adanya sistem tersebut, diharapkan proses operasional CV Edukom Jaya Abadi dapat berlangsung secara lebih terstruktur, transparan, dan dapat ditelusuri. Pengembangan sistem juga diharapkan mengurangi ketergantungan pada pencatatan berulang, meningkatkan konsistensi data, serta membantu pimpinan dalam memantau pelaksanaan kegiatan dan mengambil keputusan berdasarkan informasi yang terdokumentasi.

## 1.2 Tujuan Penyusunan Dokumen

Dokumen Spesifikasi Kebutuhan Perangkat Lunak (*Software Requirements Specification* atau SRS) SIM-Edukom ERP disusun sebagai acuan teknis dan fungsional dalam proses analisis, perancangan, pengembangan, serta pengujian sistem. Penyusunan dokumen ini bertujuan untuk:

1.  Mendefinisikan kebutuhan fungsional dan nonfungsional sistem berdasarkan hasil analisis proses bisnis CV Edukom Jaya Abadi, sehingga kebutuhan pengguna dapat diterjemahkan menjadi spesifikasi perangkat lunak yang terstruktur dan terukur.

2.  Menetapkan ruang lingkup dan batasan sistem, termasuk fungsi setiap modul, peran pengguna, hak akses, serta hubungan antarmodul untuk mencegah ketidaksesuaian antara kebutuhan operasional dan implementasi.

3.  Menjadi acuan bagi tim pengembang dalam melaksanakan perancangan arsitektur sistem, antarmuka pengguna, basis data, alur proses, serta implementasi fitur sesuai kebutuhan yang telah ditetapkan.

4.  Menyediakan dasar verifikasi dan validasi perangkat lunak melalui spesifikasi kebutuhan yang dapat digunakan sebagai acuan penyusunan skenario pengujian dan kriteria penerimaan sistem.

5.  Mendukung integrasi data operasional antara administrasi pembelajaran, presensi dan penggajian, serta manajemen aset dan ekspedisi untuk mengurangi duplikasi pencatatan dan kebutuhan rekonsiliasi manual.

6.  Mendukung pengawasan dan pengambilan keputusan melalui penyediaan informasi operasional yang terdokumentasi, laporan terstruktur, dan dashboard yang disesuaikan dengan kewenangan masing-masing pengguna.

Dokumen ini disusun dengan mengacu pada prinsip-prinsip rekayasa kebutuhan perangkat lunak dan struktur dokumentasi SRS yang dikenal dalam standar IEEE 830. Acuan tersebut digunakan sebagai landasan penyusunan kebutuhan secara sistematis, konsisten, dan dapat diuji, tanpa menyatakan bahwa dokumen ini telah memenuhi seluruh persyaratan sertifikasi atau kesesuaian formal terhadap standar tertentu.

## 1.3 Ruang Lingkup Sistem

SIM-Edukom ERP merupakan sistem informasi manajemen terintegrasi yang dirancang untuk mendukung proses operasional utama CV Edukom Jaya Abadi. Ruang lingkup pengembangan difokuskan pada empat modul operasional, yaitu Administrasi Pembelajaran, Izin dan Penggantian Tentor, Presensi dan Penggajian Tentor IT, serta Manajemen Aset dan Ekspedisi, yang didukung dua modul lintas fungsi, yaitu Pelaporan dan Dashboard serta Pengaturan Sistem. Modul-modul tersebut saling berhubungan melalui pertukaran data sesuai kebutuhan proses bisnis.

### 1.3.1 Modul Administrasi Pembelajaran

Modul Administrasi Pembelajaran berfungsi untuk mengelola data dan aktivitas akademik yang berkaitan dengan pelaksanaan program pembelajaran TIK di sekolah mitra. Fungsi utama modul ini meliputi:

1.  Pengelolaan data sekolah mitra, informasi kerja sama, dan dokumen Memorandum of Understanding (MoU).

2.  Pengelolaan data siswa, kelas, jumlah peserta, serta kebutuhan pembelajaran berdasarkan formulir pendataan sekolah.

3.  Perencanaan kelompok belajar dan sesi pembelajaran berdasarkan jumlah siswa serta kapasitas efektif perangkat yang tersedia atau direncanakan.

4.  Penyusunan, validasi, penerbitan, dan penyesuaian jadwal pembelajaran dengan mempertimbangkan rentang waktu sekolah, ketersediaan tentor, dan potensi bentrok penugasan.

5.  Pengelolaan dokumen administrasi tentor, yang mencakup Kalender Akademik, Program Tahunan (PROTA), Alokasi Waktu, Program Semester (PROSEM), Silabus, serta Modul Pembelajaran, disertai penyediaan unduhan Jadwal Pembelajaran dari jadwal resmi pada sistem.

6.  Pencatatan administrasi siswa yang meliputi absensi siswa, nilai, portofolio, dan jurnal kegiatan pembelajaran.

7.  Pengelolaan laporan realisasi pembelajaran, pemeriksaan kelengkapan administrasi, pencatatan perbaikan, serta penyimpanan riwayat verifikasi dokumen.

8.  Penyediaan fasilitas monitoring dan pelaporan administrasi pembelajaran bagi pengguna yang memiliki kewenangan.

Modul ini membedakan jadwal pembelajaran yang telah diterbitkan, kesiapan operasional perangkat, realisasi kegiatan pembelajaran, dan status verifikasi laporan. Pemisahan tersebut diperlukan agar data perencanaan tidak disamakan dengan bukti pelaksanaan kegiatan.

### 1.3.2 Modul Izin dan Penggantian Tentor

Modul Izin dan Penggantian Tentor berfungsi untuk mengelola ketidakhadiran tentor dan pergantian pelaksana Pertemuan sehingga setiap Pertemuan tetap memiliki tentor yang bertugas. Fungsi utama modul ini meliputi:

1.  Pengelolaan informasi ketersediaan waktu tentor sebagai referensi dalam proses pergantian penugasan.

2.  Pengajuan izin ketidakhadiran secara digital, termasuk pemilihan jadwal yang terdampak dan pengajuan calon tentor pengganti sesuai prosedur perusahaan.

3.  Pemeriksaan dan persetujuan pengajuan izin serta pergantian tentor oleh Admin.

Tentor pengganti dipilih dari tentor IT aktif, dan perubahan pelaksana hanya berlaku setelah disahkan oleh Admin. Izin yang tidak memperoleh pengganti dieskalasi kepada Owner. Modul ini juga menangani penggantian Pertemuan akibat tentor berstatus nonaktif.

### 1.3.3 Modul Presensi dan Penggajian Tentor IT

Modul Presensi dan Penggajian Tentor IT berfungsi untuk mengelola kehadiran dan perhitungan honorarium berdasarkan ketentuan operasional perusahaan. Fungsi utama modul ini meliputi:

4.  Penyajian jadwal mengajar yang telah ditetapkan oleh Admin melalui akun masing-masing tentor.

5.  Pencatatan presensi masuk (*check-in*) dan presensi pulang (*check-out*) menggunakan geolocation dan geofencing berdasarkan koordinat sekolah mitra dan radius yang ditetapkan.

6.  Penyimpanan data presensi beserta waktu pelaksanaan sebagai dasar pemeriksaan dan perhitungan honorarium.

7.  Otomatisasi perhitungan komponen honorarium, yang meliputi uang kehadiran, uang transportasi, honor mengajar per sesi, dan bonus sesuai ketentuan perusahaan.

8.  Pengelolaan hasil rekapitulasi penggajian, validasi dan persetujuan pimpinan, serta penerbitan slip gaji digital yang dapat diakses oleh tentor sesuai hak aksesnya.

Dalam modul ini, data presensi yang telah tervalidasi menjadi dasar perhitungan honorarium. Apabila suatu jadwal dilaksanakan oleh tentor pengganti yang telah disetujui, sistem harus menghubungkan realisasi kehadiran dan perhitungan honorarium dengan tentor yang benar-benar melaksanakan pembelajaran.

### 1.3.4 Modul Manajemen Aset dan Ekspedisi

Modul Manajemen Aset dan Ekspedisi berfungsi untuk mengelola inventaris perangkat operasional, distribusi dan pengambilan perangkat, serta pemeliharaan aset yang digunakan dalam kegiatan pembelajaran. Fungsi utama modul ini meliputi:

1.  Pendataan inventaris aset dan penyimpanan identitas setiap unit perangkat dalam basis data terpusat.

2.  Pembuatan QR Code unik untuk setiap unit atau item aset yang terdaftar.

3.  Pengelolaan kondisi, status, dan lokasi aset berdasarkan data operasional yang tercatat.

4.  Pembuatan penugasan distribusi perangkat oleh Admin, termasuk penentuan sekolah tujuan, kurir yang bertugas, dan daftar unit aset yang dibawa.

5.  Pencatatan serah terima perangkat melalui pemindaian QR Code pada saat pengantaran dan pengambilan kembali.

6.  Pencatatan bukti penyelesaian distribusi berupa foto yang didukung validasi lokasi sesuai ketentuan sistem.

7.  Pelaporan kerusakan perangkat oleh tentor atau kurir melalui pemindaian QR Code, pengisian deskripsi kendala, dan pengunggahan foto pendukung.

8.  Pengelolaan proses perbaikan oleh teknisi, termasuk pencatatan kerusakan, penanganan, status perbaikan, dan riwayat pemeliharaan setiap unit.

9.  Penyediaan dashboard inventaris dan laporan pergerakan aset bagi pimpinan serta pengguna yang berwenang.

Modul ini mengutamakan ketertelusuran aset berdasarkan identitas unit. Perangkat yang berstatus perbaikan tidak dapat dipilih untuk penugasan distribusi selama status tersebut masih berlaku. Adapun keputusan pengadaan aset baru tetap menjadi kewenangan pimpinan perusahaan, sedangkan Admin bertugas menyampaikan informasi kebutuhan pengadaan berdasarkan kondisi inventaris.

### 1.3.5 Modul Pelaporan dan Dashboard serta Pengaturan Sistem

Dua modul lintas fungsi mendukung seluruh modul operasional. Fungsi utamanya meliputi:

1.  Penyediaan dashboard monitoring administrasi pembelajaran dan aset bagi Owner, serta pencarian dan ekspor laporan rinci dengan definisi indikator yang sama.

2.  Pengelolaan parameter kebijakan, seperti durasi sesi, toleransi presensi, batas waktu pengajuan dan keputusan, ambang peringatan, dan masa simpan data, dengan riwayat versi.

3.  Pengelolaan daftar rujukan, yaitu alasan penolakan izin, kategori kendala perangkat, dan Jenis Perangkat.

### 1.3.6 Integrasi Antarmodul

Integrasi antarmodul dilakukan untuk memastikan bahwa informasi yang digunakan oleh setiap bagian berasal dari data yang konsisten dan saling berkaitan. Hubungan utama antarmodul meliputi:

1.  Administrasi Pembelajaran dengan Presensi dan Penggajian: jadwal pembelajaran yang telah diterbitkan menjadi referensi penugasan tentor dan pelaksanaan presensi. Informasi pergantian tentor yang telah disetujui digunakan untuk menentukan identitas pelaksana kegiatan dan dasar perhitungan honorarium.

2.  Izin dan Penggantian dengan Administrasi Pembelajaran serta Presensi dan Penggajian: Penugasan Sah pada Pertemuan PUBLISHED menjadi dasar pengajuan izin. Pergantian pelaksana yang telah disahkan Admin diteruskan kepada Presensi dan Penggajian, sedangkan angka izin dan penggantian pada rekap presensi bersumber dari Modul Izin.

3.  Administrasi Pembelajaran dengan Manajemen Aset dan Ekspedisi: jadwal, jumlah siswa, kelompok belajar, dan sesi yang direncanakan menjadi referensi estimasi kebutuhan perangkat serta penyusunan tugas distribusi. Status kesiapan perangkat tetap dikelola dan dipantau secara terpisah dari status penerbitan jadwal.

4.  Manajemen Aset dan Ekspedisi dengan Administrasi Pembelajaran: informasi alokasi, distribusi, pengambilan, dan kesiapan perangkat digunakan untuk mendukung pemantauan operasional pembelajaran.

5.  Integrasi Data Pelaporan: setiap modul menyediakan data operasional yang dapat digunakan untuk menyusun laporan dan dashboard sesuai hak akses pengguna. Data yang belum diverifikasi harus dibedakan dari data yang telah diperiksa atau disahkan.

Integrasi tersebut tidak menghilangkan kewenangan masing-masing bagian. Penetapan jadwal, persetujuan pergantian tentor, validasi penggajian, pengelolaan aset, dan keputusan pengadaan tetap mengikuti pembagian tanggung jawab yang berlaku di CV Edukom Jaya Abadi.

Pengelolaan keuangan secara menyeluruh di luar perhitungan honorarium belum ditetapkan sebagai ruang lingkup fungsional utama dalam dokumen ini karena proses bisnis pengelolaannya belum dijelaskan secara memadai. Pengembangan lebih lanjut pada aspek tersebut memerlukan analisis kebutuhan tersendiri.

## 1.4 Definisi, Akronim, dan Istilah

Untuk menjaga konsistensi pemahaman antara pemangku kepentingan, analis sistem, pengembang, dan penguji perangkat lunak, istilah yang digunakan dalam dokumen ini didefinisikan sebagai berikut.

| **Istilah**                                 | **Definisi**                                                                                                                                                                                                                                                                              |
|---------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| SIM-Edukom ERP                              | Sistem Informasi Manajemen Terintegrasi yang diusulkan untuk mendukung administrasi pembelajaran, presensi dan penggajian tentor, serta manajemen aset dan ekspedisi pada CV Edukom Jaya Abadi.                                                                                           |
| SRS (*Software Requirements Specification*) | Dokumen spesifikasi kebutuhan perangkat lunak yang mendefinisikan fungsi, batasan, karakteristik, dan kebutuhan sistem sebagai acuan pengembangan serta pengujian.                                                                                                                        |
| ERP (*Enterprise Resource Planning*)        | Pendekatan pengelolaan sistem informasi terintegrasi yang menghubungkan data dan proses bisnis dari beberapa fungsi operasional dalam satu ekosistem sistem.                                                                                                                              |
| *As-is*                                     | Gambaran proses bisnis yang sedang berjalan sebelum penerapan sistem yang diusulkan.                                                                                                                                                                                                      |
| *To-be*                                     | Gambaran proses bisnis yang direncanakan setelah penerapan sistem yang diusulkan.                                                                                                                                                                                                         |
| MoU (*Memorandum of Understanding*)         | Dokumen nota kesepahaman yang mencatat kesepakatan kerja sama antara CV Edukom Jaya Abadi dan sekolah mitra. MoU merupakan dokumen kerja sama, bukan sumber utama data siswa dan kelas.                                                                                                   |
| Tentor IT                                   | Tenaga pengajar yang melaksanakan kegiatan pembelajaran Teknologi Informasi dan Komunikasi di sekolah mitra.                                                                                                                                                                              |
| Admin                                       | Pengguna yang menjalankan fungsi administrasi, pengelolaan data, penjadwalan, pemeriksaan dokumen, serta pemrosesan operasional sesuai kewenangannya. Saat ini terdapat satu akun Admin. Pencatat pembayaran adalah Admin, sedangkan penyetuju honorarium adalah Owner.                   |
| Tim Ekspedisi                               | Personel yang bertanggung jawab atas persiapan, pengantaran, pengambilan, dan pelaporan distribusi perangkat pembelajaran.                                                                                                                                                                |
| *Owner*                                     | Pemilik sekaligus pimpinan CV Edukom Jaya Abadi yang memiliki kewenangan pengambilan keputusan tertentu, termasuk persetujuan penggajian dan keputusan pengadaan aset. Hanya terdapat satu akun Owner. Istilah Pimpinan tidak dipakai pada kebutuhan fungsional dan dibaca sebagai Owner. |
| Geolocation                                 | Teknologi untuk memperoleh informasi lokasi geografis perangkat pengguna berdasarkan layanan lokasi yang tersedia.                                                                                                                                                                        |
| Geofencing                                  | Mekanisme validasi lokasi menggunakan batas geografis virtual yang ditentukan berdasarkan koordinat dan radius tertentu, misalnya pada lokasi sekolah mitra. Aturan validasi tercantum pada KU-02.                                                                                        |
| *Check-in*                                  | Proses pencatatan presensi masuk tentor pada saat pelaksanaan tugas mengajar.                                                                                                                                                                                                             |
| *Check-out*                                 | Proses pencatatan presensi pulang tentor sebagai pelengkap pencatatan kehadiran selama pelaksanaan tugas.                                                                                                                                                                                 |
| QR Code (*Quick Response Code*)             | Kode matriks dua dimensi yang digunakan untuk mengidentifikasi unit aset melalui pemindaian dan menghubungkannya dengan data inventaris serta riwayat operasional dalam sistem.                                                                                                           |
| *Haversine Formula*                         | Persamaan matematis yang dapat digunakan untuk menghitung jarak antara dua titik koordinat pada permukaan bumi. Persamaan ini dapat menjadi salah satu metode validasi jarak antara lokasi perangkat pengguna dan titik koordinat sekolah.                                                |
| *Primary Key*                               | Atribut yang digunakan untuk mengidentifikasi setiap rekaman secara unik dalam suatu entitas pada basis data.                                                                                                                                                                             |
| *Foreign Key*                               | Atribut yang menghubungkan suatu entitas dengan entitas lain melalui referensi terhadap kunci pada tabel yang berkaitan.                                                                                                                                                                  |
| *Audit Trail*                               | Rekam jejak aktivitas atau perubahan data yang disimpan untuk mendukung penelusuran riwayat, termasuk identitas pelaku, waktu, dan perubahan yang dilakukan sesuai kebutuhan sistem.                                                                                                      |
| *Dashboard*                                 | Antarmuka yang menyajikan ringkasan data operasional dalam bentuk indikator, tabel, atau visualisasi untuk mendukung monitoring dan pengambilan keputusan.                                                                                                                                |
| *Draft*                                     | Status rancangan data atau jadwal yang masih dalam tahap penyusunan dan belum diterbitkan sebagai informasi resmi.                                                                                                                                                                        |
| *Published*                                 | Status jadwal atau Pertemuan yang telah melalui pemeriksaan yang diwajibkan dan diterbitkan oleh pengguna berwenang sehingga menjadi acuan resmi bagi modul lain.                                                                                                                         |
| *Real-time*                                 | Pemutakhiran atau penyajian informasi yang dilakukan segera setelah perubahan data diproses oleh sistem, dengan tetap bergantung pada kondisi koneksi dan mekanisme pemrosesan.                                                                                                           |
| *Verifikasi*                                | Proses pemeriksaan terhadap kelengkapan dan kesesuaian data atau dokumen berdasarkan kriteria yang telah ditentukan.                                                                                                                                                                      |
| *Slip Gaji Digital*                         | Dokumen elektronik yang menyajikan rincian perhitungan honorarium tentor untuk periode penggajian tertentu dan dapat diakses sesuai hak pengguna.                                                                                                                                         |
| *Ticketing*                                 | Mekanisme pencatatan laporan kendala atau kerusakan ke dalam suatu rekaman yang memiliki identitas, status penanganan, dan riwayat penyelesaian.                                                                                                                                          |
| *Master Data*                               | Data referensi utama yang digunakan bersama oleh berbagai proses sistem, seperti data sekolah, tentor, siswa, kelas, dan aset.                                                                                                                                                            |
| *Tentor*                                    | Tentor IT yang terdaftar dan aktif pada Modul Administrasi Pembelajaran.                                                                                                                                                                                                                  |
| *Tentor Pengganti*                          | Tentor IT aktif terdaftar yang menggantikan Tentor asli pada Pertemuan tertentu setelah pergantian disahkan Admin.                                                                                                                                                                        |
| *Pertemuan*                                 | Satu kegiatan pembelajaran yang dijadwalkan pada tanggal dan jam tertentu di satu sekolah. Pertemuan menjadi unit dasar penjadwalan, laporan, izin, penggantian, presensi, dan honorarium.                                                                                                |
| *Sesi*                                      | Satuan waktu mengajar berdurasi 70 menit (sesuai Lampiran D). Pada Modul Presensi dan Penggajian, istilah sesi dipakai untuk Pertemuan yang menjadi unit presensi dan honorarium.                                                                                                         |
| *Jadwal*                                    | Kumpulan Pertemuan milik satu Tentor pada satu sekolah.                                                                                                                                                                                                                                   |
| *Penugasan Sah*                             | Penetapan Tentor yang berwenang melaksanakan suatu Pertemuan PUBLISHED, termasuk Tentor Pengganti setelah pergantian disahkan.                                                                                                                                                            |
| *Kunjungan*                                 | Kehadiran Tentor pada satu sekolah pada satu hari, berapa pun jumlah sesinya.                                                                                                                                                                                                             |
| *Periode*                                   | Satu bulan kalender. Cut-off adalah hari terakhir bulan pukul 23.59 WIB.                                                                                                                                                                                                                  |
| *Hari-H*                                    | Tanggal pelaksanaan Pertemuan.                                                                                                                                                                                                                                                            |
| *Izin Terencana*                            | Izin yang diajukan paling lambat H-3, per jadwal.                                                                                                                                                                                                                                         |
| *Izin Mendesak*                             | Izin yang diajukan pada H-2, H-1, atau hari-H, per sesi.                                                                                                                                                                                                                                  |
| *Valid*                                     | Status presensi sesi yang dihitung honorarium.                                                                                                                                                                                                                                            |
| *Penyesuaian*                               | Nilai tambah atau kurang pada periode berjalan, berasal dari koreksi, sanggahan, atau bonus susulan.                                                                                                                                                                                      |

Definisi di atas menjadi dasar penggunaan istilah dalam keseluruhan dokumen SRS. Istilah teknis yang berkaitan dengan aturan operasional, seperti radius geofencing, tarif honorarium, kriteria verifikasi dokumen, dan ketentuan penggajian, harus mengikuti parameter yang ditetapkan atau disahkan oleh CV Edukom Jaya Abadi.

# BAB II ANALISIS SISTEM

## 2.1 Analisis Sistem Berjalan

Proses bisnis yang sedang berjalan pada CV Edukom Jaya Abadi merupakan rangkaian kegiatan pelayanan pembelajaran Teknologi Informasi dan Komunikasi (TIK) yang melibatkan sekolah mitra, Admin, tentor, kurir atau Tim Ekspedisi, teknisi, dan pimpinan perusahaan. Rangkaian tersebut dimulai dari pengajuan kerja sama sekolah, perencanaan pembelajaran, penyediaan perangkat, pelaksanaan kegiatan mengajar, pengelolaan administrasi, hingga perhitungan honorarium dan pelaporan kepada pimpinan. Seluruh kegiatan memiliki keterkaitan, tetapi pengelolaan informasinya masih menggunakan kombinasi dokumen fisik, Microsoft Excel, Google Form, WhatsApp, email, dan Google Drive yang belum terintegrasi.

Proses diawali ketika sekolah menghubungi Edukom untuk menyampaikan kebutuhan pembelajaran TIK melalui WhatsApp, email, atau datang langsung ke kantor. Edukom kemudian membahas kebutuhan dan bentuk kerja sama dengan pihak sekolah. Apabila tercapai kesepakatan, kerja sama dituangkan dalam Memorandum of Understanding (MoU). Selanjutnya, sekolah mengisi formulir pendataan yang memuat identitas sekolah, daftar siswa, pembagian kelas, jumlah peserta, kebutuhan pembelajaran, serta hari dan rentang waktu yang tersedia. MoU menjadi dokumen dasar kerja sama, sedangkan formulir pendataan menjadi sumber informasi untuk perencanaan kegiatan operasional.

Setelah menerima formulir, Admin memeriksa kelengkapan dan kesesuaian data. Apabila terdapat informasi yang belum lengkap, Admin melakukan konfirmasi kepada sekolah. Data yang telah diperiksa kemudian dicatat menggunakan Microsoft Excel atau dokumen digital lainnya. Informasi tersebut digunakan untuk menentukan kebutuhan tentor, pembagian kelompok belajar, jumlah sesi, serta kebutuhan laptop dan perangkat pendukung. Jika jumlah siswa melebihi kapasitas perangkat yang tersedia, kelas dibagi menjadi beberapa kelompok. Pembagian kelompok dan sesi ini

menjadi penghubung antara kebutuhan pembelajaran sekolah, penugasan tentor, dan distribusi perangkat.

Berdasarkan kebutuhan tersebut, Admin berkoordinasi dengan sekolah dan tentor untuk menyusun jadwal pembelajaran. Admin mencocokkan rentang waktu sekolah dengan ketersediaan tentor serta jadwal yang telah ditetapkan sebelumnya. Apabila belum ditemukan pengaturan yang sesuai, koordinasi dilakukan kembali untuk menyesuaikan hari, jam, atau pembagian sesi. Jadwal yang telah disepakati dicatat secara manual, kemudian disampaikan kepada tentor dan digunakan sebagai acuan koordinasi pengantaran serta pengambilan perangkat oleh Tim Ekspedisi. Karena informasi jadwal, tentor, kelompok belajar, dan perangkat dikelola secara terpisah, kesesuaiannya bergantung pada pemeriksaan serta komunikasi antarpihak.

Apabila terjadi perubahan akibat kegiatan sekolah, ujian, hari libur, atau kebutuhan lainnya, Admin memeriksa kembali penugasan dan memperbarui jadwal. Perubahan tersebut kemudian disampaikan kepada tentor dan Tim Ekspedisi apabila memengaruhi distribusi perangkat. Untuk tentor yang berhalangan hadir, dokumen menjelaskan ketentuan pengajuan izin paling lambat H-3 serta tanggung jawab tentor mencari calon pengganti. Calon pengganti diajukan kepada Admin untuk diperiksa dan disahkan. Jika tentor keluar atau menjadi nonaktif, pencarian dan penugasan pengganti menjadi tanggung jawab Admin. Perubahan penugasan ini juga perlu diperhatikan pada saat rekapitulasi kehadiran agar honorarium diberikan kepada tentor yang benar-benar melaksanakan pembelajaran.

Sebelum pelaksanaan pembelajaran, tentor menyiapkan dokumen administrasi yang meliputi Kalender Akademik, Program Tahunan, Alokasi Waktu, Program Semester, Silabus, Modul Pembelajaran, dan Jadwal Pembelajaran. Pada sisi operasional, Tim Ekspedisi menyiapkan perangkat sesuai kebutuhan kegiatan. Kurir memiliki jadwal kerja tetap, dan apabila berhalangan, pengganti dicari oleh kurir yang bersangkutan atau dengan bantuan Admin. Sebelum perangkat dibawa ke sekolah, kurir mengisi dan menandatangani formulir cetak yang mencatat nama kurir, tanggal, serta jumlah laptop dan aksesori yang dibawa. Pencatatan ini menjadi bukti keluar masuk perangkat, tetapi belum memungkinkan pencocokan identitas setiap unit secara pasti.

Setibanya di sekolah, kurir memasang perangkat agar siap digunakan, kemudian mengirimkan foto hasil pemasangan ke grup WhatsApp operasional. Foto tersebut dilengkapi keterangan waktu dan lokasi sebagai bukti pelaksanaan tugas. Setelah perangkat tersedia, tentor atau tentor pengganti melaksanakan pembelajaran sesuai jadwal. Tentor mengisi lembar presensi fisik dari sekolah serta Google Form untuk melaporkan kehadiran kepada kantor. Selama atau setelah pembelajaran, tentor juga mencatat absensi siswa, materi yang disampaikan, jurnal kegiatan, nilai, dan portofolio menggunakan buku, formulir fisik, Microsoft Excel, atau dokumen digital pribadi. Dengan demikian, satu kegiatan pembelajaran menghasilkan beberapa jenis catatan yang disimpan pada media berbeda.

Apabila perangkat mengalami kendala saat digunakan, tentor atau kurir memfoto perangkat yang bermasalah dan mengirimkan laporan ke grup WhatsApp yang beranggotakan Admin dan teknisi. Laporan tersebut menjadi dasar tindak lanjut pengiriman perangkat cadangan. Pada proses pengambilan, kurir membereskan perangkat dan membawanya kembali ke kantor, kemudian mencatat jumlah perangkat yang dikembalikan. Dokumen menyebutkan pengambilan dilakukan sekitar 15 menit sebelum pembelajaran berakhir, tetapi rincian pelaksanaannya terhadap perangkat yang masih digunakan perlu dikonfirmasi lebih lanjut. Berbeda dengan pemasangan, pengambilan perangkat tidak disertai kewajiban pelaporan foto.

Perangkat yang mengalami kerusakan kemudian diberi catatan menggunakan *sticky notes* oleh Admin dan diserahkan kepada teknisi internal. Penanganan kerusakan belum didukung pencatatan terpusat mengenai tanggal kerusakan, tindakan perbaikan, dan waktu penyelesaian. Riwayat perawatan masih bergantung pada percakapan WhatsApp dan ingatan teknisi. Kondisi ini menyulitkan penelusuran kerusakan berulang maupun penilaian kesiapan perangkat untuk mendukung jadwal pembelajaran berikutnya.

Pada periode pengumpulan administrasi, tentor merekap dan menyerahkan dokumen kepada Admin. Dokumen tahunan mencakup Kalender Akademik, Program Tahunan, dan Alokasi Waktu, sedangkan dokumen semesteran mencakup Program Semester, Silabus, Modul Pembelajaran, dan Jadwal Pembelajaran. Administrasi bulanan meliputi absensi, nilai, dan portofolio siswa. Pengumpulan dilakukan melalui WhatsApp, email, Google Drive, atau penyerahan berkas fisik. Admin memeriksa kelengkapan dokumen, menghubungi tentor apabila diperlukan perbaikan, kemudian mengarsipkan dokumen yang telah memenuhi ketentuan. Karena dokumen tersebar pada berbagai media, Admin harus menelusuri dan mencocokkan informasi untuk mengetahui kelengkapan serta versi dokumen yang digunakan.

Menjelang akhir bulan, Admin juga melakukan rekapitulasi kehadiran tentor dengan membandingkan data Google Form dan bukti presensi fisik yang dikirim dalam bentuk foto atau diserahkan langsung. Informasi izin dan pergantian tentor dicocokkan kembali agar kehadiran tercatat atas nama pelaksana yang benar. Setelah data dinyatakan valid, Admin menghitung honorarium berdasarkan uang kehadiran, uang transportasi, honor mengajar per sesi, dan bonus. Rekapitulasi penggajian disampaikan kepada pimpinan untuk diperiksa dan disetujui. Gaji beserta slip cetak kemudian diserahkan kepada tentor pada rapat rutin awal bulan berikutnya.

Data sekolah, pelaksanaan pembelajaran, kelengkapan administrasi, kehadiran tentor, penggajian, serta catatan perangkat menjadi informasi pendukung pengawasan perusahaan. Namun, informasi tersebut belum tersedia sebagai satu rangkaian data yang mudah ditelusuri. Untuk memenuhi kebutuhan pelaporan, Admin perlu mengumpulkan dan merekap kembali informasi dari dokumen serta media komunikasi yang digunakan oleh setiap bagian.

Berdasarkan keseluruhan alur tersebut, keterkaitan antarproses sudah terbentuk secara operasional, tetapi belum didukung integrasi pencatatan dan pertukaran data. Jadwal pembelajaran menjadi titik penghubung utama antara kebutuhan sekolah, penugasan tentor, dan distribusi perangkat. Realisasi kegiatan kemudian menjadi dasar pencatatan administrasi siswa dan kehadiran tentor, sedangkan kehadiran yang telah diperiksa menjadi dasar penghitungan honorarium. Pada saat yang sama, kondisi perangkat menentukan kesiapan operasional untuk kegiatan berikutnya.

Kelemahan utama proses yang berjalan adalah ketergantungan pada komunikasi personal dan pemeriksaan manual untuk menjaga kesesuaian informasi tersebut. Satu perubahan jadwal atau pergantian tentor membutuhkan pembaruan pada beberapa catatan, sementara bukti pelaksanaan, dokumen pembelajaran, dan riwayat perangkat tersebar di berbagai media. Kondisi ini berpotensi menimbulkan perbedaan data, keterlambatan penyampaian informasi, kesalahan rekapitulasi, dan kesulitan penelusuran riwayat. Pemeriksaan Admin, bukti presensi, formulir perangkat, serta persetujuan pimpinan telah menjadi pengendalian dasar, tetapi pelaksanaannya masih sangat bergantung pada ketelitian dan konsistensi personel.

<img src="media/image1.png" style="width:5.55521in;height:8.50206in" />

## 2.2 Analisis Masalah Pokok

Berdasarkan analisis proses bisnis CV Edukom Jaya Abadi, kegiatan administrasi pembelajaran, pengelolaan tentor, penggajian, dan manajemen aset masih menggunakan kombinasi dokumen fisik serta aplikasi yang belum terintegrasi. Kondisi tersebut menyebabkan pertukaran informasi dan pemeriksaan data bergantung pada komunikasi serta pencocokan manual. Permasalahan pokok yang teridentifikasi adalah sebagai berikut.

**1. Pengelolaan Data Belum Terintegrasi**

Data sekolah mitra, siswa, jadwal pembelajaran, tentor, presensi, penggajian, dan perangkat disimpan pada media yang berbeda, seperti Microsoft Excel, Google Form, WhatsApp, email, Google Drive, dan dokumen fisik. Belum terdapat satu sumber data bersama yang menghubungkan seluruh kegiatan tersebut.

Kondisi ini menyulitkan pencarian dan pencocokan informasi antarbagian. Perubahan data harus diperbarui secara manual pada dokumen yang berkaitan sehingga berpotensi menimbulkan perbedaan versi informasi dan pengulangan pencatatan.

**2. Penyusunan Jadwal dan Koordinasi Operasional Masih Dilakukan Secara Manual**

Penyusunan jadwal memerlukan pencocokan antara waktu yang disediakan sekolah, ketersediaan tentor, jumlah siswa, pembagian kelompok, jumlah sesi, serta kebutuhan perangkat. Admin melakukan pencocokan tersebut melalui dokumen dan komunikasi langsung dengan pihak terkait.

Apabila terjadi perubahan, Admin harus memeriksa kembali pengaturan yang terdampak dan menyampaikan informasi kepada tentor serta Tim Ekspedisi. Proses ini membutuhkan pemeriksaan berulang dan berpotensi menyebabkan ketidaksesuaian informasi antara jadwal mengajar dan distribusi perangkat.

**3. Pencatatan Izin dan Pergantian Tentor Belum Terhubung dengan Data Kehadiran**

Pengajuan izin dan pencarian tentor pengganti dilakukan melalui komunikasi personal. Tentor yang berhalangan bertanggung jawab mencari calon pengganti untuk diajukan kepada Admin, tetapi proses pencarian belum didukung informasi ketersediaan tentor yang terpusat.

Informasi pergantian juga harus dicocokkan kembali pada saat rekapitulasi kehadiran. Kondisi ini menimbulkan risiko perbedaan antara tentor yang tercantum dalam jadwal dan tentor yang benar-benar mengajar, sehingga dapat memengaruhi ketepatan pencatatan kehadiran serta penerima honorarium.

**4. Pemantauan Kelengkapan Administrasi Pembelajaran Belum Efisien**

Tentor mengumpulkan dokumen administrasi melalui berbagai media, baik secara digital maupun dalam bentuk berkas fisik. Admin harus menelusuri dokumen satu per satu untuk mengetahui kelengkapan pengumpulan dan memastikan dokumen yang digunakan merupakan versi yang sesuai.

Ketika terdapat kekurangan, permintaan perbaikan dan pengiriman ulang dilakukan melalui komunikasi terpisah. Akibatnya, pemantauan dokumen yang belum dikumpulkan, masih memerlukan perbaikan, dan telah memenuhi ketentuan membutuhkan waktu serta ketelitian yang tinggi.

**5. Rekapitulasi Kehadiran dan Perhitungan Honorarium Bergantung pada Pemeriksaan Manual**

Kehadiran tentor dicatat melalui lembar presensi fisik dan Google Form. Menjelang akhir bulan, Admin mencocokkan kedua sumber tersebut serta menyesuaikannya dengan informasi izin dan pergantian tentor. Hasil pemeriksaan kemudian menjadi dasar perhitungan uang kehadiran, uang transportasi, honor mengajar per sesi, dan bonus.

Penggunaan beberapa sumber data memberikan bahan pembanding, tetapi juga menambah beban pemeriksaan. Apabila bukti belum lengkap atau terdapat ketidaksesuaian, Admin perlu melakukan konfirmasi kembali. Kondisi tersebut berpotensi memperpanjang proses rekapitulasi dan memengaruhi ketepatan perhitungan honorarium.

**6. Pencatatan Keluar Masuk Aset Belum Menjamin Ketertelusuran Setiap Unit**

Pendataan perangkat yang dibawa dan dikembalikan oleh kurir masih menggunakan formulir cetak dengan penekanan pada jumlah laptop serta aksesori. Pencatatan tersebut belum memastikan bahwa setiap perangkat yang kembali merupakan unit yang sama dengan perangkat yang dibawa.

Dengan demikian, kesesuaian jumlah belum cukup untuk memastikan kesesuaian identitas perangkat. Kondisi ini menyulitkan penelusuran pergerakan setiap unit, pemeriksaan pertukaran perangkat, dan pertanggungjawaban atas aset tertentu.

**7. Riwayat Kerusakan dan Perbaikan Aset Belum Terdokumentasi Secara Terstruktur**

Laporan kerusakan disampaikan melalui foto dan pesan dalam grup WhatsApp. Setelah perangkat dikembalikan ke kantor, Admin menempelkan catatan kerusakan pada perangkat sebelum menyerahkannya kepada teknisi. Riwayat penanganan belum dicatat secara terpusat dan masih bergantung pada percakapan serta ingatan teknisi.

Akibatnya, informasi mengenai waktu kerusakan, tindakan perbaikan, lama penanganan, dan kesiapan perangkat sulit ditelusuri secara menyeluruh. Kondisi ini juga menyulitkan evaluasi kerusakan berulang dan penentuan kebutuhan perawatan atau penggantian perangkat.

**8. Penyusunan Laporan Membutuhkan Penggabungan Data dari Berbagai Sumber**

Untuk menyusun laporan kepada pimpinan, Admin harus mengumpulkan dan merekap kembali informasi sekolah, kegiatan pembelajaran, kelengkapan administrasi, kehadiran tentor, serta catatan operasional terkait. Informasi tersebut belum tersedia dalam bentuk yang saling terhubung dan dapat langsung digunakan.

Proses penggabungan data menyebabkan penyediaan laporan bergantung pada waktu yang diperlukan untuk pencarian dan pemeriksaan. Akibatnya, pemantauan kondisi operasional terkini belum dapat dilakukan secara cepat dan menyeluruh.

**9. Ketergantungan terhadap Personel Masih Tinggi**

Kesinambungan proses bisnis sangat bergantung pada Admin dan personel terkait dalam mengingat perubahan jadwal, menelusuri komunikasi, mencocokkan dokumen, serta menjelaskan riwayat penanganan perangkat. Sebagian informasi operasional belum terdokumentasi dengan cara yang mudah digunakan oleh personel lain.

Ketika personel berhalangan atau terjadi pergantian pegawai, penelusuran informasi dan pelaksanaan pekerjaan berpotensi terhambat. Hal ini menunjukkan bahwa keberlanjutan proses belum sepenuhnya didukung oleh dokumentasi yang konsisten.

## 2.3 Karakteristik dan Pemetaan Pengguna

Berdasarkan proses bisnis CV Edukom Jaya Abadi, pihak yang terlibat meliputi Admin, tentor, kurir atau Tim Ekspedisi, teknisi, pimpinan, dan sekolah mitra. Setiap pihak memiliki tanggung jawab serta kebutuhan informasi yang berbeda, tetapi saling berkaitan dalam pelaksanaan layanan pembelajaran TIK.

Pemetaan berikut menjelaskan karakteristik pengguna berdasarkan kegiatan yang sedang berjalan. Kebutuhan akses merupakan dasar untuk perancangan sistem, bukan gambaran hak akses yang telah diterapkan saat ini.

### 1. Admin

Admin berperan sebagai pusat pengelolaan administrasi dan koordinasi operasional. Pekerjaannya membutuhkan ketelitian karena melibatkan pemeriksaan data dari berbagai pihak serta penyesuaian informasi antarproses.

1.  Tanggung jawab: Mengelola data sekolah, siswa, kelas, dan tentor; menyusun jadwal; mengoordinasikan perubahan penugasan; memeriksa administrasi pembelajaran; merekap kehadiran; serta menghitung honorarium.

2.  Kebutuhan informasi: Data sekolah dan siswa, ketersediaan tentor, jadwal pembelajaran, kebutuhan perangkat, dokumen administrasi, bukti kehadiran, serta informasi izin dan pergantian tentor.

3.  Kebutuhan akses: Pengelolaan data operasional, pemeriksaan dokumen, validasi kehadiran, penyusunan rekap penggajian, dan pembuatan laporan sesuai kewenangannya.

4.  Batas kewenangan: Persetujuan akhir penggajian tetap berada pada pimpinan. Dalam proses aset yang berjalan, pencatatan keluar masuk perangkat dilakukan oleh kurir.

### 2. Tentor

Tentor merupakan pelaksana pembelajaran di sekolah mitra sekaligus penanggung jawab administrasi kegiatan yang diampunya. Tentor membutuhkan informasi penugasan yang jelas dan sarana pencatatan yang mudah digunakan saat berada di lapangan.

1.  Tanggung jawab: Menyiapkan dokumen pembelajaran, melaksanakan kegiatan mengajar, mencatat kehadiran, mengelola absensi dan hasil belajar siswa, serta mengumpulkan administrasi pembelajaran.

2.  Kebutuhan informasi: Jadwal mengajar, sekolah tujuan, kelas atau kelompok yang diampu, kewajiban administrasi, hasil pemeriksaan dokumen, dan rincian honorarium pribadi.

3.  Kebutuhan akses: Melihat penugasan sendiri, mengajukan izin dan calon pengganti, mencatat kegiatan serta administrasi siswa yang menjadi tanggung jawabnya, mengumpulkan dokumen, dan melihat slip honorarium pribadi.

4.  Batas kewenangan: Tentor tidak menetapkan sendiri persetujuan pergantian penugasan, hasil verifikasi administrasi, maupun nominal honorarium.

### 3. Kurir atau Tim Ekspedisi

Kurir bertanggung jawab atas distribusi dan pemasangan perangkat pembelajaran. Aktivitasnya lebih banyak berlangsung di lapangan sehingga membutuhkan informasi penugasan yang ringkas, jelas, dan sesuai dengan jadwal pembelajaran.

1.  Tanggung jawab: Mencatat perangkat yang dibawa dan dikembalikan, mengantarkan perangkat, melakukan pemasangan di sekolah, mengirimkan bukti pemasangan, serta mengambil kembali perangkat.

2.  Kebutuhan informasi: Sekolah tujuan, waktu pelaksanaan, kebutuhan perangkat, jadwal pengantaran dan pengambilan, serta perubahan kegiatan yang memengaruhi distribusi.

3.  Kebutuhan akses: Melihat tugas distribusi, mencatat keluar masuk perangkat, mengirimkan bukti pelaksanaan tugas, dan melaporkan kerusakan yang ditemukan.

4.  Batas kewenangan: Kurir mencatat pelaksanaan distribusi, sedangkan keputusan perbaikan teknis dan persetujuan pengadaan berada pada pihak yang berwenang.

### 4. Teknisi

Teknisi bertanggung jawab menangani perangkat yang mengalami kerusakan. Pekerjaannya membutuhkan informasi yang dapat menghubungkan identitas perangkat, keluhan, dan tindakan perbaikan.

1.  Tanggung jawab: Memeriksa perangkat bermasalah dan melakukan perbaikan sesuai kondisi kerusakan.

2.  Kebutuhan informasi: Identitas perangkat, laporan kendala, bukti kerusakan, riwayat penanganan, dan kondisi perangkat setelah diperbaiki.

3.  Kebutuhan akses: Melihat laporan kerusakan, mencatat hasil pemeriksaan, memperbarui perkembangan perbaikan, serta mendokumentasikan tindakan dan hasil penanganan.

4.  Batas kewenangan: Akses teknisi difokuskan pada informasi teknis aset, tanpa kebutuhan mengakses data penggajian atau administrasi siswa.

### 5. Pimpinan atau Owner

Pimpinan berperan dalam pengawasan dan pengambilan keputusan perusahaan. Kebutuhan utamanya adalah informasi yang telah dirangkum, dapat dipercaya, dan dapat ditelusuri ke data pendukung apabila diperlukan.

1.  Tanggung jawab: Memantau kegiatan perusahaan, mengevaluasi laporan, serta memeriksa dan menyetujui rekapitulasi penggajian.

2.  Kebutuhan informasi: Ringkasan kegiatan pembelajaran, kelengkapan administrasi, rekap kehadiran dan honorarium, serta kondisi dan penggunaan aset.

3.  Kebutuhan akses: Melihat laporan lintas bagian, meninjau rincian pendukung, dan memberikan persetujuan sesuai kewenangan.

4.  Batas kewenangan operasional: Pimpinan tidak harus melakukan pencatatan harian yang menjadi tanggung jawab Admin, tentor, kurir, dan teknisi.

### 6. Sekolah Mitra

Sekolah mitra merupakan pihak eksternal yang mengajukan kebutuhan pembelajaran dan menyediakan data awal untuk perencanaan layanan. Sekolah juga menjadi pihak yang berkoordinasi dengan Edukom mengenai waktu dan perubahan pelaksanaan kegiatan.

1.  Tanggung jawab: Menyampaikan kebutuhan pembelajaran, mengisi formulir data sekolah dan siswa, menyediakan rentang waktu pembelajaran, serta menginformasikan perubahan kegiatan sekolah.

2.  Kebutuhan informasi: Kesepakatan kerja sama, jadwal pembelajaran, penugasan tentor, dan perubahan pelaksanaan yang berkaitan dengan sekolahnya.

3.  Bentuk keterlibatan: Menjadi sumber data dan mitra koordinasi melalui saluran komunikasi yang digunakan perusahaan.

## 2.4 Usulan Solusi Arsitektur Sistem Baru (ERP)

Proses bisnis baru pada CV Edukom Jaya Abadi diusulkan menggunakan SIM-Edukom ERP untuk mengintegrasikan administrasi pembelajaran, penugasan tentor, presensi dan penggajian, serta manajemen aset. Sistem menyediakan sumber data bersama yang dapat digunakan oleh setiap bagian sesuai tanggung jawab dan kewenangannya. Melalui integrasi tersebut, kegiatan dapat ditelusuri sejak pengajuan kebutuhan sekolah hingga pelaksanaan pembelajaran, pengembalian perangkat, dan penggajian tentor.

Proses dimulai ketika sekolah mengajukan kebutuhan pembelajaran TIK melalui WhatsApp, email, atau kunjungan langsung. Edukom kemudian membahas kebutuhan dan bentuk kerja sama dengan sekolah hingga mencapai kesepakatan yang dituangkan dalam Memorandum of Understanding (MoU). Setelah kesepakatan tercapai, Admin mencatat identitas sekolah, kontak penanggung jawab, periode kerja sama, serta dokumen MoU ke dalam sistem. Sekolah selanjutnya mengisi formulir pendataan yang memuat data siswa, kelas, jumlah peserta, kebutuhan pembelajaran, serta hari dan rentang waktu yang tersedia.

Admin memeriksa kelengkapan dan kesesuaian formulir yang dikembalikan oleh sekolah. Apabila terdapat informasi yang belum lengkap, Admin melakukan konfirmasi sebelum memasukkan atau mengimpor data ke dalam sistem. Data yang telah diperiksa digunakan untuk menentukan kelompok belajar, jumlah sesi, kebutuhan tentor, dan perangkat pendukung. Apabila jumlah siswa melebihi kapasitas perangkat yang dapat digunakan, kelas dibagi menjadi beberapa kelompok yang tetap dihubungkan dengan kelas dan sekolah asalnya.

Berdasarkan kebutuhan tersebut, Admin menyusun jadwal dengan mempertimbangkan waktu sekolah, ketersediaan tentor, pembagian kelompok, dan kebutuhan sesi. Sistem membantu memeriksa benturan penugasan agar tentor tidak dijadwalkan pada waktu yang bersamaan. Jika terdapat ketidaksesuaian, Admin berkoordinasi kembali dengan sekolah dan tentor untuk menentukan penyesuaian. Jadwal yang telah disepakati kemudian diterbitkan dan menjadi acuan pelaksanaan pembelajaran serta perencanaan distribusi perangkat.

Apabila terjadi perubahan kegiatan sekolah, Admin memperbarui jadwal dengan mencatat alasan perubahan dan memeriksa penugasan yang terdampak. Tentor yang berhalangan hadir mengajukan izin melalui sistem sesuai ketentuan perusahaan dan mengusulkan calon pengganti yang telah bersedia. Sistem membantu menampilkan calon pengganti berdasarkan ketersediaan dan jadwal yang tercatat, sedangkan Admin memeriksa serta mengesahkan perubahan penugasan. Setelah disetujui, informasi diperbarui kepada pihak terkait dengan tetap menyimpan riwayat tentor awal, tentor pengganti, dan alasan pergantian.

Sebelum pelaksanaan pembelajaran, tentor menyiapkan dan mengunggah dokumen administrasi melalui akun masing-masing. Dokumen tersebut meliputi Kalender Akademik, Program Tahunan, Alokasi Waktu, Program Semester, Silabus, serta Modul Pembelajaran sesuai periode serta cakupan kewajibannya, sedangkan Jadwal Pembelajaran diunduh dari jadwal resmi pada sistem dan tidak diunggah. Admin memeriksa kelengkapan dan kesesuaian isi dokumen, kemudian memberikan catatan apabila diperlukan perbaikan. Tentor mengirimkan versi perbaikan melalui sistem, sedangkan dokumen yang telah memenuhi ketentuan ditetapkan sebagai terverifikasi dan disimpan beserta riwayat pemeriksaannya.

Pada saat yang sama, petugas operasional menyiapkan distribusi perangkat berdasarkan kebutuhan jadwal pembelajaran. Petugas memilih sekolah tujuan, kurir, waktu pengantaran dan pengambilan, serta unit perangkat yang akan digunakan. Sistem memeriksa kondisi dan ketersediaan perangkat untuk mencegah penggunaan unit yang sedang diperbaiki atau telah dialokasikan pada waktu yang bertabrakan. Apabila kebutuhan belum terpenuhi, sistem menampilkan peringatan untuk ditindaklanjuti melalui penyesuaian alokasi atau keputusan operasional, sementara kebutuhan pengadaan disampaikan kepada pimpinan untuk diputuskan.

Kurir melihat tugas distribusi melalui sistem dan memindai QR Code setiap perangkat sebelum membawanya keluar dari kantor. Hasil pemindaian dicocokkan dengan daftar penugasan agar identitas perangkat yang dibawa tercatat secara jelas. Setibanya di sekolah, kurir melakukan pemasangan dan mengirimkan foto bukti pelaksanaan yang dilengkapi informasi waktu serta pemeriksaan lokasi. Laporan tersebut memperbarui status distribusi sehingga Admin dan tentor terkait dapat mengetahui kesiapan perangkat sebelum pembelajaran dimulai.

Tentor atau tentor pengganti melaksanakan pembelajaran sesuai penugasan yang telah disahkan. Tentor melakukan presensi masuk dan keluar melalui sistem yang menghubungkan catatan kehadiran dengan jadwal serta memeriksa lokasi terhadap area sekolah yang ditentukan. Apabila terjadi kendala jaringan, ketidakakuratan lokasi, atau kesalahan pencatatan, tentor mengajukan koreksi dengan alasan dan bukti pendukung untuk diperiksa oleh Admin. Selama atau setelah pembelajaran, tentor mencatat absensi siswa, materi, jurnal kegiatan, nilai, dan portofolio yang dihubungkan dengan sekolah, kelas atau kelompok, serta pertemuan terkait.

Apabila perangkat mengalami kendala saat digunakan, tentor atau kurir membuat laporan kerusakan dengan memindai QR Code unit terkait. Laporan memuat uraian masalah dan foto pendukung agar Admin atau petugas berwenang dapat menentukan tindak lanjut. Jika diperlukan, petugas mengatur pengiriman perangkat pengganti dan mencatatnya sebagai pergerakan aset tersendiri. Perangkat yang dinyatakan bermasalah diberi status yang mencegah penugasan berikutnya sampai pemeriksaan atau perbaikan selesai.

Setelah perangkat selesai digunakan, kurir melakukan pengambilan sesuai pengaturan operasional yang telah disepakati. Kurir memindai setiap unit untuk memastikan kesesuaian perangkat yang diambil dengan catatan perangkat di sekolah, kemudian sistem mencatat statusnya dalam perjalanan kembali. Setelah tiba di kantor, petugas mengonfirmasi identitas, jumlah, dan kondisi perangkat sebelum menyatakan penerimaan selesai. Apabila ditemukan selisih atau kerusakan, petugas mencatatnya sebagai masalah yang memerlukan tindak lanjut.

Perangkat yang mengalami kerusakan diserahkan kepada teknisi beserta laporan yang telah tersimpan dalam sistem. Teknisi mencatat hasil pemeriksaan, tindakan perbaikan, dan hasil pengujian sehingga perkembangan penanganan dapat dipantau. Setelah perangkat dinyatakan layak oleh pihak berwenang, statusnya diperbarui menjadi siap digunakan. Seluruh riwayat penanganan tetap terhubung dengan identitas aset sebagai dasar evaluasi kondisi dan kebutuhan perawatan.

Setelah kegiatan pembelajaran, tentor melengkapi dan mengirimkan laporan realisasi melalui sistem. Admin memeriksa kesesuaian laporan dengan jadwal, identitas tentor pelaksana, dan kewajiban administrasi yang berlaku. Laporan yang belum sesuai dikembalikan dengan catatan perbaikan, sedangkan laporan yang telah memenuhi ketentuan ditetapkan sebagai terverifikasi. Status pemeriksaan laporan pembelajaran tetap dibedakan dari validasi kehadiran karena keduanya memiliki fungsi yang berbeda.

Pada akhir periode penggajian, Admin meninjau data kehadiran, izin, pergantian tentor, dan pengajuan koreksi yang belum diselesaikan. Setelah data dinyatakan valid, sistem menghitung honorarium berdasarkan aturan uang kehadiran, transportasi, honor mengajar per sesi, dan bonus yang berlaku. Apabila bonus mensyaratkan kelengkapan administrasi, perhitungan menggunakan hasil verifikasi pada periode terkait. Honorarium atas penugasan yang digantikan diperhitungkan bagi tentor pengganti berdasarkan penugasan dan kehadiran yang telah disahkan.

Admin memeriksa hasil perhitungan sebelum mengajukan rekapitulasi penggajian kepada pimpinan. Pimpinan meninjau rekap tersebut dan dapat mengembalikannya dengan catatan apabila diperlukan perbaikan. Setelah persetujuan diberikan, sistem menerbitkan slip honorarium digital yang dapat diakses oleh masing-masing tentor. Pembayaran dilaksanakan melalui mekanisme perusahaan, sedangkan status pembayaran dicatat berdasarkan bukti pelaksanaannya.

Seluruh data dan dokumen yang dihasilkan disimpan sebagai arsip operasional yang saling terhubung. Admin dan pimpinan dapat memantau jadwal, realisasi pembelajaran, kelengkapan administrasi, kehadiran, penggajian, serta kondisi dan pergerakan aset sesuai hak aksesnya. Informasi yang belum diperiksa ditampilkan berbeda dari informasi yang telah terverifikasi agar status data dapat dipahami secara tepat. Riwayat perubahan dan persetujuan juga disimpan untuk mendukung penelusuran, pemeriksaan, serta evaluasi kegiatan perusahaan.

<img src="media/image3.png" style="width:4.96614in;height:9.07604in" />

# BAB III KEBUTUHAN FUNGSIONAL (USER STORIES)

## 3.1 Ketentuan Umum dan Layanan Bersama

Bab ini menguraikan kebutuhan fungsional sistem berdasarkan peran pengguna. Setiap peran memiliki daftar kebutuhan fungsionalnya sendiri sehingga tanggung jawab masing-masing pihak dapat dibaca secara utuh. Beberapa kebutuhan pada peran yang berbeda dapat memiliki nama yang mirip, misalnya pelaporan kendala perangkat atau pemantauan izin, tetapi tanggung jawab yang dijalankan berbeda: satu peran mencatat atau mengajukan, peran lain memeriksa, memutuskan, atau memantau.

Kebutuhan fungsional menjelaskan apa yang dapat dilakukan setiap peran dan data apa yang dipakai atau diinputkan. Besaran nilai, rumus perhitungan, batas waktu dalam angka, dan rincian teknis lain tidak diuraikan pada bab ini. Nilai-nilai tersebut ditetapkan Owner sebagai parameter kebijakan (OW-02) dan komponen honorarium (OW-01), sedangkan ketentuan teknisnya diatur pada BAB IV, BAB V, dan Lampiran.

### Susunan Penulisan Kebutuhan Fungsional

Setiap kebutuhan fungsional ditulis dengan susunan yang sama: judul dengan kode dan nama fungsi (misalnya AD-07 \| Penyusunan dan Penerbitan Jadwal), SRS — Kebutuhan Fungsional yang berisi uraian ringkas, User Story, dan Acceptance Criteria. Kode AC diberi nomor urut AC-\[kode fungsi\].\[nomor\], misalnya AC-AD-07.1. Ketentuan yang berlaku bagi seluruh peran ditulis satu kali pada bagian ini dengan kode KU dan dirujuk oleh kebutuhan lain tanpa mengulang isinya.

### Kode Peran

| **Kode** | **Peran**                          | **Bagian** |
|----------|------------------------------------|------------|
| KU       | Ketentuan Umum dan Layanan Bersama | 3.1        |
| OW       | Owner                              | 3.2        |
| AD       | Admin                              | 3.3        |
| TN       | Tentor (termasuk Tentor Pengganti) | 3.4        |
| KR       | Kurir                              | 3.5        |
| TK       | Teknisi                            | 3.6        |

Sekolah Mitra tidak memiliki akun pada sistem. Data dari sekolah, seperti formulir peserta, kesepakatan jadwal, dan perubahan kegiatan sekolah, dicatat oleh Admin. Pemetaan kode fungsi versi sebelumnya yang berbasis modul (ADM, IZN, PAY, AST, RPT, SET) ke kode kebutuhan per peran tercantum pada Lampiran G, sehingga rujukan kode modul pada BAB IV dan lampiran lain tetap dapat ditelusuri.

### Istilah Baku

Istilah berikut dipakai secara konsisten pada seluruh kebutuhan fungsional: Owner (bukan Pimpinan), Admin, Tentor, Tentor Pengganti, Kurir, Teknisi, Pertemuan (satu sesi pembelajaran yang dijadwalkan untuk satu kelompok pada satu tanggal dan jam), Jadwal, Penugasan Sah (tanda bahwa seorang tentor resmi ditugaskan pada satu Pertemuan yang sudah terbit), Kasus Penggantian, dan Periode (satu periode penggajian). Definisi lengkap tercantum pada bagian 1.4.

### KU-01 \| Penentuan Jarak Domisili Tentor ke Sekolah

**SRS — Kebutuhan Fungsional**

Sistem harus menentukan jarak antara domisili tentor dan sekolah mitra dengan satu cara yang sama bagi seluruh kebutuhan yang memakainya, yaitu rekomendasi calon pengganti, peringatan jeda antarsekolah, dan uang transportasi. Data yang dipakai adalah titik lokasi domisili tentor dan titik lokasi sekolah mitra.

**User Story**

**KU-01** Sebagai Owner, saya ingin jarak domisili tentor ke sekolah ditentukan dengan satu cara yang sama agar rekomendasi pengganti dan uang transportasi memakai acuan jarak yang sama.

**Acceptance Criteria**

AC-KU-01.1. Jarak ditentukan dari titik lokasi domisili tentor ke titik lokasi sekolah mitra berdasarkan jarak tempuh jalan.

AC-KU-01.2. Jarak disimpan bersama tanggal penentuannya dan ditampilkan kepada pengguna yang berwenang tanpa menampilkan alamat domisili tentor.

AC-KU-01.3. Bila jarak belum dapat ditentukan, sistem menampilkan keterangan Jarak Belum Tersedia tanpa menghentikan proses lain, dan Admin dapat mengisi jarak secara manual disertai alasan.

AC-KU-01.4. Perubahan lokasi domisili atau lokasi sekolah tidak mengubah jarak yang sudah dipakai pada periode penggajian yang telah ditutup.

### KU-02 \| Pemeriksaan Lokasi Kehadiran dan Serah Terima

**SRS — Kebutuhan Fungsional**

Sistem harus memakai satu aturan pemeriksaan lokasi bagi presensi tentor dan bukti serah terima perangkat oleh Kurir, yaitu memastikan pengguna berada di dalam area sekolah mitra pada saat melakukan tindakan. Data yang dipakai adalah lokasi pengguna pada saat tindakan dilakukan serta titik lokasi dan batas area setiap sekolah.

**User Story**

**KU-02** Sebagai Admin, saya ingin pemeriksaan lokasi pada presensi dan serah terima perangkat memakai aturan yang sama agar hasilnya konsisten dan dapat dipertanggungjawabkan.

**Acceptance Criteria**

AC-KU-02.1. Tindakan dinyatakan sesuai lokasi bila pengguna berada di dalam batas area sekolah yang tercatat pada data sekolah mitra.

AC-KU-02.2. Lokasi dibaca hanya pada saat tindakan dilakukan dan hanya diterima bila ketelitiannya memenuhi batas yang ditetapkan Owner. Sistem tidak melacak lokasi pengguna secara terus-menerus.

AC-KU-02.3. Bila lokasi tidak sesuai, sistem menolak tindakan atau mengarahkannya ke jalur pengecualian pada kebutuhan yang bersangkutan, dan mencatat setiap percobaan beserta waktu dan hasilnya.

AC-KU-02.4. Pengguna wajib mengizinkan akses lokasi. Bila izin ditolak, sistem menampilkan petunjuk untuk mengaktifkannya.

### KU-03 \| Pemberitahuan

**SRS — Kebutuhan Fungsional**

Sistem harus menyampaikan pemberitahuan kepada pengguna atas hal yang memerlukan tindakan atau perhatiannya melalui satu mekanisme pemberitahuan di dalam sistem yang berlaku bagi seluruh peran.

**User Story**

**KU-03** Sebagai pengguna sistem, saya ingin menerima pemberitahuan atas hal yang memerlukan tindakan saya agar tidak ada proses yang tertunda tanpa disadari.

**Acceptance Criteria**

AC-KU-03.1. Pemberitahuan disampaikan di dalam sistem dan memuat jenis kejadian, data terkait, waktu, serta tautan ke halaman tindakan.

AC-KU-03.2. Setiap pemberitahuan memiliki keterangan Belum Dibaca atau Sudah Dibaca.

AC-KU-03.3. Pemberitahuan hanya dikirim kepada pengguna yang berwenang atas data terkait dan tidak memuat data kesehatan atau data pribadi yang tidak diperlukan.

AC-KU-03.4. Kegagalan penyampaian pemberitahuan tidak membatalkan proses yang memicunya.

### KU-04 \| Lampiran dan Berkas Bukti

**SRS — Kebutuhan Fungsional**

Sistem harus memperlakukan seluruh berkas yang diunggah, seperti bukti, lampiran izin, dokumen administrasi, foto, dan slip, dengan aturan yang sama pada seluruh peran.

**User Story**

**KU-04** Sebagai Admin, saya ingin seluruh berkas diunggah dan disimpan dengan aturan yang sama agar pengunggahan konsisten dan berkas hanya dibuka oleh pihak yang berwenang.

**Acceptance Criteria**

AC-KU-04.1. Jenis dan ukuran berkas yang diizinkan mengikuti ketentuan yang ditetapkan pada parameter kebijakan atau pada pengaturan jenis dokumen.

AC-KU-04.2. Berkas hanya dapat dibuka oleh pengguna yang berwenang atas data terkait.

AC-KU-04.3. Berkas yang sudah diunggah tidak ditimpa. Unggahan ulang disimpan sebagai versi baru dan versi lama tetap dapat dibuka pihak yang berwenang.

AC-KU-04.4. Berkas yang berisi data kesehatan, seperti surat keterangan sakit, hanya dapat dilihat Admin dan Owner.

### KU-05 \| Riwayat Perubahan Data

**SRS — Kebutuhan Fungsional**

Sistem harus mencatat riwayat perubahan atas data penting, keputusan, dan status pada seluruh peran, sehingga setiap perubahan dapat ditelusuri.

**User Story**

**KU-05** Sebagai Owner, saya ingin setiap perubahan data penting tercatat lengkap agar dapat ditelusuri bila terjadi perselisihan.

**Acceptance Criteria**

AC-KU-05.1. Setiap perubahan mencatat pengguna, waktu, keadaan sebelum, keadaan sesudah, dan alasan bila kebutuhan yang bersangkutan mewajibkannya.

AC-KU-05.2. Riwayat perubahan tidak dapat diubah atau dihapus oleh pengguna mana pun.

AC-KU-05.3. Admin dan Owner dapat melihat riwayat sesuai kewenangannya.

AC-KU-05.4. Perubahan yang dilakukan otomatis oleh sistem dicatat dengan pelaku Sistem.

### KU-06 \| Mekanisme Verifikasi

**SRS — Kebutuhan Fungsional**

Sistem harus memakai satu mekanisme verifikasi bagi dokumen administrasi tentor dan laporan Pertemuan, yaitu pemeriksaan berdasarkan daftar kriteria yang menghasilkan satu keputusan: Terverifikasi atau Perlu Perbaikan.

**User Story**

**KU-06** Sebagai Admin, saya ingin memverifikasi berdasarkan kriteria yang sama agar keputusan konsisten dan dapat dipertanggungjawabkan.

**Acceptance Criteria**

AC-KU-06.1. Verifikasi dilakukan atas versi terbaru yang sudah dikirim, dan setiap versi hanya memiliki satu keputusan akhir.

AC-KU-06.2. Keputusan Perlu Perbaikan wajib disertai catatan yang dapat dilihat pengirim, dan pengirim memperbaikinya dengan mengirim versi baru.

AC-KU-06.3. Bila dua pemeriksa memutuskan hampir bersamaan, keputusan yang pertama tersimpan yang berlaku dan pemeriksa berikutnya melihat keadaan terkini.

AC-KU-06.4. Keputusan menyimpan pemeriksa, waktu, hasil setiap kriteria, serta versi data dan versi kriteria yang dipakai.

### KU-07 \| Penanda Perlu Ditinjau

**SRS — Kebutuhan Fungsional**

Sistem harus memberi penanda Perlu Ditinjau pada Pertemuan yang sudah terbit apabila data yang menjadi dasarnya berubah, tanpa mengubah jadwal secara otomatis.

**User Story**

**KU-07** Sebagai Admin, saya ingin mengetahui Pertemuan yang terdampak perubahan data agar dapat menyesuaikannya secara sadar.

**Acceptance Criteria**

AC-KU-07.1. Penanda diberikan bila terjadi perubahan masa kerja sama sekolah, data tentor, keanggotaan kelompok, ketersediaan tentor, jam sekolah, hari libur, atau tanggal tidak efektif yang memengaruhi Pertemuan terbit yang laporannya belum dikirim.

AC-KU-07.2. Penanda memuat penyebab, waktu timbul, dan tautan ke data yang berubah, serta tampil pada Daftar Tindak Lanjut Admin.

AC-KU-07.3. Sistem tidak mengubah, membatalkan, atau menjadwalkan ulang Pertemuan secara otomatis. Perubahan dilakukan Admin.

AC-KU-07.4. Penanda selesai ketika penyebabnya diperbaiki atau ketika Admin menandainya selesai dengan catatan.

### KU-08 \| Ekspor Data dan Laporan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan ekspor data dan laporan dengan aturan yang sama bagi seluruh peran yang berwenang mengekspor.

**User Story**

**KU-08** Sebagai pengguna yang berwenang, saya ingin mengekspor laporan dengan aturan yang sama agar hasilnya mudah dibandingkan dan dibagikan.

**Acceptance Criteria**

AC-KU-08.1. Ekspor tersedia dalam bentuk lembar kerja dan dokumen siap cetak, serta memuat judul, penyaring yang dipakai, nama pengekspor, dan waktu ekspor.

AC-KU-08.2. Ekspor hanya memuat data yang berwenang dilihat oleh pengguna dan mengikuti penyaring yang sedang aktif.

AC-KU-08.3. Bila data terlalu banyak, sistem meminta pengguna mempersempit penyaring atau menyiapkan berkas ekspor dan memberi tahu pengguna setelah siap diunduh.

AC-KU-08.4. Setiap ekspor dicatat sesuai KU-05.

### KU-09 \| Hak Akses Berdasarkan Peran

**SRS — Kebutuhan Fungsional**

Sistem harus membatasi akses setiap pengguna sesuai perannya, sebagaimana diuraikan pada bagian 3.2 sampai 3.6 dan dirangkum pada Lampiran A.

**User Story**

**KU-09** Sebagai Owner, saya ingin hak akses dibatasi menurut peran agar setiap pengguna hanya mengakses data yang menjadi kewenangannya.

**Acceptance Criteria**

AC-KU-09.1. Peran pengguna adalah Owner, Admin, Tentor, Kurir, dan Teknisi. Tentor Pengganti adalah Tentor yang ditugaskan menggantikan tentor lain dan memperoleh akses sebatas Pertemuan yang digantikannya.

AC-KU-09.2. Saat ini terdapat satu akun Owner dan satu akun Admin. Tidak ada peran Keuangan tersendiri, sehingga pencatatan pembayaran dilakukan Admin dan persetujuan dilakukan Owner.

AC-KU-09.3. Tentor hanya dapat melihat data miliknya sendiri dan data Pertemuan yang ditugaskan kepadanya. Kurir hanya melihat tugas distribusinya, dan Teknisi hanya melihat data perangkat yang diperlukan untuk perbaikan.

AC-KU-09.4. Percobaan akses yang tidak berwenang ditolak dan dicatat sesuai KU-05.

### KU-10 \| Masa Simpan Data

**SRS — Kebutuhan Fungsional**

Sistem harus menerapkan satu kebijakan masa simpan data bagi seluruh peran sesuai masa simpan yang ditetapkan Owner.

**User Story**

**KU-10** Sebagai Owner, saya ingin kebijakan masa simpan diterapkan seragam agar data tidak disimpan lebih lama atau lebih singkat dari ketentuan.

**Acceptance Criteria**

AC-KU-10.1. Bukti, lampiran, slip, dan riwayat perubahan disimpan sesuai masa simpan yang ditetapkan Owner pada parameter kebijakan.

AC-KU-10.2. Data yang menjadi dasar perhitungan honorarium dan laporan tidak dihapus oleh kebijakan masa simpan.

AC-KU-10.3. Data induk yang sudah dipakai, seperti sekolah, tentor, program, dan perangkat, tidak dapat dihapus dan hanya dapat dinonaktifkan.

AC-KU-10.4. Pembersihan data yang melewati masa simpan dijalankan otomatis dan dicatat sesuai KU-05.

## 3.2 Kebutuhan Fungsional Owner (OW)

Owner adalah pimpinan CV Edukom Jaya Abadi. Kebutuhan fungsional Owner berfokus pada penetapan kebijakan, pengambilan keputusan yang menjadi kewenangan pimpinan, dan pemantauan kegiatan perusahaan. Owner tidak melakukan pencatatan harian yang menjadi tanggung jawab Admin, Tentor, Kurir, dan Teknisi.

### OW-01 \| Penetapan dan Pengelolaan Komponen Honorarium

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk menetapkan dan mengelola komponen honorarium tentor. Komponen yang dikelola adalah uang kehadiran, honor mengajar, uang transportasi, dan uang bonus kelengkapan administrasi, serta komponen lain yang ditambahkan Owner bila ada kebijakan honorarium baru. Setiap komponen memuat nama komponen, dasar perhitungan, besaran, tanggal mulai berlaku, dan status aktif atau nonaktif. Dasar perhitungan yang dapat dipilih adalah per sesi yang sah, per kunjungan sekolah, per sekolah per periode, atau tetap per periode. Komponen yang ditetapkan pada fungsi ini menjadi acuan perhitungan honorarium oleh Admin (AD-23).

**User Story**

**OW-01** Sebagai Owner, saya ingin menetapkan dan mengelola komponen honorarium tentor beserta dasar perhitungannya agar honorarium dihitung sesuai kebijakan yang saya tetapkan dan tidak bergantung pada perhitungan manual.

**Acceptance Criteria**

AC-OW-01.1. Owner dapat melihat daftar komponen honorarium beserta dasar perhitungan, besaran yang berlaku, tanggal mulai berlaku, dan statusnya.

AC-OW-01.2. Owner dapat menambah komponen baru dengan mengisi nama komponen, dasar perhitungan, besaran, dan tanggal mulai berlaku.

AC-OW-01.3. Owner dapat mengubah besaran komponen. Perubahan disimpan sebagai versi baru dengan tanggal mulai berlaku, dan versi sebelumnya tetap tersimpan.

AC-OW-01.4. Uang transportasi ditetapkan berdasarkan tingkatan jarak domisili tentor ke sekolah. Owner menetapkan batas setiap tingkatan jarak dan besarannya.

AC-OW-01.5. Uang bonus diberikan per sekolah yang diampu tentor apabila status kelengkapan administrasi tentor pada sekolah tersebut Lengkap. Owner menetapkan besaran bonus, sedangkan status kelengkapan ditetapkan melalui AD-10.

AC-OW-01.6. Komponen tidak dapat dihapus dan hanya dapat dinonaktifkan. Komponen nonaktif tidak dipakai pada perhitungan setelah tanggal nonaktif, dan riwayatnya tetap tersimpan.

AC-OW-01.7. Perubahan komponen tidak dapat diberlakukan pada periode penggajian yang sudah ditutup, sehingga hasil periode tersebut tidak berubah.

AC-OW-01.8. Hanya Owner yang dapat menambah, mengubah, dan menonaktifkan komponen honorarium. Setiap perubahan tercatat sesuai KU-05.

### OW-02 \| Penetapan Parameter Kebijakan Operasional

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk menetapkan dan mengelola parameter kebijakan yang menjadi aturan operasional seluruh peran. Parameter dikelompokkan menjadi parameter pembelajaran (durasi sesi, tenggat materi rencana, tenggat laporan Pertemuan, dan jeda antarsekolah), parameter presensi (rentang waktu presensi masuk dan pulang, toleransi keterlambatan, ketelitian lokasi, dan batas area awal sekolah baru), parameter izin dan penggantian (batas waktu izin terencana, batas waktu respons calon pengganti, batas waktu keputusan Admin, batas eskalasi, jam layanan Admin, dan ambang frekuensi izin), parameter penggajian (batas waktu pengajuan koreksi presensi dan sanggahan honorarium), parameter operasional (jendela peringatan kesiapan perangkat dan batas ekspor), serta masa simpan data. Daftar parameter tercantum pada Lampiran D.

**User Story**

**OW-02** Sebagai Owner, saya ingin menetapkan dan mengubah parameter kebijakan operasional agar aturan kerja dapat disesuaikan dengan kebijakan perusahaan tanpa mengubah program.

**Acceptance Criteria**

AC-OW-02.1. Owner dapat melihat seluruh parameter beserta nilai yang berlaku dan tanggal mulai berlakunya.

AC-OW-02.2. Owner dapat mengubah nilai parameter. Perubahan disimpan sebagai versi baru dengan tanggal mulai berlaku dan tidak mengubah hasil periode yang sudah ditutup.

AC-OW-02.3. Parameter yang belum diisi Owner ditampilkan Belum Dikonfigurasi pada kebutuhan yang memakainya, tanpa menghentikan proses lain.

AC-OW-02.4. Batas area sekolah ditetapkan per sekolah oleh Admin (AD-01). Nilai yang ditetapkan Owner pada fungsi ini dipakai sebagai nilai awal untuk sekolah baru.

AC-OW-02.5. Hanya Owner yang dapat mengubah parameter. Setiap perubahan tercatat sesuai KU-05.

### OW-03 \| Pengelolaan Daftar Alasan Penolakan Izin

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk menyusun dan mengelola daftar alasan baku yang dipakai Admin ketika menolak pengajuan izin atau menolak calon tentor pengganti. Data yang dikelola adalah nama alasan dan statusnya.

**User Story**

**OW-03** Sebagai Owner, saya ingin menyusun daftar alasan penolakan izin agar setiap penolakan memakai alasan yang baku dan dapat direkap.

**Acceptance Criteria**

AC-OW-03.1. Owner dapat menambah, mengubah nama, dan menonaktifkan alasan penolakan.

AC-OW-03.2. Admin hanya dapat memilih alasan dari daftar ini saat menolak izin atau calon pengganti dan tidak dapat mengubah daftarnya.

AC-OW-03.3. Alasan yang sudah pernah dipakai tidak dapat dihapus dan hanya dapat dinonaktifkan. Alasan nonaktif tidak muncul pada pilihan baru, tetapi tetap tampil pada data lama.

AC-OW-03.4. Setiap perubahan daftar tercatat sesuai KU-05.

### OW-04 \| Pemrosesan Izin Mendesak di Luar Jam Layanan Admin

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk memproses izin mendesak yang masuk di luar jam layanan Admin. Owner meninjau pengajuan dan memutuskan pengesahan pengganti atau penolakan dengan pemeriksaan yang sama seperti pada pengesahan oleh Admin (AD-15).

**User Story**

**OW-04** Sebagai Owner, saya ingin dapat memproses izin mendesak di luar jam layanan Admin agar Pertemuan yang terdampak tetap memperoleh pelaksana.

**Acceptance Criteria**

AC-OW-04.1. Di luar jam layanan Admin yang ditetapkan pada parameter kebijakan, Owner melihat izin mendesak yang belum diputuskan beserta Pertemuan, tentor asal, alasan, bukti, dan calon pengganti yang sudah menerima.

AC-OW-04.2. Owner dapat mengesahkan pengganti atau menolak izin dengan alasan dari daftar baku (OW-03).

AC-OW-04.3. Pengesahan oleh Owner melalui pemeriksaan kelayakan calon yang sama dengan pengesahan oleh Admin.

AC-OW-04.4. Keputusan Owner diberitahukan kepada tentor asal, tentor pengganti, dan Admin, serta tercatat sesuai KU-05.

### OW-05 \| Keputusan atas Pertemuan tanpa Tentor Pengganti

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk memutuskan tindak lanjut atas Kasus Penggantian yang dieskalasi karena tidak memperoleh tentor pengganti sampai batas eskalasi. Pilihan keputusan adalah menetapkan pengganti, menjadwalkan ulang Pertemuan, atau membatalkan Pertemuan.

**User Story**

**OW-05** Sebagai Owner, saya ingin memutuskan tindak lanjut atas Pertemuan yang tidak memperoleh pengganti agar sekolah mitra memperoleh kepastian pelaksanaan.

**Acceptance Criteria**

AC-OW-05.1. Owner melihat daftar kasus berstatus Dieskalasi beserta sekolah, kelompok, tanggal dan jam Pertemuan, tentor asal, penyebab, riwayat permintaan pengganti, dan catatan koordinasi Admin.

AC-OW-05.2. Owner memilih keputusan Tetapkan Pengganti, Jadwalkan Ulang, atau Batalkan, disertai catatan.

AC-OW-05.3. Keputusan diteruskan kepada Admin untuk dicatat pada jadwal dan disampaikan kepada sekolah mitra, dan status kasus berubah sesuai keputusan.

AC-OW-05.4. Pertemuan yang dibatalkan karena tidak ada pengganti tidak dibayarkan kepada pihak mana pun. Pertemuan yang dijadwalkan ulang dibayarkan bila Pertemuan baru terlaksana dan presensinya sah.

AC-OW-05.5. Sistem tidak mengelola penalti atau kewajiban kepada sekolah mitra.

### OW-06 \| Pembukaan Kembali Laporan Pertemuan Terverifikasi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk membuka kembali laporan Pertemuan yang sudah terverifikasi apabila ditemukan kekeliruan, sehingga tentor dapat memperbaikinya.

**User Story**

**OW-06** Sebagai Owner, saya ingin membuka kembali laporan Pertemuan yang sudah terverifikasi dengan alasan yang jelas agar kekeliruan dapat diperbaiki tanpa menghilangkan riwayat.

**Acceptance Criteria**

AC-OW-06.1. Hanya Owner yang dapat membuka kembali laporan berstatus Terverifikasi, dan alasan wajib diisi.

AC-OW-06.2. Pembukaan kembali menghasilkan versi baru berstatus Perlu Perbaikan, sedangkan versi terverifikasi sebelumnya tetap tersimpan sebagai riwayat.

AC-OW-06.3. Tentor pemilik laporan dan Admin menerima pemberitahuan beserta alasan pembukaan kembali.

### OW-07 \| Persetujuan Honorarium Periode

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk meninjau dan memutuskan hasil perhitungan honorarium satu periode yang diajukan Admin. Owner menyetujui atau menolak dan tidak mengubah nilai. Data yang ditinjau adalah ringkasan total honorarium, rincian per tentor dan per komponen, penyesuaian beserta alasannya, peringatan nilai tidak lazim, serta penelusuran sampai ke data presensi.

**User Story**

**OW-07.1** Sebagai Owner, saya ingin meninjau ringkasan dan rincian honorarium beserta peringatannya agar pembayaran hanya dilakukan atas nilai yang sudah saya periksa.

**OW-07.2** Sebagai Owner, saya ingin menyetujui atau menolak honorarium untuk seluruh tentor atau per tentor agar keputusan saya sesuai hasil pemeriksaan.

**Acceptance Criteria**

AC-OW-07.1. Owner menerima pemberitahuan saat Admin mengajukan honorarium periode dan dapat membuka ringkasan, rincian per tentor, penyesuaian, peringatan, serta penelusuran ke presensi.

AC-OW-07.2. Owner dapat menyetujui atau menolak honorarium. Penolakan wajib disertai alasan dan mengembalikan honorarium kepada Admin untuk diperbaiki.

AC-OW-07.3. Owner dapat memutuskan per tentor. Bila hanya sebagian tentor disetujui, tentor lain tetap menunggu keputusan.

AC-OW-07.4. Owner tidak dapat mengubah nilai honorarium. Perubahan nilai dilakukan Admin melalui perhitungan ulang atau penyesuaian.

AC-OW-07.5. Slip honorarium terbit setelah Owner menyetujui.

AC-OW-07.6. Owner dapat membatalkan persetujuan hanya apabila belum ada pembayaran yang tercatat bagi tentor tersebut, dan slip yang sudah terbit ditarik.

AC-OW-07.7. Owner menerima pengingat bila pengajuan belum diputuskan melewati batas waktu yang ditetapkan. Persetujuan tidak dapat didelegasikan kepada pihak lain.

### OW-08 \| Keputusan Penyesuaian Honorarium

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk memutuskan usulan penyesuaian honorarium yang diajukan Admin sebagai hasil penanganan sanggahan honorarium tentor. Data yang ditinjau adalah sanggahan tentor, alasan dan bukti, tanggapan Admin, serta usulan penyesuaian berupa penambahan atau pengurangan honorarium.

**User Story**

**OW-08** Sebagai Owner, saya ingin memutuskan usulan penyesuaian honorarium agar setiap perubahan nilai honorarium terkontrol.

**Acceptance Criteria**

AC-OW-08.1. Owner melihat usulan penyesuaian beserta sanggahan, bukti, tanggapan Admin, tentor, dan periode terkait.

AC-OW-08.2. Owner menyetujui atau menolak usulan dengan alasan.

AC-OW-08.3. Penyesuaian penambahan yang disetujui dibayarkan pada periode berjalan, sedangkan penyesuaian pengurangan diperhitungkan pada periode berikutnya.

AC-OW-08.4. Periode yang sudah disetujui tidak dibuka kembali, dan penyesuaian tampil pada slip periode berjalan.

AC-OW-08.5. Admin dan tentor terkait menerima pemberitahuan atas keputusan Owner.

### OW-09 \| Keputusan Pengadaan Aset

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk meninjau dan memutuskan pengajuan pengadaan perangkat yang diajukan Admin. Pada keputusan setuju, Owner menetapkan spesifikasi perangkat, jumlah yang disetujui, dan perkiraan anggaran. Keputusan Owner menjadi acuan pendataan perangkat baru oleh Admin.

**User Story**

**OW-09** Sebagai Owner, saya ingin memutuskan pengajuan pengadaan perangkat dan menetapkan spesifikasinya agar pembelian aset berada di bawah kendali saya.

**Acceptance Criteria**

AC-OW-09.1. Owner menerima pemberitahuan pengajuan pengadaan dan dapat melihat daftar pengajuan yang menunggu keputusan beserta jenis perangkat, jumlah, alasan, dan lampirannya.

AC-OW-09.2. Owner memutuskan Disetujui atau Ditolak. Penolakan wajib disertai alasan.

AC-OW-09.3. Pada keputusan Disetujui, Owner menetapkan spesifikasi perangkat dan jumlah yang disetujui, serta dapat mencatat perkiraan anggaran.

AC-OW-09.4. Pengajuan yang sudah diputuskan tidak dapat diubah. Pembatalan keputusan hanya dapat dilakukan Owner dengan alasan.

AC-OW-09.5. Owner dapat memantau perkembangan penerimaan perangkat atas pengajuan yang disetujui, yaitu Belum Diterima, Diterima Sebagian, atau Diterima Lengkap.

AC-OW-09.6. Owner menerima pengingat atas pengajuan yang belum diputuskan melewati batas waktu yang ditetapkan.

### OW-10 \| Pemantauan Administrasi Pembelajaran

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan dashboard bagi Owner untuk memantau ringkasan kegiatan pembelajaran, yaitu jumlah sekolah, siswa, kelompok, Pertemuan terjadwal, laporan terkirim, laporan terlaksana dan tidak terlaksana, laporan terverifikasi, pengisian materi rencana, kesiapan perangkat, kelengkapan dokumen administrasi tentor, dan ketepatan rekomendasi calon pengganti. Dashboard dapat disaring berdasarkan periode, sekolah, program, kelompok, dan tentor.

**User Story**

**OW-10** Sebagai Owner, saya ingin melihat ringkasan pelaksanaan dan administrasi pembelajaran dalam satu dashboard agar saya mengetahui pekerjaan yang memerlukan tindak lanjut.

**Acceptance Criteria**

AC-OW-10.1. Seluruh angka mengikuti penyaring yang dipilih, dan dashboard menampilkan waktu pengambilan data.

AC-OW-10.2. Jumlah Pertemuan dan jumlah laporan ditampilkan terpisah, karena Pertemuan yang diajar dua tentor memiliki dua laporan. Pertemuan yang dibatalkan tidak dihitung, dan Pertemuan yang dijadwalkan ulang dihitung satu kali.

AC-OW-10.3. Jumlah siswa dihitung per siswa, sehingga siswa yang tercatat pada lebih dari satu kelompok tidak dihitung ganda.

AC-OW-10.4. Owner dapat melihat status kelengkapan administrasi tentor per sekolah dan daftar dokumen yang belum terverifikasi.

AC-OW-10.5. Owner dapat melihat butir Daftar Tindak Lanjut yang berstatus Dieskalasi.

AC-OW-10.6. Owner hanya dapat melihat dan tidak dapat mengubah data melalui dashboard.

### OW-11 \| Pemantauan Aset dan Perangkat

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan dashboard bagi Owner untuk memantau jumlah, kondisi, dan persebaran perangkat, laporan kendala dan perbaikan yang belum selesai, ringkasan pengadaan, serta riwayat pergerakan setiap unit. Data diperbarui otomatis dari kegiatan Admin, Kurir, Tentor, dan Teknisi tanpa input ulang.

**User Story**

**OW-11** Sebagai Owner, saya ingin melihat rekap kondisi dan persebaran perangkat agar saya dapat mengevaluasi kesehatan inventaris secara cepat.

**Acceptance Criteria**

AC-OW-11.1. Dashboard menampilkan jumlah perangkat per status (Tersedia, Terdistribusi, Rusak, Perbaikan, Hilang, Nonaktif), per jenis perangkat, dan per lokasi (kantor dan setiap sekolah mitra).

AC-OW-11.2. Dashboard menampilkan jumlah laporan kendala dan tiket perbaikan yang belum selesai, serta riwayat perbaikan dan biaya perbaikan per unit.

AC-OW-11.3. Dashboard menampilkan ringkasan pengadaan, yaitu pengajuan yang menunggu keputusan, pengajuan disetujui yang belum diterima lengkap, dan total perkiraan anggaran.

AC-OW-11.4. Owner dapat menelusuri riwayat pergerakan setiap unit, yaitu pengantaran, penjemputan, Kurir, sekolah, waktu, hasil pemeriksaan lokasi, laporan kendala, dan riwayat perbaikan.

AC-OW-11.5. Owner dapat membuka profil singkat unit dengan memindai label QR perangkat.

AC-OW-11.6. Owner hanya dapat melihat dan mengekspor data sesuai KU-08, tanpa mengubah data aset.

### OW-12 \| Pemantauan Rekap Izin dan Penggantian

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan rekap izin dan penggantian seluruh tentor bagi Owner, yaitu jumlah izin, jumlah sesi yang digantikan, dan jumlah sesi yang menggantikan, serta penanda tentor yang melampaui ambang frekuensi izin yang ditetapkan Owner.

**User Story**

**OW-12** Sebagai Owner, saya ingin melihat rekap izin dan penggantian seluruh tentor agar saya dapat memantau frekuensi izin.

**Acceptance Criteria**

AC-OW-12.1. Owner melihat rekap per tentor dengan penyaring periode, tentor, dan status.

AC-OW-12.2. Tentor yang melampaui ambang frekuensi izin diberi penanda. Penanda tidak menimbulkan sanksi.

AC-OW-12.3. Rekap dapat diekspor sesuai KU-08.

### OW-13 \| Pemantauan Honorarium dan Pembayaran

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Owner untuk memantau hasil perhitungan honorarium dan status pembayarannya per tentor dan per periode, tanpa melakukan pencatatan pembayaran.

**User Story**

**OW-13** Sebagai Owner, saya ingin melihat status pembayaran honorarium yang sudah saya setujui agar saya mengetahui honorarium yang sudah dan belum dibayarkan.

**Acceptance Criteria**

AC-OW-13.1. Owner melihat honorarium per tentor dan per periode beserta status pembayaran Belum Dibayar, Dibayar Sebagian, Dibayar, atau Tertunda.

AC-OW-13.2. Owner dapat membuka rincian pembayaran, yaitu tanggal, nominal, cara pembayaran, dan bukti pembayaran.

AC-OW-13.3. Owner hanya dapat melihat dan tidak dapat mencatat atau mengubah pembayaran.

## 3.3 Kebutuhan Fungsional Admin (AD)

Admin adalah pusat pengelolaan administrasi dan koordinasi operasional. Kebutuhan fungsional Admin mencakup pengelolaan data induk, penjadwalan, pemeriksaan administrasi pembelajaran, penanganan izin dan penggantian, pengolahan presensi dan honorarium sampai pencatatan pembayaran, serta pengelolaan perangkat dan distribusinya. Keputusan yang menjadi kewenangan Owner, seperti persetujuan honorarium dan pengadaan aset, tidak dapat diambil Admin.

### AD-01 \| Pengelolaan Data Sekolah Mitra dan Kerja Sama

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mengelola profil sekolah mitra dan catatan kerja sama setiap periode. Profil sekolah memuat nama sekolah, NPSN, alamat, kabupaten atau kota, kontak sekolah, titik lokasi sekolah, batas area sekolah untuk pemeriksaan lokasi, sumber perangkat pembelajaran (laptop Edukom atau komputer milik sekolah), dan penanda apakah sekolah masih mewajibkan lembar presensi fisik. Catatan kerja sama memuat tahun ajaran, cakupan semester, tanggal mulai, tanggal akhir, penanggung jawab dari sekolah, status, dan berkas MoU. Satu sekolah memiliki satu profil dan dapat memiliki banyak catatan kerja sama.

**User Story**

**AD-01** Sebagai Admin, saya ingin mengelola profil sekolah mitra dan catatan kerja sama per periode agar pendataan peserta, penjadwalan, presensi, dan pengantaran perangkat memakai data sekolah yang sama tanpa menimpa riwayat kerja sama sebelumnya.

**Acceptance Criteria**

AC-AD-01.1. Admin wajib mencari sekolah terlebih dahulu sebelum membuat profil baru, dan sistem menampilkan sekolah yang berpotensi sama berdasarkan nama, NPSN, dan wilayah.

AC-AD-01.2. Bila NPSN sudah terdaftar, sistem menolak profil baru. Bila ditemukan sekolah yang mirip, Admin memilih memakai profil lama atau tetap membuat profil baru disertai alasan.

AC-AD-01.3. Admin menetapkan titik lokasi dan batas area sekolah. Perubahan keduanya tercatat dan langsung menjadi acuan presensi tentor dan serah terima perangkat.

AC-AD-01.4. Sekolah yang memakai komputer milik sekolah tidak dihitung dalam kebutuhan laptop dan tidak menghasilkan permintaan pengantaran perangkat.

AC-AD-01.5. Admin dapat menambah catatan kerja sama baru untuk periode berikutnya tanpa mengubah catatan lama. Tanggal kerja sama tidak boleh beririsan untuk sekolah yang sama.

AC-AD-01.6. Status kerja sama (Direncanakan, Aktif, Berakhir) ditentukan dari tanggal kerja sama. Admin dapat membatalkan kerja sama dengan alasan.

AC-AD-01.7. Pembaruan MoU disimpan sebagai versi baru dan versi lama tetap dapat dibuka.

AC-AD-01.8. Bila masa kerja sama diperpendek atau dibatalkan, Pertemuan terbit di luar masa kerja sama diberi penanda Perlu Ditinjau sesuai KU-07.

AC-AD-01.9. Sekolah yang sudah memiliki peserta, jadwal, atau MoU tidak dapat dihapus dan hanya dapat dinonaktifkan. Sebelum menonaktifkan, Admin melihat daftar Pertemuan sekolah tersebut yang belum berlangsung.

### AD-02 \| Pengelolaan Formulir, Kelas, dan Peserta

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mencatat formulir peserta dari sekolah, menyiapkan kelas, dan mendaftarkan siswa per sekolah dan tahun ajaran. Formulir memuat sekolah, tahun ajaran, tanggal penerimaan, daftar kelas yang ikut, dan berkas formulir. Kelas memuat nama kelas dan tingkat. Data siswa yang diinputkan adalah nama siswa, kelas, NIS, dan NISN, beserta tanggal mulai ikut. Siswa dapat didaftarkan satu per satu atau melalui unggahan berkas dengan templat resmi. Admin juga mencatat perpindahan kelas, siswa keluar, dan siswa yang kembali ikut berdasarkan konfirmasi sekolah.

**User Story**

**AD-02** Sebagai Admin, saya ingin mencatat formulir sekolah, mengelola kelas, dan mendaftarkan serta memperbarui data siswa agar daftar peserta setiap semester akurat dan riwayat pembelajaran siswa dapat ditelusuri.

**Acceptance Criteria**

AC-AD-02.1. Formulir wajib memuat sekolah, tahun ajaran, tanggal penerimaan, daftar kelas yang ikut, dan berkas atau referensi formulir. Perubahan kelas yang ikut dicatat sebagai formulir perbaikan tanpa menghapus formulir lama.

AC-AD-02.2. Nama siswa dan kelas wajib diisi, sedangkan NIS dan NISN bersifat opsional.

AC-AD-02.3. Saat mendaftarkan siswa, sistem mencocokkan data dengan siswa yang sudah tersimpan dan menandai data yang berpotensi ganda atau bertentangan untuk diputuskan Admin. Pendaftaran berulang tidak menghasilkan siswa ganda.

AC-AD-02.4. Pada unggahan berkas, baris yang benar tersimpan, sedangkan baris bermasalah ditampilkan beserta nomor baris dan alasannya untuk diperbaiki tanpa mengulang baris yang sudah benar.

AC-AD-02.5. Siswa tercatat untuk satu tahun ajaran sehingga tidak perlu didaftarkan ulang pada semester kedua.

AC-AD-02.6. Perpindahan kelas, siswa keluar, dan siswa yang kembali ikut wajib memuat tanggal berlaku dan sumber konfirmasi sekolah, serta tidak menghapus catatan pembelajaran sebelumnya.

AC-AD-02.7. Siswa hanya muncul pada daftar hadir, penilaian, dan rekap untuk tanggal saat ia aktif mengikuti pembelajaran.

AC-AD-02.8. Perubahan keikutsertaan siswa memberi penanda Perlu Ditinjau pada kelompok dan Pertemuan terdampak sesuai KU-07.

### AD-03 \| Pengelolaan Program Pembelajaran

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mengelola katalog program dan menetapkan program pada sekolah dan semester tertentu. Katalog program memuat kode program, nama program, tingkat kelas sasaran, dan target jumlah Pertemuan per semester. Penetapan program memuat sekolah, tahun ajaran, semester, program yang dipilih dari katalog, kelas atau kelompok yang tercakup, dan hasil koordinasi dengan sekolah.

**User Story**

**AD-03** Sebagai Admin, saya ingin memilih program dari katalog, menetapkannya pada kelas atau kelompok, dan memantau pencapaian target Pertemuan agar seluruh peserta memakai satu acuan pembelajaran.

**Acceptance Criteria**

AC-AD-03.1. Kode program wajib unik. Program yang sudah dipakai tidak dapat dihapus dan hanya dapat dinonaktifkan.

AC-AD-03.2. Program dipilih dari katalog dan tidak diketik ulang. Sistem menolak kelas atau kelompok yang berasal dari sekolah atau tahun ajaran lain, atau yang tingkatnya di luar sasaran program.

AC-AD-03.3. Penetapan program yang belum mencakup kelas atau kelompok berstatus Belum Lengkap dan belum dapat dipakai pada penyusunan jadwal.

AC-AD-03.4. Satu penetapan program dipakai bersama oleh seluruh peserta yang tercakup tanpa input per siswa.

AC-AD-03.5. Admin melihat perbandingan target Pertemuan, Pertemuan terjadwal, dan Pertemuan terlaksana, serta peringatan bila target diperkirakan tidak tercapai.

AC-AD-03.6. Admin dapat membuka lampiran kurikulum sekolah yang diunggah tentor pada penetapan program.

### AD-04 \| Pembagian Kelompok dan Perencanaan Sesi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk membagi siswa ke dalam kelompok belajar dan menyusun rencana jumlah sesi serta hari pelaksanaan di satu sekolah. Data yang diinputkan adalah jumlah laptop per kelompok, jumlah siswa per laptop, batas peserta per kelompok, jumlah tentor yang tersedia, jumlah tentor per sesi, dan jam sekolah. Sistem mengusulkan jumlah kelompok, pembagian anggota, jumlah sesi, dan jumlah hari pelaksanaan berdasarkan data tersebut. Rencana sesi menjadi bahan Admin saat menyepakati hari dan jam dengan sekolah.

**User Story**

**AD-04** Sebagai Admin, saya ingin membagi siswa ke dalam kelompok dan memperoleh usulan jumlah sesi serta hari pelaksanaan agar kesepakatan jadwal dengan sekolah memiliki dasar yang jelas.

**Acceptance Criteria**

AC-AD-04.1. Admin mengisi data dasar pembagian kelompok, dan sistem menampilkan usulan jumlah kelompok serta pembagian anggota yang merata.

AC-AD-04.2. Admin dapat menyesuaikan anggota setiap kelompok. Sistem menampilkan siswa yang belum ditempatkan, siswa yang tercatat pada lebih dari satu kelompok, dan kelompok yang melebihi kapasitas.

AC-AD-04.3. Pembagian dapat disimpan sebagai Draf. Pembagian hanya dapat ditetapkan Final bila setiap siswa ditempatkan tepat satu kali dan tidak ada kelompok yang melebihi kapasitas. Kelompok Draf belum dapat dijadwalkan.

AC-AD-04.4. Perubahan anggota kelompok memiliki tanggal berlaku, tidak mengubah laporan yang sudah dikirim, dan memberi penanda Perlu Ditinjau pada Pertemuan terdampak sesuai KU-07.

AC-AD-04.5. Sistem menampilkan usulan jumlah sesi dan hari pelaksanaan per pekan beserta sumber daya yang kurang bila rencana tidak dapat disusun.

AC-AD-04.6. Rencana sesi tidak membentuk jadwal dan ditampilkan kembali saat Admin menyusun jadwal sekolah tersebut.

### AD-05 \| Pengelolaan Data dan Status Keaktifan Tentor

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk membuat, mencari, dan memperbarui profil tentor serta mengelola status keaktifannya. Profil tentor memuat kode tentor, nama, kontak, alamat domisili, titik lokasi domisili, dan rekening bank. Status keaktifan bernilai Aktif atau Nonaktif dengan tanggal berlaku dan alasan. Penyimpanan tentor baru sekaligus membuat akun Tentor.

**User Story**

**AD-05** Sebagai Admin, saya ingin mengelola profil, domisili, dan status keaktifan tentor agar penugasan, uang transportasi, dan kebutuhan pengganti ditentukan dari data yang sama.

**Acceptance Criteria**

AC-AD-05.1. Profil tentor wajib memuat kode tentor yang unik, nama, kontak, alamat domisili, dan titik lokasi domisili. Admin dapat mencari tentor berdasarkan nama, kode, atau kontak.

AC-AD-05.2. Penyimpanan tentor baru membuat satu akun Tentor dan mengirim undangan aktivasi. Penyimpanan berulang tidak membuat akun ganda.

AC-AD-05.3. Alamat dan titik lokasi domisili hanya dapat dilihat dan diubah Admin. Pengguna lain hanya melihat jarak.

AC-AD-05.4. Perubahan status wajib memuat status, tanggal berlaku, dan alasan (Keluar, Cuti, atau Lainnya). Status Cuti wajib disertai tanggal kembali, dan tentor otomatis kembali Aktif pada tanggal tersebut.

AC-AD-05.5. Tentor Nonaktif tidak dapat ditugaskan pada Pertemuan baru atau disahkan sebagai pengganti selama masa nonaktif.

AC-AD-05.6. Saat tentor dinonaktifkan, sistem membentuk Kasus Penggantian untuk setiap Pertemuan terbit milik tentor tersebut dalam masa nonaktif, untuk ditangani pada AD-16.

AC-AD-05.7. Tentor Nonaktif tetap dapat masuk ke sistem dalam batas waktu tertentu hanya untuk menyelesaikan laporan Pertemuan sebelum masa nonaktif.

AC-AD-05.8. Data rekening bank (nama bank, nomor rekening, dan nama pemilik) hanya dapat dilihat dan diubah Admin dan Owner.

### AD-06 \| Pencatatan Kesepakatan Jadwal, Jam Sekolah, dan Tanggal Tidak Efektif

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mencatat kesepakatan jadwal dengan sekolah, jam sekolah, libur nasional, dan tanggal tidak efektif setiap sekolah. Kesepakatan jadwal memuat sekolah, semester, tanggal kesepakatan, perwakilan sekolah, perwakilan Edukom, hari, jam mulai, dan kelas yang dijadwalkan. Tanggal tidak efektif memuat tanggal, keterangan, sumber informasi, cakupan (seluruh sekolah, tingkat, atau kelas tertentu), dan waktu (sepanjang hari atau jam tertentu).

**User Story**

**AD-06** Sebagai Admin, saya ingin mencatat kesepakatan hari dan jam dengan sekolah, jam sekolah, libur nasional, dan tanggal tidak efektif agar penyusunan jadwal memakai dasar yang tercatat.

**Acceptance Criteria**

AC-AD-06.1. Kesepakatan jadwal wajib memuat data di atas, dan kelas yang dijadwalkan harus termasuk kelas yang ikut pada formulir sekolah.

AC-AD-06.2. Perubahan hari atau jam dicatat sebagai kesepakatan baru yang merujuk kesepakatan lama.

AC-AD-06.3. Admin mencatat rentang jam sekolah per hari dan daftar libur nasional per tahun yang otomatis berlaku untuk seluruh sekolah.

AC-AD-06.4. Penambahan atau perubahan libur dan tanggal tidak efektif setelah jadwal terbit memberi penanda Perlu Ditinjau pada Pertemuan terdampak sesuai KU-07, tanpa mengubah jadwal secara otomatis.

### AD-07 \| Penyusunan dan Penerbitan Jadwal

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk menyusun, memeriksa, dan menerbitkan jadwal Pertemuan. Data yang dipilih atau diinputkan adalah sekolah, semester, penetapan program, kelompok, satu atau dua tentor, tanggal atau pola jadwal mingguan, dan jam mulai. Jam selesai mengikuti durasi sesi yang ditetapkan Owner. Saat menyusun, Admin melihat ketersediaan waktu tentor dan rencana sesi sekolah. Jadwal yang terbit menjadi acuan bagi tentor, presensi, honorarium, dan pengantaran perangkat.

**User Story**

**AD-07** Sebagai Admin, saya ingin menyusun jadwal berdasarkan kesepakatan dengan sekolah, memeriksanya, lalu menerbitkannya agar tentor, Kurir, dan presensi hanya menerima jadwal resmi yang sudah lolos pemeriksaan.

**Acceptance Criteria**

AC-AD-07.1. Jadwal dapat disimpan sebagai Draf walaupun pemeriksaan belum terpenuhi. Pola jadwal menghasilkan satu Pertemuan untuk setiap tanggal dan melewati libur serta tanggal tidak efektif, dengan tanggal yang dilewati ditampilkan kepada Admin.

AC-AD-07.2. Setiap Pertemuan wajib memiliki satu atau dua tentor yang berbeda.

AC-AD-07.3. Admin melihat ketersediaan waktu setiap tentor (Tersedia, Tidak Tersedia, atau Belum Mengisi) bersama jadwal yang sudah ada.

AC-AD-07.4. Sebelum terbit, sistem memeriksa dan menampilkan Pertemuan yang tidak memenuhi syarat beserta alasannya, yaitu: kelompok atau program tidak sesuai sekolah dan semester, kesepakatan jadwal belum dicatat, tanggal di luar masa kerja sama, waktu sudah lewat, tentor nonaktif, bentrok jadwal tentor atau kelompok, jeda antarsekolah tidak terpenuhi, di luar jam sekolah atau pada tanggal tidak efektif, tentor tidak tersedia, dan kebutuhan laptop melebihi laptop yang layak pakai.

AC-AD-07.5. Tentor yang belum mengisi ketersediaan hanya dapat dijadwalkan bila Admin mencatat dasar koordinasi dengan tentor tersebut.

AC-AD-07.6. Penerbitan berlaku untuk seluruh Pertemuan dalam satu draf. Bila satu Pertemuan tidak memenuhi syarat, seluruh draf tetap Draf.

AC-AD-07.7. Penerbitan yang berhasil membentuk Penugasan Sah dan laporan kosong untuk setiap tentor, menampilkan Pertemuan pada dashboard tentor, serta meneruskan jadwal untuk presensi, honorarium, dan kebutuhan pengantaran perangkat.

AC-AD-07.8. Bila data jam sekolah atau jumlah laptop belum tersedia, pemeriksaan terkait ditandai Belum Diperiksa, tidak menghalangi penerbitan, dan muncul pada Daftar Tindak Lanjut.

### AD-08 \| Penjadwalan Ulang dan Pembatalan Pertemuan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk menjadwalkan ulang atau membatalkan Pertemuan yang sudah terbit. Data yang diinputkan adalah tanggal dan jam pengganti (untuk penjadwalan ulang), kategori alasan (Dibatalkan Sekolah, Libur, Dibatalkan Edukom, atau Dijadwalkan Ulang), uraian alasan, dan hasil koordinasi dengan sekolah. Kategori alasan menentukan perlakuan presensi dan honorarium.

**User Story**

**AD-08** Sebagai Admin, saya ingin menjadwalkan ulang atau membatalkan Pertemuan dengan alasan yang tercatat agar tentor, Kurir, presensi, dan honorarium mengikuti perubahan tersebut.

**Acceptance Criteria**

AC-AD-08.1. Penjadwalan ulang hanya memengaruhi Pertemuan yang dipilih, wajib lolos pemeriksaan yang sama dengan penerbitan, dan mempertahankan riwayat waktu sebelumnya.

AC-AD-08.2. Pembatalan hanya dapat dilakukan pada Pertemuan yang laporannya belum dikirim, dengan alasan wajib. Pertemuan yang dibatalkan tidak dapat diterbitkan kembali atau dilaporkan.

AC-AD-08.3. Pembatalan menutup Kasus Penggantian yang masih terbuka pada Pertemuan tersebut.

AC-AD-08.4. Admin dapat menandai Pertemuan sebagai Dibatalkan Sekolah walaupun tentor sudah melakukan presensi, tanpa menghapus catatan presensi.

AC-AD-08.5. Tentor, Kurir terkait, dan pihak yang mengolah presensi dan honorarium menerima pemberitahuan atas perubahan tersebut.

### AD-09 \| Pemantauan Kesiapan Operasional

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memantau kesiapan perangkat setiap Pertemuan dan mencatat kendala nonperangkat beserta penanganannya. Data yang dipantau adalah kebutuhan laptop setiap Pertemuan, unit yang dialokasikan, dan unit yang sudah terdistribusi. Data kendala nonperangkat memuat Pertemuan terdampak, kategori kendala (sekolah tutup, listrik atau jaringan, atau lainnya), uraian, pihak terkait, tindakan, dan status penanganan.

**User Story**

**AD-09** Sebagai Admin, saya ingin memantau kesiapan perangkat dan mencatat penanganan kendala pada Pertemuan terdampak agar Pertemuan yang belum siap ditangani sebelum hari pelaksanaan.

**Acceptance Criteria**

AC-AD-09.1. Setiap Pertemuan menampilkan status kesiapan Belum Siap, Sebagian Siap, Siap, atau Tidak Diketahui berdasarkan data pengantaran perangkat. Pertemuan di sekolah yang memakai komputer sendiri ditampilkan sebagai Perangkat Sekolah.

AC-AD-09.2. Pertemuan yang belum Siap dalam jendela peringatan yang ditetapkan Owner muncul pada Daftar Tindak Lanjut.

AC-AD-09.3. Admin dapat mencatat koreksi status kesiapan dengan alasan. Koreksi ditampilkan berdampingan dengan status otomatis dan tidak menimpanya.

AC-AD-09.4. Admin mencatat kendala nonperangkat dan perkembangannya dengan status Terbuka, Ditangani, atau Selesai. Status Selesai wajib disertai tindakan akhir.

AC-AD-09.5. Penyesuaian jadwal akibat kendala dilakukan melalui AD-08.

### AD-10 \| Pengaturan Kewajiban Dokumen dan Status Kelengkapan Administrasi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mengatur jenis dokumen administrasi yang wajib diunggah tentor, yaitu Kalender Akademik, PROTA, Alokasi Waktu, PROSEM, Silabus, dan Modul Pembelajaran. Untuk setiap jenis dokumen, Admin mengatur periode (tahunan atau semesteran), cakupan, tenggat, daftar kriteria pemeriksaan, jenis berkas yang diterima, dan penanda apakah dokumen menjadi syarat bonus. Kewajiban dokumen setiap tentor terbentuk otomatis dari penugasannya. Admin juga menetapkan dan mengoreksi status kelengkapan administrasi tentor per sekolah dan per periode, yang menjadi dasar uang bonus.

**User Story**

**AD-10.1** Sebagai Admin, saya ingin mengatur kewajiban setiap jenis dokumen sesuai periode dan cakupannya agar daftar dokumen yang harus diunggah setiap tentor sesuai dengan penugasannya.

**AD-10.2** Sebagai Admin, saya ingin status kelengkapan administrasi tentor per sekolah ditetapkan dari dokumen yang sudah terverifikasi dan dapat saya koreksi dengan alasan agar bonus diberikan dengan benar.

**Acceptance Criteria**

AC-AD-10.1. Setiap kewajiban memuat jenis dokumen, tentor, periode, cakupan sekolah atau program, tenggat, dan status Aktif atau Dibatalkan.

AC-AD-10.2. Kewajiban terbentuk otomatis saat tentor pertama kali memperoleh penugasan pada cakupan tersebut. Pembentukan berulang tidak menggandakan kewajiban.

AC-AD-10.3. Bila Pertemuan diajar dua tentor, setiap tentor memiliki kewajibannya sendiri. Tentor pengganti sementara tidak memperoleh kewajiban, sedangkan tentor pengganti tetap memperoleh kewajiban untuk cakupan yang diambil alih.

AC-AD-10.4. Perubahan pengaturan jenis dokumen hanya berlaku untuk kewajiban baru, kecuali Admin secara sengaja menerapkannya pada kewajiban yang sudah ada.

AC-AD-10.5. Kewajiban yang sudah memiliki unggahan tidak dapat dihapus dan hanya dapat dibatalkan dengan alasan.

AC-AD-10.6. Status kelengkapan administrasi bernilai Lengkap bila seluruh dokumen syarat bonus pada sekolah dan periode tersebut sudah terverifikasi, dan Belum Lengkap bila tidak.

AC-AD-10.7. Admin dapat mengoreksi status kelengkapan dengan alasan. Koreksi setelah periode ditutup diperhitungkan sebagai penyesuaian pada periode berjalan.

### AD-11 \| Verifikasi Dokumen Administrasi Tentor

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memeriksa dokumen administrasi yang diunggah tentor berdasarkan daftar kriteria jenis dokumen, lalu menetapkan Terverifikasi atau Perlu Perbaikan dengan catatan. Mekanisme verifikasi mengikuti KU-06.

**User Story**

**AD-11** Sebagai Admin, saya ingin memeriksa kelengkapan dan isi dokumen tentor berdasarkan daftar kriteria agar setiap persetujuan atau permintaan perbaikan memiliki dasar yang jelas.

**Acceptance Criteria**

AC-AD-11.1. Admin melihat daftar dokumen yang menunggu pemeriksaan beserta tentor, jenis dokumen, periode, cakupan, dan waktu unggah.

AC-AD-11.2. Admin memberi hasil Terpenuhi atau Tidak Terpenuhi pada setiap kriteria. Dokumen hanya dapat ditetapkan Terverifikasi bila seluruh kriteria terpenuhi.

AC-AD-11.3. Keputusan Perlu Perbaikan wajib disertai catatan yang dapat dilihat tentor.

AC-AD-11.4. Hanya versi terbaru yang dapat diperiksa, dan keputusan atas satu versi tidak berlaku bagi versi lain.

AC-AD-11.5. Setelah Kalender Akademik suatu sekolah terverifikasi, sistem mengingatkan Admin untuk mencatat tanggal tidak efektif sekolah tersebut.

### AD-12 \| Pengelolaan Kegiatan Penilaian

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk menetapkan kegiatan penilaian, yaitu kegiatan pembelajaran yang dinilai atau menghasilkan portofolio. Data kegiatan penilaian memuat nama kegiatan, penetapan program, jenis penilaian (nilai, portofolio, atau keduanya), Pertemuan atau rentang tanggal pelaksanaan, penanda wajib atau opsional, dan status. Kegiatan penilaian menjadi acuan tentor dalam mencatat nilai dan portofolio siswa.

**User Story**

**AD-12** Sebagai Admin, saya ingin menetapkan kegiatan penilaian beserta jenis dan sasarannya agar tentor mencatat nilai dan portofolio berdasarkan acuan yang sama.

**Acceptance Criteria**

AC-AD-12.1. Kegiatan penilaian hanya dapat dikaitkan dengan penetapan program yang siap dipakai dan Pertemuan yang termasuk dalam program tersebut.

AC-AD-12.2. Siswa sasaran adalah anggota kelompok yang aktif pada tanggal Pertemuan.

AC-AD-12.3. Kegiatan berpenanda wajib mengharuskan tentor mengisi nilai atau portofolio sebelum laporan Pertemuan dikirim.

AC-AD-12.4. Kegiatan yang sudah memiliki catatan nilai atau portofolio tidak dapat dihapus dan hanya dapat dinonaktifkan.

AC-AD-12.5. Perubahan kegiatan penilaian tercatat dan memberi penanda Perlu Ditinjau pada Pertemuan terdampak sesuai KU-07.

### AD-13 \| Verifikasi Laporan Pertemuan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memeriksa laporan Pertemuan yang dikirim tentor berdasarkan kriteria verifikasi laporan, lalu menetapkan Terverifikasi atau Perlu Perbaikan. Data yang diperiksa adalah jadwal, tentor pemilik laporan, hasil pelaksanaan, absensi siswa, materi yang disampaikan, jurnal kegiatan, nilai atau portofolio bila diwajibkan, serta keterangan presensi tentor. Admin juga mencatat laporan yang tidak dikirim tentor sampai melewati tenggat.

**User Story**

**AD-13.1** Sebagai Admin, saya ingin memeriksa laporan Pertemuan setiap tentor agar laporan yang sesuai disahkan dan kekurangan dikembalikan kepada tentor untuk diperbaiki.

**AD-13.2** Sebagai Admin, saya ingin mencatat laporan yang tidak dikirim tentor sebagai tidak terlaksana dengan alasan agar setiap Pertemuan memiliki kejelasan hasil.

**Acceptance Criteria**

AC-AD-13.1. Admin melihat isi laporan sesuai keadaan saat laporan dikirim. Bila data saat ini berbeda, perbedaannya ditampilkan sebagai informasi tanpa mengubah isi laporan.

AC-AD-13.2. Bila Pertemuan diajar dua tentor, Admin memeriksa laporan setiap tentor secara terpisah.

AC-AD-13.3. Admin memberi hasil Terpenuhi atau Tidak Terpenuhi pada setiap kriteria. Keputusan Perlu Perbaikan wajib disertai catatan untuk tentor.

AC-AD-13.4. Laporan yang sudah terverifikasi tidak dapat diubah Admin. Pembukaan kembali hanya dapat dilakukan Owner (OW-06).

AC-AD-13.5. Untuk laporan yang belum dikirim setelah tenggat, Admin dapat mencatatnya sebagai Tidak Terlaksana dengan kategori dan alasan, misalnya tentor tidak hadir.

AC-AD-13.6. Verifikasi laporan tidak mengesahkan presensi atau honorarium.

### AD-14 \| Daftar Tindak Lanjut

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan Daftar Tindak Lanjut bagi Admin, yaitu satu daftar yang menghimpun seluruh penanda dan peringatan yang memerlukan perhatian Admin, seperti Pertemuan Perlu Ditinjau, pemeriksaan Belum Diperiksa, materi rencana belum terisi, target Pertemuan belum terpenuhi, siswa belum ditempatkan, pengingat tanggal tidak efektif, perangkat belum siap, dan Kasus Penggantian yang perlu ditangani.

**User Story**

**AD-14** Sebagai Admin, saya ingin melihat seluruh hal yang perlu ditindaklanjuti dalam satu daftar yang terurut menurut prioritas agar tidak ada Pertemuan, kasus, atau dokumen yang terlewat.

**Acceptance Criteria**

AC-AD-14.1. Setiap butir memuat jenis butir, data terkait, alasan, waktu timbul, dan tautan ke data asal.

AC-AD-14.2. Butir yang mendesak tampil paling atas, kemudian diurutkan menurut tanggal Pertemuan terdekat.

AC-AD-14.3. Admin dapat menyaring butir menurut jenis, sekolah, tanggal, dan status Terbuka atau Selesai.

AC-AD-14.4. Admin dapat menandai butir selesai dengan catatan. Butir juga selesai otomatis ketika penyebabnya diperbaiki, dan butir yang selesai tetap tersimpan sebagai riwayat.

AC-AD-14.5. Daftar tidak mengubah jadwal atau data asal secara otomatis.

### AD-15 \| Peninjauan Izin dan Pengesahan Tentor Pengganti

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk meninjau pengajuan izin tentor dan mengesahkan tentor pengganti pada setiap Kasus Penggantian, baik yang berasal dari izin maupun dari tentor nonaktif. Fungsi ini adalah satu-satunya tempat pengesahan perubahan pelaksana Pertemuan. Data yang ditinjau adalah Pertemuan, tentor asal, penyebab, alasan dan bukti izin, calon pengganti beserta peringkat rekomendasinya, dan status kasus.

**User Story**

**AD-15.1** Sebagai Admin, saya ingin memeriksa dan mengesahkan pengganti untuk satu atau banyak kasus sekaligus agar setiap Pertemuan kembali memiliki pelaksana yang sah.

**AD-15.2** Sebagai Admin, saya ingin dapat menetapkan pengganti secara langsung bila diperlukan agar Pertemuan tidak kosong.

**Acceptance Criteria**

AC-AD-15.1. Admin melihat antrean kasus dengan izin mendesak dan Pertemuan yang paling dekat waktunya di urutan teratas.

AC-AD-15.2. Admin dapat menolak izin atau menolak calon pengganti dengan alasan dari daftar baku (OW-03). Penolakan izin mengembalikan Pertemuan kepada tentor asal, sedangkan penolakan calon mengembalikan kasus untuk dicarikan pengganti lain.

AC-AD-15.3. Sebelum mengesahkan, sistem memeriksa bahwa calon aktif, sudah menyatakan bersedia, tidak bentrok jadwal, memenuhi jeda antarsekolah, dan belum ditugaskan pada Pertemuan yang sama. Kasus yang gagal pemeriksaan tidak dapat disahkan.

AC-AD-15.4. Admin dapat mengesahkan banyak kasus sekaligus, dan kasus yang gagal pemeriksaan tetap menunggu beserta alasannya.

AC-AD-15.5. Admin memilih jenis penggantian Sementara atau Tetap. Penggantian Tetap hanya dapat dipilih bila mencakup seluruh Pertemuan tentor asal yang tersisa pada program dan kelompok yang sama.

AC-AD-15.6. Pengesahan memindahkan Penugasan Sah dan laporan Pertemuan kepada pengganti, serta memberi tahu tentor asal, tentor pengganti, dan pengolahan presensi.

AC-AD-15.7. Admin dapat menetapkan pengganti secara langsung dengan mencatat kesediaan pengganti beserta catatannya.

AC-AD-15.8. Admin wajib memutuskan sebelum batas waktu keputusan yang ditetapkan Owner dan menerima pengingat bila batas tersebut mendekat.

AC-AD-15.9. Admin dapat membatalkan izin yang sudah disetujui sebelum Pertemuan dimulai, dan penugasan dikembalikan kepada tentor asal bila tentor tersebut masih aktif.

AC-AD-15.10. Pemrosesan setelah Pertemuan dimulai hanya dapat dilakukan sebagai koreksi Admin dengan alasan dalam batas waktu yang ditetapkan.

### AD-16 \| Penanganan Penggantian karena Tentor Nonaktif

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mencarikan pengganti bagi Pertemuan milik tentor yang dinonaktifkan. Admin memilih calon pengganti dengan bantuan rekomendasi sistem, lalu mengirim permintaan kesediaan untuk satu atau beberapa Pertemuan sekaligus. Pengesahan dilakukan melalui AD-15.

**User Story**

**AD-16** Sebagai Admin, saya ingin memilih calon pengganti untuk Pertemuan milik tentor nonaktif dan meminta kesediaannya sekaligus untuk banyak Pertemuan agar Pertemuan tersebut tetap terlaksana.

**Acceptance Criteria**

AC-AD-16.1. Admin melihat Kasus Penggantian berpenyebab tentor nonaktif yang perlu ditangani.

AC-AD-16.2. Admin melihat calon pengganti yang aktif, diurutkan berdasarkan ketersediaan dan jarak terdekat.

AC-AD-16.3. Admin memilih satu atau beberapa kasus dari tentor asal yang sama dan mengirim satu permintaan kesediaan kepada calon.

AC-AD-16.4. Pertemuan yang diterima calon siap disahkan, sedangkan Pertemuan yang ditolak atau tidak ditanggapi sampai batas waktu kembali untuk dicarikan calon lain.

### AD-17 \| Penanganan Izin tanpa Pengganti

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memantau Kasus Penggantian yang tidak memperoleh pengganti, meneruskannya kepada Owner, dan mencatat keputusan Owner untuk disampaikan kepada sekolah mitra.

**User Story**

**AD-17** Sebagai Admin, saya ingin melihat kasus yang tidak memperoleh pengganti beserta batas waktunya agar tindak lanjutnya tidak terlewat.

**Acceptance Criteria**

AC-AD-17.1. Kasus berstatus Perlu Tindak Lanjut bila tidak ada calon, seluruh calon menolak, atau permintaan kedaluwarsa.

AC-AD-17.2. Kasus yang melewati batas eskalasi otomatis diteruskan kepada Owner. Admin dapat meneruskannya lebih awal dengan mencatat hasil koordinasi.

AC-AD-17.3. Setelah Owner memutuskan, Admin mencatat penjadwalan ulang atau pembatalan pada jadwal dan menyampaikannya kepada sekolah mitra di luar sistem.

### AD-18 \| Pemantauan Rekap Izin dan Penggantian

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan rekap izin dan penggantian seluruh tentor bagi Admin, yaitu jumlah izin, sesi yang digantikan, dan sesi yang menggantikan. Rekap ini menjadi satu-satunya sumber angka izin dan penggantian pada rekap presensi.

**User Story**

**AD-18** Sebagai Admin, saya ingin melihat rekap izin dan penggantian seluruh tentor agar saya dapat memantau frekuensinya dan memakainya pada rekap presensi.

**Acceptance Criteria**

AC-AD-18.1. Admin melihat rekap per tentor dengan penyaring periode, tentor, dan status.

AC-AD-18.2. Tentor yang melampaui ambang frekuensi izin diberi penanda tanpa sanksi.

AC-AD-18.3. Rekap dapat diekspor sesuai KU-08.

### AD-19 \| Pemantauan Presensi Harian

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memantau presensi tentor setiap hari, termasuk keterlambatan, sesi yang belum presensi pulang, dan percobaan presensi yang ditolak.

**User Story**

**AD-19** Sebagai Admin, saya ingin memantau presensi harian beserta penandanya agar masalah kehadiran dapat segera ditangani.

**Acceptance Criteria**

AC-AD-19.1. Admin melihat daftar presensi dengan penyaring tanggal, sekolah, tentor, status, dan penanda.

AC-AD-19.2. Setiap presensi menampilkan sesi, sekolah, tentor, jam masuk, jam pulang, status, dan penanda seperti Terlambat atau Belum Presensi Pulang.

AC-AD-19.3. Admin dapat melihat catatan percobaan presensi pada setiap sesi, termasuk yang ditolak beserta alasannya.

### AD-20 \| Peninjauan Koreksi Presensi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk meninjau dan memutuskan pengajuan koreksi presensi dari tentor. Data yang ditinjau adalah sesi, jenis koreksi, alasan, bukti pendukung, data presensi, catatan percobaan presensi, dan penanda lembar presensi fisik sekolah.

**User Story**

**AD-20** Sebagai Admin, saya ingin meninjau pengajuan koreksi presensi beserta bukti dan catatan percobaan presensi agar keputusan saya dapat dipertanggungjawabkan.

**Acceptance Criteria**

AC-AD-20.1. Admin menerima pemberitahuan setiap ada pengajuan koreksi baru.

AC-AD-20.2. Admin memutuskan Diterima atau Ditolak dengan catatan, atau meminta informasi tambahan kepada tentor.

AC-AD-20.3. Koreksi yang diterima menjadikan sesi sah dengan penanda Dikoreksi, sedangkan koreksi yang ditolak menjadikan sesi tidak sah.

AC-AD-20.4. Pada koreksi lupa presensi pulang yang diterima, Admin mengisi jam pulang koreksi. Data presensi asli tidak diubah.

AC-AD-20.5. Lembar presensi fisik hanya menjadi bukti pendukung dan bukan syarat sesi sah.

### AD-21 \| Validasi Presensi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memvalidasi presensi per sesi dengan mencocokkannya terhadap jadwal, izin, dan penggantian. Status sesi adalah Menunggu Validasi, Sah, Perlu Klarifikasi, dan Tidak Sah. Sesi yang sesuai disahkan otomatis, sedangkan sesi bermasalah diputuskan Admin. Hanya sesi Sah yang dihitung dalam honorarium.

**User Story**

**AD-21.1** Sebagai Admin, saya ingin sesi yang sesuai disahkan otomatis agar saya hanya menangani sesi yang bermasalah.

**AD-21.2** Sebagai Admin, saya ingin memproses banyak presensi sekaligus dengan penyaring agar validasi akhir periode tidak memakan waktu lama.

**Acceptance Criteria**

AC-AD-21.1. Admin melihat presensi per sesi beserta status, penanda, jadwal, tentor, sekolah, jam masuk, jam pulang, dan hasil laporan Pertemuan sebagai pembanding.

AC-AD-21.2. Sesi yang presensinya lengkap, sesuai jadwal, terlambat masih dalam toleransi, dan tidak bertentangan dengan izin disahkan otomatis. Sesi tentor pengganti diputuskan Admin.

AC-AD-21.3. Sesi yang terlambat melebihi toleransi berstatus Perlu Klarifikasi. Setelah tentor mengisi alasan, Admin menetapkan Sah atau Tidak Sah dengan catatan.

AC-AD-21.4. Presensi yang tidak sesuai jadwal atau penugasan diberi penanda Tidak Sesuai Jadwal dan hanya dapat disahkan Admin dengan alasan.

AC-AD-21.5. Sesi tanpa presensi dan tanpa izin ditandai Tidak Hadir dan tidak dibayarkan, tanpa sanksi atau potongan.

AC-AD-21.6. Admin hanya dapat mengubah status dan catatan, tidak dapat mengubah jam atau lokasi presensi, dan setiap perubahan wajib disertai catatan.

AC-AD-21.7. Admin dapat mengesahkan sekaligus seluruh sesi yang sesuai melalui penyaring, dan satu sesi tidak dapat divalidasi oleh dua pengguna bersamaan.

### AD-22 \| Rekap Presensi dan Penutupan Periode

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk melihat rekap presensi per tentor, menutup periode penggajian, dan membuka kembali periode sebelum disetujui Owner. Rekap memuat jumlah sesi terjadwal, sesi sah, sesi tidak sah, sesi tidak hadir, sesi dibatalkan, dan sesi yang belum diputuskan, serta angka izin dan penggantian dari AD-18.

**User Story**

**AD-22.1** Sebagai Admin, saya ingin melihat rekap presensi per tentor sepanjang periode agar saya dapat memantau kelengkapan validasi.

**AD-22.2** Sebagai Admin, saya ingin menutup periode setelah seluruh data selesai diputuskan agar perhitungan honorarium memakai data yang final.

**Acceptance Criteria**

AC-AD-22.1. Rekap dapat disaring berdasarkan tentor, sekolah, dan status, serta dapat diekspor sesuai KU-08.

AC-AD-22.2. Penutupan periode ditolak bila masih ada sesi yang perlu klarifikasi, izin yang belum diputuskan, atau koreksi presensi yang belum diputuskan.

AC-AD-22.3. Sesi yang belum presensi pulang tanpa koreksi yang diterima menjadi tidak sah saat periode ditutup.

AC-AD-22.4. Setelah ditutup, data presensi periode tersebut tidak dapat diubah.

AC-AD-22.5. Admin dapat membuka kembali periode dengan alasan selama Owner belum menyetujui honorarium periode tersebut.

AC-AD-22.6. Tentor nonaktif tetap tampil pada rekap bila memiliki sesi sah pada periode tersebut.

### AD-23 \| Perhitungan Honorarium

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk menghitung honorarium seluruh tentor pada periode yang sudah ditutup. Perhitungan memakai sesi yang sah dan komponen honorarium yang ditetapkan Owner (OW-01), yaitu uang kehadiran, honor mengajar, uang transportasi berdasarkan jarak, uang bonus kelengkapan administrasi, dan komponen lain yang aktif. Admin dapat menambahkan penyesuaian dengan alasan.

**User Story**

**AD-23.1** Sebagai Admin, saya ingin sistem menghitung honorarium seluruh tentor secara otomatis agar tidak ada lagi perhitungan manual.

**AD-23.2** Sebagai Admin, saya ingin melihat rincian per komponen, menambahkan penyesuaian, dan melihat peringatan nilai tidak lazim agar hasil dapat saya periksa sebelum diajukan kepada Owner.

**Acceptance Criteria**

AC-AD-23.1. Perhitungan hanya dapat dijalankan pada periode yang sudah ditutup dan hanya menghitung sesi sah.

AC-AD-23.2. Setiap komponen dihitung sesuai dasar perhitungan dan besaran yang berlaku pada tanggal sesi.

AC-AD-23.3. Untuk tentor pengganti, uang transportasi memakai jarak domisili tentor pengganti. Bonus hanya diberikan untuk sekolah yang menjadi penugasan tentor tersebut.

AC-AD-23.4. Bila jarak belum tersedia, perhitungan diberi penanda dan belum dapat difinalkan sampai Admin mengisi jarak dengan alasan.

AC-AD-23.5. Admin dapat menambah penyesuaian pada tentor tertentu dengan alasan wajib. Total honorarium tidak boleh bernilai negatif.

AC-AD-23.6. Sistem menampilkan peringatan bila honorarium tentor bernilai nol atau berbeda jauh dari periode sebelumnya. Peringatan tidak menghalangi pengajuan.

AC-AD-23.7. Admin dapat menghitung ulang selama honorarium belum diajukan kepada Owner. Setiap angka dapat ditelusuri sampai ke sesi, sekolah, besaran, dan jarak yang dipakai.

### AD-24 \| Pengajuan Honorarium dan Pemantauan Slip

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mengajukan hasil perhitungan honorarium satu periode kepada Owner, menarik pengajuan sebelum diputuskan, serta memantau slip honorarium yang terbit setelah disetujui. Slip memuat identitas tentor, periode, rincian setiap komponen, penyesuaian beserta alasannya, dan total honorarium.

**User Story**

**AD-24.1** Sebagai Admin, saya ingin mengajukan honorarium kepada Owner dan dapat menariknya sebelum diputuskan agar kekeliruan dapat diperbaiki.

**AD-24.2** Sebagai Admin, saya ingin melihat slip setiap tentor dan mengetahui apakah slip sudah dibuka agar saya dapat memantau penyampaiannya.

**Acceptance Criteria**

AC-AD-24.1. Admin dapat mengajukan honorarium periode yang sudah dihitung, dan Owner menerima pemberitahuan.

AC-AD-24.2. Admin dapat menarik pengajuan selama Owner belum memutuskan.

AC-AD-24.3. Honorarium yang ditolak Owner kembali kepada Admin beserta alasan penolakan untuk diperbaiki.

AC-AD-24.4. Admin dapat melihat dan mengunduh slip setiap tentor beserta keterangan Sudah Dibuka atau Belum Dibuka oleh tentor.

AC-AD-24.5. Slip yang direvisi mendapat penanda revisi, dan versi sebelumnya tetap tersimpan.

### AD-25 \| Penanganan Sanggahan Honorarium

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk menanggapi sanggahan honorarium yang diajukan tentor setelah slip terbit, dan mengajukan usulan penyesuaian kepada Owner bila sanggahan diterima. Data sanggahan memuat periode, hal yang disanggah (jumlah sesi, besaran, jarak, bonus, atau penyesuaian), alasan, dan bukti.

**User Story**

**AD-25** Sebagai Admin, saya ingin menanggapi sanggahan honorarium dan mengajukan penyesuaian kepada Owner agar penyelesaiannya tercatat.

**Acceptance Criteria**

AC-AD-25.1. Admin menerima pemberitahuan sanggahan baru dan menanggapinya dalam batas waktu yang ditetapkan.

AC-AD-25.2. Admin dapat meminta informasi tambahan, menerima, atau menolak sanggahan dengan catatan.

AC-AD-25.3. Sanggahan yang diterima diajukan sebagai usulan penyesuaian kepada Owner (OW-08).

AC-AD-25.4. Periode yang sudah disetujui tidak dibuka kembali, dan penyesuaian dicatat pada periode berjalan.

### AD-26 \| Pencatatan Pembayaran Honorarium

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mencatat pembayaran honorarium yang sudah disetujui Owner. Data pembayaran memuat tentor, periode, tanggal pembayaran, nominal, cara pembayaran (tunai atau transfer), rekening tujuan, dan bukti pembayaran. Data pembayaran dapat diekspor sebagai bahan pencatatan keuangan di luar sistem.

**User Story**

**AD-26** Sebagai Admin, saya ingin mencatat pembayaran honorarium per tentor, termasuk sekaligus untuk banyak tentor, agar status pembayaran selalu terkini.

**Acceptance Criteria**

AC-AD-26.1. Pembayaran hanya dapat dicatat untuk honorarium yang sudah disetujui Owner.

AC-AD-26.2. Status pembayaran adalah Belum Dibayar, Dibayar Sebagian, Dibayar, dan Tertunda. Satu honorarium dapat memiliki beberapa catatan pembayaran.

AC-AD-26.3. Total pembayaran tidak boleh melebihi nilai yang disetujui.

AC-AD-26.4. Rekening tujuan diambil dari profil tentor.

AC-AD-26.5. Admin dapat mencatat pembayaran transfer untuk banyak tentor sekaligus.

AC-AD-26.6. Honorarium yang melewati tanggal rencana pembayaran dan belum dibayar ditandai Tertunda.

AC-AD-26.7. Kesalahan pencatatan dibetulkan dengan membatalkan catatan pembayaran disertai alasan, bukan dengan menghapusnya.

### AD-27 \| Peninjauan Komponen Honorarium dan Parameter Kebijakan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk melihat komponen honorarium dan parameter kebijakan yang ditetapkan Owner beserta riwayat perubahannya, sebagai pengendalian atas dasar perhitungan dan aturan operasional. Admin tidak dapat mengubahnya.

**User Story**

**AD-27** Sebagai Admin, saya ingin melihat komponen honorarium dan parameter kebijakan beserta riwayatnya agar saya memahami dasar perhitungan dan aturan yang sedang berlaku.

**Acceptance Criteria**

AC-AD-27.1. Admin dapat melihat komponen honorarium, parameter kebijakan, nilai yang berlaku, tanggal mulai berlaku, dan riwayat perubahannya.

AC-AD-27.2. Admin tidak dapat menambah, mengubah, atau menonaktifkan komponen honorarium maupun parameter kebijakan.

### AD-28 \| Pengajuan Pengadaan Aset

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mengajukan pengadaan perangkat atau aksesoris baru kepada Owner. Data pengajuan memuat satu atau beberapa kebutuhan barang, masing-masing berisi jenis perangkat, jumlah, dan alasan atau kondisi stok, serta lampiran pendukung. Admin tidak menentukan merek, tipe, atau spesifikasi akhir, karena hal tersebut menjadi kewenangan Owner.

**User Story**

**AD-28** Sebagai Admin, saya ingin mengajukan pengadaan barang melalui sistem agar Owner dapat meninjau kebutuhan dan memutuskan pembelian.

**Acceptance Criteria**

AC-AD-28.1. Admin membuat dan mengirim pengajuan. Setelah dikirim, pengajuan berstatus Diajukan, memperoleh nomor pengajuan, dan diteruskan kepada Owner.

AC-AD-28.2. Sistem menampilkan peringatan kepada Admin ketika jumlah perangkat yang tersedia berada di bawah batas stok minimum.

AC-AD-28.3. Sistem memperingatkan bila sudah ada pengajuan lain yang masih menunggu untuk jenis perangkat yang sama, tanpa menghalangi pengajuan.

AC-AD-28.4. Admin dapat mengubah atau membatalkan pengajuan selama belum diputuskan. Pengajuan yang ditolak tidak diubah, tetapi dapat disalin menjadi pengajuan baru.

AC-AD-28.5. Admin menerima pemberitahuan keputusan Owner dan dapat menyaring daftar pengajuan berdasarkan status, jenis perangkat, dan tanggal.

### AD-29 \| Pengelolaan Inventaris Perangkat dan Label QR

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mendaftarkan dan mengelola setiap perangkat. Data perangkat memuat jenis perangkat, merek, tipe, nomor seri, tanggal perolehan, kondisi, status, lokasi penempatan, dan keterkaitan dengan pengajuan pengadaan yang disetujui. Setiap perangkat memperoleh label QR dan kode aset yang dapat dicetak sebagai stiker.

**User Story**

**AD-29.1** Sebagai Admin, saya ingin mendaftarkan dan mengelola data perangkat agar informasi setiap unit tercatat akurat dan tidak ganda.

**AD-29.2** Sebagai Admin, saya ingin setiap perangkat memiliki label QR yang dapat dicetak agar unit mudah dikenali dan dipindai di lapangan.

**Acceptance Criteria**

AC-AD-29.1. Admin dapat mendaftarkan perangkat satu per satu atau sekaligus melalui unggahan berkas dengan templat, dengan baris bermasalah ditampilkan beserta alasannya.

AC-AD-29.2. Nomor seri wajib diisi dan tidak boleh sama dengan perangkat lain mana pun.

AC-AD-29.3. Lokasi perangkat dipilih dari kantor Edukom atau daftar sekolah mitra.

AC-AD-29.4. Perangkat baru dapat dikaitkan dengan pengajuan pengadaan yang disetujui, dan jumlahnya tidak boleh melebihi jumlah yang disetujui Owner.

AC-AD-29.5. Status perangkat adalah Tersedia, Terdistribusi, Rusak, Perbaikan, Hilang, dan Nonaktif. Perangkat yang tidak dipakai lagi dinonaktifkan tanpa menghapus riwayatnya.

AC-AD-29.6. Admin dapat mencari dan menyaring perangkat berdasarkan jenis, status, dan lokasi.

AC-AD-29.7. Admin dapat mencetak label QR satu per satu, sekaligus untuk banyak perangkat, atau mencetak ulang label yang rusak tanpa mengubah identitas perangkat. Label memuat QR dan kode aset yang dapat dibaca.

### AD-30 \| Penugasan Distribusi Perangkat kepada Kurir

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk membuat penugasan distribusi perangkat kepada Kurir yang terkait dengan Pertemuan yang sudah terbit. Data penugasan memuat jenis kegiatan (Pengantaran, Penjemputan, atau Pengantaran Unit Cadangan), sekolah tujuan, Pertemuan terkait, tanggal dan waktu pelaksanaan, Kurir yang ditunjuk, dan daftar unit perangkat.

**User Story**

**AD-30** Sebagai Admin, saya ingin membuat penugasan Kurir yang terkait dengan jadwal Pertemuan agar pemakaian perangkat tidak bentrok dan instruksi pengantaran serta penjemputan jelas.

**Acceptance Criteria**

AC-AD-30.1. Penugasan wajib dikaitkan dengan satu atau beberapa Pertemuan terbit pada sekolah tujuan.

AC-AD-30.2. Untuk pengantaran, hanya perangkat berstatus Tersedia yang dapat dipilih. Untuk penjemputan, hanya perangkat yang berada di sekolah tujuan yang dapat dipilih.

AC-AD-30.3. Perangkat yang rusak, sedang diperbaiki, hilang, nonaktif, atau sudah dialokasikan pada waktu yang bertumpang tindih tidak dapat dipilih untuk pengantaran.

AC-AD-30.4. Hanya Kurir aktif yang dapat ditunjuk, dan Kurir menerima pemberitahuan penugasan.

AC-AD-30.5. Status penugasan adalah Ditugaskan, Sedang Berjalan, Selesai, dan Dibatalkan.

AC-AD-30.6. Selama belum berjalan, Admin dapat mengubah rincian, mengganti Kurir, atau membatalkan penugasan dengan alasan. Setelah berjalan, Admin hanya dapat mengganti Kurir atau mengeluarkan dan mengganti unit yang belum dipindai.

AC-AD-30.7. Admin dapat membuat penugasan pengantaran unit cadangan atau penjemputan langsung dari laporan kendala yang dikonfirmasi.

AC-AD-30.8. Bila jadwal yang terkait penugasan berubah, Admin menerima informasi perubahan dan memutuskan penyesuaian penugasan.

### AD-31 \| Pemantauan Serah Terima dan Konfirmasi Unit Hilang

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memantau pelaksanaan serah terima perangkat oleh Kurir dan menindaklanjuti unit yang ditolak atau tidak ditemukan saat penjemputan.

**User Story**

**AD-31** Sebagai Admin, saya ingin memantau perkembangan serah terima perangkat dan menindaklanjuti unit yang bermasalah agar setiap unit dapat dipertanggungjawabkan.

**Acceptance Criteria**

AC-AD-31.1. Admin melihat perkembangan setiap penugasan, yaitu unit yang sudah dan belum dipindai beserta bukti foto, waktu, dan hasil pemeriksaan lokasi.

AC-AD-31.2. Admin menerima pemberitahuan ketika unit ditolak saat pemindaian, ketika penugasan selesai, dan ketika Kurir melaporkan unit tidak ditemukan.

AC-AD-31.3. Admin mengonfirmasi unit yang tidak ditemukan sebagai Hilang dengan alasan. Sebelum dikonfirmasi, status unit tidak berubah.

### AD-32 \| Verifikasi Laporan Kendala Perangkat dan Tindak Lanjut

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk memverifikasi laporan kendala perangkat dari Tentor, Kurir, atau Admin sendiri, lalu menindaklanjutinya dengan perbaikan, pengantaran unit cadangan, atau penjemputan unit. Data laporan memuat perangkat, pelapor, sekolah, waktu, kategori kendala, uraian, dan foto. Admin juga dapat membuat laporan kendala dengan cara yang sama seperti peran lain.

**User Story**

**AD-32** Sebagai Admin, saya ingin memverifikasi laporan kendala dan menugaskan penggantian atau penjemputan unit agar kegiatan belajar tidak terhambat dan unit bermasalah dapat diperbaiki.

**Acceptance Criteria**

AC-AD-32.1. Admin melihat daftar laporan kendala dengan penyaring status, sekolah, dan tanggal. Laporan yang belum diverifikasi melewati batas waktu tampil sebagai prioritas.

AC-AD-32.2. Admin dapat menolak laporan yang tidak valid dengan alasan, dan status unit dikembalikan ke status sebelumnya. Pelapor menerima pemberitahuan.

AC-AD-32.3. Konfirmasi laporan kerusakan mengubah status unit menjadi Perbaikan dan membentuk tiket perbaikan untuk Teknisi.

AC-AD-32.4. Laporan kendala bukan kerusakan yang dikonfirmasi ditutup Admin dengan catatan tindak lanjut.

AC-AD-32.5. Admin mengonfirmasi tiket yang diajukan Teknisi sebagai Tidak Dapat Diperbaiki, sehingga perangkat menjadi Nonaktif.

AC-AD-32.6. Detail laporan menampilkan keterkaitannya dengan penugasan unit cadangan, penjemputan, tiket perbaikan, dan riwayat status.

### AD-33 \| Pengelolaan Daftar Rujukan Perangkat

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mengelola daftar rujukan yang dipakai sebagai pilihan baku pada pengelolaan perangkat, yaitu jenis perangkat dan kategori kendala perangkat.

**User Story**

**AD-33** Sebagai Admin, saya ingin mengelola daftar jenis perangkat dan kategori kendala agar pengadaan, inventaris, dan pelaporan kendala memakai pilihan yang seragam.

**Acceptance Criteria**

AC-AD-33.1. Admin dapat menambah, mengubah nama, dan menonaktifkan jenis perangkat dan kategori kendala.

AC-AD-33.2. Butir yang sudah dipakai tidak dapat dihapus dan hanya dapat dinonaktifkan. Butir nonaktif tidak muncul pada pilihan baru, tetapi tetap tampil pada data lama.

AC-AD-33.3. Setiap perubahan tercatat sesuai KU-05.

### AD-34 \| Pencarian dan Ekspor Laporan Administrasi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Admin untuk mencari, menyaring, dan mengekspor laporan rinci, yaitu laporan peserta, jadwal, realisasi Pertemuan, dan kelengkapan dokumen tentor. Penyaring yang tersedia adalah periode, sekolah, kelas atau kelompok, tentor, dan status.

**User Story**

**AD-34** Sebagai Admin, saya ingin menyaring dan mengekspor laporan rinci dengan definisi yang sama seperti dashboard Owner agar data yang saya berikan sesuai permintaan.

**Acceptance Criteria**

AC-AD-34.1. Laporan peserta memuat sekolah, tahun ajaran, kelas, kelompok, nama siswa, NIS, dan NISN.

AC-AD-34.2. Laporan jadwal memuat sekolah, program, kelompok, tentor, tanggal, jam, status, dan penerbit jadwal.

AC-AD-34.3. Laporan realisasi memuat sekolah, kelompok, Pertemuan, tentor, hasil pelaksanaan, status laporan, keterlambatan, pemeriksa, dan jumlah siswa hadir.

AC-AD-34.4. Laporan kelengkapan dokumen memuat tentor, jenis dokumen, periode, cakupan, tenggat, status, waktu unggah pertama, dan keterangan keterlambatan.

AC-AD-34.5. Hasil mengikuti seluruh penyaring yang dipilih, menampilkan keterangan Hasil Kosong bila tidak ada data, dan dapat diekspor sesuai KU-08.

## 3.4 Kebutuhan Fungsional Tentor (TN)

Tentor adalah pelaksana pembelajaran di sekolah mitra sekaligus penanggung jawab administrasi kegiatan yang diampunya. Kebutuhan fungsional pada bagian ini juga berlaku bagi Tentor Pengganti, yaitu tentor yang disahkan menggantikan tentor lain pada Pertemuan tertentu. Tentor hanya dapat melihat dan mengisi data miliknya sendiri, dan tidak menetapkan persetujuan penggantian, hasil verifikasi, maupun besaran honorarium.

### TN-01 \| Pengisian Ketersediaan Waktu Mengajar

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengisi dan mengonfirmasi waktu ketersediaannya mengajar. Data yang diinputkan adalah hari, jam mulai, jam selesai, tanggal mulai berlaku, tanggal akhir berlaku, dan catatan. Ketersediaan menjadi bahan Admin dalam menyusun jadwal dan dalam rekomendasi calon pengganti.

**User Story**

**TN-01** Sebagai Tentor, saya ingin mengisi dan mengonfirmasi hari, jam, dan periode ketersediaan saya agar penugasan disusun berdasarkan waktu yang telah saya nyatakan.

**Acceptance Criteria**

AC-TN-01.1. Tentor hanya dapat mengisi ketersediaan atas namanya sendiri.

AC-TN-01.2. Hari, jam mulai, jam selesai, tanggal mulai, dan tanggal akhir wajib diisi. Sistem menolak jam selesai yang tidak lebih akhir dari jam mulai dan tanggal akhir yang mendahului tanggal mulai.

AC-TN-01.3. Tentor menyimpan ketersediaan melalui tindakan Simpan dan Konfirmasi. Ketersediaan baru menggantikan ketersediaan lama hanya pada hari dan tanggal yang beririsan, dan ketersediaan lama tetap tersimpan sebagai riwayat.

AC-TN-01.4. Perubahan ketersediaan tidak mengubah jadwal yang sudah terbit. Bila perubahan membuat tentor tidak tersedia pada Pertemuan yang sudah terbit, Admin menerima penanda Perlu Ditinjau sesuai KU-07.

### TN-02 \| Melihat Jadwal Mengajar dan Penugasan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan dashboard bagi Tentor untuk melihat seluruh Pertemuan yang ditugaskan kepadanya, termasuk Pertemuan sebagai Tentor Pengganti, serta mengunduh jadwal resmi miliknya sebagai bahan penyusunan dokumen administrasi.

**User Story**

**TN-02** Sebagai Tentor, saya ingin melihat jadwal mengajar saya beserta rinciannya agar saya mengetahui sekolah, kelompok, dan waktu yang menjadi tanggung jawab saya.

**Acceptance Criteria**

AC-TN-02.1. Tentor hanya melihat Pertemuan terbit yang memiliki Penugasan Sah atas namanya, beserta sekolah, program, kelompok, tanggal, jam, dan nama tentor lain bila Pertemuan diajar dua tentor.

AC-TN-02.2. Setiap Pertemuan menampilkan status materi rencana, status laporan, dan kegiatan penilaian yang berlaku.

AC-TN-02.3. Tentor menerima pemberitahuan saat jadwal baru terbit, dijadwalkan ulang, dibatalkan, atau saat ia disahkan sebagai pengganti.

AC-TN-02.4. Tentor dapat mengunduh jadwal resmi miliknya per sekolah dan semester beserta jumlah minggu efektif. Unduhan ini menggantikan dokumen Jadwal Pembelajaran sehingga tidak perlu diunggah.

### TN-03 \| Pengisian Materi Rencana

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengisi materi rencana mengajar pada setiap Pertemuan yang ditugaskan kepadanya sebelum tenggat yang ditetapkan. Bila satu Pertemuan diajar dua tentor, setiap tentor mengisi materi rencananya sendiri.

**User Story**

**TN-03** Sebagai Tentor, saya ingin mengisi materi rencana saya sendiri sebelum tenggat agar persiapan mengajar saya tercatat untuk kelompok dan tanggal yang tepat.

**Acceptance Criteria**

AC-TN-03.1. Tentor hanya dapat mengisi dan mengubah materi rencana miliknya. Materi rencana tentor lain pada Pertemuan yang sama dapat dilihat, tetapi tidak dapat diubah.

AC-TN-03.2. Setiap penyimpanan materi rencana tercatat sebagai riwayat.

AC-TN-03.3. Materi rencana yang belum diisi sampai tenggat diberi penanda Materi Belum Terisi, dan tentor menerima pengingat.

AC-TN-03.4. Materi rencana dapat diubah sampai laporan Pertemuan dikirim, lalu terkunci.

AC-TN-03.5. Setelah pengganti disahkan, tentor asal tidak dapat lagi mengisi materi rencana pada Pertemuan tersebut, dan tentor pengganti mengisi materi rencananya sendiri.

### TN-04 \| Pengunggahan Lampiran Kurikulum Sekolah

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengunggah kurikulum sekolah sebagai lampiran acuan pada penetapan program yang ditugaskan kepadanya. Lampiran ini bukan kewajiban dokumen administrasi.

**User Story**

**TN-04** Sebagai Tentor, saya ingin mengunggah kurikulum sekolah pada program yang saya ampu agar acuan pembelajaran sekolah tersimpan bersama program tersebut.

**Acceptance Criteria**

AC-TN-04.1. Tentor hanya dapat mengunggah lampiran pada penetapan program yang ditugaskan kepadanya.

AC-TN-04.2. Unggahan ulang disimpan sebagai versi baru sesuai KU-04.

AC-TN-04.3. Lampiran kurikulum tidak memengaruhi status kelengkapan administrasi maupun bonus.

### TN-05 \| Pengunggahan dan Perbaikan Dokumen Administrasi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk melihat daftar kewajiban dokumen administrasinya, mengunggah dokumen, melihat catatan pemeriksaan, dan mengirim perbaikan. Jenis dokumen yang diunggah adalah Kalender Akademik, PROTA, Alokasi Waktu, PROSEM, Silabus, dan Modul Pembelajaran sesuai kewajiban yang terbentuk dari penugasannya.

**User Story**

**TN-05** Sebagai Tentor, saya ingin mengunggah dan memperbaiki dokumen administrasi pada kewajiban yang sama agar Admin memeriksa versi terbaru beserta riwayat perbaikannya.

**Acceptance Criteria**

AC-TN-05.1. Tentor melihat kewajiban aktif miliknya beserta jenis dokumen, periode, cakupan, tenggat, dan status terakhir.

AC-TN-05.2. Berkas yang tidak sesuai jenis atau ukuran yang diizinkan ditolak beserta alasannya dan tidak mengubah status kewajiban.

AC-TN-05.3. Unggahan yang diterima berstatus Menunggu Pemeriksaan dan memperoleh nomor versi.

AC-TN-05.4. Pada dokumen berstatus Perlu Perbaikan, tentor melihat catatan Admin dan mengirim perbaikan sebagai versi baru pada kewajiban yang sama.

AC-TN-05.5. Bila tentor mengunggah versi baru sebelum versi sebelumnya diperiksa, hanya versi terbaru yang diperiksa.

AC-TN-05.6. Kalender Akademik yang diunggah tentor tidak mengubah tanggal tidak efektif maupun jadwal resmi.

### TN-06 \| Pencatatan Nilai dan Portofolio Siswa

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mencatat nilai dan portofolio siswa berdasarkan kegiatan penilaian yang ditetapkan Admin pada Pertemuan yang ditugaskan kepadanya. Data yang diinputkan adalah nilai siswa dan/atau portofolio berupa catatan atau berkas hasil karya.

**User Story**

**TN-06** Sebagai Tentor, saya ingin mencatat nilai dan portofolio siswa berdasarkan kegiatan penilaian agar hasil belajar siswa dapat direkap dan ditelusuri.

**Acceptance Criteria**

AC-TN-06.1. Tentor hanya dapat mencatat nilai dan portofolio pada Pertemuan yang memiliki Penugasan Sah atas namanya, untuk siswa sasaran kegiatan penilaian.

AC-TN-06.2. Tentor dapat melihat kegiatan penilaian, tetapi tidak dapat mengubahnya.

AC-TN-06.3. Nilai harus berada dalam rentang yang berlaku. Nilai kosong dan nilai nol dibedakan pada tampilan dan rekap.

AC-TN-06.4. Bila Pertemuan diajar dua tentor, setiap tentor mencatat nilai dan portofolio pada laporannya sendiri.

AC-TN-06.5. Perubahan nilai setelah laporan dikirim wajib disertai alasan dan tercatat. Nilai pada laporan yang sudah terverifikasi hanya dapat diubah setelah Owner membuka kembali laporan tersebut.

### TN-07 \| Pengisian dan Pengiriman Laporan Pertemuan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengisi dan mengirim laporan pada setiap Pertemuan yang ditugaskan kepadanya. Data laporan memuat hasil pelaksanaan (Terlaksana atau Tidak Terlaksana), absensi setiap siswa (Hadir, Izin, Sakit, atau Alpa), materi yang disampaikan, jurnal kegiatan, serta nilai atau portofolio bila diwajibkan. Untuk Pertemuan yang tidak terlaksana, data yang diinputkan adalah kategori dan uraian penyebab.

**User Story**

**TN-07** Sebagai Tentor, saya ingin mengisi absensi, materi yang disampaikan, dan jurnal pada laporan saya lalu mengirimkannya agar pekerjaan saya tercatat lengkap sebagai administrasi pembelajaran.

**Acceptance Criteria**

AC-TN-07.1. Tentor hanya dapat mengisi dan mengirim laporannya sendiri. Laporan tentor lain pada Pertemuan yang sama dapat dilihat, tetapi tidak dapat diubah.

AC-TN-07.2. Laporan Terlaksana dapat diisi sejak Pertemuan dimulai dan dikirim setelah Pertemuan selesai. Laporan Tidak Terlaksana dapat diisi sejak tanggal Pertemuan.

AC-TN-07.3. Daftar absensi berisi anggota kelompok pada tanggal Pertemuan, dan setiap siswa diberi tepat satu status kehadiran.

AC-TN-07.4. Sistem menampilkan isian wajib yang masih kosong dan menolak pengiriman sampai seluruh isian wajib terisi.

AC-TN-07.5. Bila seluruh siswa tidak hadir pada laporan Terlaksana, sistem meminta konfirmasi dan menyarankan pilihan Tidak Terlaksana.

AC-TN-07.6. Laporan yang belum dikirim sampai tenggat diberi penanda Terlambat dan tetap dapat dikirim.

AC-TN-07.7. Laporan menampilkan keterangan presensi tentor sebagai informasi. Laporan tanpa presensi diberi penanda Tanpa Presensi, tetapi tetap dapat dikirim.

AC-TN-07.8. Bila sambungan internet terputus, isian laporan disimpan sementara dan dikirim saat sambungan kembali.

AC-TN-07.9. Laporan yang sudah dikirim tidak dapat diubah. Laporan berstatus Perlu Perbaikan menampilkan catatan Admin dan dapat diperbaiki lalu dikirim ulang sebagai versi baru.

### TN-08 \| Rekap Administrasi Pribadi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan rekap administrasi pribadi bagi Tentor berdasarkan tahun ajaran, semester, atau bulan. Rekap memuat kewajiban dokumen, dokumen terkumpul, dokumen terverifikasi, dokumen perlu perbaikan, tenggat dan keterlambatan, status kelengkapan administrasi per sekolah, serta rekap penugasan, absensi, nilai, portofolio, dan laporan.

**User Story**

**TN-08** Sebagai Tentor, saya ingin melihat rekap administrasi pribadi saya agar saya mengetahui administrasi yang masih harus diselesaikan.

**Acceptance Criteria**

AC-TN-08.1. Tentor hanya melihat rekap miliknya sendiri. Pertemuan sebagai pengganti masuk rekap tentor pengganti, bukan rekap tentor asal.

AC-TN-08.2. Rekap dokumen menampilkan jumlah terkumpul dan terverifikasi dibandingkan jumlah kewajiban aktif, serta keterangan keterlambatan setiap kewajiban.

AC-TN-08.3. Tentor melihat status kelengkapan administrasi Lengkap atau Belum Lengkap per sekolah beserta dokumen yang belum terverifikasi.

AC-TN-08.4. Tentor dapat membuka kewajiban atau Pertemuan asal dari setiap angka pada rekap.

### TN-09 \| Pengajuan Izin Terencana

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengajukan izin tidak mengajar secara terencana, yaitu izin yang diajukan sebelum batas waktu izin terencana yang ditetapkan Owner. Data yang diinputkan adalah Pertemuan yang diajukan izin (dapat lebih dari satu dan pada beberapa hari), alasan, dan bukti pendukung bila ada. Setiap Pertemuan yang diajukan membentuk satu Kasus Penggantian.

**User Story**

**TN-09.1** Sebagai Tentor, saya ingin mengajukan izin terencana untuk satu atau beberapa Pertemuan beserta alasannya agar saya dapat tidak mengajar tanpa mengganggu sekolah mitra.

**TN-09.2** Sebagai Tentor, saya ingin menarik pengajuan izin yang belum diputuskan agar rencana saya dapat berubah.

**Acceptance Criteria**

AC-TN-09.1. Tentor memilih Pertemuan miliknya yang sudah terbit dan belum berlangsung, mengisi alasan, lalu mengajukan izin.

AC-TN-09.2. Izin yang diajukan setelah batas waktu izin terencana diarahkan ke izin mendesak (TN-10).

AC-TN-09.3. Setelah mengajukan, tentor melanjutkan dengan memilih calon pengganti (TN-11).

AC-TN-09.4. Selama Admin belum memutuskan, penugasan tidak berubah.

AC-TN-09.5. Tentor dapat menarik pengajuan selama belum disetujui, dan calon pengganti yang sudah diminta menerima pemberitahuan.

AC-TN-09.6. Satu Pertemuan hanya dapat berada pada satu pengajuan izin yang masih aktif.

AC-TN-09.7. Tentor Pengganti tidak dapat mengajukan izin atas Pertemuan pengganti, dan perubahan atas Pertemuan tersebut dilakukan melalui Admin.

### TN-10 \| Pengajuan Izin Mendesak

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengajukan izin mendesak, yaitu izin yang diajukan setelah batas waktu izin terencana sampai sebelum Pertemuan dimulai. Data yang diinputkan adalah Pertemuan, alasan, dan bukti. Untuk izin sakit, surat keterangan dokter wajib dilampirkan.

**User Story**

**TN-10** Sebagai Tentor, saya ingin mengajukan izin mendesak untuk Pertemuan tertentu beserta alasannya agar Pertemuan saya dapat segera digantikan.

**Acceptance Criteria**

AC-TN-10.1. Izin mendesak diajukan per Pertemuan dan dapat memuat beberapa Pertemuan sekaligus.

AC-TN-10.2. Alasan wajib diisi. Izin sakit wajib disertai surat keterangan dokter, sedangkan bukti untuk alasan lain bersifat opsional.

AC-TN-10.3. Pada hari pelaksanaan, izin hanya dapat diajukan sampai Pertemuan dimulai. Setelah itu, perubahan hanya dapat dilakukan melalui koreksi Admin.

AC-TN-10.4. Izin mendesak diberi penanda Mendadak dan diteruskan sebagai prioritas kepada Admin, atau kepada Owner di luar jam layanan Admin.

AC-TN-10.5. Lampiran izin sakit hanya dapat dilihat Admin dan Owner sesuai KU-04.

### TN-11 \| Pemilihan Calon Tentor Pengganti

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor yang mengajukan izin untuk memilih calon tentor pengganti dari daftar tentor aktif yang disarankan sistem, lalu mengirim permintaan kepada calon tersebut.

**User Story**

**TN-11** Sebagai Tentor, saya ingin melihat daftar calon pengganti yang sesuai dan memilih di antaranya agar Pertemuan saya tetap terlaksana.

**Acceptance Criteria**

AC-TN-11.1. Daftar calon hanya berisi tentor aktif yang tidak bentrok jadwal dan belum ditugaskan pada Pertemuan yang sama.

AC-TN-11.2. Daftar diurutkan berdasarkan ketersediaan, kemudian jarak terdekat ke sekolah. Sistem hanya menampilkan nama dan perkiraan jarak, tanpa alamat calon.

AC-TN-11.3. Sistem menampilkan peringatan bila jeda waktu calon antara dua sekolah tidak mencukupi.

AC-TN-11.4. Pada izin terencana, permintaan dikirim kepada satu calon pada satu waktu. Pada izin mendesak, permintaan dapat dikirim kepada beberapa calon sekaligus dan calon pertama yang menerima yang dipakai.

AC-TN-11.5. Bila calon menerima, kasus diteruskan kepada Admin untuk disahkan. Bila tidak ada calon atau seluruh calon menolak, kasus menjadi Perlu Tindak Lanjut, dan tentor dapat menandai kondisi tanpa pengganti secara manual.

### TN-12 \| Tanggapan atas Permintaan Menjadi Tentor Pengganti

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor yang diminta menjadi pengganti, baik oleh tentor lain maupun oleh Admin, untuk melihat rincian Pertemuan yang diminta lalu menerima atau menolaknya dalam batas waktu yang ditetapkan.

**User Story**

**TN-12** Sebagai calon Tentor Pengganti, saya ingin melihat rincian Pertemuan yang diminta dan menerima atau menolaknya agar saya hanya mengajar pada Pertemuan yang dapat saya penuhi.

**Acceptance Criteria**

AC-TN-12.1. Calon pengganti menerima pemberitahuan yang memuat sekolah, kelompok, tanggal, jam, dan perkiraan uang transportasi.

AC-TN-12.2. Calon menerima atau menolak setiap Pertemuan yang diminta. Permintaan yang tidak ditanggapi sampai batas waktu menjadi Kedaluwarsa.

AC-TN-12.3. Bila beberapa permintaan pada waktu yang bentrok diterima, hanya permintaan yang pertama diterima yang berlaku.

AC-TN-12.4. Calon dapat membatalkan kesediaan sebelum Admin mengesahkan. Setelah disahkan, pembatalan hanya dapat dilakukan melalui Admin.

AC-TN-12.5. Setelah disahkan, Pertemuan tampil pada jadwal, presensi, dan laporan tentor pengganti.

### TN-13 \| Riwayat Izin dan Penggantian

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan riwayat izin dan penggantian bagi Tentor, yaitu daftar izin yang pernah diajukan, Pertemuan yang digantikan tentor lain, dan Pertemuan yang ia gantikan, beserta statusnya.

**User Story**

**TN-13** Sebagai Tentor, saya ingin melihat riwayat izin dan penggantian saya agar saya mengetahui catatan saya.

**Acceptance Criteria**

AC-TN-13.1. Tentor hanya melihat riwayat miliknya sendiri.

AC-TN-13.2. Riwayat menampilkan Pertemuan, alasan, status pengajuan, dan tentor pengganti atau tentor yang digantikan.

AC-TN-13.3. Tentor menerima pemberitahuan pada setiap perubahan status pengajuan izinnya.

### TN-14 \| Presensi Masuk dan Pulang

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor dan Tentor Pengganti untuk melakukan presensi masuk dan presensi pulang pada setiap sesi melalui telepon genggam saat berada di sekolah mitra, sebagai pengganti lembar presensi fisik dan formulir terpisah. Data yang dicatat adalah sesi, waktu presensi, dan lokasi saat presensi. Pemeriksaan lokasi mengikuti KU-02.

**User Story**

**TN-14.1** Sebagai Tentor, saya ingin melakukan presensi masuk dan pulang langsung dari telepon genggam saat berada di sekolah agar kehadiran saya tercatat tanpa lembar presensi fisik.

**TN-14.2** Sebagai Tentor, saya ingin melakukan presensi pulang sekaligus presensi masuk sesi berikutnya di sekolah yang sama dengan satu tindakan agar pencatatan sesi berurutan tidak memakan waktu.

**TN-14.3** Sebagai Tentor Pengganti, saya ingin melakukan presensi pada Pertemuan pengganti yang sudah disahkan agar kehadiran saya tercatat atas nama saya.

**Acceptance Criteria**

AC-TN-14.1. Tentor melihat daftar sesi miliknya pada hari tersebut, termasuk sesi pengganti yang sudah disahkan, lalu memilih sesi yang akan dipresensi.

AC-TN-14.2. Presensi hanya diterima bila tentor berada di dalam area sekolah. Bila di luar area, sistem menampilkan jarak ke sekolah dan menolak presensi.

AC-TN-14.3. Presensi masuk dan pulang hanya dapat dilakukan dalam rentang waktu yang ditetapkan Owner, dan waktu presensi mengikuti waktu sistem sehingga tidak dapat diubah tentor.

AC-TN-14.4. Presensi masuk setelah sesi dimulai diberi penanda Terlambat. Keterlambatan yang melebihi toleransi tetap tercatat dan memerlukan klarifikasi.

AC-TN-14.5. Presensi pulang hanya dapat dilakukan setelah presensi masuk pada hari yang sama. Tentor menerima pengingat bila belum melakukan presensi pulang.

AC-TN-14.6. Sesi yang dibatalkan, dijadwalkan ulang, atau jatuh pada hari libur tidak dapat dipresensi, dan presensi ganda pada sesi yang sama ditolak.

AC-TN-14.7. Tentor melihat riwayat presensinya beserta status, penanda, dan alasan penolakan.

AC-TN-14.8. Bila presensi gagal karena kendala teknis, tentor diarahkan ke pengajuan koreksi presensi (TN-15).

### TN-15 \| Pengajuan Koreksi Presensi dan Klarifikasi Sesi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengajukan koreksi bila presensi pada suatu sesi gagal tercatat atau tidak dapat dilakukan, serta mengisi klarifikasi atas sesi yang diminta Admin. Data koreksi memuat sesi, jenis koreksi (lupa presensi pulang, lokasi atau sinyal gagal, presensi ditolak sistem, perangkat bermasalah, atau lainnya), alasan, dan bukti pendukung.

**User Story**

**TN-15.1** Sebagai Tentor, saya ingin mengajukan koreksi presensi beserta alasan dan bukti agar sesi yang saya ajar tetap dihitung bila presensi gagal karena kendala teknis.

**TN-15.2** Sebagai Tentor, saya ingin mengisi alasan atas sesi yang memerlukan klarifikasi agar sesi saya dinilai dengan benar.

**Acceptance Criteria**

AC-TN-15.1. Satu pengajuan dapat memuat beberapa sesi pada hari yang sama, dan satu sesi hanya dapat memiliki satu pengajuan yang masih aktif.

AC-TN-15.2. Pengajuan hanya dapat dibuat dalam batas waktu yang ditetapkan dan selama periode penggajian sesi tersebut belum ditutup.

AC-TN-15.3. Tentor dapat memantau status pengajuan, menarik pengajuan yang belum diputuskan, dan melengkapi informasi bila diminta Admin.

AC-TN-15.4. Tentor menerima pengingat dan mengisi alasan pada sesi berstatus Perlu Klarifikasi sebelum periode ditutup.

AC-TN-15.5. Koreksi tidak mengubah waktu dan lokasi presensi asli.

### TN-16 \| Pengajuan Sanggahan Honorarium

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk mengajukan sanggahan atas honorarium setelah slip terbit. Data sanggahan memuat periode, hal yang disanggah (jumlah sesi, besaran, jarak, bonus, atau penyesuaian), alasan, dan bukti pendukung.

**User Story**

**TN-16** Sebagai Tentor, saya ingin mengajukan sanggahan atas honorarium saya agar kekeliruan dapat diperbaiki.

**Acceptance Criteria**

AC-TN-16.1. Sanggahan dapat diajukan dalam batas waktu yang ditetapkan setelah slip terbit, termasuk atas honorarium yang sudah dibayar.

AC-TN-16.2. Tentor dapat memantau status sanggahan, menarik sanggahan yang belum diputuskan, dan melengkapi informasi bila diminta.

AC-TN-16.3. Tentor menerima pemberitahuan atas tanggapan Admin dan keputusan Owner. Penyesuaian yang disetujui tampil pada slip periode berjalan.

### TN-17 \| Slip dan Status Pembayaran Honorarium

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk melihat dan mengunduh slip honorarium miliknya serta memantau status pembayarannya. Slip memuat identitas tentor, periode, rincian setiap komponen honorarium, penyesuaian beserta alasannya, dan total honorarium.

**User Story**

**TN-17.1** Sebagai Tentor, saya ingin melihat dan mengunduh slip honorarium saya agar saya mengetahui rincian penghasilan setiap periode.

**TN-17.2** Sebagai Tentor, saya ingin melihat status pembayaran honorarium saya dan dapat mengonfirmasi penerimaan bila saya mau agar saya mengetahui kapan honorarium dibayarkan.

**Acceptance Criteria**

AC-TN-17.1. Tentor hanya dapat melihat dan mengunduh slip miliknya. Tentor nonaktif tetap dapat mengunduh slip lamanya selama masa simpan.

AC-TN-17.2. Tentor menerima pemberitahuan saat slip terbit atau direvisi, dan versi sebelumnya tetap dapat dilihat.

AC-TN-17.3. Tentor melihat status pembayaran Belum Dibayar, Dibayar Sebagian, Dibayar, atau Tertunda.

AC-TN-17.4. Konfirmasi penerimaan oleh tentor bersifat opsional dan tidak mengubah status pembayaran.

### TN-18 \| Pelaporan Kendala Perangkat

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Tentor untuk melaporkan kendala perangkat yang ditemui saat pembelajaran dengan memindai label QR perangkat atau mengetik kode aset. Data laporan memuat kategori kendala, uraian, dan foto perangkat. Identitas perangkat, pelapor, sekolah, dan waktu terisi otomatis.

**User Story**

**TN-18** Sebagai Tentor, saya ingin melaporkan perangkat yang bermasalah dengan memindai label QR dan mengunggah foto agar kendala segera tercatat dan ditindaklanjuti Admin.

**Acceptance Criteria**

AC-TN-18.1. Pemindaian label QR atau pengetikan kode aset membuka formulir laporan untuk perangkat tersebut, dan tentor dapat melihat profil singkat perangkat.

AC-TN-18.2. Kategori kendala, uraian, dan foto perangkat wajib diisi.

AC-TN-18.3. Laporan kerusakan langsung mengubah status perangkat menjadi Rusak sehingga perangkat tidak dapat dipakai pada pengantaran berikutnya. Laporan kendala yang bukan kerusakan tidak mengubah status perangkat.

AC-TN-18.4. Laporan diteruskan kepada Admin, dan tentor menerima pemberitahuan atas hasil verifikasinya. Bila sambungan internet terputus, laporan dikirim saat sambungan kembali.

## 3.5 Kebutuhan Fungsional Kurir (KR)

Kurir bertanggung jawab atas pengantaran, pemasangan, dan penjemputan perangkat pembelajaran di sekolah mitra. Kebutuhan fungsional Kurir berfokus pada penerimaan tugas distribusi, bukti serah terima setiap unit, dan pelaporan kendala yang ditemukan di lapangan. Kurir tidak memutuskan perbaikan maupun pengadaan perangkat.

### KR-01 \| Melihat Tugas Distribusi

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Kurir untuk melihat tugas distribusi yang ditugaskan Admin kepadanya. Rincian tugas memuat jenis kegiatan (Pengantaran, Penjemputan, atau Pengantaran Unit Cadangan), tanggal dan waktu pelaksanaan, sekolah tujuan, jumlah unit, dan daftar unit beserta kode asetnya.

**User Story**

**KR-01** Sebagai Kurir, saya ingin melihat daftar tugas distribusi saya beserta rinciannya agar saya mengetahui perangkat yang harus diantar atau dijemput, ke mana, dan kapan.

**Acceptance Criteria**

AC-KR-01.1. Kurir hanya melihat tugas yang ditugaskan kepadanya, dan menerima pemberitahuan saat tugas baru dibuat atau diubah.

AC-KR-01.2. Setiap tugas menampilkan status Ditugaskan, Sedang Berjalan, Selesai, atau Dibatalkan.

AC-KR-01.3. Bila jadwal Pertemuan yang terkait tugas berubah, Kurir melihat informasi perubahan tersebut pada tugasnya.

AC-KR-01.4. Kurir tidak dapat menolak tugas melalui sistem. Kurir yang berhalangan menghubungi Admin untuk penggantian.

### KR-02 \| Serah Terima Pengantaran Perangkat

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Kurir untuk mencatat serah terima setiap unit saat pengantaran dan pemasangan di sekolah mitra, dengan memindai label QR setiap unit dan mengunggah foto hasil pemasangan. Pemeriksaan lokasi foto mengikuti KU-02. Data yang dicatat adalah unit, waktu, lokasi, foto, dan penerima di sekolah.

**User Story**

**KR-02** Sebagai Kurir, saya ingin memindai label QR perangkat dan mengunggah foto pemasangan saat tiba di sekolah agar perangkat tercatat sudah terdistribusi.

**Acceptance Criteria**

AC-KR-02.1. Kurir memindai label QR setiap unit satu per satu, hanya pada tugas pengantaran miliknya.

AC-KR-02.2. Unit yang tidak ada dalam daftar tugas atau statusnya sudah tidak tersedia ditolak beserta alasannya, dan Admin menerima pemberitahuan.

AC-KR-02.3. Kurir mengunggah foto hasil pemasangan yang diambil langsung dari kamera. Foto yang diambil di luar area sekolah ditolak sebagai bukti.

AC-KR-02.4. Unit yang berhasil dipindai dan didukung foto yang sah berubah status menjadi Terdistribusi dengan lokasi sekolah tujuan.

AC-KR-02.5. Tugas pengantaran menjadi Selesai setelah seluruh unit dalam daftar berhasil diserahkan.

AC-KR-02.6. Bila label QR rusak, Kurir dapat mengetik kode aset secara manual, dan pencatatan tersebut ditandai sebagai pemindaian manual.

### KR-03 \| Serah Terima Penjemputan Perangkat

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Kurir untuk mencatat penjemputan setiap unit dari sekolah mitra dengan memindai label QR dan mengunggah foto kondisi perangkat sebelum dikemas. Data yang dicatat adalah unit, waktu, lokasi, foto kondisi, serta keterangan unit bermasalah atau tidak ditemukan.

**User Story**

**KR-03** Sebagai Kurir, saya ingin memindai ulang label QR dan mengunggah foto kondisi perangkat saat menjemput agar setiap unit dapat dipertanggungjawabkan dan kembali tercatat di kantor.

**Acceptance Criteria**

AC-KR-03.1. Kurir memindai label QR setiap unit satu per satu, hanya pada tugas penjemputan miliknya.

AC-KR-03.2. Sistem mencocokkan unit yang dipindai dengan daftar tugas dan menampilkan peringatan bila masih ada unit yang belum dipindai.

AC-KR-03.3. Kurir mengunggah foto kondisi perangkat di sekolah sebelum perangkat dikemas.

AC-KR-03.4. Unit yang berhasil dijemput kembali berstatus Tersedia dengan lokasi kantor Edukom. Unit yang rusak atau sedang dalam perbaikan tetap pada statusnya dan hanya berpindah lokasi ke kantor.

AC-KR-03.5. Bila unit bermasalah, Kurir dapat langsung melaporkan kendala dari layar penjemputan (KR-04).

AC-KR-03.6. Bila unit tidak ditemukan, Kurir menandainya Tidak Ditemukan dengan alasan, sehingga tugas dapat diselesaikan dan Admin menerima pemberitahuan untuk menindaklanjuti.

AC-KR-03.7. Tugas penjemputan menjadi Selesai setelah setiap unit berhasil dijemput atau ditandai Tidak Ditemukan.

### KR-04 \| Pelaporan Kendala Perangkat

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Kurir untuk melaporkan kendala perangkat yang ditemukan saat pengantaran atau penjemputan dengan memindai label QR atau mengetik kode aset. Data laporan memuat kategori kendala, uraian, dan foto perangkat. Identitas perangkat, pelapor, sekolah, dan waktu terisi otomatis.

**User Story**

**KR-04** Sebagai Kurir, saya ingin melaporkan perangkat yang bermasalah saat bertugas agar kendala segera tercatat dan perangkat tidak dikirim kembali sebelum diperbaiki.

**Acceptance Criteria**

AC-KR-04.1. Laporan dapat dibuat dari menu pelaporan kendala atau langsung dari layar penjemputan dengan data perangkat dan sekolah terisi otomatis.

AC-KR-04.2. Kategori kendala, uraian, dan foto perangkat wajib diisi.

AC-KR-04.3. Laporan kerusakan langsung mengubah status perangkat menjadi Rusak. Pada penjemputan, perangkat tetap dihitung sudah dijemput dan berpindah lokasi ke kantor.

AC-KR-04.4. Laporan diteruskan kepada Admin. Bila sambungan internet terputus, laporan dikirim saat sambungan kembali.

### KR-05 \| Melihat Profil Perangkat melalui Label QR

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Kurir untuk melihat profil singkat perangkat dengan memindai label QR, sebagai pengganti catatan kertas di lapangan.

**User Story**

**KR-05** Sebagai Kurir, saya ingin melihat profil singkat perangkat dengan memindai label QR agar saya dapat memastikan identitas dan kondisi perangkat di lapangan.

**Acceptance Criteria**

AC-KR-05.1. Profil singkat menampilkan kode aset, jenis perangkat, status, lokasi, dan kendala yang masih terbuka.

AC-KR-05.2. Profil hanya dapat dibuka oleh pengguna yang sudah masuk ke sistem dan berwenang. Pemindaian di luar sistem tidak menampilkan informasi perangkat.

## 3.6 Kebutuhan Fungsional Teknisi (TK)

Teknisi bertanggung jawab menangani perangkat yang mengalami kerusakan. Kebutuhan fungsional Teknisi berfokus pada pencatatan penanganan perbaikan sehingga riwayat perbaikan melekat pada setiap perangkat. Teknisi tidak mengakses data penggajian maupun administrasi siswa.

### TK-01 \| Melihat Tiket Perbaikan dan Riwayat Perangkat

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Teknisi untuk melihat daftar tiket perbaikan yang terbentuk dari laporan kendala yang dikonfirmasi Admin, beserta identitas perangkat, laporan kendala, foto kerusakan, dan riwayat perbaikan sebelumnya.

**User Story**

**TK-01** Sebagai Teknisi, saya ingin melihat daftar tiket perbaikan beserta laporan dan riwayat perangkatnya agar saya dapat memeriksa kerusakan dengan informasi yang lengkap.

**Acceptance Criteria**

AC-TK-01.1. Teknisi melihat daftar tiket dengan penyaring status, tanggal, dan perangkat.

AC-TK-01.2. Setiap tiket menampilkan perangkat, laporan kendala, foto, pelapor, lokasi perangkat, dan riwayat perbaikan sebelumnya.

AC-TK-01.3. Tiket untuk perangkat yang masih berada di sekolah diberi keterangan Menunggu Unit Dijemput.

### TK-02 \| Pencatatan Penanganan Perbaikan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Teknisi untuk mencatat penanganan perbaikan pada tiket. Data yang diinputkan adalah tindakan perbaikan, suku cadang yang dipakai beserta jumlahnya, biaya perbaikan bila ada, tanggal mulai, dan tanggal selesai.

**User Story**

**TK-02** Sebagai Teknisi, saya ingin mendokumentasikan tindakan perbaikan ke dalam sistem agar riwayat perbaikan perangkat tersimpan permanen.

**Acceptance Criteria**

AC-TK-02.1. Teknisi mengubah status tiket dari Dibuka menjadi Diproses saat mulai menangani perangkat. Tiket tidak dapat diproses selama perangkat belum berada di kantor.

AC-TK-02.2. Teknisi mencatat tindakan perbaikan, suku cadang, dan biaya pada tiket.

AC-TK-02.3. Sistem mencatat tanggal perangkat diterima di kantor dan lama penanganan secara otomatis.

AC-TK-02.4. Satu perangkat hanya memiliki satu tiket aktif pada satu waktu, dan setiap perubahan tiket tercatat sesuai KU-05.

### TK-03 \| Penyelesaian Perbaikan

**SRS — Kebutuhan Fungsional**

Sistem harus menyediakan fasilitas bagi Teknisi untuk menyelesaikan tiket perbaikan dengan hasil Selesai, atau mengajukan perangkat sebagai Tidak Dapat Diperbaiki untuk dikonfirmasi Admin.

**User Story**

**TK-03** Sebagai Teknisi, saya ingin menyelesaikan tiket perbaikan agar status perangkat dipulihkan dan perangkat dapat dipakai kembali.

**Acceptance Criteria**

AC-TK-03.1. Tiket yang diselesaikan mengubah status perangkat menjadi Tersedia, menutup laporan kendala terkait, dan memberi tahu Admin bahwa perangkat siap dipakai.

AC-TK-03.2. Penyelesaian ditolak bila perangkat tidak berada di kantor.

AC-TK-03.3. Teknisi dapat mengajukan perangkat sebagai Tidak Dapat Diperbaiki dengan alasan. Setelah dikonfirmasi Admin, perangkat menjadi Nonaktif.

AC-TK-03.4. Tiket yang sudah selesai tidak dapat dibuka kembali. Kerusakan baru pada perangkat yang sama dilaporkan sebagai laporan kendala baru.

AC-TK-03.5. Riwayat perbaikan tersimpan permanen pada profil perangkat dan tetap dapat ditelusuri walaupun Teknisi berganti.

# BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)

Mendampingi spesifikasi kebutuhan fungsional, aspek rekayasa non-fungsional memastikan infrastruktur kode memenuhi landasan skalabilitas masa depan, resistensi penetrasi digital, kecepatan respons algoritmik, serta ketangguhan mitigasi anomali sistemik.

## 4.1 Performa (PRF)

| ID     | Kategori | Deskripsi Kebutuhan                                                                               | Metrik dan Target                                                  | Kondisi Pengujian                                                      | Metode Verifikasi                       | Status                              |
|--------|----------|---------------------------------------------------------------------------------------------------|--------------------------------------------------------------------|------------------------------------------------------------------------|-----------------------------------------|-------------------------------------|
| PRF-01 | Performa | Waktu muat halaman presensi (FR: PAY-02, ADM-13)                                                  | p95 ≤ 3 detik muat awal; p95 ≤ 1,5 detik navigasi berikutnya (SPA) | Ponsel Android kelas menengah, Chrome, 4G, cache dingin, 30 kali ulang | Lighthouse atau WebPageTest, hitung p95 | Usulan Analis — Menunggu Konfirmasi |
| PRF-02 | Performa | Waktu muat halaman data berat: dashboard, rekap, daftar aset (FR: RPT-01, RPT-03, AST-06, PAY-05) | p95 ≤ 5 detik pada volume data penuh (N_S, N_U)                    | Desktop, LAN kantor, data uji volume penuh                             | Lighthouse dan log waktu API            | Usulan Analis — Menunggu Konfirmasi |

| PRF-03 | Performa | Respons API baca (FR: seluruh modul)                                                                                                            | p95 ≤ 2 detik, p99 ≤ 4 detik                                                                                                                           | Beban normal = 50% N_C; basis data berisi data uji volume penuh | k6 atau JMeter, laporan persentil     | Usulan Analis — Menunggu Konfirmasi            |
|--------|----------|-------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------|---------------------------------------|------------------------------------------------|
| PRF-04 | Performa | Respons API tulis ringan: check-in/out, kirim izin, jurnal, absensi siswa (FR: PAY-02, IZN-01, ADM-19). SRS hanya menyebut "instan" tanpa angka | p95 ≤ 3 detik end-to-end setelah koordinat tersedia                                                                                                    | Beban puncak N_C serentak dalam jendela 5 menit                 | Uji beban, ukur dari klien dan server | Usulan Analis — Menunggu Konfirmasi (Q2)       |
| PRF-05 | Performa | Perhitungan geofence (Haversine) di server (FR: PAY-02, ADM-01)                                                                                 | ≤ 100 ms per permintaan; hasil sama dengan perhitungan acuan (selisih ≤ 1 m); radius mengikuti parameter sekolah                                       | Uji unit dengan koordinat batas radius                          | Uji unit dan log waktu                | Usulan Analis — Menunggu Konfirmasi (K3, Q5)   |
| PRF-06 | Performa | Umpan balik saat perolehan GPS lambat (FR: PAY-02)                                                                                              | Waktu perolehan GPS di luar kendali sistem; indikator "mencari lokasi" tampil ≤ 1 detik; pesan bantuan jika \> 15 detik                                | Perangkat dengan GPS dingin, di dalam gedung                    | Uji manual pada perangkat uji         | Usulan Analis — Menunggu Konfirmasi            |
| PRF-07 | Performa | Validasi bentrok dan publikasi jadwal (FR: ADM-11, ADM-12, ADM-14)                                                                              | Pemeriksaan ulang saat publikasi (AC-ADM-08.5); p95 ≤ 5 detik per jadwal                                                                               | Data jadwal semester penuh seluruh sekolah                      | Uji fungsional dan ukur waktu         | Ditetapkan SRS (mekanisme); angka waktu usulan |
| PRF-08 | Performa | Perhitungan honorarium satu periode seluruh tentor (FR: PAY-06)                                                                                 | ≤ 2 menit untuk N_T tentor; hitung ulang ≤ 2 menit                                                                                                     | Data uji satu periode penuh: N_T tentor, 37 sekolah             | Uji batch dengan data volume penuh    | Usulan Analis — Menunggu Konfirmasi            |
| PRF-09 | Performa | Penerbitan slip gaji PDF (FR: PAY-07)                                                                                                           | Satu slip ≤ 5 detik; seluruh slip satu periode ≤ 5 menit (asinkron, ada indikator progres)                                                             | Setelah persetujuan, N_T slip                                   | Uji batch, ukur waktu                 | Usulan Analis — Menunggu Konfirmasi            |
| PRF-10 | Performa | Unggah berkas bukti dan dokumen (FR: ADM-13, PAY-03, AST-04, AST-05, IZN-01)                                                                    | Berkas ≤ batas ukuran selesai ≤ 30 detik pada upstream 2 Mbps (contoh: 5 MB ≈ 20 detik); foto dikompres di klien; ada indikator progres dan coba ulang | Jaringan dibatasi 2 Mbps up; berkas JPG, PNG, PDF uji           | Uji dengan throttling jaringan        | Usulan Analis — Menunggu Konfirmasi (Q13)      |
| PRF-11 | Performa | Unduh slip PDF dan ekspor laporan (FR: PAY-07, RPT-03)                                                                                          | Slip ≤ 3 detik; ekspor ≤ 30 detik, atau asinkron dengan notifikasi jika lebih lama                                                                     | Volume data penuh, 4G                                           | Uji unduh terukur                     | Usulan Analis — Menunggu Konfirmasi            |
| PRF-12 | Performa | Impor Excel siswa (FR: ADM-03)                                                                                                                  | Tanpa kehilangan data diam-diam, error ditampilkan per baris (AC-ADM-03.3); 1.000 baris ≤ 60 detik                                                     | Berkas valid, invalid, duplikat, ukuran besar                   | Uji impor dan hitung baris            | Ditetapkan SRS (perilaku); angka usulan        |
| PRF-13 | Performa | Pemindaian QR dan tampilan profil unit (FR: AST-03, AST-04, AST-05)                                                                             | p95 ≤ 2 detik setelah kode terbaca                                                                                                                     | Ponsel kelas menengah, 4G                                       | Uji lapangan dan log                  | Usulan Analis — Menunggu Konfirmasi            |
| PRF-14 | Performa | Pembaruan status mendekati waktu nyata dan pengiriman notifikasi (FR: AST-05, AST-06, ADM-17, PAY-07, IZN-04, IZN-05, AST-03)                   | Status tampil di dashboard ≤ 10 detik; notifikasi terkirim ≤ 1 menit (kanal belum ditetapkan)                                                          | Pemicu kejadian lalu ukur waktu tampil                          | Uji ujung ke ujung, stopwatch dan log | Keputusan Diperlukan (Q9)                      |

## 4.2 Keamanan (SEC)

| ID     | Kategori | Deskripsi Kebutuhan                                                                                                                                             | Metrik dan Target                                                                                                                                                          | Kondisi Pengujian                                                 | Metode Verifikasi                                    | Status                                                           |
|--------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------|------------------------------------------------------|------------------------------------------------------------------|
| SEC-01 | Keamanan | Autentikasi dan penyimpanan kata sandi sebagai hash satu arah (FR: KU-09). Rujukan "bcrypt atau AES-256" di SRS dikoreksi karena AES bukan hash (K7)            | Tidak ada kata sandi terbaca di basis data; algoritma bcrypt atau argon2id; 0 akses data terlindungi tanpa sesi sah                                                        | Inspeksi tabel pengguna; akses tanpa token                        | Inspeksi basis data dan uji penetrasi                | Ditetapkan SRS (hash); algoritma usulan                          |
| SEC-02 | Keamanan | Kebijakan kata sandi dan pembatasan percobaan (FR: KU-09)                                                                                                       | Panjang minimal 8 karakter; kunci sementara 15 menit setelah 5 kali gagal; semua percobaan gagal tercatat                                                                  | Uji percobaan login berulang                                      | Uji fungsional dan tinjauan log                      | Usulan Analis — Menunggu Konfirmasi                              |
| SEC-03 | Keamanan | Keamanan sesi (FR: KU-09)                                                                                                                                       | Token kedaluwarsa idle 30 menit untuk Admin dan Owner; masa Tentor dan Kurir menyusul; cookie HttpOnly, Secure, SameSite; sesi dibatalkan saat logout dan ganti kata sandi | Uji kedaluwarsa dan pembajakan sesi                               | Uji penetrasi dan inspeksi header                    | Usulan Analis — Menunggu Konfirmasi                              |
| SEC-04 | Keamanan | Otorisasi berbasis peran (RBAC) di sisi server untuk 5 peran: Admin, Tentor, Owner, Kurir, Teknisi (FR: KU-09, PAY-01, PAY-07, AST-02, ADM-12, RPT-01, AST-06)  | 100% endpoint memeriksa peran; permintaan langsung di luar kewenangan ditolak meski antarmuka dimanipulasi; Owner read-only pada dashboard                                 | Matriks peran × fungsi lengkap                                    | Uji otomatis seluruh endpoint dan uji manipulasi API | Ditetapkan SRS (prinsip); matriks rinci menunggu K1, Q8          |
| SEC-05 | Keamanan | Otorisasi level objek: pembatasan data milik pengguna (FR: ADM-04, ADM-13, ADM-19, RPT-01, PAY-03, PAY-07, RPT-03)                                              | 0 kebocoran data antar pengguna pada uji ganti ID                                                                                                                          | Dua akun Tentor berbeda saling mengakses                          | Uji IDOR otomatis dan manual                         | Ditetapkan SRS (perilaku)                                        |
| SEC-06 | Keamanan | Perlindungan data sensitif: domisili dan koordinat tentor, data siswa SD, honorarium, bukti presensi (FR: ADM-03, ADM-05, PAY-02, PAY-07)                       | Enkripsi at-rest untuk kolom sensitif dan backup; data dibatasi sesuai peran; kebijakan privasi dan dasar persetujuan                                                      | Inspeksi penyimpanan; uji akses per peran                         | Tinjauan kepatuhan UU PDP dan inspeksi               | Keputusan Diperlukan (Q12)                                       |
| SEC-07 | Keamanan | Enkripsi transmisi (FR: seluruh modul, PAY-02)                                                                                                                  | 100% trafik HTTPS (§4.1.3); TLS ≥ 1.2; HSTS aktif                                                                                                                          | Pindai konfigurasi; akses HTTP                                    | SSL Labs atau testssl.sh                             | Ditetapkan SRS (HTTPS); versi TLS usulan                         |
| SEC-08 | Keamanan | Validasi input dan pencegahan serangan umum (FR: seluruh formulir)                                                                                              | Validasi sisi server untuk semua input; query berparameter; 0 temuan High atau Critical (OWASP Top 10) sebelum rilis; proteksi XSS dan CSRF                                | Uji dengan payload injeksi dan skrip                              | SAST, DAST, uji penetrasi                            | Usulan Analis — Menunggu Konfirmasi                              |
| SEC-09 | Keamanan | Keamanan unggahan berkas (FR: ADM-13, PAY-03, IZN-01, AST-04, AST-05)                                                                                           | Hanya jenis dan ukuran yang diizinkan; nama berkas diacak; pemindaian malware; berkas hanya diakses pihak berwenang                                                        | Unggah berkas terlarang, oversize, tipe palsu; akses URL langsung | Uji fungsional dan uji akses                         | Ditetapkan SRS (pembatasan tipe dan ukuran); detail usulan (Q13) |
| SEC-10 | Keamanan | Keandalan waktu dan lokasi kejadian (FR: PAY-02, AST-04, RPT-03)                                                                                                | Semua waktu presensi dan pelaporan dari server; koordinat, akurasi, identitas perangkat tercatat 100%                                                                      | Ubah jam perangkat lalu presensi                                  | Uji manual dan inspeksi log                          | Ditetapkan SRS                                                   |
| SEC-11 | Keamanan | Penanganan lokasi palsu (GPS spoofing). Klaim bahwa Google Maps API mendeteksi mock location (§5.3) tidak tepat dan sulit dipenuhi pada web tanpa aplikasi (K6) | Minimal: tandai akurasi tidak wajar, lompatan lokasi, dan anomali untuk ditinjau Admin; pemblokiran otomatis hanya jika diputuskan                                         | Perangkat uji dengan aplikasi lokasi palsu                        | Uji lapangan pada perangkat uji                      | Keputusan Diperlukan (Q10)                                       |
| SEC-12 | Keamanan | Identifikasi QR yang aman (FR: AST-03)                                                                                                                          | Identifier acak, tidak berurutan; data profil hanya tampil setelah login dan sesuai peran                                                                                  | Pindai tanpa login; coba tebak ID                                 | Uji penetrasi                                        | Usulan Analis — Menunggu Konfirmasi                              |
| SEC-13 | Keamanan | Pembatasan laju dan perlindungan endpoint (FR: login, API)                                                                                                      | Rate limit per IP dan akun; autentikasi dua faktor untuk Owner dan Admin (opsional)                                                                                        | Uji banjir permintaan                                             | Uji beban dan inspeksi konfigurasi                   | Usulan Analis — Menunggu Konfirmasi                              |
| SEC-14 | Keamanan | Pengelolaan rahasia dan dependensi                                                                                                                              | Kunci API dan kredensial tidak ada di kode sumber; pemindaian kerentanan dependensi pada setiap rilis; 0 kerentanan Critical terbuka                                       | Tinjauan repositori dan pipeline                                  | Pemindai rahasia dan dependensi                      | Usulan Analis — Menunggu Konfirmasi                              |

## 4.3 Keandalan dan Ketersediaan (REL)

| ID     | Kategori  | Deskripsi Kebutuhan                                                                                      | Metrik dan Target                                                                                                                   | Kondisi Pengujian                         | Metode Verifikasi                            | Status                                                        |
|--------|-----------|----------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------|----------------------------------------------|---------------------------------------------------------------|
| REL-01 | Keandalan | Ketersediaan layanan. "Tanpa downtime" pada satu VPS tidak terukur (K9), sehingga diganti target numerik | Uptime ≥ 99,5% per bulan (± 3,6 jam downtime maksimum per bulan); jam kritis (H_KRITIS) diprioritaskan                              | Pemantauan 30 hari berjalan               | Monitoring uptime eksternal, laporan bulanan | Keputusan Diperlukan (Q3)                                     |
| REL-02 | Keandalan | Pemeliharaan terjadwal                                                                                   | Dilakukan di luar H_KRITIS; pemberitahuan ≥ 24 jam sebelumnya                                                                       | Simulasi rilis                            | Tinjauan jadwal rilis                        | Usulan Analis — Menunggu Konfirmasi                           |
| REL-03 | Keandalan | Konsistensi transaksi dan pengendalian konkurensi (FR: ADM-11, AST-03, PAY-02, IZN-05, AST-04)           | 0 jadwal bentrok pada publikasi bersamaan; 0 alokasi unit ganda; 0 presensi ganda; transaksi ACID                                   | Dua sesi paralel melakukan aksi sama      | Uji konkurensi otomatis                      | Ditetapkan SRS (perilaku)                                     |
| REL-04 | Keandalan | Penanganan kegagalan jaringan dan perangkat lapangan (FR: PAY-02, PAY-03, AST-04)                        | Permintaan kirim ulang bersifat idempoten (tidak membuat data ganda); pesan galat jelas; jalur alternatif lewat koreksi (PAY-03)    | Putus koneksi saat kirim lalu kirim ulang | Uji dengan simulasi jaringan buruk           | Usulan Analis — Menunggu Konfirmasi (Q14: perlu mode luring?) |
| REL-05 | Keandalan | Kegagalan layanan eksternal Google Maps (FR: PAY-06, ADM-05, PAY-02)                                     | Presensi tetap berjalan jika jarak rute gagal dihitung; nilai jarak terakhir yang tersimpan dipakai dan ditandai                    | Blokir akses Google API                   | Uji kegagalan layanan                        | Usulan Analis — Menunggu Konfirmasi (K4, Q6)                  |
| REL-06 | Keandalan | Status integrasi gagal tidak diasumsikan siap (FR: ADM-17, ADM-18)                                       | Status "tidak diketahui" ditampilkan, bukan "siap"                                                                                  | Matikan sumber status kesiapan            | Uji fungsional                               | Ditetapkan SRS                                                |
| REL-07 | Keandalan | Pencegahan kehilangan data saat penyimpanan                                                              | Konfirmasi sukses hanya setelah data tersimpan permanen; unggahan berkas atomik dengan data terkait                                 | Matikan server di tengah transaksi        | Uji kegagalan terkendali                     | Usulan Analis — Menunggu Konfirmasi                           |
| REL-08 | Keandalan | Pemulihan otomatis status aset (FR: AST-05)                                                              | Status unit kembali Tersedia otomatis saat tiket Selesai; Tidak Dapat Diperbaiki menjadi Nonaktif setelah konfirmasi Admin (§4.3.2) | Tutup tiket dengan tiap status            | Uji transisi                                 | Ditetapkan SRS                                                |

## 4.4 Kapasitas dan Skalabilitas (CAP)

| ID     | Kategori  | Deskripsi Kebutuhan                                     | Metrik dan Target                                                                                                                                   | Kondisi Pengujian                             | Metode Verifikasi                         | Status                                          |
|--------|-----------|---------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------|-------------------------------------------|-------------------------------------------------|
| CAP-01 | Kapasitas | Pengguna bersamaan pada puncak presensi (FR: PAY-02)    | Mendukung N_C check-in serentak dalam 5 menit dengan 37 lokasi geofence berbeda; beban uji = 2 × N_C; 0 presensi hilang atau ganda                  | Skrip beban dengan koordinat 37 sekolah       | k6 atau JMeter, hitung transaksi          | Keputusan Diperlukan (Q2)                       |
| CAP-02 | Kapasitas | Pengguna terdaftar dan sesi aktif (FR: seluruh modul)   | Mendukung N_T + N_A + N_K + N_Tk + N_O akun; uji 2 × jumlah sesi aktif                                                                              | Beban campuran semua peran                    | Uji beban campuran                        | Keputusan Diperlukan (Q1)                       |
| CAP-03 | Kapasitas | Volume data (FR: ADM-03, PAY-02, AST-04, audit)         | PRF-01 s.d. PRF-13 tetap terpenuhi pada volume proyeksi 3 tahun (N_S, N_U, N_J × hari ajar × tahun)                                                 | Basis data diisi data sintetis volume 3 tahun | Uji performa pada data volume penuh       | Keputusan Diperlukan (Q1)                       |
| CAP-04 | Kapasitas | Penyimpanan berkas (FR: ADM-13, PAY-03, AST-04, AST-05) | Kuota dihitung dari unggahan per bulan × ukuran rata-rata × 36 bulan; peringatan saat pemakaian ≥ 80%                                               | Proyeksi penyimpanan                          | Perhitungan kapasitas dan pemantauan disk | Keputusan Diperlukan (Q13)                      |
| CAP-05 | Kapasitas | Utilisasi sumber daya pada beban puncak                 | CPU dan RAM rata-rata ≤ 70% pada beban uji puncak; spesifikasi minimum VPS ditetapkan setelah uji (SRS: ≥ 4 core CPU dan SSD, RAM kosong)           | Beban CAP-01 selama 30 menit                  | Monitoring sumber daya selama uji         | Ditetapkan SRS (4 core, SSD); angka lain usulan |
| CAP-06 | Kapasitas | Skalabilitas dan perilaku saat kelebihan beban          | Dapat ditingkatkan dengan menaikkan sumber daya VPS tanpa ubah kode; saat kelebihan beban sistem merespons lambat atau antre, bukan kehilangan data | Beban 3 × N_C                                 | Uji stres                                 | Usulan Analis — Menunggu Konfirmasi             |

## 4.5 Integritas dan Audit Data (INT)

| ID     | Kategori   | Deskripsi Kebutuhan                                                                                       | Metrik dan Target                                                                                                                                 | Kondisi Pengujian                                            | Metode Verifikasi                        | Status                                                               |
|--------|------------|-----------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------|------------------------------------------|----------------------------------------------------------------------|
| INT-01 | Integritas | Keunikan data presensi (FR: PAY-02, PAY-04)                                                               | 1 presensi per (tentor, jadwal, tanggal, jenis); dijamin constraint basis data, bukan hanya aplikasi                                              | Kirim presensi ganda paralel                                 | Uji konkurensi dan inspeksi skema        | Ditetapkan SRS (perilaku)                                            |
| INT-02 | Integritas | Hanya presensi Valid masuk perhitungan (FR: PAY-04, PAY-06)                                               | 0 presensi non-Valid terhitung pada honorarium                                                                                                    | Data campuran berbagai status                                | Uji dengan data uji baku                 | Ditetapkan SRS                                                       |
| INT-03 | Integritas | Akurasi perhitungan honorarium (FR: PAY-06)                                                               | Akurasi 100% terhadap perhitungan acuan independen; tipe numerik desimal (bukan float); aturan pembulatan rupiah                                  | Kasus uji baku: pengganti, jarak berbeda, bonus, penyesuaian | Perbandingan dengan perhitungan manual   | Ditetapkan SRS (akurasi 100%); pembulatan Keputusan Diperlukan (Q11) |
| INT-04 | Integritas | Snapshot tarif dan jarak, kekekalan periode (FR: PAY-01, PAY-05, PAY-06, PAY-07)                          | 0 perubahan hasil periode lampau saat tarif atau domisili berubah; periode ditutup dan honorarium disetujui hanya berubah melalui proses tercatat | Ubah tarif dan domisili setelah penutupan lalu hitung ulang  | Uji regresi                              | Ditetapkan SRS                                                       |
| INT-05 | Integritas | Rekonsiliasi hasil (FR: PAY-05, PAY-06)                                                                   | Total rekap = jumlah rincian per tentor = jumlah slip; selisih Rp0                                                                                | Satu periode data uji                                        | Uji rekonsiliasi otomatis                | Usulan Analis — Menunggu Konfirmasi                                  |
| INT-06 | Integritas | Pencatatan audit trail (FR: KU-05, KU-09, PAY-01, PAY-05, PAY-06, PAY-07, PAY-03, IZN-05, AST-03, AST-05) | 100% tindakan penting tercatat dengan pelaku, waktu, objek, tindakan; koreksi mencatat nilai sebelum dan sesudah                                  | Eksekusi setiap tindakan pada AC-KU-05.1                     | Uji per tindakan dan inspeksi log        | Ditetapkan SRS                                                       |
| INT-07 | Integritas | Audit trail tidak dapat diubah (§4.1.4)                                                                   | Append-only; tidak ada fungsi ubah atau hapus log lewat aplikasi atau akun aplikasi basis data; timestamp otomatis                                | Coba ubah dan hapus log                                      | Uji akses basis data dan pemeriksaan hak | Ditetapkan SRS (prinsip); mekanisme usulan                           |
| INT-08 | Integritas | Riwayat tidak dihapus (FR: ADM-01, ADM-04, ADM-05, ADM-16, AST-05)                                        | Penghapusan bersifat soft delete atau nonaktif; riwayat penugasan, keanggotaan, servis tetap ada                                                  | Coba hapus entitas bertaut                                   | Uji fungsional                           | Ditetapkan SRS                                                       |
| INT-09 | Integritas | Integritas referensial dan normalisasi 3NF (§4.3.1, §5.2.3)                                               | 0 data yatim; semua relasi memakai foreign key; perubahan data sekolah otomatis tersedia pada modul lain (AC-ADM-01.6, AC-AST-03.4)               | Hapus atau ubah data induk                                   | Inspeksi skema dan uji integritas        | Ditetapkan SRS                                                       |
| INT-10 | Integritas | Konsistensi mesin status: jadwal, laporan, izin, presensi, penggajian, aset, tiket, penugasan, kesiapan   | 0 transisi ilegal; tiap transisi melalui satu jalur terkontrol                                                                                    | Uji semua transisi sah dan tidak sah                         | Uji state machine otomatis               | Ditetapkan SRS (perilaku); K11 perlu diselaraskan                    |
| INT-11 | Integritas | Versi dokumen dan verifikasi (FR: ADM-13, ADM-18, ADM-19)                                                 | Versi lama dan hasil verifikasi tidak hilang saat unggah ulang                                                                                    | Unggah ulang berkali-kali                                    | Uji fungsional                           | Ditetapkan SRS                                                       |

## 4.6 Backup dan Pemulihan (BCK)

SRS tidak memuat kebutuhan backup sama sekali, sehingga seluruh baris berikut adalah usulan dan bergantung pada Q4 dan Q12.

| ID     | Kategori | Deskripsi Kebutuhan                          | Metrik dan Target                                                                       | Kondisi Pengujian                                            | Metode Verifikasi                 | Status                              |
|--------|----------|----------------------------------------------|-----------------------------------------------------------------------------------------|--------------------------------------------------------------|-----------------------------------|-------------------------------------|
| BCK-01 | Backup   | Frekuensi pencadangan basis data             | Backup penuh harian di luar jam kritis; opsi tambahan log perubahan (binlog) setiap jam | Pemeriksaan jadwal 30 hari                                   | Tinjauan log backup               | Keputusan Diperlukan (Q4)           |
| BCK-02 | Backup   | Target kehilangan data maksimum (RPO)        | RPO ≤ 24 jam pada konfigurasi minimum; opsi RPO ≤ 1 jam jika binlog digunakan           | Simulasi kegagalan; ukur data terakhir yang dapat dipulihkan | Uji restore dan perbandingan data | Keputusan Diperlukan (Q4)           |
| BCK-03 | Backup   | Target waktu pemulihan (RTO)                 | RTO ≤ 4 jam untuk pemulihan penuh ke server cadangan                                    | Restore penuh pada lingkungan kosong                         | Uji restore terukur               | Keputusan Diperlukan (Q4)           |
| BCK-04 | Backup   | Backup berkas unggahan: bukti, dokumen, foto | Dicadangkan dengan jadwal sama; konsisten dengan basis data                             | Restore basis data dan berkas bersamaan                      | Uji restore dan cek tautan berkas | Usulan Analis — Menunggu Konfirmasi |
| BCK-05 | Backup   | Lokasi dan keamanan backup                   | Disimpan di lokasi terpisah dari VPS produksi; terenkripsi; akses dibatasi              | Inspeksi penyimpanan dan hak akses                           | Tinjauan konfigurasi              | Usulan Analis — Menunggu Konfirmasi |
| BCK-06 | Backup   | Retensi backup                               | Contoh: 30 harian dan 12 bulanan; disesuaikan retensi data                              | Tinjauan kebijakan                                           | Inspeksi penyimpanan backup       | Keputusan Diperlukan (Q12)          |
| BCK-07 | Backup   | Uji pemulihan berkala                        | Uji restore minimal satu kali per kuartal, hasil terdokumentasi                         | Restore ke lingkungan staging                                | Laporan uji restore               | Usulan Analis — Menunggu Konfirmasi |
| BCK-08 | Backup   | Pemantauan keberhasilan backup               | Notifikasi ke pengelola jika backup gagal atau tidak berjalan \> 24 jam                 | Gagalkan backup sengaja                                      | Uji alert                         | Usulan Analis — Menunggu Konfirmasi |
| BCK-09 | Backup   | Prosedur pemulihan bencana (runbook)         | Dokumen langkah demi langkah, peran, dan kontak; diuji bersama BCK-07                   | Latihan pemulihan                                            | Tinjauan dokumen dan simulasi     | Usulan Analis — Menunggu Konfirmasi |

## 4.7 Kompatibilitas dan Usability (USA)

| ID     | Kategori       | Deskripsi Kebutuhan                                                                                            | Metrik dan Target                                                                                                                 | Kondisi Pengujian                                                | Metode Verifikasi                 | Status                                                   |
|--------|----------------|----------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------|-----------------------------------|----------------------------------------------------------|
| USA-01 | Kompatibilitas | Dukungan browser (§4.4.1, §5.2.1)                                                                              | Chrome dan Safari didukung; versi minimum: dua versi mayor terakhir (usulan)                                                      | Matriks browser dan versi                                        | Uji lintas browser                | Ditetapkan SRS (jenis); versi Keputusan Diperlukan (Q14) |
| USA-02 | Kompatibilitas | Dukungan perangkat dan OS                                                                                      | Android dan iOS; tanpa instalasi APK pihak ketiga (SRS); versi minimum menyusul                                                   | Perangkat uji beragam kelas                                      | Uji pada perangkat nyata          | Keputusan Diperlukan (Q14)                               |
| USA-03 | Usability      | Antarmuka responsif (§4.4.1, §5.1.2)                                                                           | Berfungsi pada lebar 360 px s.d. 1920 px; Admin di desktop, Owner di tablet, Tentor dan Kurir di ponsel; tanpa scroll horizontal  | Uji pada ukuran layar utama                                      | Uji responsif otomatis dan manual | Ditetapkan SRS (prinsip); batas ukuran usulan            |
| USA-04 | Kompatibilitas | Akses lokasi dan kamera dari browser (FR: PAY-02, AST-04, AST-05)                                              | Izin ditolak menampilkan panduan dan jalur alternatif (koreksi PAY-03); pemindaian QR bekerja di Chrome Android dan Safari iOS    | Tolak dan izinkan izin pada tiap OS                              | Uji lapangan                      | Usulan Analis — Menunggu Konfirmasi                      |
| USA-05 | Usability      | Efisiensi alur lapangan (FR: PAY-02, AST-04, AST-05)                                                           | Presensi selesai ≤ 3 ketukan; pelaporan kerusakan ≤ 5 langkah; pengguna baru menyelesaikan presensi tanpa bantuan dalam ≤ 2 menit | Uji dengan 5 Tentor dan 3 Kurir yang belum pernah memakai sistem | Uji kegunaan terpantau            | Usulan Analis — Menunggu Konfirmasi                      |
| USA-06 | Usability      | Kepuasan penggunaan                                                                                            | Skor SUS ≥ 68 per peran                                                                                                           | Uji penerimaan pengguna                                          | Kuesioner SUS                     | Usulan Analis — Menunggu Konfirmasi                      |
| USA-07 | Usability      | Pesan galat dan validasi jelas (FR: PAY-02, AST-04, ADM-03, RPT-03, IZN-01)                                    | Pesan memuat sebab dan tindakan (mis. jarak ke sekolah); tidak menampilkan detail teknis                                          | Uji skenario galat                                               | Inspeksi UI                       | Ditetapkan SRS (pesan tertentu); standar umum usulan     |
| USA-08 | Usability      | Pembedaan status data (FR: ADM-17, RPT-01, RPT-03)                                                             | Belum diverifikasi vs terverifikasi, PUBLISHED vs kesiapan, terkumpul vs terverifikasi dibedakan; ekspor juga menandai status     | Layar rekap dan ekspor                                           | Inspeksi UI dan ekspor            | Ditetapkan SRS                                           |
| USA-09 | Aksesibilitas  | Aksesibilitas dasar dan isyarat warna (§4.4.2; K14)                                                            | Kontras memenuhi WCAG 2.1 AA; status tidak hanya dibedakan warna (ada teks atau ikon)                                             | Pemindaian aksesibilitas                                         | Axe atau Lighthouse dan inspeksi  | Usulan Analis — Menunggu Konfirmasi                      |
| USA-10 | Usability      | Bahasa dan format lokal                                                                                        | Bahasa Indonesia; zona waktu WIB; format Rp dan tanggal Indonesia                                                                 | Inspeksi seluruh layar                                           | Inspeksi UI                       | Usulan Analis — Menunggu Konfirmasi                      |
| USA-11 | Kompatibilitas | Format keluaran: slip PDF, templat impor Excel, ekspor laporan, stiker QR (FR: PAY-07, ADM-03, RPT-03, AST-03) | Slip PDF dan impor Excel (SRS); format ekspor dan printer termal menunggu; stiker QR terbaca ≥ 99% pada pemindaian uji            | Cetak stiker, pindai 100 percobaan                               | Uji cetak dan pindai              | Keputusan Diperlukan (Q15)                               |

## 4.8 Pemeliharaan dan Monitoring (MNT)

| ID     | Kategori     | Deskripsi Kebutuhan                                                                                    | Metrik dan Target                                                                                                                              | Kondisi Pengujian                                        | Metode Verifikasi                | Status                                         |
|--------|--------------|--------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------|----------------------------------|------------------------------------------------|
| MNT-01 | Pemeliharaan | Log aplikasi terstruktur dan terkorelasi                                                               | Setiap permintaan memiliki request ID; log tidak memuat kata sandi atau token; retensi log 90 hari (usulan)                                    | Telusuri satu transaksi dari klien ke basis data         | Inspeksi log                     | Usulan Analis — Menunggu Konfirmasi            |
| MNT-02 | Monitoring   | Pemantauan galat dan kesehatan sistem                                                                  | Health check endpoint; peringatan jika tingkat galat 5xx \> 1% dalam 5 menit atau layanan tidak merespons                                      | Simulasi galat                                           | Uji alert                        | Usulan Analis — Menunggu Konfirmasi            |
| MNT-03 | Monitoring   | Pemantauan sumber daya                                                                                 | CPU, RAM, disk, koneksi basis data dipantau; peringatan di ≥ 80%                                                                               | Beban uji                                                | Dasbor monitoring                | Usulan Analis — Menunggu Konfirmasi            |
| MNT-04 | Pemeliharaan | Kemudahan diagnosis masalah                                                                            | Admin dapat melihat alasan penolakan presensi dan koordinat tercatat (PAY-04.5); pengembang dapat melacak penyebab galat ≤ 30 menit dengan log | Skenario galat buatan                                    | Latihan diagnosis                | Usulan Analis — Menunggu Konfirmasi            |
| MNT-05 | Pemeliharaan | Parameter dapat diubah tanpa ubah kode (FR: PAY-01, ADM-01, ADM-18, PAY-06, AST-01, AST-05, IZN-08)    | 0 nilai tarif, bonus, durasi sesi, toleransi, radius, ambang stok, tenggat, atau kategori yang di-hardcode                                     | Ubah tiap parameter lalu uji perilaku                    | Tinjauan kode dan uji fungsional | Ditetapkan SRS (parameter dapat dikonfigurasi) |
| MNT-06 | Pemeliharaan | Arsitektur backend tunggal dan modular. SRS menyebut FastAPI "bersama" Laravel (K8)                    | Satu backend resmi; batas modul jelas; dokumentasi API dan ERD                                                                                 | Tinjauan arsitektur                                      | Tinjauan kode dan dokumen        | Keputusan Diperlukan (Q16)                     |
| MNT-07 | Pemeliharaan | Pengujian otomatis logika kritis: geofence, validasi presensi, penggajian, bentrok jadwal, status aset | Cakupan uji otomatis ≥ 80% pada modul kritis; seluruh uji lulus sebelum rilis                                                                  | Pipeline CI                                              | Laporan cakupan                  | Usulan Analis — Menunggu Konfirmasi            |
| MNT-08 | Pemeliharaan | Deployment dan rollback                                                                                | Lingkungan staging terpisah; migrasi skema berversi; rollback ≤ 30 menit                                                                       | Latihan rilis dan rollback                               | Uji prosedur                     | Usulan Analis — Menunggu Konfirmasi            |
| MNT-09 | Pemeliharaan | Dokumentasi untuk pengelola                                                                            | Panduan deployment, backup dan restore, pengelolaan akun, dan daftar parameter                                                                 | Tinjauan oleh pengelola yang tidak terlibat pengembangan | Tinjauan dokumen                 | Usulan Analis — Menunggu Konfirmasi            |
| MNT-10 | Pemeliharaan | Migrasi data awal dari Excel, Google Form, dan Drive (Bab I, II)                                       | 100% data master terimpor dengan laporan rekonsiliasi; masa paralel ditentukan                                                                 | Impor data contoh nyata                                  | Rekonsiliasi jumlah dan sampel   | Keputusan Diperlukan (Q17)                     |

# BAB V ARSITEKTUR DAN LINGKUNGAN TEKNOLOGI

Dalam menerjemahkan desain operasional ERP skala institusional menjadi perwujudan konkret piranti lunak, ekosistem SIM-Edukom didirikan menggunakan pola infrastruktur layanan awan hibrida terdistribusi, memisahkan lapisan klien representasional dari lapisan kueri mesin dan memadukan *framework* web masa kini.

## 5.1 Infrastruktur Komponen dan Perangkat Keras

Keandalan aliran asinkronus memerlukan orkestrasi perpaduan peranti keras berkecepatan komputasi tinggi pada lapisan mesin peladen dan kapabilitas interaktif ujung-klien:

1.  Mesin Pusat Cloud (Server VPS): Titik nadi tempat algoritma ditanam menuntut pengerahan *Virtual Private Server* yang bersenjatakan mesin inti setidaknya 4 Inti Pemrosesan Terpusat (*Quad-Core CPU*), kapabilitas Memori Akses Acak (RAM) <img src="media/image4.png" style="width:0.70703in;height:0.25994in" />, dan ketersediaan penyimpanan *Solid-State Drive* (SSD) isolasi *blob-storage* bagi repositori jutaan ukuran lampiran berkas kurikulum dan faktur penagihan.

2.  Mesin Eksekutor Representasi Klien (Klien Lapangan/Kantor):

    1.  Operasi Manajerial PC: Modul penjadwalan (*Admin*), dioperasikan dengan terminal Komputer Pribadi berlayar lega (*Desktop PC*).

    2.  Instrumen Peninjauan (Tablet): Modul presentasi data audit maupun keputusan (*approval digital*) oleh Pimpinan (*Owner*), dioperasikan murni pada tablet yang memancarkan grafik presisi tinggi.

    3.  Medium Mobilitas Lapangan (*Smartphone*): Gawai ponsel cerdas pribadi pekerja (Tentor/Kurir) dengan dukungan GPS teraktivasi tinggi dan resolusi kamera responsif untuk memantik penanda *QR* aset dan

> mengonsumsi algoritma triangulasi jarak (Modul Gaji & Modul Aset).

3.  Infrastruktur Pencetakan Logistik (Peripherals): Modul Administrasi dan Aset memandu proses interkoneksi pencetak jaringan (*printer*) untuk menerbitkan cetak buku besar laporan keuangan (*PDF*) dan modul stiker *printer* termal untuk memproduksi fisik matriks batang *QR Code* inventaris laptop.

## 5.2 Fondasi Arsitektur Perangkat Lunak dan Bahasa Pemrograman

Sistem direkayasa meninggalkan monolitik konvensional guna mengadopsi model *Decoupled Client-Server*, yang mempercepat penyajian navigasi di medan sinyal lemah.

1.  Lapisan Presentasi Klien (*Frontend UI*): Seluruh representasi navigasi dirender memanfaatkan infrastruktur pustaka *React* berlandaskan pola *Single Page Application* (SPA). Hal ini membebaskan perangkat peramban gawai (seperti Google Chrome atau Apple Safari) dari pemuatan ulang lamban yang menimpa keseluruhan halaman per interaksi (*no-page reloads*), sehingga animasi dasbor pengawas dan matriks *QR* disajikan lebih dinamis.

2.  Infrastruktur API (*Backend Server*): Untuk mengatasi tingginya lonjakan asinkron komputasi algoritma presensi trigonometri dan penyediaan penugasan basis data inventaris, mesin otak operasional mengadopsi *FastAPI* (Python) bersama implementasi paralel *Framework Laravel* (PHP). Keduanya melempar aliran *RESTful API* menuju lapisan *frontend* untuk berkolaborasi menangani transaksi tanpa *latency*.

3.  Mesin Manajemen Relasional Basis Data (DBMS): MySQL dengan spesifikasi proteksi tabel *InnoDB Engine* menaungi konstruksi skema entitas sentral (seperti repositori db_sistemGajiEdukom dll). Lingkungan ini mendikte seluruh batasan (*constraint*) operasional relasional, yang menjamin pergeseran pembaruan dan referensi silang antar-modul (*misal, perpindahan entitas alamat sekolah secara absolut akan mengalihkan catatan lokasi peminjaman aset otomatis*).

## 5.3 Modul Integrasi Pihak Ketiga (Oracles)

Implementasi sistem membatasi ketergantungan API pihak luar secara eksklusif hanya untuk menunjang keamanan spasial:

1.  Google Maps API: Penyediaan orakel algoritma pengenalan bumi (Layanan *Geocoding* serta Matriks Triangulasi Jarak Matriks) mutlak bergantung pada jembatan antarmuka Google Maps. Hal ini bertujuan sebagai pondasi penegakan radius toleransi maya (*Geofencing Validation*), pengkalkulasian jarak tempuh radius gradien pencairan subsidi transpor bagi tenaga pengajar, dan penangkalan infiltrasi dari aplikasi emulator sinyal perangkat *fake* (*Mock Location/GPS spoofing*).

# LAMPIRAN

## Lampiran A \| Matriks Peran

Matriks berikut merangkum kewenangan setiap peran pada fungsi utama. Tanda - berarti peran tidak memiliki akses pada fungsi tersebut. Kewenangan rinci tercantum pada Acceptance Criteria masing-masing fungsi.

| **Fungsi**                                                             | **Owner**                    | **Admin**                            | **Tentor**          | **Tentor Pengganti**         | **Kurir**           | **Teknisi** |
|------------------------------------------------------------------------|------------------------------|--------------------------------------|---------------------|------------------------------|---------------------|-------------|
| ADM-01 sampai ADM-05 Data sekolah, peserta, program, kelompok, tentor  | \-                           | Kelola                               | \-                  | \-                           | \-                  | \-          |
| ADM-03 Lampiran kurikulum                                              | \-                           | Kelola                               | Unggah              | \-                           | \-                  | \-          |
| ADM-06 Ketersediaan waktu mengajar                                     | \-                           | Lihat                                | Isi dan konfirmasi  | \-                           | \-                  | \-          |
| ADM-07 sampai ADM-09 Jadwal, penerbitan, penjadwalan ulang, pembatalan | \-                           | Kelola                               | \-                  | \-                           | \-                  | \-          |
| ADM-10 Kesiapan operasional                                            | \-                           | Pantau                               | \-                  | \-                           | \-                  | \-          |
| ADM-11 Materi rencana                                                  | \-                           | \-                                   | Isi                 | \-                           | \-                  | \-          |
| ADM-12 Kewajiban dokumen dan kelengkapan administrasi                  | Lihat                        | Tetapkan                             | Lihat               | \-                           | \-                  | \-          |
| ADM-13 Unggah dokumen administrasi                                     | \-                           | \-                                   | Ya                  | \-                           | \-                  | \-          |
| ADM-14 Verifikasi dokumen                                              | \-                           | Ya                                   | \-                  | \-                           | \-                  | \-          |
| ADM-15 Kegiatan penilaian                                              | \-                           | Kelola                               | Lihat               | \-                           | \-                  | \-          |
| ADM-16 Nilai dan portofolio                                            | \-                           | \-                                   | Isi                 | \-                           | \-                  | \-          |
| ADM-17 Laporan Pertemuan                                               | \-                           | Catat laporan yang tidak dikirim     | Kirim               | \-                           | \-                  | \-          |
| ADM-18 Verifikasi laporan                                              | Buka kembali                 | Ya                                   | \-                  | \-                           | \-                  | \-          |
| ADM-19 Rekap administrasi pribadi                                      | \-                           | \-                                   | Lihat milik sendiri | \-                           | \-                  | \-          |
| ADM-20 Daftar Tindak Lanjut                                            | Lihat butir Dieskalasi       | Ya                                   | \-                  | \-                           | \-                  | \-          |
| IZN-01, IZN-02 Ajukan izin                                             | \-                           | Putuskan                             | Ya                  | \-                           | \-                  | \-          |
| IZN-03, IZN-04 Pilih dan konfirmasi pengganti                          | \-                           | Tetapkan langsung                    | Pilih               | Konfirmasi                   | \-                  | \-          |
| IZN-05, IZN-06 Pengesahan pergantian                                   | \-                           | Ya                                   | \-                  | Respons Permintaan Kesediaan | \-                  | \-          |
| IZN-07 Eskalasi tanpa pengganti                                        | Putuskan                     | Catat                                | Tandai              | \-                           | \-                  | \-          |
| IZN-08 Riwayat dan rekap izin                                          | Lihat                        | Lihat                                | Milik sendiri       | \-                           | \-                  | \-          |
| PAY-01 Komponen, tarif                                                 | Ubah                         | Lihat                                | \-                  | \-                           | \-                  | \-          |
| PAY-02 Presensi masuk dan pulang                                       | \-                           | Pantau                               | Ya                  | Ya                           | \-                  | \-          |
| PAY-03 Koreksi presensi dan sanggahan                                  | Putuskan penyesuaian         | Putuskan koreksi, tanggapi sanggahan | Ajukan              | Ajukan                       | \-                  | \-          |
| PAY-04 Validasi presensi                                               | \-                           | Ya                                   | Isi klarifikasi     | Isi klarifikasi              | \-                  | \-          |
| PAY-05 Rekap dan penutupan periode                                     | \-                           | Ya                                   | \-                  | \-                           | \-                  | \-          |
| PAY-06 Hitung honorarium                                               | Lihat                        | Ya                                   | \-                  | \-                           | \-                  | \-          |
| PAY-07 Persetujuan dan slip                                            | Setujui                      | Ajukan, lihat slip                   | Slip milik sendiri  | Slip milik sendiri           | \-                  | \-          |
| PAY-08 Catat pembayaran                                                | Lihat                        | Ya                                   | Lihat               | Lihat                        | \-                  | \-          |
| AST-01 Pengajuan pengadaan                                             | \-                           | Ajukan                               | \-                  | \-                           | \-                  | \-          |
| AST-02 Otorisasi pengadaan                                             | Putuskan                     | Lihat                                | \-                  | \-                           | \-                  | \-          |
| AST-03 Inventaris dan QR Code                                          | \-                           | Kelola                               | \-                  | \-                           | \-                  | \-          |
| AST-04 Penugasan distribusi                                            | \-                           | Tetapkan                             | \-                  | \-                           | Lihat tugas sendiri | \-          |
| AST-05 Serah terima perangkat                                          | \-                           | Pantau                               | \-                  | \-                           | Ya                  | \-          |
| AST-06 Laporan kendala perangkat                                       | \-                           | Lapor                                | Lapor               | \-                           | Lapor               | \-          |
| AST-07 Verifikasi laporan kendala                                      | \-                           | Ya                                   | \-                  | \-                           | \-                  | \-          |
| AST-08 Tiket servis                                                    | \-                           | Lihat                                | \-                  | \-                           | \-                  | Ya          |
| AST-09 Status kesiapan perangkat                                       | \-                           | Lihat                                | \-                  | \-                           | \-                  | \-          |
| RPT-01, RPT-02 Dashboard                                               | Ya                           | \-                                   | \-                  | \-                           | \-                  | \-          |
| RPT-03 Pencarian dan ekspor laporan                                    | \-                           | Ya                                   | \-                  | \-                           | \-                  | \-          |
| SET-01 Parameter kebijakan                                             | Ubah                         | Lihat                                | \-                  | \-                           | \-                  | \-          |
| SET-02 Daftar rujukan                                                  | Daftar alasan penolakan izin | Kategori kendala dan Jenis Perangkat | \-                  | \-                           | \-                  | \-          |

## Lampiran B \| Master Status dan Transisi

Daftar status berikut dipakai sebagai rujukan oleh seluruh modul. Tanda ke berarti berpindah ke status berikutnya.

| **Entitas**                                                       | **Status**                                                                                                                                                                                                                                            | **Transisi yang diizinkan**                                                                                                                                                                                                                                                                                                                                                                 |
|-------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| Jadwal dan Pertemuan (ADM-08, ADM-09)                             | DRAFT, PUBLISHED, CANCELLED                                                                                                                                                                                                                           | DRAFT ke PUBLISHED melalui penerbitan. PUBLISHED ke CANCELLED melalui pembatalan. Penjadwalan ulang mempertahankan identitas Pertemuan.                                                                                                                                                                                                                                                     |
| Kerja sama sekolah (ADM-01)                                       | PLANNED, ACTIVE, ENDED, CANCELLED                                                                                                                                                                                                                     | Berubah otomatis menurut tanggal. CANCELLED ditetapkan manual dengan alasan dan tidak berubah lagi.                                                                                                                                                                                                                                                                                         |
| Dokumen administrasi (ADM-13, ADM-14)                             | SUBMITTED, VERIFIED, NEEDS_REVISION, SUPERSEDED                                                                                                                                                                                                       | SUBMITTED ke VERIFIED atau NEEDS_REVISION. SUBMITTED ke SUPERSEDED bila versi baru diunggah.                                                                                                                                                                                                                                                                                                |
| Laporan Pertemuan (ADM-17, ADM-18)                                | NOT_SUBMITTED, SUBMITTED, VERIFIED, NEEDS_REVISION, CANCELLED                                                                                                                                                                                         | NOT_SUBMITTED ke SUBMITTED. SUBMITTED ke VERIFIED atau NEEDS_REVISION. VERIFIED dibuka kembali hanya oleh Owner menjadi versi baru NEEDS_REVISION.                                                                                                                                                                                                                                          |
| Kasus Penggantian dan Permintaan Kesediaan (IZN-01 sampai IZN-07) | Menunggu Pengganti, Menunggu Konfirmasi, Menunggu Admin, Perlu Tindak Lanjut, Dieskalasi, Disetujui, Ditolak, Ditarik, Kedaluwarsa, Dijadwalkan Ulang, Dibatalkan. Permintaan Kesediaan: Menunggu Respons, Diterima, Ditolak, Kedaluwarsa, Dibatalkan | Kasus menunggu pengganti, konfirmasi, lalu pengesahan Admin. Kasus tanpa pengganti menjadi Perlu Tindak Lanjut dan dapat Dieskalasi kepada Owner. Perubahan pelaksana hanya berlaku pada status Disetujui (IZN-05).                                                                                                                                                                         |
| Presensi sesi                                                     | Menunggu Validasi, Valid, Perlu Klarifikasi, Tidak Valid, Dibatalkan                                                                                                                                                                                  | Menunggu Validasi ke Valid, Perlu Klarifikasi, atau Tidak Valid. Perlu Klarifikasi ke Valid atau Tidak Valid. Valid ke Dibatalkan bila sesi ditandai Dibatalkan Sekolah.                                                                                                                                                                                                                    |
| Penanda presensi                                                  | Terlambat, Terlambat Melebihi Toleransi, Belum Check-Out, Tidak Sesuai Jadwal, Tidak Hadir, Dibatalkan Sekolah, Pengganti, Dikoreksi, Izin Menunggu Keputusan                                                                                         | Penanda tidak mengubah status, tetapi menjadi dasar keputusan.                                                                                                                                                                                                                                                                                                                              |
| Koreksi presensi                                                  | Diajukan, Perlu Informasi Tambahan, Diterima, Ditolak, Ditarik                                                                                                                                                                                        | Diajukan ke Perlu Informasi Tambahan, Diterima, Ditolak, atau Ditarik. Perlu Informasi Tambahan ke Diajukan (unggah ulang) atau Ditolak.                                                                                                                                                                                                                                                    |
| Periode                                                           | Terbuka, Ditutup, Menunggu Persetujuan, Disetujui, Disetujui Sebagian, Ditolak                                                                                                                                                                        | Terbuka ke Ditutup. Ditutup ke Terbuka (sebelum disetujui) atau Menunggu Persetujuan. Menunggu Persetujuan ke Disetujui, Disetujui Sebagian, atau Ditutup (ditarik atau ditolak).                                                                                                                                                                                                           |
| Pembayaran                                                        | Belum Dibayar, Dibayar Sebagian, Dibayar, Tertunda                                                                                                                                                                                                    | Belum Dibayar ke Dibayar Sebagian, Dibayar, atau Tertunda. Tertunda dan Dibayar Sebagian ke Dibayar.                                                                                                                                                                                                                                                                                        |
| Sanggahan                                                         | Diajukan, Perlu Informasi Tambahan, Diproses, Diterima, Ditolak, Ditarik, Selesai                                                                                                                                                                     | Diajukan ke Perlu Informasi Tambahan, Diproses, atau Ditarik. Diproses ke Diterima atau Ditolak. Diterima atau Ditolak ke Selesai.                                                                                                                                                                                                                                                          |
| Kelengkapan administrasi                                          | Belum Lengkap, Lengkap                                                                                                                                                                                                                                | Berubah otomatis atau melalui koreksi Admin dengan alasan.                                                                                                                                                                                                                                                                                                                                  |
| Pengajuan pengadaan (AST-01, AST-02)                              | Diajukan, Disetujui, Ditolak, Dibatalkan                                                                                                                                                                                                              | Diajukan ke Disetujui, Ditolak, atau Dibatalkan. Pengajuan Ditolak tidak diedit ulang dan dibuat ulang sebagai pengajuan baru.                                                                                                                                                                                                                                                              |
| Aset (AST-03 sampai AST-08)                                       | Tersedia, Terdistribusi, Rusak, Perbaikan, Hilang, Nonaktif                                                                                                                                                                                           | Tersedia ke Terdistribusi saat pengantaran lolos validasi. Terdistribusi ke Tersedia saat penjemputan lolos validasi. Rusak saat laporan Unit tidak berfungsi dikirim, lalu Perbaikan setelah dikonfirmasi Admin, Tersedia bila tiket Selesai, atau Nonaktif bila Tidak Dapat Diperbaiki. Penolakan laporan mengembalikan status sebelumnya hanya bila unit masih Rusak akibat laporan itu. |
| Penugasan distribusi (AST-04, AST-05)                             | Ditugaskan, Sedang Berjalan, Selesai, Dibatalkan                                                                                                                                                                                                      | Sedang Berjalan dicapai otomatis setelah unit pertama berhasil dipindai. Selesai bila setiap unit berhasil dipindai atau dilaporkan Tidak Ditemukan.                                                                                                                                                                                                                                        |
| Laporan Kendala Perangkat (AST-06, AST-07)                        | Dilaporkan, Dikonfirmasi, Ditolak, Selesai                                                                                                                                                                                                            | Dilaporkan ke Dikonfirmasi atau Ditolak. Dikonfirmasi ke Selesai saat tiket Selesai atau Tidak Dapat Diperbaiki, atau ditutup Admin untuk kendala non-kerusakan.                                                                                                                                                                                                                            |
| Tiket Servis (AST-08)                                             | Dibuka, Diproses, Selesai, Menunggu Konfirmasi Admin, Tidak Dapat Diperbaiki                                                                                                                                                                          | Dibuka ke Diproses. Diproses ke Selesai atau Menunggu Konfirmasi Admin. Tiket Selesai tidak dapat dibuka kembali.                                                                                                                                                                                                                                                                           |

## Lampiran C \| Tabel Keputusan Honorarium

Tabel berikut menjadi rujukan perlakuan honorarium untuk PAY-06. Kondisi diberi nomor C-1 sampai C-11.

| **No** | **Kondisi**                                            | **Tentor asli**                                           | **Tentor pengganti**         | **Transportasi**        |
|--------|--------------------------------------------------------|-----------------------------------------------------------|------------------------------|-------------------------|
| C-1    | Hadir tepat waktu atau terlambat ≤ 30 menit            | Dibayar penuh per sesi                                    | \-                           | Mengikuti sesi Valid    |
| C-2    | Terlambat \> 30 menit                                  | Perlu Klarifikasi. Valid: dibayar penuh. Tidak Valid: Rp0 | \-                           | Mengikuti keputusan     |
| C-3    | Lupa check-out                                         | Koreksi disetujui: dibayar. Tanpa koreksi: tidak dibayar  | \-                           | Mengikuti keputusan     |
| C-4    | Izin terencana disetujui, pengganti hadir              | Rp0                                                       | Dibayar penuh                | Dari domisili pengganti |
| C-5    | Izin mendesak disetujui, pengganti hadir               | Rp0                                                       | Dibayar penuh                | Dari domisili pengganti |
| C-6    | Izin sakit disetujui, pengganti hadir                  | Rp0                                                       | Dibayar penuh                | Dari domisili pengganti |
| C-7    | Izin disetujui tanpa pengganti, sesi dibatalkan Edukom | Rp0                                                       | \-                           | Rp0                     |
| C-8    | Izin ditolak, tentor tidak hadir                       | Tidak Hadir, Rp0, tanpa sanksi                            | \-                           | Rp0                     |
| C-9    | Sekolah membatalkan mendadak, tentor sudah hadir       | Rp0                                                       | \-                           | Rp0                     |
| C-10   | Pengganti disetujui tetapi tidak hadir                 | Rp0                                                       | Tidak Hadir, Rp0             | Rp0                     |
| C-11   | Sesi dijadwalkan ulang                                 | Sesi asal tidak dibayar. Sesi baru dibayar bila Valid     | Sesi baru dibayar bila Valid | Mengikuti sesi baru     |

## Lampiran D \| Daftar Parameter

Parameter berikut dikelola Owner pada SET-01. Kolom Dipakai pada memuat fungsi yang menggunakan nilai tersebut.

| **Parameter**                                    | **Nilai awal**                                          | **Dipakai pada** |
|--------------------------------------------------|---------------------------------------------------------|------------------|
| Durasi satu sesi                                 | 70 menit                                                | PAY-01, PAY-02   |
| Toleransi keterlambatan                          | 30 menit                                                | PAY-02, PAY-04   |
| Presensi masuk dibuka                            | 15 menit sebelum jam mulai sampai jam selesai sesi      | PAY-02           |
| Presensi pulang dibuka                           | 15 menit sebelum jam selesai sesi, hari yang sama       | PAY-02           |
| Akurasi lokasi maksimal                          | 50 meter                                                | PAY-02           |
| Radius sekolah (Modul Administrasi)              | 150 meter                                               | PAY-02           |
| Pengingat check-out                              | Jam selesai sesi dan pukul 20.00 WIB                    | PAY-02           |
| Batas jarak transportasi                         | 10 km (Rp10.000 hingga 10 km, Rp15.000 di atas 10 km)   | PAY-01, PAY-06   |
| Batas pengajuan koreksi presensi                 | 60 hari kalender, sebelum periode ditutup               | PAY-03           |
| Unggah ulang koreksi                             | 3 kali dalam 3 hari                                     | PAY-03           |
| Berkas bukti                                     | JPG, PNG, PDF; 5 MB per berkas; 5 berkas                | PAY-03           |
| Pengingat Perlu Klarifikasi                      | 3 hari sebelum cut-off                                  | PAY-04           |
| Waktu penandaan Tidak Hadir                      | Setiap hari pukul 23.59 WIB                             | PAY-04           |
| Cut-off periode                                  | Hari terakhir bulan pukul 23.59 WIB                     | PAY-05           |
| Ambang peringatan honorarium tidak lazim         | Nol atau selisih lebih dari 30% dari periode sebelumnya | PAY-06           |
| Pengingat keputusan Owner                        | Lebih dari 2 hari                                       | PAY-07           |
| Batas sanggahan                                  | 14 hari kalender setelah slip terbit                    | PAY-03           |
| Tanggapan Admin atas sanggahan                   | 3 hari kerja                                            | PAY-03           |
| Batas izin terencana                             | H-3 pukul 23.59 WIB                                     | IZN-01           |
| Batas keputusan Admin atas izin                  | 2 jam sebelum jam mulai sesi                            | IZN-01           |
| Respons pengganti                                | 24 jam (terencana), 1 jam (mendesak)                    | IZN-04           |
| Peringatan jeda antar sekolah                    | Kurang dari 30 menit                                    | IZN-03           |
| Batas koreksi retroaktif izin                    | 3 hari setelah sesi                                     | IZN-05           |
| Tenggat penanganan tanpa pengganti               | Paling lambat H-1                                       | IZN-07           |
| Ambang frekuensi izin per periode                | Diisi Owner                                             | IZN-08           |
| Jam layanan Admin                                | Diisi Owner                                             | IZN-02           |
| Masa simpan bukti, lampiran, slip, dan audit log | 6 bulan                                                 | Seluruh modul    |
| Radius sekolah (nilai awal sekolah baru)         | 150 meter (diatur per sekolah pada ADM-01)              | PAY-02, AST-05   |
| Tenggat laporan Pertemuan                        | 48 jam setelah jam selesai Pertemuan                    | ADM-17           |
| Batas ekspor                                     | Diisi Owner                                             | KU-08            |

## Lampiran E \| Daftar Keputusan dan Hal yang Perlu Diisi

Daftar berikut memuat keputusan yang telah diambil dan hal yang masih perlu dilengkapi sebelum sistem dirilis.

| **No** | **Butir**                                                           | **Keputusan atau status**                                                                                       | **PIC** |
|--------|---------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------|---------|
| 1      | Istilah peran                                                       | Owner sama dengan Pimpinan, satu akun, tanpa peran Keuangan terpisah                                            | Owner   |
| 2      | Unit izin dan pengganti                                             | H-3: per jadwal. Hari-H dan mendesak: per sesi                                                                  | Owner   |
| 3      | Koreksi setelah tutup, setuju, atau bayar                           | Sebelum persetujuan Owner periode dapat dibuka kembali. Sesudahnya selisih menjadi penyesuaian periode berjalan | Owner   |
| 4      | Alasan sesi tidak berlangsung                                       | Dibatalkan Sekolah, Libur, Dibatalkan Edukom, Dijadwalkan Ulang, ditandai di Modul Administrasi                 | Admin   |
| 5      | Saluran notifikasi                                                  | Notifikasi web saja                                                                                             | Owner   |
| 6      | Masa simpan                                                         | 6 bulan untuk bukti, lampiran, slip, dan audit log                                                              | Owner   |
| 7      | Batas pengajuan koreksi                                             | 60 hari kalender, selama periode belum ditutup                                                                  | Owner   |
| 8      | Penyimpanan berkas                                                  | Object storage pada VPS                                                                                         | Owner   |
| 9      | Metode jarak                                                        | Jarak rute jalan                                                                                                | Owner   |
| 10     | Sanksi ketidakhadiran                                               | Tidak ada sanksi, hanya tidak dibayar                                                                           | Owner   |
| 11     | Daftar 10 jenis dokumen administrasi                                | Diisi Owner pada master dokumen di Modul Administrasi sebelum rilis                                             | Owner   |
| 12     | Jam layanan Admin dan pengganti Admin                               | Jam layanan diisi Owner. Di luar jam itu Owner memproses izin mendesak                                          | Owner   |
| 13     | Ambang frekuensi izin                                               | Diisi Owner. Tanpa nilai, penanda tidak aktif                                                                   | Owner   |
| 14     | Daftar alasan penolakan izin                                        | Disusun Owner sebagai daftar baku                                                                               | Owner   |
| 15     | Contoh slip dan sekolah yang mewajibkan lembar fisik                | Disediakan Edukom sebelum rilis                                                                                 | Admin   |
| 16     | Jumlah jenis dokumen administrasi tentor                            | Dokumen ini memakai 6 jenis (ADM-12). Owner perlu menegaskan apakah 6 atau jumlah lain yang berlaku             | Owner   |
| 17     | Tenggat pengajuan dan keputusan izin                                | Satu set tenggat yang sama dipakai pada IZN-01 sampai IZN-05. Owner perlu menegaskan                            | Owner   |
| 18     | Perlakuan honorarium bagi pengganti yang disetujui lalu tidak hadir | Mengikuti PAY-04 dan Lampiran C. Owner perlu menegaskan                                                         | Owner   |

## Lampiran F \| Pemetaan Kode Lama ke Kode Baru

Tabel berikut membantu menelusuri kode kebutuhan dari versi sebelumnya ke versi ini. Kode lama yang digabung atau dihapus diberi keterangan.

| **Kode lama** | **Kode baru** | **Fungsi**                                                                 |
|---------------|---------------|----------------------------------------------------------------------------|
| ADM-01        | ADM-01        | Pengelolaan Data Sekolah Mitra dan Kerja Sama                              |
| ADM-02        | ADM-02        | Pengelolaan Peserta Berdasarkan Formulir Sekolah                           |
| ADM-03        | ADM-03        | Katalog Program dan Penetapan Program per Semester                         |
| ADM-04        | ADM-04        | Perhitungan Kapasitas, Pembagian Kelompok, dan Rencana Sesi                |
| ADM-05        | ADM-05        | Pengelolaan Data dan Status Keaktifan Tentor                               |
| ADM-06        | ADM-06        | Pengisian dan Konfirmasi Ketersediaan Waktu Mengajar                       |
| ADM-07        | ADM-08        | Penyusunan dan Penerbitan Jadwal                                           |
| ADM-08        | ADM-11        | Pengisian Materi Rencana per Pertemuan                                     |
| ADM-09        | ADM-12        | Pengaturan Kewajiban Dokumen Administrasi Tentor dan Status Kelengkapan    |
| ADM-10        | ADM-13        | Pengunggahan dan Perbaikan Dokumen Administrasi                            |
| ADM-11        | ADM-14        | Verifikasi Kelengkapan dan Kesesuaian Isi Dokumen                          |
| ADM-12        | IZN-03        | Pemilihan Tentor Pengganti dan Rekomendasi Calon                           |
| ADM-13        | IZN-05        | Peninjauan dan Pengesahan Tentor Pengganti                                 |
| ADM-14        | ADM-10        | Pemantauan dan Tindak Lanjut Kesiapan Operasional                          |
| ADM-15        | ADM-16        | Pencatatan Nilai dan Portofolio Siswa                                      |
| ADM-16        | ADM-17        | Pencatatan dan Pengiriman Laporan Pertemuan                                |
| ADM-17        | ADM-18        | Pemeriksaan dan Verifikasi Laporan Pertemuan                               |
| ADM-18        | ADM-19        | Rekapitulasi Administrasi Pribadi Tentor                                   |
| ADM-19        | RPT-01        | Dashboard Monitoring Administrasi Pembelajaran bagi Owner                  |
| ADM-20        | RPT-03        | Pencarian dan Ekspor Laporan Administrasi                                  |
| AST-01        | AST-01        | Pengajuan Kebutuhan Pengadaan Aset                                         |
| AST-02        | AST-02        | Otorisasi dan Persetujuan Pengadaan Aset                                   |
| AST-03        | AST-03        | Manajemen Data Master Inventaris Aset dan QR Code                          |
| AST-04        | AST-03        | Manajemen Data Master Inventaris Aset dan QR Code                          |
| AST-05        | AST-04        | Penugasan Distribusi Perangkat Terpusat                                    |
| AST-06        | AST-05        | Serah Terima Perangkat Berbasis Geofencing (Pengantaran dan Penjemputan)   |
| AST-07        | AST-05        | Serah Terima Perangkat Berbasis Geofencing (Pengantaran dan Penjemputan)   |
| AST-08        | AST-06        | Pelaporan Kendala Perangkat via QR Code                                    |
| AST-09        | AST-07        | Verifikasi Laporan Kendala Perangkat dan Tindak Lanjut                     |
| AST-10        | AST-08        | Pencatatan Riwayat Penanganan (Ticketing Servis)                           |
| AST-11        | RPT-02        | Dashboard Pemantauan dan Rekapitulasi Aset bagi Owner                      |
| AST-12        | AST-09        | Penyediaan Status Kesiapan Perangkat dan Ekspedisi bagi Modul Administrasi |
| IZN-01        | IZN-01        | Pengajuan Izin Terencana                                                   |
| IZN-02        | IZN-03        | Pemilihan Tentor Pengganti dan Rekomendasi Calon                           |
| IZN-03        | IZN-04        | Konfirmasi Pengganti                                                       |
| IZN-04        | IZN-05        | Peninjauan dan Pengesahan Tentor Pengganti                                 |
| IZN-05        | IZN-02        | Izin Mendesak                                                              |
| IZN-06        | IZN-08        | Riwayat dan Rekap Izin                                                     |
| IZN-07        | IZN-07        | Eskalasi Izin tanpa Pengganti                                              |
| PAY-01        | PAY-01        | Pengelolaan Komponen dan Tarif Honorarium                                  |
| PAY-02        | PAY-02        | Pencatatan Presensi Berbasis Lokasi (Check-In dan Check-Out)               |
| PAY-03        | PAY-03        | Pengajuan Koreksi Presensi dan Sanggahan Honorarium                        |
| PAY-04        | PAY-04        | Validasi dan Pencocokan Presensi                                           |
| PAY-05        | PAY-05        | Rekap Presensi dan Penutupan Periode                                       |
| PAY-06        | PAY-06        | Perhitungan Honorarium                                                     |
| PAY-07        | PAY-07        | Persetujuan Owner dan Penerbitan Slip Honorarium                           |
| PAY-08        | PAY-07        | Persetujuan Owner dan Penerbitan Slip Honorarium                           |
| PAY-09        | PAY-08        | Pencatatan Pembayaran Honorarium                                           |
| PAY-10        | PAY-03        | Pengajuan Koreksi Presensi dan Sanggahan Honorarium                        |
| PAY-11        | ADM-12        | Pengaturan Kewajiban Dokumen Administrasi Tentor dan Status Kelengkapan    |

## Lampiran G \| Pemetaan Kode Fungsi Modul ke Kebutuhan Fungsional per Peran

Tabel berikut menghubungkan kode fungsi berbasis modul yang masih dirujuk pada BAB IV dan lampiran lain dengan kode kebutuhan fungsional per peran pada BAB III. Satu fungsi modul dapat dijalankan oleh beberapa peran dengan tanggung jawab yang berbeda.

| **Kode Modul** | **Fungsi**                                                              | **Kebutuhan per Peran**           |
|----------------|-------------------------------------------------------------------------|-----------------------------------|
| ADM-01         | Pengelolaan Data Sekolah Mitra dan Kerja Sama                           | AD-01                             |
| ADM-02         | Pengelolaan Peserta Berdasarkan Formulir Sekolah                        | AD-02                             |
| ADM-03         | Katalog Program dan Penetapan Program per Semester                      | AD-03, TN-04                      |
| ADM-04         | Perhitungan Kapasitas, Pembagian Kelompok, dan Rencana Sesi             | AD-04                             |
| ADM-05         | Pengelolaan Data dan Status Keaktifan Tentor                            | AD-05                             |
| ADM-06         | Pengisian dan Konfirmasi Ketersediaan Waktu Mengajar                    | TN-01, AD-07                      |
| ADM-07         | Kesepakatan Jadwal, Jam Sekolah, dan Tanggal Tidak Efektif              | AD-06                             |
| ADM-08         | Penyusunan dan Penerbitan Jadwal                                        | AD-07, TN-02                      |
| ADM-09         | Penjadwalan Ulang dan Pembatalan Pertemuan                              | AD-08                             |
| ADM-10         | Pemantauan dan Tindak Lanjut Kesiapan Operasional                       | AD-09                             |
| ADM-11         | Pengisian Materi Rencana per Pertemuan                                  | TN-03                             |
| ADM-12         | Pengaturan Kewajiban Dokumen Administrasi Tentor dan Status Kelengkapan | AD-10                             |
| ADM-13         | Pengunggahan dan Perbaikan Dokumen Administrasi                         | TN-05, TN-02                      |
| ADM-14         | Verifikasi Kelengkapan dan Kesesuaian Isi Dokumen                       | AD-11                             |
| ADM-15         | Pengelolaan Kegiatan Penilaian                                          | AD-12, TN-06                      |
| ADM-16         | Pencatatan Nilai dan Portofolio Siswa                                   | TN-06                             |
| ADM-17         | Pencatatan dan Pengiriman Laporan Pertemuan                             | TN-07, AD-13                      |
| ADM-18         | Pemeriksaan dan Verifikasi Laporan Pertemuan                            | AD-13, OW-06                      |
| ADM-19         | Rekapitulasi Administrasi Pribadi Tentor                                | TN-08                             |
| ADM-20         | Daftar Tindak Lanjut                                                    | AD-14, OW-10                      |
| IZN-01         | Pengajuan Izin Terencana                                                | TN-09, AD-15                      |
| IZN-02         | Izin Mendesak                                                           | TN-10, AD-15, OW-04               |
| IZN-03         | Pemilihan Tentor Pengganti dan Rekomendasi Calon                        | TN-11                             |
| IZN-04         | Konfirmasi Pengganti                                                    | TN-12                             |
| IZN-05         | Peninjauan dan Pengesahan Tentor Pengganti                              | AD-15                             |
| IZN-06         | Penggantian Pertemuan karena Tentor Nonaktif                            | AD-16, TN-12                      |
| IZN-07         | Eskalasi Izin tanpa Pengganti                                           | AD-17, OW-05, TN-11               |
| IZN-08         | Riwayat dan Rekap Izin                                                  | TN-13, AD-18, OW-12               |
| PAY-01         | Pengelolaan Komponen dan Tarif Honorarium                               | OW-01, AD-27                      |
| PAY-02         | Pencatatan Presensi Berbasis Lokasi                                     | TN-14, AD-19                      |
| PAY-03         | Pengajuan Koreksi Presensi dan Sanggahan Honorarium                     | TN-15, TN-16, AD-20, AD-25, OW-08 |
| PAY-04         | Validasi dan Pencocokan Presensi                                        | AD-21, TN-15                      |
| PAY-05         | Rekap Presensi dan Penutupan Periode                                    | AD-22                             |
| PAY-06         | Perhitungan Honorarium                                                  | AD-23                             |
| PAY-07         | Persetujuan Owner dan Penerbitan Slip Honorarium                        | OW-07, AD-24, TN-17               |
| PAY-08         | Pencatatan Pembayaran Honorarium                                        | AD-26, TN-17, OW-13               |
| AST-01         | Pengajuan Kebutuhan Pengadaan Aset                                      | AD-28                             |
| AST-02         | Otorisasi dan Persetujuan Pengadaan Aset                                | OW-09                             |
| AST-03         | Manajemen Data Master Inventaris Aset dan QR Code                       | AD-29, KR-05                      |
| AST-04         | Penugasan Distribusi Perangkat Terpusat                                 | AD-30, KR-01                      |
| AST-05         | Serah Terima Perangkat Berbasis Geofencing                              | KR-02, KR-03, AD-31               |
| AST-06         | Pelaporan Kendala Perangkat via QR Code                                 | TN-18, KR-04, AD-32               |
| AST-07         | Verifikasi Laporan Kendala Perangkat dan Tindak Lanjut                  | AD-32                             |
| AST-08         | Pencatatan Riwayat Penanganan (Ticketing Servis)                        | TK-01, TK-02, TK-03, AD-32        |
| AST-09         | Penyediaan Status Kesiapan Perangkat dan Ekspedisi                      | AD-09                             |
| RPT-01         | Dashboard Monitoring Administrasi Pembelajaran                          | OW-10                             |
| RPT-02         | Dashboard Pemantauan dan Rekapitulasi Aset                              | OW-11                             |
| RPT-03         | Pencarian dan Ekspor Laporan Administrasi                               | AD-34                             |
| SET-01         | Pengelolaan Parameter Kebijakan Sistem                                  | OW-02, AD-27                      |
| SET-02         | Pengelolaan Daftar Rujukan                                              | OW-03, AD-33                      |
