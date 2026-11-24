**Dokumen Spesifikasi Kebutuhan Perangkat Lunak (Software Requirements Specification)**

Sistem Informasi Manajemen Terintegrasi

|                               |                                    |
|-------------------------------|------------------------------------|
| **Di susun Oleh :**           |                                    |
| **Choiruddin Effendi**        | **5230311068 ( Project Manager )** |
| **Agis Maulana**              | **5230311042 (Developer)**         |
| **Ramaditya Naufal Ramadhan** | **(Developer)**                    |

<img src="media/image1.png" style="width:4.01111in;height:4.01111in" />

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

1.  Penyajian jadwal mengajar yang telah ditetapkan oleh Admin melalui akun masing-masing tentor.

2.  Pencatatan presensi masuk (*check-in*) dan presensi pulang (*check-out*) menggunakan geolocation dan geofencing berdasarkan koordinat sekolah mitra dan radius yang ditetapkan.

3.  Penyimpanan data presensi beserta waktu pelaksanaan sebagai dasar pemeriksaan dan perhitungan honorarium.

4.  Otomatisasi perhitungan komponen honorarium, yang meliputi uang kehadiran, uang transportasi, honor mengajar per sesi, dan bonus sesuai ketentuan perusahaan.

5.  Pengelolaan hasil rekapitulasi penggajian, validasi dan persetujuan pimpinan, serta penerbitan slip gaji digital yang dapat diakses oleh tentor sesuai hak aksesnya.

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

|                                             |                                                                                                                                                                                                                                                                                           |
|---------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| **Istilah**                                 | **Definisi**                                                                                                                                                                                                                                                                              |
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

<img src="media/image2.png" style="width:5.55521in;height:8.50206in" />

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

Bagian ini memuat ketentuan yang berlaku bagi seluruh modul. Fungsi pada modul lain merujuk ketentuan ini dengan kode KU dan tidak mengulang isinya, sehingga satu aturan hanya ditulis satu kali.

### Susunan Penulisan Kebutuhan Fungsional

Setiap kebutuhan fungsional ditulis dengan susunan yang sama: judul dengan kode dan nama fungsi (misalnya ADM-08 \| Penyusunan dan Penerbitan Jadwal), SRS — Kebutuhan Fungsional yang berisi uraian ringkas, User Story, dan Acceptance Criteria. Kode AC diberi nomor urut AC-\[kode fungsi\].\[nomor\], misalnya AC-ADM-08.1, dan tidak berubah selama dokumen ini berlaku.

### Kode Modul

| **Kode** | **Modul**                          | **Bagian** |
|----------|------------------------------------|------------|
| ADM      | Administrasi Pembelajaran          | 3.2        |
| IZN      | Izin dan Penggantian Tentor        | 3.3        |
| PAY      | Presensi dan Penggajian Tentor IT  | 3.4        |
| AST      | Manajemen Aset dan Ekspedisi       | 3.5        |
| RPT      | Pelaporan dan Dashboard            | 3.6        |
| SET      | Pengaturan Sistem                  | 3.7        |
| KU       | Ketentuan Umum dan Layanan Bersama | 3.1        |

### Istilah Baku

Istilah berikut dipakai secara konsisten pada seluruh kebutuhan fungsional: Owner (bukan Pimpinan), Admin, Tentor, Tentor Pengganti, Pertemuan (satu sesi pembelajaran yang dijadwalkan, berdurasi 70 menit), Jadwal, Penugasan Sah (tentor yang berwenang melaksanakan Pertemuan), dan Periode (satu bulan kalender). Definisi lengkap tercantum pada bagian 1.4.

### KU-01 \| Perhitungan Jarak Domisili dan Sekolah

SRS — Kebutuhan Fungsional

Sistem harus menghitung jarak antara domisili tentor dan sekolah dengan satu metode yang sama bagi semua fungsi yang membutuhkannya, yaitu rekomendasi calon pengganti (IZN-03), peringatan jeda antar sekolah, dan uang transportasi (PAY-06).

User Story

**KU-01** Sebagai Owner, saya ingin jarak dihitung dengan satu metode baku agar rekomendasi pengganti dan uang transportasi memakai angka yang sama.

Acceptance Criteria

AC-KU-01.1. Jarak dihitung sebagai jarak rute jalan dari titik koordinat domisili tentor ke titik koordinat sekolah melalui layanan peta pihak ketiga, bukan jarak garis lurus.

AC-KU-01.2. Hasil dibulatkan satu desimal dalam kilometer dan disimpan bersama tanggal perhitungan.

AC-KU-01.3. Bila layanan peta tidak tersedia atau koordinat belum lengkap, sistem menampilkan keterangan Jarak Belum Tersedia, tidak memblokir proses lain, dan Admin dapat memasukkan jarak secara manual dengan alasan yang tercatat.

AC-KU-01.4. Perubahan koordinat domisili atau sekolah tidak mengubah jarak yang sudah dipakai pada periode penggajian yang telah ditutup.

### KU-02 \| Validasi Lokasi dan Geofence

SRS — Kebutuhan Fungsional

Sistem harus memakai satu aturan validasi lokasi bagi presensi tentor (PAY-02) dan bukti serah terima perangkat (AST-05) agar penilaian di dalam atau di luar area sekolah konsisten.

User Story

**KU-02** Sebagai Admin, saya ingin validasi lokasi memakai aturan yang sama pada presensi dan serah terima agar hasilnya dapat dibandingkan dan dipertanggungjawabkan.

Acceptance Criteria

AC-KU-02.1. Lokasi dinyatakan sesuai bila jarak antara koordinat perangkat dan titik sekolah tidak melebihi radius geofence sekolah pada ADM-01 (nilai awal 150 meter), dihitung dengan rumus Haversine.

AC-KU-02.2. Koordinat dibaca pada saat tombol ditekan atau foto diambil, dan hanya diterima bila akurasi lokasi tidak melebihi batas pada Lampiran D (nilai awal 50 meter).

AC-KU-02.3. Bila lokasi tidak sesuai atau akurasi melebihi batas, sistem menolak aksi atau mengalihkannya ke jalur pengecualian yang diatur pada fungsi masing-masing, dan menyimpan koordinat, akurasi, serta waktu percobaan.

AC-KU-02.4. Izin akses lokasi dari perangkat wajib diberikan pengguna. Bila ditolak, sistem menampilkan petunjuk mengaktifkannya.

### KU-03 \| Notifikasi

SRS — Kebutuhan Fungsional

Sistem harus menyampaikan pemberitahuan kepada pengguna melalui satu mekanisme notifikasi yang sama bagi seluruh modul.

User Story

**KU-03** Sebagai pengguna sistem, saya ingin menerima pemberitahuan atas hal yang memerlukan tindakan saya agar tidak ada proses yang tertunda tanpa disadari.

Acceptance Criteria

AC-KU-03.1. Notifikasi disampaikan melalui notifikasi web di dalam sistem. Saluran lain, seperti email dan WhatsApp, tidak termasuk dalam versi ini.

AC-KU-03.2. Setiap notifikasi memuat jenis kejadian, objek terkait, waktu, dan tautan ke halaman tindakan, serta berstatus Belum Dibaca atau Sudah Dibaca.

AC-KU-03.3. Notifikasi hanya dikirim kepada pengguna yang berwenang atas objek terkait dan tidak memuat data kesehatan atau data pribadi yang tidak diperlukan.

AC-KU-03.4. Kegagalan pengiriman notifikasi tidak membatalkan proses yang memicunya, dan kejadian tersebut tetap tercatat pada riwayat objek terkait.

### KU-04 \| Penyimpanan dan Aturan Berkas

SRS — Kebutuhan Fungsional

Sistem harus menyimpan berkas bukti, lampiran, dokumen, foto, dan slip dengan aturan yang sama pada seluruh modul.

User Story

**KU-04** Sebagai Admin, saya ingin berkas disimpan dan dibatasi dengan aturan baku agar pengunggahan konsisten dan aman.

Acceptance Criteria

AC-KU-04.1. Berkas disimpan pada object storage di VPS dan hanya dapat dibuka oleh pengguna yang berwenang atas objek terkait.

AC-KU-04.2. Kecuali ditentukan lain pada fungsi yang bersangkutan, berkas bukti berformat JPG, PNG, atau PDF, berukuran paling besar 5 MB per berkas, dengan paling banyak 5 berkas per pengajuan.

AC-KU-04.3. Berkas yang sudah diunggah tidak ditimpa. Pengunggahan ulang disimpan sebagai versi baru dan versi lama tetap dapat dibuka oleh pihak yang berwenang.

AC-KU-04.4. Berkas yang berisi data kesehatan, seperti lampiran izin sakit, hanya dapat dilihat Admin dan Owner.

### KU-05 \| Riwayat Perubahan (Audit Trail)

SRS — Kebutuhan Fungsional

Sistem harus mencatat riwayat perubahan data penting dengan format yang sama pada seluruh modul, sehingga setiap perubahan dapat ditelusuri.

User Story

**KU-05** Sebagai Owner, saya ingin setiap perubahan data penting tercatat dengan lengkap agar dapat ditelusuri bila terjadi perselisihan.

Acceptance Criteria

AC-KU-05.1. Setiap perubahan status, keputusan, dan nilai pada data yang disebut dalam dokumen ini mencatat pengguna, waktu, nilai atau status sebelum, nilai atau status sesudah, dan alasan bila fungsi mewajibkannya.

AC-KU-05.2. Catatan riwayat tidak dapat diubah atau dihapus oleh pengguna mana pun.

AC-KU-05.3. Riwayat disimpan paling sedikit sesuai masa simpan pada Lampiran D (nilai awal 6 bulan) dan dapat dilihat oleh Admin dan Owner sesuai kewenangan fungsi.

AC-KU-05.4. Perubahan yang dilakukan oleh proses otomatis dicatat dengan pengguna Sistem.

### KU-06 \| Mekanisme Verifikasi

SRS — Kebutuhan Fungsional

Sistem harus memakai satu mekanisme verifikasi bagi dokumen administrasi tentor (ADM-14) dan laporan Pertemuan (ADM-18), yaitu pemeriksaan berdasarkan kriteria yang menghasilkan satu keputusan akhir.

User Story

**KU-06** Sebagai Admin Edukom, saya ingin memverifikasi berdasarkan kriteria yang sama agar keputusan konsisten dan dapat dipertanggungjawabkan.

Acceptance Criteria

AC-KU-06.1. Verifikasi dilakukan atas satu versi objek yang berstatus SUBMITTED, dan setiap versi hanya memiliki satu keputusan akhir, yaitu VERIFIED atau NEEDS_REVISION.

AC-KU-06.2. NEEDS_REVISION mewajibkan catatan perbaikan yang dapat dilihat oleh pengirim, dan pengirim memperbaikinya dengan mengirim versi baru.

AC-KU-06.3. Bila dua Admin memutuskan hampir bersamaan, keputusan pertama yang tersimpan berlaku dan keputusan berikutnya ditolak dengan menampilkan keadaan terkini.

AC-KU-06.4. Keputusan menyimpan pemeriksa, waktu, hasil tiap kriteria, dan nomor versi objek serta versi kriteria yang dipakai.

### KU-07 \| Penanda Perlu Ditinjau

SRS — Kebutuhan Fungsional

Sistem harus memberi penanda Perlu Ditinjau pada Pertemuan PUBLISHED yang terdampak apabila data master berubah, tanpa mengubah jadwal secara otomatis.

User Story

**KU-07** Sebagai Admin Edukom, saya ingin mengetahui Pertemuan yang terdampak perubahan data agar dapat menyesuaikannya secara sadar.

Acceptance Criteria

AC-KU-07.1. Penanda Perlu Ditinjau diberikan pada Pertemuan PUBLISHED yang terdampak perubahan data master pada ADM-01 sampai ADM-08, yaitu perubahan masa kerja sama, tentor, kelompok, ketersediaan, jam sekolah, dan tanggal tidak efektif.

AC-KU-07.2. Penanda memuat penyebab, waktu timbul, dan tautan ke data yang berubah, serta ditampilkan pada Daftar Tindak Lanjut (ADM-20).

AC-KU-07.3. Sistem tidak mengubah, membatalkan, atau menjadwalkan ulang Pertemuan secara otomatis. Perubahan dilakukan Admin melalui ADM-08 atau ADM-09.

AC-KU-07.4. Penanda hilang ketika penyebabnya diperbaiki atau ketika Admin menandainya selesai dengan catatan.

### KU-08 \| Ekspor Laporan

SRS — Kebutuhan Fungsional

Sistem harus menyediakan ekspor data dan laporan dengan aturan yang sama pada seluruh modul.

User Story

**KU-08** Sebagai Admin Edukom, saya ingin mengekspor laporan dengan format dan aturan yang sama agar hasilnya mudah dibandingkan dan dibagikan.

Acceptance Criteria

AC-KU-08.1. Ekspor tersedia dalam format XLSX dan PDF, dan memuat judul, filter yang dipakai, pengguna pengekspor, serta waktu ekspor.

AC-KU-08.2. Ekspor hanya memuat data yang berwenang dilihat oleh pengguna dan mengikuti filter yang sedang aktif.

AC-KU-08.3. Bila data melebihi batas ekspor pada Lampiran D, sistem meminta pengguna mempersempit filter.

AC-KU-08.4. Setiap ekspor dicatat sesuai KU-05.

### KU-09 \| Hak Akses dan Peran

SRS — Kebutuhan Fungsional

Sistem harus menerapkan hak akses berbasis peran secara konsisten pada seluruh modul sesuai Lampiran A.

User Story

**KU-09** Sebagai Owner, saya ingin hak akses dibatasi menurut peran agar pengguna hanya mengakses data yang menjadi kewenangannya.

Acceptance Criteria

AC-KU-09.1. Peran akun dalam sistem adalah Owner, Admin, Tentor, Kurir, dan Teknisi. Tentor Pengganti adalah Tentor yang ditugaskan menggantikan Tentor asli pada Pertemuan tertentu dan memperoleh akses sebatas Pertemuan tersebut. Istilah Pimpinan tidak dipakai pada kebutuhan fungsional dan dibaca sebagai Owner.

AC-KU-09.2. Saat ini terdapat satu akun Owner dan satu akun Admin. Tidak ada peran Keuangan yang terpisah, dan pencatatan pembayaran dilakukan oleh Admin.

AC-KU-09.3. Setiap permintaan akses diperiksa pada sisi server terhadap peran dan kepemilikan data, sehingga tentor hanya dapat melihat data miliknya sendiri.

AC-KU-09.4. Percobaan akses yang tidak berwenang ditolak dan dicatat sesuai KU-05.

### KU-10 \| Masa Simpan dan Penghapusan Data

SRS — Kebutuhan Fungsional

Sistem harus menerapkan satu kebijakan masa simpan data bagi seluruh modul.

User Story

**KU-10** Sebagai Owner, saya ingin kebijakan masa simpan diterapkan seragam agar data tidak disimpan lebih lama atau lebih singkat dari ketentuan.

Acceptance Criteria

AC-KU-10.1. Bukti, lampiran, slip, dan riwayat perubahan disimpan sesuai parameter masa simpan pada Lampiran D (nilai awal 6 bulan).

AC-KU-10.2. Data transaksi yang menjadi dasar perhitungan honorarium dan laporan tidak dihapus oleh kebijakan masa simpan dan hanya berubah status.

AC-KU-10.3. Data master yang sudah dipakai tidak dapat dihapus dan hanya dapat dinonaktifkan.

AC-KU-10.4. Pembersihan data yang melewati masa simpan dijalankan otomatis dan dicatat sesuai KU-05.

## 3.2 Modul Administrasi Pembelajaran (ADM)

Modul ini mengatur data sekolah mitra, peserta, kelompok, penjadwalan, dokumen administrasi tentor, laporan Pertemuan, dan Daftar Tindak Lanjut. Penugasan tentor pada Pertemuan PUBLISHED menjadi acuan bagi Modul Izin, Modul Penggajian, dan Modul Manajemen Aset.

### ADM-01 \| Pengelolaan Data Sekolah Mitra dan Kerja Sama

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk mengelola Profil Sekolah dan Catatan Kerja Sama secara terpisah. Satu sekolah memiliki satu Profil Sekolah dan dapat memiliki banyak Catatan Kerja Sama. Profil Sekolah memuat nama, NPSN, alamat, kabupaten atau kota, nomor telepon kontak, koordinat lintang dan bujur, radius geofence presensi, penanda Wajib Lembar Fisik, serta sumber perangkat pembelajaran, yaitu laptop Edukom atau komputer milik sekolah. Setiap Catatan Kerja Sama memuat tahun ajaran, cakupan semester, tanggal mulai, tanggal akhir, kontak penanggung jawab, status, dan berkas MoU. Sistem mewajibkan pencarian sebelum Admin membuat profil baru dan menampilkan sekolah yang berpotensi ganda.

Aktor: Admin Edukom.

User Story

**ADM-01** Sebagai Admin Edukom, saya ingin mengelola Profil Sekolah beserta koordinatnya dan Catatan Kerja Sama per periode agar pendataan peserta, penjadwalan, presensi, dan pengantaran laptop memakai identitas dan lokasi sekolah yang sama tanpa menimpa riwayat kerja sama sebelumnya.

Acceptance Criteria

AC-ADM-01.1. Tombol Buat Profil Baru aktif hanya setelah Admin menjalankan pencarian. Pencarian menerima kata kunci nama sekolah, NPSN, kabupaten atau kota, dan nomor telepon kontak.

AC-ADM-01.2. Sistem membuat identitas internal unik untuk setiap Profil Sekolah. Identitas ini tidak dapat diubah dan tidak dipakai ulang. NPSN bersifat opsional dan, bila diisi, wajib berupa 8 digit angka yang unik.

AC-ADM-01.3. Sistem menyamakan penulisan nama sekolah sebelum dibandingkan, yaitu huruf kecil, tanpa tanda baca, tanpa spasi ganda, dan tanpa spasi di awal dan akhir. Sistem menampilkan kandidat sekolah ganda bila NPSN sama, bila nama yang sudah disamakan identik, atau bila nama tersebut hanya berbeda paling banyak 2 huruf dan kabupaten atau kota sama.

AC-ADM-01.4. Bila NPSN sama dengan profil yang sudah ada, sistem menolak pembuatan profil baru dan Admin memakai profil lama. Bila kandidat ganda muncul karena kondisi lain, Admin wajib memilih memakai profil lama atau membuat profil baru dengan alasan. Sistem menyimpan pilihan, alasan, identitas Admin, dan waktu pemilihan.

AC-ADM-01.5. Koordinat wajib diisi dalam derajat desimal dengan enam angka di belakang koma, baik dipilih pada peta maupun diketik. Perubahan koordinat menyimpan nilai lama, pengubah, dan waktu, lalu dikirim ke Modul Penggajian dan Modul Manajemen Aset.

AC-ADM-01.6. Sekolah dengan sumber perangkat komputer milik sekolah tidak membutuhkan laptop Edukom, sehingga Pertemuan di sekolah tersebut tidak dihitung dalam kebutuhan laptop dan tidak dikirim sebagai permintaan pengantaran ke Modul Manajemen Aset.

AC-ADM-01.7. Satu sekolah boleh memiliki lebih dari satu Catatan Kerja Sama dalam satu tahun ajaran selama tanggalnya tidak beririsan. Sekolah yang bekerja sama hanya satu semester dicatat dengan cakupan semester tersebut. Sekolah lama dipakai pada periode berikutnya dengan membuat Catatan Kerja Sama baru tanpa mengubah catatan lama.

AC-ADM-01.8. Sistem menolak tanggal akhir yang mendahului tanggal mulai, serta tanggal mulai dan tanggal akhir yang berada di luar semester sesuai cakupannya. Status ditetapkan otomatis berdasarkan tanggal: PLANNED sebelum tanggal mulai, ACTIVE dari tanggal mulai sampai tanggal akhir, dan ENDED sesudah tanggal akhir. Admin menetapkan CANCELLED secara manual dengan alasan wajib, dan status CANCELLED tidak berubah lagi.

AC-ADM-01.9. Bila tanggal akhir dimajukan atau Catatan Kerja Sama dibatalkan, sistem memberi penanda Perlu Ditinjau pada Pertemuan PUBLISHED sekolah tersebut yang tanggalnya berada di luar masa kerja sama yang baru dan laporannya belum dikirim, lalu menampilkannya pada Daftar Tindak Lanjut.

AC-ADM-01.10. Pembaruan MoU menyimpan berkas baru sebagai versi baru dengan nomor versi berurutan, dan versi lama tetap dapat dibuka.

AC-ADM-01.11. Sekolah yang sudah memiliki peserta, jadwal, atau MoU tidak dapat dihapus dan hanya dapat dinonaktifkan. Saat menonaktifkan, sistem menampilkan seluruh Pertemuan PUBLISHED sekolah tersebut yang tanggalnya sama dengan atau setelah hari ini, dan Admin wajib mengonfirmasi setelah melihat daftar itu. Penonaktifan tidak mengubah jadwal secara otomatis, dan sekolah nonaktif tidak dapat dipilih pada formulir, kelas, program, dan jadwal baru.

AC-ADM-01.12. Profil Sekolah memuat radius geofence dalam meter berupa bilangan bulat positif, dengan nilai awal mengikuti parameter pada SET-01 (150 meter), dan penanda Wajib Lembar Fisik bernilai Ya atau Tidak. Perubahan radius menyimpan nilai lama, pengubah, dan waktu, lalu dipakai oleh PAY-02 dan AST-05 sesuai KU-02. Penanda Wajib Lembar Fisik dibaca oleh PAY-03.

### ADM-02 \| Pengelolaan Peserta Berdasarkan Formulir Sekolah

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk mencatat formulir peserta per sekolah dan tahun ajaran, menyiapkan kelas, dan mendaftarkan siswa melalui input manual atau impor berkas XLSX dengan template resmi. Sekolah menentukan kelas yang ikut melalui formulir, dan perubahan kelas yang ikut dicatat sebagai formulir perbaikan. Kelas dan keikutsertaan siswa berlaku untuk satu tahun ajaran, sehingga siswa tidak didaftarkan ulang pada semester kedua. Setiap keikutsertaan memiliki tanggal mulai ikut dan, bila siswa berhenti, tanggal berhenti, sehingga siswa yang hanya mengikuti satu semester tercatat sesuai periode aktifnya. Sistem memisahkan identitas siswa, keikutsertaan siswa, dan baris formulir sumber, mencocokkan setiap baris dengan identitas siswa tersimpan, menampilkan baris bermasalah beserta nomor baris dan alasannya, dan menjamin pengulangan proses tidak menghasilkan data ganda. Perpindahan kelas, siswa keluar, dan siswa yang kembali ikut dicatat dengan tanggal berlaku dan sumber konfirmasi sekolah tanpa menghapus riwayat.

Aktor: Admin Edukom.

User Story

**ADM-02** Sebagai Admin Edukom, saya ingin mencatat formulir sekolah, mengelola kelas, mendaftarkan siswa secara manual atau melalui impor XLSX, menyelesaikan baris bermasalah, serta mencatat periode aktif, perpindahan kelas, siswa keluar, dan siswa yang kembali ikut agar daftar peserta setiap semester akurat dan riwayat pembelajaran dapat ditelusuri.

Acceptance Criteria

AC-ADM-02.1. Setiap formulir wajib memiliki sekolah, tahun ajaran, tanggal penerimaan, daftar kelas yang ikut, serta minimal satu berkas atau satu referensi formulir. Formulir dapat disimpan tanpa peserta dan dapat dicari berdasarkan sekolah dan tahun ajaran.

AC-ADM-02.2. Formulir perbaikan merujuk formulir lama dan memperbarui daftar kelas yang ikut sejak tanggal penerimaannya. Formulir lama tetap tersimpan.

AC-ADM-02.3. Kelas dibuat pada kombinasi sekolah dan tahun ajaran dengan nama dan tingkat 1 sampai 6. Nama kelas wajib unik pada kombinasi tersebut, tanpa membedakan huruf besar dan kecil dan tanpa memperhitungkan spasi berlebih.

AC-ADM-02.4. Input manual dan impor mewajibkan nama siswa dan kelas, sedangkan NIS dan NISN bersifat opsional. NIS dan NISN disimpan sebagai teks sehingga angka nol di depan tidak hilang.

AC-ADM-02.5. Impor hanya menerima berkas XLSX dengan template resmi. Sistem menolak berkas yang tidak sesuai template atau melebihi batas ukuran dan jumlah baris pada pengaturan parameter, dengan nilai awal 5 MB dan 1.000 baris.

AC-ADM-02.6. Sistem menyamakan penulisan nama siswa dengan cara yang sama seperti nama sekolah, lalu mencocokkan setiap baris dengan identitas siswa tersimpan dalam urutan berikut dan berhenti pada aturan pertama yang terpenuhi. NIS atau NISN yang kosong pada salah satu sisi tidak dibandingkan.

a\. NISN sama dan nama sama menghasilkan Cocok.

b\. NISN sama tetapi nama berbeda menghasilkan Ditahan dengan alasan Identitas Bertentangan.

c\. NIS sama pada sekolah yang sama, NISN sama atau tidak dibandingkan, dan nama sama menghasilkan Cocok.

d\. NIS sama pada sekolah yang sama, tetapi nama atau NISN berbeda, menghasilkan Ditahan dengan alasan Identitas Bertentangan.

e\. NIS dan NISN tidak dibandingkan, sekolah sama, dan nama berbeda paling banyak 1 huruf untuk nama sampai 10 huruf atau paling banyak 2 huruf untuk nama yang lebih panjang, menghasilkan Ditahan dengan alasan Kemungkinan Duplikasi.

f\. Kondisi lain menghasilkan Siswa Baru.

AC-ADM-02.7. Hasil Cocok memakai identitas siswa yang sudah ada, dan hasil Siswa Baru membuat identitas siswa baru. Baris Ditahan tidak diproses sampai Admin memilih memakai siswa yang ada atau membuat siswa baru dan mengisi sumber konfirmasi sekolah.

AC-ADM-02.8. Sistem menampilkan nomor baris dan alasan untuk data wajib kosong, kelas tidak terdaftar, duplikasi di dalam berkas, dan baris Ditahan. Duplikasi di dalam berkas berarti NISN sama, NIS sama, atau nama dan kelas sama bila NIS dan NISN kosong. Baris pertama diproses dan baris berikutnya ditandai bermasalah.

AC-ADM-02.9. Impor menyimpan baris valid dan menampilkan baris bermasalah. Admin memperbaiki baris bermasalah tanpa memasukkan ulang baris yang sudah valid.

AC-ADM-02.10. Satu siswa hanya memiliki satu keikutsertaan pada satu sekolah dan tahun ajaran. Pengiriman ulang baris, impor ulang berkas yang sama, dan penekanan tombol berulang tidak membuat siswa atau keikutsertaan ganda. Baris yang sudah terdaftar pada kelas yang sama ditandai Sudah Terdaftar dan tidak dihitung sebagai kesalahan.

AC-ADM-02.11. Bila siswa yang cocok sudah terdaftar pada kelas lain di tahun ajaran yang sama, sistem menahan baris dengan alasan Kelas Tidak Sesuai dan tidak memindahkan siswa secara otomatis.

AC-ADM-02.12. Setiap keikutsertaan wajib memiliki tanggal mulai ikut. Nilai awalnya adalah tanggal mulai semester pertama ketika kelas siswa termasuk kelas yang ikut, dan Admin dapat mengubahnya untuk siswa yang bergabung di tengah tahun ajaran. Keikutsertaan berstatus VALIDATED bila barisnya tidak memiliki masalah terbuka, PENDING_VALIDATION selama masih ada masalah terbuka, dan WITHDRAWN sejak tanggal berlaku siswa keluar. Hanya siswa VALIDATED yang dapat ditempatkan dalam kelompok.

AC-ADM-02.13. Perpindahan kelas mewajibkan kelas asal, kelas tujuan pada sekolah dan tahun ajaran yang sama, tanggal berlaku, dan sumber konfirmasi sekolah. Siswa keluar mewajibkan tanggal berlaku, alasan, dan sumber konfirmasi sekolah. Tanggal berlaku boleh mundur, dan sistem menolak dua perubahan untuk siswa yang sama dengan tanggal berlaku yang sama.

AC-ADM-02.14. Perpindahan kelas dan siswa keluar mempertahankan seluruh catatan pembelajaran sebelum tanggal berlaku dan tidak mengubah laporan berstatus SUBMITTED atau VERIFIED.

AC-ADM-02.15. Siswa hanya muncul pada daftar hadir, siswa sasaran penilaian, rekap, dan dashboard untuk tanggal yang berada di antara tanggal mulai ikut dan tanggal berhentinya. Siswa yang hanya aktif pada semester 1 tidak dihitung sebagai peserta, tidak hadir, atau nilai belum lengkap pada semester 2, dan berlaku sebaliknya. Contoh uji: siswa dengan tanggal mulai ikut pada awal semester 2 tidak muncul pada daftar hadir Pertemuan semester 1 dan tidak dihitung pada rekap nilai semester 1.

AC-ADM-02.16. Bila formulir perbaikan menghapus kelas dari daftar kelas yang ikut, sistem menampilkan seluruh siswa aktif kelas tersebut dan mengusulkan siswa keluar dengan tanggal berlaku sama dengan tanggal penerimaan formulir perbaikan. Usulan ini berlaku setelah Admin mengonfirmasi. Bila formulir perbaikan menambah kelas, siswa yang didaftarkan pada kelas itu memperoleh tanggal mulai ikut sama dengan tanggal penerimaan formulir perbaikan.

AC-ADM-02.17. Siswa WITHDRAWN yang kembali mengikuti pembelajaran pada tahun ajaran yang sama diaktifkan kembali pada keikutsertaan yang sama dengan tanggal berlaku dan sumber konfirmasi sekolah, tanpa membuat keikutsertaan baru. Sistem menyimpan setiap periode aktif sebagai riwayat. Setelah diaktifkan kembali, siswa tampil sebagai Belum Ditempatkan sampai Admin menempatkannya dalam kelompok.

AC-ADM-02.18. Setelah perpindahan kelas, siswa keluar, atau pengaktifan kembali disimpan, sistem memberi penanda Perlu Ditinjau pada kelompok siswa tersebut dan pada Pertemuan PUBLISHED kelompok itu yang tanggalnya sama dengan atau setelah tanggal berlaku dan laporannya belum dikirim, lalu menampilkannya pada Daftar Tindak Lanjut. Penanda hilang saat Admin menyesuaikan keanggotaan kelompok atau menandai tinjauan selesai, dan penanda ini tidak memblokir pengiriman laporan.

### ADM-03 \| Katalog Program dan Penetapan Program per Semester

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk mengelola Katalog Program dan menetapkan program pada sekolah dan semester tertentu. Katalog Program memuat kode, nama, tingkat sasaran 1 sampai 6, dan jumlah Pertemuan yang direncanakan per semester. Program dipilih dari katalog dan tidak diketik ulang. Penetapan Program menghubungkan satu program katalog dengan satu sekolah, satu semester, dan cakupan kelas atau kelompok, serta mencatat hasil koordinasi dengan sekolah. Kurikulum sekolah diunggah tentor sebagai lampiran acuan pada Penetapan Program dan tidak dihitung sebagai kewajiban dokumen. Satu penetapan dipakai bersama oleh seluruh peserta program yang sama. Sistem menampilkan perbandingan target Pertemuan dengan realisasinya pada setiap Penetapan Program.

Aktor: Admin Edukom; Tentor (mengunggah lampiran kurikulum).

User Story

**ADM-03** Sebagai Admin Edukom, saya ingin memilih program dari katalog, menetapkannya pada kelas atau kelompok, dan memantau pencapaian target Pertemuannya agar seluruh peserta memakai satu acuan pembelajaran tanpa input per siswa.

Acceptance Criteria

AC-ADM-03.1. Kode program wajib unik. Tingkat minimum tidak boleh lebih besar daripada tingkat maksimum, dan jumlah Pertemuan yang direncanakan wajib berupa bilangan bulat positif. Program yang sudah dipakai tidak dapat dihapus dan hanya dapat dinonaktifkan, dan program nonaktif tidak dapat dipilih pada penetapan baru.

AC-ADM-03.2. Penetapan wajib memuat sekolah, tahun ajaran, semester, program dari katalog, cakupan kelas atau kelompok, dan hasil koordinasi. Sistem menolak kelas atau kelompok dari sekolah atau tahun ajaran lain, serta yang tingkatnya di luar tingkat sasaran program.

AC-ADM-03.3. Penetapan berstatus INCOMPLETE selama belum ada kelas atau kelompok dalam cakupan dan berstatus READY setelah minimal satu tercakup. Penetapan INCOMPLETE tidak dapat dipilih pada penyusunan jadwal.

AC-ADM-03.4. Peserta program dihitung dari keanggotaan kelas atau kelompok dalam cakupan pada tanggal yang dinilai, dan siswa yang tercakup melalui lebih dari satu hubungan dihitung satu kali. Untuk 100 peserta pada program yang sama, sistem menyimpan satu Penetapan Program tanpa salinan per siswa.

AC-ADM-03.5. Penetapan hanya dapat dipakai pada jadwal bila sekolah dan semester sama dan seluruh anggota kelompok pada tanggal Pertemuan tercakup. Bila ada anggota yang tidak tercakup, sistem menolak kombinasi tersebut dan menampilkan nama siswa penyebabnya.

AC-ADM-03.6. Perubahan cakupan menyimpan tanggal berlaku dan riwayat, dan tanggal berlaku boleh mundur. Bila perubahan membuat Pertemuan PUBLISHED yang laporannya belum dikirim menjadi tidak sesuai, sistem memberi penanda Perlu Ditinjau pada Pertemuan tersebut dan menampilkannya pada Daftar Tindak Lanjut.

AC-ADM-03.7. Tentor yang ditugaskan pada Penetapan Program dapat mengunggah lampiran kurikulum sekolah. Lampiran disimpan berversi, dapat dibuka Admin dan tentor terkait, dan tidak memengaruhi kelengkapan dokumen maupun bonus.

AC-ADM-03.8. Setiap Penetapan Program menampilkan target Pertemuan dari katalog, jumlah Pertemuan terjadwal, jumlah Pertemuan terlaksana, yaitu Pertemuan yang memiliki minimal satu laporan TERLAKSANA, dan selisihnya. Bila jumlah Pertemuan terlaksana ditambah jumlah Pertemuan terjadwal yang belum dilaporkan lebih kecil daripada target, sistem menampilkan peringatan Target Belum Terpenuhi pada Daftar Tindak Lanjut.

### ADM-04 \| Perhitungan Kapasitas, Pembagian Kelompok, dan Rencana Sesi

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk menghitung kapasitas kelompok, menempatkan siswa ke dalam kelompok, dan menghitung rencana jumlah sesi dan hari pelaksanaan satu sekolah. Cakupan pembagian adalah satu kelas atau gabungan beberapa kelas bertingkat sama pada satu sekolah dan satu tahun ajaran. Admin mengisi jumlah laptop per kelompok, jumlah siswa per laptop, dan batas peserta per kelompok, lalu sistem menghitung kapasitas kelompok dan jumlah kelompok minimum. Jumlah sesi ditentukan Edukom melalui perhitungan ini berdasarkan jumlah kelompok, jumlah tentor, jumlah tentor per sesi (satu atau dua), jumlah laptop Edukom, dan jam sekolah. Hasil rencana sesi menjadi acuan saat Admin menyepakati hari dan jam dengan sekolah. Status pembagian bernilai DRAFT atau FINAL.

Aktor: Admin Edukom.

User Story

**ADM-04** Sebagai Admin Edukom, saya ingin menghitung kapasitas, membagi siswa ke dalam kelompok, dan menghitung jumlah sesi serta hari pelaksanaan agar pembagian kelompok dan jumlah sesi yang saya sepakati dengan sekolah memiliki dasar hitungan yang pasti.

Acceptance Criteria

AC-ADM-04.1. Jumlah laptop per kelompok (L), jumlah siswa per laptop (S), dan batas peserta per kelompok (B) wajib berupa bilangan bulat sama dengan atau lebih dari 1. Sistem tidak menghasilkan perhitungan selama ada nilai yang kosong atau tidak valid dan menampilkan alasannya. Untuk sekolah yang memakai komputer milik sekolah, Admin mengisi jumlah komputer sekolah sebagai L.

AC-ADM-04.2. Sistem menghitung kapasitas kelompok C = min(L × S, B) dan jumlah kelompok minimum G = ceil(N ÷ C), dengan N jumlah siswa VALIDATED dalam cakupan. Contoh: L = 8, S = 2, B = 15, dan N = 30 menghasilkan C = 15 dan G = 2; N = 31 menghasilkan G = 3; N = 0 menghasilkan G = 0.

AC-ADM-04.3. Sistem mengusulkan penempatan awal dengan selisih jumlah anggota antar kelompok paling banyak 1. Contoh: 31 siswa dan 3 kelompok menghasilkan 11, 10, dan 10 anggota. Admin dapat menyesuaikan anggota setiap kelompok.

AC-ADM-04.4. Sistem menampilkan siswa yang belum ditempatkan, siswa yang berada di lebih dari satu kelompok dalam pembagian yang sama, dan kelompok yang melebihi C.

AC-ADM-04.5. Pembagian dapat disimpan sebagai DRAFT walaupun ada siswa yang belum ditempatkan. Pembagian hanya dapat ditetapkan FINAL bila setiap siswa VALIDATED dalam cakupan ditempatkan tepat satu kali dan tidak ada kelompok yang melebihi C. Kelompok dari pembagian DRAFT tidak dapat dipilih pada penjadwalan dan daftar hadir.

AC-ADM-04.6. Bila setelah pembagian FINAL ada siswa yang menjadi VALIDATED, pembagian tetap FINAL dan siswa tersebut tampil sebagai Belum Ditempatkan pada Daftar Tindak Lanjut sampai Admin menempatkannya melalui perubahan keanggotaan.

AC-ADM-04.7. Perubahan keanggotaan memiliki tanggal berlaku dan riwayat, dan tanggal berlaku boleh mundur. Sistem menolak dua perubahan untuk siswa yang sama dengan tanggal berlaku yang sama. Pertemuan sebelum tanggal berlaku tetap memakai keanggotaan lama, dan perubahan tidak mengubah laporan berstatus SUBMITTED atau VERIFIED.

AC-ADM-04.8. Setelah perubahan keanggotaan disimpan, sistem memberi penanda Perlu Ditinjau pada Pertemuan PUBLISHED kelompok terkait yang tanggalnya sama dengan atau setelah tanggal berlaku dan laporannya belum dikirim, lalu menampilkannya pada Daftar Tindak Lanjut.

AC-ADM-04.9. Sistem menghitung rencana sesi dari jumlah kelompok FINAL (K), jumlah tentor yang tersedia per hari (T), jumlah tentor per sesi (t, bernilai 1 atau 2), jumlah laptop Edukom yang layak pakai (A), kebutuhan laptop kelompok terbesar u = ceil(anggota terbesar ÷ S), dan durasi sesi (d). Jumlah kelompok yang belajar bersamaan adalah p = min(floor(T ÷ t), floor(A ÷ u)), dan untuk sekolah yang memakai komputer sendiri p = floor(T ÷ t). Jumlah sesi yang dibutuhkan adalah Q = ceil(K ÷ p). Jumlah sesi maksimum per hari Qmaks adalah jumlah dari floor(panjang setiap rentang jam sekolah ÷ d), dan jumlah hari pelaksanaan per pekan adalah H = ceil(Q ÷ Qmaks). Bila p = 0, sistem menolak perhitungan dan menampilkan sumber daya yang kurang. Tentor yang tidak terpakai karena pembagian floor(T ÷ t) ditampilkan sebagai sisa tentor.

AC-ADM-04.10. Contoh uji dengan A = 40, S = 2, d = 70 menit, dan jam sekolah 07.30–11.30 tanpa istirahat sehingga Qmaks = 3:

a\. Kelas 1 sampai 6 masing-masing 14 siswa menghasilkan K = 6 dan u = 7. Dengan T = 2 dan t = 1, hasilnya p = 2, Q = 3, dan H = 1.

b\. Kelas 1 sampai 6 masing-masing 22 siswa dengan C = 15 menghasilkan K = 12. Dengan T = 2 dan t = 1, hasilnya Q = 6 dan H = 2, sehingga kelas 1 sampai 3 dijadwalkan pada hari pertama dan kelas 4 sampai 6 pada hari kedua.

c\. Jam sekolah 07.30–09.30 dan 10.00–12.00 menghasilkan Qmaks = 1 + 1 = 2.

AC-ADM-04.11. Rencana sesi tidak membentuk jadwal. Sistem menyimpan rencana beserta seluruh masukannya dan menampilkannya saat Admin menyusun jadwal sekolah tersebut.

### ADM-05 \| Pengelolaan Data dan Status Keaktifan Tentor

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk membuat, mencari, dan memperbarui profil tentor serta mengelola status keaktifannya dengan satu identitas tentor yang dipakai seluruh modul. Profil tentor memuat kode tentor, nama, kontak, alamat domisili, koordinat domisili, dan nomor rekening bank. Penyimpanan tentor baru membuat akun Tentor dan mengirim undangan aktivasi. Sistem menghitung jarak rute jalan sesuai KU-01 dari domisili tentor ke setiap sekolah mitra dalam kilometer dengan satu angka desimal, dan menyimpan jarak yang berlaku pada setiap penugasan sebagai acuan uang transportasi pada Modul Penggajian. Status tentor bernilai ACTIVE atau INACTIVE dengan tanggal berlaku dan dinilai pada tanggal Pertemuan. Perubahan menjadi INACTIVE membentuk Kasus Penggantian (IZN-06) untuk setiap penugasan yang terdampak.

Aktor: Admin Edukom.

User Story

**ADM-05** Sebagai Admin Edukom, saya ingin mengelola profil, domisili, dan status keaktifan tentor beserta tanggal berlakunya agar kelayakan penugasan, jarak transportasi, dan kebutuhan pengganti ditentukan dari data yang sama.

Acceptance Criteria

AC-ADM-05.1. Profil tentor wajib memiliki kode tentor unik, nama, minimal satu kontak, alamat domisili, dan koordinat domisili. Admin dapat mencari profil berdasarkan nama, kode tentor, atau kontak.

AC-ADM-05.2. Penyimpanan tentor baru membuat tepat satu akun Tentor dan mengirim undangan aktivasi. Penyimpanan berulang tidak membuat akun ganda.

AC-ADM-05.3. Koordinat domisili hanya dapat dilihat dan diubah Admin, sedangkan pengguna lain hanya melihat jarak dalam kilometer. Perubahan koordinat tentor atau sekolah menghitung ulang jarak untuk penugasan yang tanggalnya sama dengan atau setelah tanggal perubahan. Jarak pada penugasan sebelum tanggal perubahan tidak berubah.

AC-ADM-05.4. Perubahan status wajib berisi status, tanggal berlaku, dan alasan. Status INACTIVE memakai alasan KELUAR, CUTI, atau LAINNYA dengan keterangan. Alasan CUTI wajib disertai tanggal kembali, dan sistem otomatis mengembalikan tentor menjadi ACTIVE pada tanggal tersebut. Sistem menyimpan riwayat setiap perubahan beserta Admin pengubahnya.

AC-ADM-05.5. Tanggal berlaku boleh mundur. Sistem menolak dua perubahan status untuk tentor yang sama dengan tanggal berlaku yang sama. Status pada suatu tanggal adalah status dari perubahan terakhir yang tanggal berlakunya sama dengan atau sebelum tanggal tersebut.

AC-ADM-05.6. Tentor yang INACTIVE pada tanggal Pertemuan ditolak untuk penugasan baru dan pengesahan pengganti pada Pertemuan tersebut.

AC-ADM-05.7. Setelah perubahan menjadi INACTIVE disimpan, sistem membuat satu Kasus Penggantian (IZN-06) dengan penyebab NONAKTIF untuk setiap penugasan tentor tersebut pada Pertemuan PUBLISHED yang tanggalnya berada dalam masa nonaktif dan laporannya belum dikirim. Masa nonaktif dimulai pada tanggal berlaku dan berakhir sehari sebelum tanggal kembali untuk CUTI, atau tanpa akhir untuk alasan lain. Sistem tidak mengubah jadwal secara otomatis, dan proses berulang tidak menggandakan kasus.

AC-ADM-05.8. Tentor INACTIVE tetap dapat masuk ke sistem hanya untuk melengkapi dan mengirim laporan Pertemuan yang tanggalnya sebelum tanggal berlaku nonaktif, selama batas akses pada pengaturan parameter (nilai awal 7 hari setelah tenggat laporan). Setelah batas tersebut, akses tentor ditutup.

AC-ADM-05.9. Nomor rekening bank tentor (nama bank, nomor rekening, dan nama pemilik) bersifat opsional saat profil dibuat, hanya dapat dilihat dan diubah Admin dan Owner, dan dibaca oleh PAY-08 untuk pembayaran melalui transfer.

### ADM-06 \| Pengisian dan Konfirmasi Ketersediaan Waktu Mengajar

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor untuk mengisi satu atau beberapa rentang ketersediaan berupa hari, jam mulai, jam selesai, tanggal mulai berlaku, tanggal akhir berlaku, dan catatan opsional, lalu menyimpannya melalui tindakan Simpan dan Konfirmasi Ketersediaan. Rentang baru menggantikan rentang lama milik tentor yang sama pada hari yang sama hanya untuk tanggal yang beririsan. Untuk setiap penugasan, sistem menetapkan tepat satu klasifikasi: Tersedia bila seluruh jam Pertemuan berada di dalam rentang terkonfirmasi, Tidak Tersedia bila ada rentang terkonfirmasi pada hari dan tanggal itu tetapi sebagian atau seluruh jam Pertemuan berada di luarnya, dan Belum Mengisi bila tidak ada rentang terkonfirmasi yang berlaku. Admin Edukom melihat ketersediaan bersama jadwal resmi. Perubahan ketersediaan tidak mengubah jadwal yang sudah terbit.

Aktor: Tentor; Admin Edukom (melihat).

User Story

**ADM-06** Sebagai tentor, saya ingin mengisi dan mengonfirmasi hari, jam, dan periode ketersediaan saya agar Admin Edukom menyusun penugasan berdasarkan waktu yang telah saya nyatakan.

Acceptance Criteria

AC-ADM-06.1. Tentor hanya dapat mengisi dan mengonfirmasi ketersediaan atas identitasnya sendiri.

AC-ADM-06.2. Hari, jam mulai, jam selesai, tanggal mulai berlaku, dan tanggal akhir berlaku wajib diisi, sedangkan catatan bersifat opsional. Sistem menolak jam selesai yang sama dengan atau lebih awal daripada jam mulai, serta tanggal akhir yang mendahului tanggal mulai.

AC-ADM-06.3. Simpan dan Konfirmasi Ketersediaan menyimpan rentang, identitas tentor, waktu konfirmasi, dan nomor revisi dalam satu tindakan. Rentang lama yang tergantikan disimpan dalam riwayat revisi dan tidak dihapus.

AC-ADM-06.4. Contoh uji: rentang lama berlaku Senin dan Rabu pukul 07.00–12.00 pada 1 Agustus sampai 20 Desember, lalu rentang baru berlaku Senin pukul 09.00–12.00 pada 1 sampai 31 Oktober. Senin pada bulan Oktober memakai rentang baru, sedangkan Senin di luar Oktober dan seluruh Rabu tetap memakai rentang lama.

AC-ADM-06.5. Klasifikasi Tersedia, Tidak Tersedia, dan Belum Mengisi dipakai pada pemeriksaan jadwal, pemeriksaan calon pengganti, dan rekomendasi calon pengganti.

AC-ADM-06.6. Admin melihat ketersediaan bersama jadwal resmi sehingga rentang yang sudah memiliki penugasan dapat dikenali.

AC-ADM-06.7. Bila perubahan ketersediaan membuat penugasan pada Pertemuan PUBLISHED yang laporannya belum dikirim menjadi Tidak Tersedia, sistem memberi penanda Perlu Ditinjau pada Pertemuan tersebut dan menampilkannya pada Daftar Tindak Lanjut tanpa mengubah jadwal.

### ADM-07 \| Kesepakatan Jadwal, Jam Sekolah, dan Tanggal Tidak Efektif

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk mencatat Kesepakatan Jadwal, yaitu hasil diskusi pihak sekolah dan pihak Edukom mengenai hari dan jam pembelajaran, serta rentang jam sekolah per hari. Admin uga mengelola Daftar Libur Nasional yang berlaku untuk seluruh sekolah dan tanggal tidak efektif per sekolah, seperti libur semester, ujian, dan acara sekolah. Seluruh data ini menjadi dasar penyusunan dan pemeriksaan jadwal pada ADM-08.

Aktor: Admin Edukom.

User Story

**ADM-07** Sebagai Admin Edukom, saya ingin mencatat kesepakatan hari dan jam dengan sekolah, jam sekolah, libur nasional, dan tanggal tidak efektif agar penyusunan jadwal memakai dasar yang tercatat dan dapat diperiksa.

Acceptance Criteria

AC-ADM-07.1. Kesepakatan Jadwal wajib memuat sekolah, semester, tanggal kesepakatan, nama perwakilan sekolah, nama perwakilan Edukom, hari, jam mulai, dan kelas yang dijadwalkan. Kelas yang dijadwalkan wajib termasuk kelas yang ikut pada formulir sekolah. Perubahan hari atau jam wajib dicatat sebagai Kesepakatan Jadwal baru yang merujuk kesepakatan lama.

AC-ADM-07.2. Admin mencatat rentang jam sekolah per hari. Daftar Libur Nasional memuat tanggal dan nama libur, dikelola per tahun, dan otomatis berlaku untuk seluruh sekolah.

AC-ADM-07.3. Tanggal tidak efektif per sekolah memuat tanggal mulai, tanggal akhir, keterangan, sumber informasi, cakupan berupa seluruh sekolah, tingkat tertentu, atau kelas tertentu, serta waktu berupa sepanjang hari atau rentang jam tertentu. Pertemuan terkena tanggal tidak efektif bila tanggalnya berada dalam rentang tanggal, kelompoknya termasuk cakupan, dan jamnya beririsan dengan rentang jam.

AC-ADM-07.4. Bila libur nasional atau tanggal tidak efektif ditambahkan atau diubah setelah jadwal terbit, sistem memberi penanda Perlu Ditinjau pada Pertemuan PUBLISHED yang terkena dan laporannya belum dikirim, lalu menampilkannya pada Daftar Tindak Lanjut. Sistem tidak mengubah jadwal secara otomatis, dan Admin menjadwalkan ulang atau membatalkan Pertemuan tersebut pada ADM-09.

### ADM-08 \| Penyusunan dan Penerbitan Jadwal

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk menyusun, memeriksa, dan menerbitkan jadwal. Penjadwalan ulang dan pembatalan Pertemuan diatur pada ADM-09. Hari dan jam ditetapkan berdasarkan Kesepakatan Jadwal yang dicatat pada ADM-07. Admin memilih sekolah, semester, Penetapan Program, kelompok, satu atau dua tentor, tanggal atau Pola Jadwal, dan jam mulai. Jam selesai dihitung sistem dari jam mulai ditambah durasi sesi pada pengaturan parameter (nilai awal 70 menit). Pola Jadwal menyimpan hari, tanggal awal, dan tanggal akhir, dan setiap tanggal hasil pola menjadi satu Pertemuan dengan id_pertemuan sendiri. Status Pertemuan bernilai DRAFT, PUBLISHED, atau CANCELLED.

Pertemuan adalah satu kelompok pada satu tanggal dan jam. Satu Pertemuan diajar oleh satu tentor atau dua tentor sekaligus, dan setiap tentor bertugas sepanjang jam Pertemuan. Penugasan Sah adalah tanda bahwa seorang tentor resmi ditugaskan pada satu Pertemuan PUBLISHED, sehingga tentor tersebut dapat mengisi materi rencana dan laporannya sendiri di dashboard tentor. Bila Pertemuan diajar dua tentor, setiap tentor memiliki Penugasan Sah sendiri dan mengerjakan isiannya masing-masing. Pertemuan yang laporannya belum dikirim berarti Pertemuan yang masih memiliki minimal satu laporan tentor berstatus NOT_SUBMITTED. Penugasan Sah terbentuk saat jadwal diterbitkan atau saat pengganti disahkan.

Sistem memeriksa seluruh ketentuan publikasi dan hanya menerbitkan draf bila tidak ada kondisi yang ditolak. Publikasi berlaku untuk seluruh Pertemuan dalam satu draf sebagai satu kesatuan. Jadwal PUBLISHED diteruskan kepada tentor, kepada Modul Manajemen Aset untuk kebutuhan laptop dan pengiriman oleh Kurir, dan kepada Modul Penggajian untuk presensi dan honor per Penugasan Sah.

Aktor: Admin Edukom.

User Story

**ADM-08** Sebagai Admin Edukom, saya ingin menyusun jadwal berdasarkan kesepakatan hari dan jam dengan sekolah, memeriksa, dan menerbitkannya agar tentor, Kurir, dan presensi hanya menerima jadwal resmi yang telah lolos seluruh pemeriksaan wajib.

Acceptance Criteria

AC-ADM-08.1. Draf jadwal dapat disimpan walaupun pemeriksaan belum terpenuhi. Pola Jadwal wajib memiliki hari, tanggal awal, dan tanggal akhir di dalam semester yang dipilih.

AC-ADM-08.2. Sistem membentuk Pertemuan dari Pola Jadwal dengan id_pertemuan unik dan melewati tanggal libur nasional serta tanggal tidak efektif. Tanggal yang dilewati ditampilkan kepada Admin beserta alasannya. Pembentukan ulang dari pola yang sama mengenali Pertemuan yang sudah ada, tidak membuat duplikat, dan tidak menimpa Pertemuan yang telah dijadwalkan ulang.

AC-ADM-08.3. Setiap Pertemuan wajib memiliki satu atau dua tentor. Bila dua tentor dipilih, keduanya wajib berbeda.

AC-ADM-08.4. Kebutuhan laptop satu Pertemuan adalah ceil(jumlah anggota kelompok ÷ siswa per laptop) dan tidak bertambah walaupun Pertemuan diajar dua tentor. Waktu pemakaian laptop dihitung dari jam mulai dikurangi waktu persiapan laptop sampai jam selesai ditambah waktu pengembalian laptop pada pengaturan parameter. Kapasitas perencanaan adalah jumlah laptop berstatus layak pakai menurut Modul Manajemen Aset pada tanggal Pertemuan. Pertemuan di sekolah yang memakai komputer milik sekolah tidak dihitung dalam kebutuhan laptop.

AC-ADM-08.5. Sistem menolak publikasi dan menampilkan Pertemuan beserta alasannya bila salah satu kondisi berikut terjadi.

a\. Kelompok atau Penetapan Program berasal dari sekolah atau semester yang berbeda dari jadwal.

b\. Penetapan Program tidak mencakup seluruh anggota kelompok pada tanggal Pertemuan, dan sistem menampilkan siswa penyebabnya.

c\. Kesepakatan Jadwal belum dicatat, atau tanggal Pertemuan berada di luar tanggal mulai dan tanggal akhir Catatan Kerja Sama yang tidak berstatus CANCELLED.

d\. Jam mulai Pertemuan sudah lewat.

e\. Tentor INACTIVE pada tanggal Pertemuan.

f\. Tentor atau anggota kelompok sudah memiliki Pertemuan PUBLISHED lain yang jamnya beririsan, termasuk irisan sebagian.

g\. Jeda antara dua Pertemuan milik tentor yang sama pada sekolah berbeda kurang dari jeda antarsekolah pada pengaturan parameter.

h\. Jam Pertemuan berada di luar rentang jam sekolah, atau Pertemuan terkena tanggal libur nasional atau tanggal tidak efektif.

i\. Ketersediaan tentor berklasifikasi Tidak Tersedia.

j\. Ketersediaan tentor berklasifikasi Belum Mengisi dan Admin belum mencatat dasar koordinasi dengan tentor untuk Pertemuan tersebut.

k\. Jumlah kebutuhan laptop seluruh Pertemuan PUBLISHED dan draf yang waktu pemakaian laptopnya beririsan melebihi kapasitas perencanaan.

AC-ADM-08.6. Contoh uji bentrok: tentor yang dijadwalkan pukul 08.00–09.10 tidak dapat dijadwalkan pukul 09.00–10.10 pada tanggal yang sama, tetapi dapat dijadwalkan pukul 09.10–10.20 di sekolah yang sama. Contoh uji laptop dengan waktu persiapan dan pengembalian masing-masing 30 menit: Pertemuan pukul 07.30–08.40 dengan kebutuhan 8 laptop memakai laptop sampai 09.10, dan Pertemuan di sekolah lain pukul 09.00–10.10 dengan kebutuhan 8 laptop memakai laptop mulai 08.30, sehingga kebutuhan keduanya dijumlahkan menjadi 16.

AC-ADM-08.7. Bila rentang jam sekolah atau kapasitas perencanaan belum tersedia, pemeriksaan terkait berhasil Belum Diperiksa dan tidak memblokir publikasi. Pertemuan tersebut diberi penanda Belum Diperiksa dan tampil pada Daftar Tindak Lanjut. Saat data menjadi tersedia, sistem menjalankan pemeriksaan ulang dan memberi penanda Perlu Ditinjau bila pemeriksaan gagal.

AC-ADM-08.8. Pertemuan dengan ketersediaan Belum Mengisi yang sudah memiliki dasar koordinasi diterbitkan dengan penanda Ketersediaan Belum Dikonfirmasi.

AC-ADM-08.9. Sistem menampilkan seluruh kondisi yang ditolak dan seluruh pemeriksaan Belum Diperiksa sebelum Admin menekan Terbitkan.

AC-ADM-08.10. Saat Terbitkan ditekan, sistem mengulang seluruh pemeriksaan dengan data terkini dalam satu transaksi. Bila satu Pertemuan ditolak, seluruh draf tetap DRAFT. Bila dua publikasi yang bertabrakan dijalankan bersamaan, tepat satu yang berhasil dan yang lain ditolak dengan alasan bentrok.

AC-ADM-08.11. Publikasi yang berhasil menetapkan status PUBLISHED, mencatat penerbit dan waktu terbit, membentuk satu Penugasan Sah dan satu laporan berstatus NOT_SUBMITTED untuk setiap tentor pada setiap Pertemuan, menampilkan Pertemuan tersebut di dashboard setiap tentor, dan mengirim jadwal kepada tentor, Modul Manajemen Aset, dan Modul Penggajian. Pertemuan di sekolah yang memakai komputer milik sekolah tidak dikirim sebagai permintaan pengantaran laptop.

AC-ADM-08.12. Tentor hanya melihat Pertemuan PUBLISHED yang memiliki Penugasan Sah atas namanya, beserta sekolah, kelompok, tanggal, jam, dan nama tentor lain bila Pertemuan diajar dua tentor.

### ADM-09 \| Penjadwalan Ulang dan Pembatalan Pertemuan

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk menjadwalkan ulang dan membatalkan Pertemuan yang telah berstatus PUBLISHED. Setiap penjadwalan ulang dan pembatalan wajib memuat alasan dan kategori alasan agar presensi dan honorarium memperlakukan Pertemuan tersebut sesuai Lampiran C.

Aktor: Admin Edukom.

User Story

**ADM-09** Sebagai Admin Edukom, saya ingin menjadwalkan ulang atau membatalkan Pertemuan dengan alasan yang tercatat agar tentor, Kurir, presensi, dan honorarium mengikuti perubahan tersebut dengan benar.

Acceptance Criteria

AC-ADM-09.1. Penjadwalan ulang hanya memengaruhi Pertemuan yang dipilih. Admin wajib mengisi tanggal dan jam mulai pengganti, alasan, dan hasil koordinasi dengan sekolah. Waktu pengganti wajib lolos seluruh pemeriksaan publikasi sebelum ditetapkan. Penjadwalan ulang mempertahankan id_pertemuan, riwayat waktu sebelumnya, dan Pertemuan lain dalam pola, dan laporan yang sudah dikirim tetap mengacu pada data yang dibekukan saat pengiriman.

AC-ADM-09.2. Admin dapat membatalkan Pertemuan PUBLISHED yang belum memiliki laporan terkirim dengan alasan wajib. Pembatalan menetapkan Pertemuan dan seluruh laporannya menjadi CANCELLED, menutup Kasus Penggantian terbuka pada Pertemuan tersebut sebagai Dibatalkan, dan mengirim pemberitahuan kepada tentor, Modul Izin, Modul Manajemen Aset, dan Modul Penggajian. Pertemuan CANCELLED tidak dapat diterbitkan kembali, tidak dapat dilaporkan, dan tidak dihitung sebagai terjadwal.

AC-ADM-09.3. Penjadwalan ulang dan pembatalan wajib memilih kategori alasan, yaitu Dibatalkan Sekolah, Libur, Dibatalkan Edukom, atau Dijadwalkan Ulang. Kategori ini diteruskan ke Modul Penggajian sebagai dasar penanda presensi (PAY-02, PAY-04) dan perlakuan honorarium (Lampiran C). Kategori Libur otomatis diberikan pada tanggal yang dilewati karena libur nasional atau tanggal tidak efektif.

AC-ADM-09.4. Admin dapat menandai Pertemuan PUBLISHED sebagai Dibatalkan Sekolah setelah tentor sudah melakukan presensi. Penandaan ini diteruskan ke PAY-04 dan tidak menghapus catatan presensi.

### ADM-10 \| Pemantauan dan Tindak Lanjut Kesiapan Operasional

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk melihat kebutuhan laptop setiap Pertemuan, alokasi unit, kesiapan aktual, dan informasi distribusi dari Modul Manajemen Aset, serta mencatat kendala nonperangkat dan tindak lanjutnya. Kerusakan perangkat tetap dicatat pada Modul Manajemen Aset. Kegagalan pembaruan data dari Modul Manajemen Aset tidak memblokir publikasi jadwal dan ditangani sebagai tindak lanjut operasional. Status kesiapan dihitung oleh AST-09 dan hanya ditampilkan pada fungsi ini. Kebutuhan laptop mengikuti rumus pada AC-ADM-08.4.

Aktor: Admin Edukom.

User Story

**ADM-10** Sebagai Admin Edukom, saya ingin memantau kesiapan perangkat dan mencatat penanganan kendala pada Pertemuan terdampak agar Pertemuan yang belum siap ditangani sebelum hari pelaksanaan.

Acceptance Criteria

AC-ADM-10.1. Tampilan memisahkan kebutuhan laptop, unit yang dialokasikan, dan kesiapan atau distribusi aktual, masing-masing dengan sumber dan waktu pembaruan terakhir.

AC-ADM-10.2. Status kesiapan setiap Pertemuan bernilai Belum Siap, Sebagian Siap, atau Siap sesuai AST-09, serta Tidak Diketahui bila data belum tersedia. Sistem tidak pernah menganggap Pertemuan Siap tanpa data dari Modul Manajemen Aset. Pertemuan di sekolah yang memakai komputer milik sekolah ditampilkan dengan status Perangkat Sekolah dan tidak masuk pemantauan laptop.

AC-ADM-10.3. Beberapa Pertemuan dapat mengacu pada satu kegiatan distribusi yang sama, dan pemakaian laptop secara bergantian tidak dihitung sebagai pengiriman terpisah.

AC-ADM-10.4. Bila pembaruan dari Modul Manajemen Aset gagal, sistem menampilkan nilai terakhir yang diketahui, waktu pembaruan terakhir, dan tanda Pembaruan Gagal tanpa menghapus data tersimpan.

AC-ADM-10.5. Pertemuan di dalam jendela peringatan pada pengaturan parameter yang belum Siap tampil pada Daftar Tindak Lanjut.

AC-ADM-10.6. Setiap kendala nonperangkat mencatat Pertemuan terdampak, kategori (SEKOLAH_TUTUP, LISTRIK_ATAU_JARINGAN, atau LAINNYA), uraian, pihak terkait, tindakan, perkembangan, waktu, dan status OPEN, IN_PROGRESS, atau RESOLVED. Status RESOLVED wajib disertai tindakan akhir.

AC-ADM-10.7. Penyesuaian jadwal akibat kendala diproses melalui fungsi penjadwalan, dan penyelesaian kendala tidak mengubah status laporan Pertemuan.

AC-ADM-10.8. Fungsi ini tidak menghitung ulang dan tidak mengoreksi status kesiapan. Koreksi manual atas status kesiapan hanya dilakukan pada AST-09.

### ADM-11 \| Pengisian Materi Rencana per Pertemuan

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor untuk mengisi materi rencana pada setiap Pertemuan yang ditugaskan kepadanya. Materi rencana diisi melalui dashboard tentor setelah jadwal diterbitkan. Setiap tentor mengisi materi rencananya sendiri. Bila satu Pertemuan diajar dua tentor, sistem menyimpan dua materi rencana yang terpisah, satu milik setiap tentor. Admin Edukom hanya dapat membaca materi rencana.

Aktor: Tentor.

User Story

**ADM-11** Sebagai tentor, saya ingin mengisi materi rencana saya sendiri di dashboard sebelum tenggat agar persiapan mengajar saya tercatat untuk kelompok dan tanggal yang tepat.

Acceptance Criteria

AC-ADM-11.1. Dashboard tentor menampilkan setiap Pertemuan PUBLISHED yang ditugaskan kepadanya beserta sekolah, program, kelompok, tanggal, jam, nama tentor lain bila ada, dan status materi rencana Sudah Diisi atau Belum Diisi.

AC-ADM-11.2. Tentor hanya dapat mengisi dan mengubah materi rencana miliknya sendiri. Tentor dapat melihat materi rencana tentor lain pada Pertemuan yang sama, tetapi tidak dapat mengubahnya.

AC-ADM-11.3. Setiap kali materi rencana disimpan, sistem mencatat isi, nama tentor, dan waktu penyimpanan sebagai riwayat.

AC-ADM-11.4. Tenggat materi rencana adalah pukul 23.59 WIB satu hari sebelum tanggal Pertemuan, sesuai nilai pada pengaturan parameter. Materi rencana yang masih kosong saat tenggat diberi penanda Materi Belum Terisi, dan tentor pemiliknya menerima pengingat. Bila tentor baru ditugaskan setelah tenggat, tenggatnya adalah jam mulai Pertemuan.

AC-ADM-11.5. Bila pengganti sudah disahkan, tentor asal tidak dapat lagi mengisi materi rencana pada Pertemuan tersebut. Pengganti mengisi materi rencananya sendiri, dan isian tentor asal tetap tersimpan sebagai riwayat.

AC-ADM-11.6. Materi rencana dapat diubah sampai tentor mengirim laporannya, lalu terkunci. Materi rencana adalah rencana mengajar, sedangkan materi yang benar-benar disampaikan dicatat pada laporan Pertemuan.

### ADM-12 \| Pengaturan Kewajiban Dokumen Administrasi Tentor dan Status Kelengkapan

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk mengatur periode, cakupan, tenggat, aturan berkas, checklist, dan penanda syarat bonus bagi enam jenis dokumen yang wajib diunggah tentor sebagai persyaratan kelengkapan administrasi, serta membentuk kewajiban setiap tentor. Sistem membentuk satu kewajiban dengan identitas sendiri untuk setiap kombinasi tentor, jenis dokumen, periode, dan cakupan berikut.

1\. Kalender Akademik: tahunan; satu kewajiban per tentor, sekolah, dan tahun ajaran.

2\. PROTA: tahunan; satu kewajiban per tentor, program, sekolah, dan tahun ajaran.

3\. Alokasi Waktu: tahunan; satu kewajiban per tentor, program, sekolah, dan tahun ajaran.

4\. PROSEM: semesteran; satu kewajiban per tentor, Penetapan Program, dan semester.

5\. Silabus: semesteran; satu kewajiban per tentor, Penetapan Program, dan semester.

6\. Modul Pembelajaran: semesteran; satu kewajiban per tentor, Penetapan Program, dan semester.

Kewajiban terbentuk otomatis saat tentor memperoleh Penugasan Sah pertama pada cakupan tersebut melalui penerbitan jadwal. Bila Pertemuan diajar dua tentor, setiap tentor memperoleh kewajibannya sendiri. Tentor pengganti dengan jenis penggantian Sementara tidak memperoleh kewajiban, sedangkan tentor pengganti dengan jenis penggantian Permanen memperoleh kewajiban untuk cakupan yang diambil alih. Sistem menyediakan ringkasan kewajiban bertanda syarat bonus yang dibaca Modul Penggajian untuk menentukan bonus kelengkapan administrasi. Jadwal Pembelajaran tidak menjadi kewajiban unggahan karena dihasilkan sistem dari jadwal resmi (AC-ADM-13.7).

Aktor: Admin Edukom.

User Story

**ADM-12.1** Sebagai Admin Edukom, saya ingin mengatur kewajiban setiap jenis dokumen sesuai periode dan cakupan agar daftar unggahan, penyebut kelengkapan, dan dasar bonus setiap tentor sesuai dengan penugasannya.

**ADM-12.2** Sebagai Admin Edukom, saya ingin status kelengkapan administrasi tentor per sekolah ditetapkan otomatis dari dokumen yang terverifikasi dan dapat saya koreksi dengan alasan agar bonus dihitung dengan benar.

Acceptance Criteria

AC-ADM-12.1. Setiap kewajiban memiliki jenis dokumen, tentor pengunggah, periode, cakupan, tenggat, dan status ACTIVE atau CANCELLED. Tenggat bersifat opsional dan ditampilkan sebagai Tenggat Belum Ditetapkan bila kosong. Tenggat berakhir pukul 23.59 WIB pada tanggal tenggat.

AC-ADM-12.2. Sistem membentuk jumlah kewajiban sesuai kombinasi pada daftar di atas. Satu berkas yang berlaku untuk beberapa kelas atau kelompok dalam cakupan yang sama dihitung sebagai satu kewajiban, dan pembentukan berulang tidak menggandakan kewajiban.

AC-ADM-12.3. Dokumen tahunan dibentuk satu kali per tahun ajaran, termasuk untuk sekolah yang bekerja sama hanya satu semester. Dokumen semesteran hanya dibentuk untuk semester yang memiliki Penugasan Sah.

AC-ADM-12.4. Setiap jenis dokumen memiliki checklist kriteria kelengkapan dan kesesuaian isi dengan nomor versi, serta aturan berkas berupa daftar tipe berkas yang diizinkan dan ukuran maksimum.

AC-ADM-12.5. Perubahan konfigurasi hanya berlaku untuk kewajiban baru. Kewajiban yang sudah ada tetap memakai checklist versi saat kewajiban dibentuk, kecuali Admin secara eksplisit menerapkan versi baru. Keputusan verifikasi yang sudah tersimpan tidak berubah.

AC-ADM-12.6. Kewajiban yang sudah memiliki unggahan tidak dapat dihapus dan hanya dapat dibatalkan dengan alasan. Kewajiban CANCELLED tetap tersimpan dalam riwayat dan tidak dihitung pada penyebut rekap tentor dan dashboard.

AC-ADM-12.7. Bila seluruh Pertemuan tentor pada cakupan suatu kewajiban dibatalkan sebelum kewajiban tersebut memiliki unggahan, sistem otomatis menetapkan kewajiban tersebut menjadi CANCELLED dengan alasan Penugasan Dibatalkan.

AC-ADM-12.8. Saat penggantian Permanen disahkan, sistem membentuk kewajiban bagi tentor pengganti untuk cakupan yang diambil alih. Kewajiban tentor asal pada cakupan tersebut yang belum memiliki unggahan otomatis menjadi CANCELLED dengan alasan Penggantian Permanen, sedangkan kewajiban yang sudah memiliki unggahan tetap ACTIVE.

AC-ADM-12.9. Setiap jenis dokumen memiliki penanda syarat bonus Ya atau Tidak. Ringkasan untuk Modul Penggajian memuat, per tentor, sekolah, dan periode, jumlah kewajiban ACTIVE bertanda syarat bonus dan jumlah kewajiban tersebut yang versi terbarunya VERIFIED.

AC-ADM-12.10. Status kelengkapan administrasi ditetapkan per tentor, per sekolah, dan per periode penggajian. Status bernilai Lengkap bila seluruh kewajiban ACTIVE bertanda syarat bonus pada tentor, sekolah, dan periode tersebut memiliki versi terbaru berstatus VERIFIED, dan bernilai Belum Lengkap bila tidak. Sekolah yang diampu adalah sekolah pada Penugasan Sah tentor dalam periode tersebut. Batas pengunggahan dan verifikasi adalah cut-off periode (PAY-05), dan status yang belum Lengkap saat periode ditutup tidak menghasilkan bonus.

AC-ADM-12.11. Admin dapat mengoreksi status kelengkapan administrasi dengan alasan tertulis. Perubahan status setelah periode ditutup menghasilkan bonus susulan sebagai penyesuaian pada periode berjalan (PAY-06). Setiap perubahan status mencatat pengguna, waktu, status sebelum, status sesudah, dan alasan sesuai KU-05.

### ADM-13 \| Pengunggahan dan Perbaikan Dokumen Administrasi

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor untuk memilih kewajiban miliknya, mengunggah berkas, melihat catatan pemeriksaan, dan mengirim versi perbaikan pada kewajiban yang sama. Sistem memeriksa tipe dan ukuran berkas berdasarkan aturan berkas jenis dokumen sebelum menyimpan. Untuk membantu penyusunan dokumen, sistem menyediakan unduhan jadwal resmi tentor beserta jumlah minggu efektif. Status versi dokumen bernilai SUBMITTED, VERIFIED, NEEDS_REVISION, atau SUPERSEDED.

Aktor: Tentor.

User Story

**ADM-13** Sebagai tentor, saya ingin mengunggah dan memperbaiki berkas pada kewajiban yang sama agar Admin Edukom memeriksa versi terbaru beserta riwayat perbaikannya.

Acceptance Criteria

AC-ADM-13.1. Tentor hanya melihat dan memilih kewajiban ACTIVE miliknya. Sebelum mengunggah, tentor melihat jenis dokumen, periode, cakupan, dan tenggat kewajiban yang dipilih.

AC-ADM-13.2. Sistem memeriksa tipe dan ukuran berkas sebelum menyimpan. Berkas yang tidak memenuhi aturan ditolak dengan alasan berupa tipe tidak diizinkan atau ukuran melebihi batas beserta nilai batasnya, tidak disimpan, dan tidak mengubah status kewajiban.

AC-ADM-13.3. Unggahan yang diterima menyimpan pengunggah, waktu unggah, nomor versi berurutan, dan status SUBMITTED. Waktu unggah pertama yang diterima pada kewajiban disimpan tersendiri dan tidak berubah.

AC-ADM-13.4. Pada versi NEEDS_REVISION, tentor melihat catatan Admin. Pengiriman perbaikan menghasilkan versi baru pada kewajiban yang sama dengan status SUBMITTED.

AC-ADM-13.5. Bila tentor mengunggah versi baru saat versi sebelumnya masih SUBMITTED, versi sebelumnya berstatus SUPERSEDED dan tidak diperiksa. Hanya versi terbaru yang dapat diperiksa.

AC-ADM-13.6. Versi dan keputusan terdahulu dapat ditelusuri, dan unggah ulang tidak menambah jumlah kewajiban.

AC-ADM-13.7. Tentor dapat mengunduh jadwal resmi miliknya per sekolah dan semester beserta jumlah minggu efektif, yaitu jumlah pekan yang memiliki minimal satu Pertemuan PUBLISHED. Unduhan ini menggantikan dokumen Jadwal Pembelajaran sehingga tidak perlu diunggah, dan menjadi bahan penyusunan PROSEM tanpa menggantikan unggahan PROSEM.

AC-ADM-13.8. Kalender Akademik yang diunggah tentor adalah dokumen administrasi dan tidak mengubah tanggal tidak efektif maupun jadwal resmi.

### ADM-14 \| Verifikasi Kelengkapan dan Kesesuaian Isi Dokumen

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk memeriksa versi dokumen berstatus SUBMITTED berdasarkan checklist jenis dokumen, lalu menetapkan VERIFIED atau NEEDS_REVISION dengan catatan perbaikan. Setiap versi hanya memiliki satu keputusan akhir. Mekanisme verifikasi mengikuti KU-06.

Aktor: Admin Edukom.

User Story

**ADM-14** Sebagai Admin Edukom, saya ingin memeriksa kelengkapan dan isi dokumen berdasarkan checklist agar setiap persetujuan atau permintaan perbaikan memiliki dasar yang jelas dan tidak bertentangan.

Acceptance Criteria

AC-ADM-14.1. Admin membuka versi berstatus SUBMITTED beserta checklist versi yang berlaku pada kewajiban tersebut.

AC-ADM-14.2. Setiap kriteria wajib diberi hasil Terpenuhi atau Tidak Terpenuhi. Status VERIFIED hanya dapat ditetapkan bila seluruh kriteria wajib telah diberi hasil dan seluruhnya Terpenuhi.

AC-ADM-14.3. Keputusan NEEDS_REVISION mewajibkan catatan, dan tentor melihat catatan tersebut pada halaman unggahan.

AC-ADM-14.4. Saat keputusan disimpan, sistem memeriksa bahwa versi masih SUBMITTED. Bila versi sudah diputuskan Admin lain atau sudah SUPERSEDED, sistem menolak keputusan baru dan menampilkan keadaan terkini.

AC-ADM-14.5. Keputusan menyimpan pemeriksa, waktu, hasil setiap kriteria, nomor versi checklist, dan nomor versi dokumen. Keputusan atas satu versi tidak berlaku bagi versi lain, dan perubahan checklist sesudahnya tidak mengubah dasar keputusan tersebut.

AC-ADM-14.6. Saat Kalender Akademik pertama untuk satu sekolah dan tahun ajaran ditetapkan VERIFIED, sistem menampilkan pengingat kepada Admin untuk mencatat tanggal tidak efektif sekolah tersebut berdasarkan kalender itu. Pengingat tampil pada Daftar Tindak Lanjut sampai Admin menandainya selesai.

### ADM-15 \| Pengelolaan Kegiatan Penilaian

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk menetapkan Kegiatan Penilaian, yaitu kegiatan pembelajaran yang dinilai atau menghasilkan portofolio, pada Penetapan Program dan Pertemuan tertentu. Tentor mencatat nilai dan portofolio berdasarkan Kegiatan Penilaian pada ADM-16 dan tidak dapat mengubahnya.

Aktor: Admin Edukom; Tentor (melihat).

User Story

**ADM-15** Sebagai Admin Edukom, saya ingin menetapkan Kegiatan Penilaian beserta jenis penilaian dan sasarannya agar tentor mencatat nilai dan portofolio berdasarkan acuan yang sama dan hasilnya dapat direkap.

Acceptance Criteria

AC-ADM-15.1. Kegiatan Penilaian memuat nama, Penetapan Program, jenis penilaian (nilai, portofolio, atau keduanya), Pertemuan atau rentang tanggal pelaksanaan, penanda wajib atau opsional, dan status ACTIVE atau INACTIVE.

AC-ADM-15.2. Kegiatan Penilaian hanya dapat dikaitkan dengan Penetapan Program berstatus READY dan Pertemuan yang termasuk dalam Penetapan Program tersebut.

AC-ADM-15.3. Siswa sasaran Kegiatan Penilaian adalah anggota kelompok yang aktif pada tanggal Pertemuan sesuai AC-ADM-02.15.

AC-ADM-15.4. Kegiatan Penilaian berpenanda wajib mensyaratkan nilai atau portofolio untuk siswa sasaran sebelum laporan Pertemuan dikirim (AC-ADM-17.4). Pertemuan tanpa Kegiatan Penilaian dapat dilaporkan tanpa nilai atau portofolio.

AC-ADM-15.5. Kegiatan Penilaian yang sudah memiliki catatan nilai atau portofolio tidak dapat dihapus dan hanya dapat dinonaktifkan. Kegiatan nonaktif tidak dapat dipilih pada Pertemuan baru, dan catatan lama tetap tersimpan.

AC-ADM-15.6. Perubahan Kegiatan Penilaian menyimpan riwayat. Bila perubahan memengaruhi Pertemuan PUBLISHED yang laporannya belum dikirim, sistem memberi penanda Perlu Ditinjau sesuai KU-07.

AC-ADM-15.7. Tentor hanya dapat melihat Kegiatan Penilaian pada Pertemuan yang memiliki Penugasan Sah atas namanya dan tidak dapat mengubahnya.

### ADM-16 \| Pencatatan Nilai dan Portofolio Siswa

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor yang memiliki Penugasan Sah untuk mencatat nilai dan portofolio siswa berdasarkan Kegiatan Penilaian yang ditetapkan Admin Edukom pada ADM-15. Tentor tidak dapat mengubah Kegiatan Penilaian. Bila Pertemuan diajar dua tentor, setiap tentor mencatat nilai dan portofolio pada laporannya sendiri, dan catatan satu tentor tidak menggantikan catatan tentor lainnya. Catatan nilai dan portofolio terhubung dengan siswa, Pertemuan, jenis penilaian, kegiatan asal, dan pencatat.

Aktor: Tentor.

User Story

**ADM-16** Sebagai tentor, saya ingin mencatat nilai dan portofolio berdasarkan Kegiatan Penilaian agar hasil belajar siswa dapat direkap dan ditelusuri ke kegiatan asalnya.

Acceptance Criteria

AC-ADM-16.1. Tentor hanya dapat memilih siswa sasaran dan Kegiatan Penilaian pada Pertemuan yang memiliki Penugasan Sah atas namanya. Sistem memeriksa Penugasan Sah pada setiap penyimpanan.

AC-ADM-16.2. Nilai berupa bilangan 0 sampai 100 dengan paling banyak dua angka desimal, dan sistem menolak nilai di luar ketentuan tersebut.

AC-ADM-16.3. Nilai menyimpan siswa, Pertemuan, jenis penilaian, kegiatan asal, pencatat, dan waktu pencatatan. Nilai kosong dan nilai 0 adalah dua kondisi berbeda pada tampilan, rekap, dan ekspor. Pada ekspor, nilai kosong berupa sel kosong dan nilai 0 berupa angka 0.

AC-ADM-16.4. Portofolio berupa catatan atau berkas hasil karya yang terhubung dengan siswa dan kegiatan asal. Berkas portofolio wajib memenuhi tipe dan ukuran maksimum pada pengaturan parameter.

AC-ADM-16.5. Pertemuan tanpa Kegiatan Penilaian dapat dilaporkan tanpa nilai atau portofolio, dan perpindahan kelas mempertahankan hasil terdahulu pada kegiatan asal.

AC-ADM-16.6. Koreksi pada catatan yang laporannya sudah dikirim menyimpan nilai lama, nilai baru, alasan, pencatat, dan waktu. Catatan pada laporan VERIFIED hanya dapat dikoreksi setelah Owner membuka kembali laporan tersebut.

### ADM-17 \| Pencatatan dan Pengiriman Laporan Pertemuan

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor untuk mengisi dan mengirim laporan pada setiap Pertemuan yang ditugaskan kepadanya. Setiap tentor memiliki laporan sendiri. Bila satu Pertemuan diajar dua tentor, setiap tentor mengisi dan mengirim laporannya masing-masing, termasuk absensi siswa, sebagai kelengkapan administrasinya. Laporan dibuat otomatis saat jadwal diterbitkan dengan status NOT_SUBMITTED dan tampil di dashboard tentor. Laporan berisi hasil pelaksanaan TERLAKSANA atau TIDAK_TERLAKSANA, absensi seluruh siswa, materi yang disampaikan, jurnal kegiatan, serta nilai dan portofolio bila Kegiatan Penilaian mewajibkannya. Laporan juga menampilkan status presensi tentor dari Modul Penggajian sebagai informasi. Status laporan bernilai NOT_SUBMITTED, SUBMITTED, NEEDS_REVISION, VERIFIED, atau CANCELLED.

Aktor: Tentor; Admin Edukom (mencatat laporan yang tidak dikirim tentor).

User Story

**ADM-17** Sebagai tentor, saya ingin mengisi absensi, materi yang disampaikan, dan jurnal pada laporan saya sendiri lalu mengirimkannya agar pekerjaan saya tercatat lengkap sebagai kelengkapan administrasi.

Acceptance Criteria

AC-ADM-17.1. Tentor hanya dapat mengisi dan mengirim laporan miliknya sendiri. Laporan tentor lain pada Pertemuan yang sama dapat dilihat, tetapi tidak dapat diubah.

AC-ADM-17.2. Laporan TERLAKSANA dapat diisi mulai jam mulai Pertemuan dan dikirim setelah jam selesai Pertemuan. Laporan TIDAK_TERLAKSANA dapat dicatat mulai pukul 00.00 WIB pada tanggal Pertemuan.

AC-ADM-17.3. Daftar absensi berisi anggota kelompok pada tanggal Pertemuan, termasuk bila laporan diisi setelah siswa pindah kelas atau kelompok. Setiap siswa diberi tepat satu status HADIR, IZIN, SAKIT, atau ALPA.

AC-ADM-17.4. Laporan TERLAKSANA wajib berisi absensi seluruh siswa, materi yang disampaikan, dan jurnal kegiatan, serta nilai atau portofolio untuk siswa sasaran bila Kegiatan Penilaian mewajibkannya. Setiap tentor wajib mengisi seluruh isian ini pada laporannya sendiri, dan isian pada laporan tentor lain tidak dapat dipakai untuk melengkapinya.

AC-ADM-17.5. Bila seluruh siswa pada laporan TERLAKSANA berstatus selain HADIR, sistem meminta konfirmasi sebelum pengiriman dan menyarankan pemilihan TIDAK_TERLAKSANA.

AC-ADM-17.6. Laporan TIDAK_TERLAKSANA wajib berisi kategori dan uraian, tanpa absensi dan materi. Kategori bernilai SEKOLAH_TUTUP, TENTOR_TIDAK_HADIR, TANPA_PENGGANTI, PERANGKAT_TIDAK_SIAP, atau LAINNYA.

AC-ADM-17.7. Sebelum laporan dikirim, sistem menampilkan setiap isian wajib yang masih kosong beserta nama siswa terkait, dan menolak pengiriman selama masih ada isian wajib yang kosong.

AC-ADM-17.8. Bila tentor tidak memiliki catatan presensi pada Modul Penggajian untuk Pertemuan tersebut, laporannya diberi penanda Tanpa Presensi. Penanda ini tidak menghalangi pengiriman.

AC-ADM-17.9. Tenggat laporan adalah 48 jam setelah jam selesai Pertemuan, sesuai nilai pada pengaturan parameter. Laporan yang belum dikirim saat tenggat diberi penanda Terlambat dan tetap dapat dikirim. Bila laporan seorang tentor masih NOT_SUBMITTED setelah tenggat, Admin dapat mencatat laporan tersebut sebagai TIDAK_TERLAKSANA dengan alasan wajib, misalnya dengan kategori TENTOR_TIDAK_HADIR bila tentor tersebut tidak datang.

AC-ADM-17.10. Bila sinyal terputus, isian laporan disimpan sementara di perangkat dalam bentuk terenkripsi dan dikirim ke server saat sinyal kembali. Isian sementara dihapus saat tentor keluar dari aplikasi. Bila isian di perangkat berbeda dengan isian di server, tentor memilih isian yang dipakai.

AC-ADM-17.11. Saat laporan dikirim, sistem menyimpan salinan isi laporan dan data Pertemuan pada saat itu, mencatat waktu kirim, memberi nomor versi, dan menetapkan status SUBMITTED. Laporan SUBMITTED tidak dapat diubah tentor, dan perubahan data sesudahnya, seperti perpindahan siswa, tidak mengubah salinan tersebut.

AC-ADM-17.12. Laporan NEEDS_REVISION menampilkan catatan pemeriksa dan dapat diperbaiki oleh tentor pemiliknya. Pengiriman ulang menghasilkan versi baru pada laporan yang sama, dan versi sebelumnya tetap tersimpan sebagai riwayat.

### ADM-18 \| Pemeriksaan dan Verifikasi Laporan Pertemuan

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk memeriksa laporan berstatus SUBMITTED terhadap data Pertemuan yang dibekukan saat pengiriman berdasarkan kriteria verifikasi laporan, lalu menetapkan VERIFIED atau NEEDS_REVISION. Bila Pertemuan diajar dua tentor, Admin memeriksa laporan setiap tentor secara terpisah, dan keputusan atas satu laporan tidak memengaruhi laporan lainnya. Laporan VERIFIED tidak dapat diubah, kecuali Owner membukanya kembali dengan alasan wajib. Verifikasi laporan tidak mengesahkan presensi atau honorarium.

Aktor: Admin Edukom; Owner (membuka kembali laporan VERIFIED).

User Story

**ADM-18** Sebagai Admin Edukom, saya ingin memeriksa laporan terhadap data Pertemuan yang dibekukan saat pengiriman agar laporan yang sesuai disahkan dan kekurangan dikembalikan kepada tentor untuk diperbaiki.

Acceptance Criteria

AC-ADM-18.1. Admin membuka laporan SUBMITTED beserta data yang dibekukan pada versi tersebut, yaitu jadwal, nama tentor pemilik laporan, penanda Tanpa Presensi, peserta, hasil pelaksanaan, absensi, materi yang disampaikan, jurnal, serta nilai atau portofolio bila diwajibkan.

AC-ADM-18.2. Bila data master saat ini berbeda dengan data yang dibekukan, sistem menampilkan perbedaan itu sebagai informasi terpisah dan tidak mengubah isi laporan.

AC-ADM-18.3. Setiap kriteria wajib diberi hasil Terpenuhi atau Tidak Terpenuhi. Status VERIFIED hanya dapat ditetapkan bila seluruh kriteria wajib telah diberi hasil dan seluruhnya Terpenuhi. Keputusan NEEDS_REVISION mewajibkan catatan yang dapat dilihat tentor pada laporannya.

AC-ADM-18.4. Keputusan menyimpan pemeriksa, waktu, hasil setiap kriteria, nomor versi kriteria, dan nomor versi laporan.

AC-ADM-18.5. Saat keputusan disimpan, sistem memeriksa bahwa versi yang dinilai masih SUBMITTED dan merupakan versi terbaru. Bila tidak, sistem menolak keputusan dan menampilkan keadaan terkini.

AC-ADM-18.6. Hanya Owner yang dapat membuka kembali laporan VERIFIED, dengan alasan wajib. Pembukaan kembali menghasilkan versi baru berstatus NEEDS_REVISION dan mempertahankan versi VERIFIED sebelumnya sebagai riwayat.

### ADM-19 \| Rekapitulasi Administrasi Pribadi Tentor

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor untuk melihat rekap administrasi pribadinya berdasarkan tahun ajaran, semester, atau bulan. Rekap memuat jumlah kewajiban dokumen ACTIVE, dokumen terkumpul, dokumen terverifikasi, dokumen perlu perbaikan, tenggat, dan status keterlambatan, serta rekap Penugasan Sah, absensi, nilai, portofolio, dan laporan. Penyebut dokumen adalah jumlah kewajiban ACTIVE milik tentor pada periode yang dipilih, dan beberapa versi pada satu kewajiban dihitung sebagai satu kewajiban. Data kegiatan dihitung berdasarkan tanggal Pertemuan, sedangkan data dokumen dihitung berdasarkan periode kewajiban. Pada pilihan bulan, kewajiban yang dihitung adalah kewajiban yang tenggatnya berada pada bulan tersebut, dan kewajiban tanpa tenggat hanya dihitung pada pilihan semester dan tahun ajaran.

Aktor: Tentor.

User Story

**ADM-19** Sebagai tentor, saya ingin melihat rekap kewajiban dokumen, status versi terbaru, tenggat, keterlambatan, serta rekap penugasan, absensi, nilai, dan portofolio agar saya mengetahui administrasi yang masih harus diselesaikan.

Acceptance Criteria

AC-ADM-19.1. Tentor hanya melihat kewajiban dan Penugasan Sah atas namanya. Penugasan sebagai pengganti masuk rekap tentor pengganti dan tidak masuk rekap tentor asal.

AC-ADM-19.2. Dokumen Terkumpul adalah kewajiban yang memiliki minimal satu unggahan diterima. Dokumen Terverifikasi adalah kewajiban yang versi terbarunya VERIFIED. Dokumen Perlu Perbaikan adalah kewajiban yang versi terbarunya NEEDS_REVISION.

AC-ADM-19.3. Contoh uji: lima kewajiban dengan empat terkumpul dan dua versi terbaru VERIFIED ditampilkan sebagai 4/5 terkumpul dan 2/5 terverifikasi. Bila tidak ada kewajiban ACTIVE pada periode yang dipilih, indikator menampilkan Tidak Berlaku.

AC-ADM-19.4. Status keterlambatan pengumpulan awal setiap kewajiban ditetapkan sebagai berikut. Waktu tunggu pemeriksaan dan waktu pengiriman perbaikan ditampilkan terpisah dan tidak memengaruhi status ini.

a\. Tenggat kosong menghasilkan Tenggat Belum Ditetapkan.

b\. Tenggat terlewati tanpa unggahan diterima menghasilkan Terlambat Belum Mengumpulkan.

c\. Unggahan pertama diterima pada atau sebelum tenggat menghasilkan Tepat Waktu.

d\. Unggahan pertama diterima setelah tenggat menghasilkan Terlambat Mengumpulkan Awal.

AC-ADM-19.5. Pertemuan tanpa Kegiatan Penilaian tidak ditandai sebagai nilai atau portofolio belum lengkap, dan rekap menghitung nilai kosong dan nilai 0 secara terpisah.

AC-ADM-19.6. Tentor dapat membuka kewajiban atau Pertemuan sumber dari setiap angka pada rekap.

AC-ADM-19.7. Tentor melihat status kelengkapan administrasi (Lengkap atau Belum Lengkap) per sekolah beserta daftar kewajiban yang belum terverifikasi, sebagaimana ditetapkan pada AC-ADM-12.10.

### ADM-20 \| Daftar Tindak Lanjut

SRS — Kebutuhan Fungsional

Sistem harus menyediakan Daftar Tindak Lanjut bagi Admin Edukom, yaitu satu daftar terpusat yang menghimpun penanda dan peringatan dari seluruh fungsi agar Pertemuan, kasus, atau data yang memerlukan perhatian dapat ditangani sebelum menimbulkan masalah operasional.

Aktor: Admin Edukom; Owner (melihat butir Dieskalasi).

User Story

**ADM-20** Sebagai Admin Edukom, saya ingin melihat seluruh hal yang perlu ditindaklanjuti dalam satu daftar yang terurut menurut prioritas agar tidak ada Pertemuan, kasus penggantian, atau dokumen yang terlewat.

Acceptance Criteria

AC-ADM-20.1. Daftar memuat butir dari seluruh fungsi yang menyebut Daftar Tindak Lanjut, yaitu penanda Perlu Ditinjau (ADM-01 sampai ADM-08, KU-07), Belum Diperiksa (AC-ADM-08.7), Materi Belum Terisi (ADM-11), Target Belum Terpenuhi (ADM-03), siswa Belum Ditempatkan (ADM-04), pengingat tanggal tidak efektif (ADM-14), Pertemuan yang belum Siap dalam jendela peringatan dan Pembaruan Gagal (ADM-10), serta Kasus Penggantian berstatus Perlu Tindak Lanjut, Mendadak, atau Dieskalasi (IZN-05, IZN-07).

AC-ADM-20.2. Setiap butir memuat jenis butir, objek terkait (Pertemuan, kelompok, kasus, atau dokumen), alasan, waktu timbul, dan tautan ke objek sumber.

AC-ADM-20.3. Butir diurutkan dengan butir bertanda Mendadak paling atas, kemudian menurut tanggal Pertemuan terdekat.

AC-ADM-20.4. Admin dapat menyaring daftar menurut jenis butir, sekolah, tanggal, dan status Terbuka atau Selesai.

AC-ADM-20.5. Admin dapat menandai butir selesai dengan catatan. Butir yang selesai tidak dihapus dan tetap tersimpan sebagai riwayat. Butir juga hilang dari status Terbuka ketika penyebabnya diperbaiki pada fungsi sumber.

AC-ADM-20.6. Daftar tidak mengubah jadwal atau data sumber secara otomatis. Perubahan tetap dilakukan Admin melalui fungsi yang bersangkutan.

AC-ADM-20.7. Owner dapat melihat butir berstatus Dieskalasi, sedangkan seluruh butir lain hanya dapat dilihat dan ditangani Admin.

## 3.3 Modul Izin dan Penggantian Tentor (IZN)

Modul ini mengatur pengajuan izin tentor, pemilihan dan konfirmasi pengganti, pengesahan perubahan pelaksana, eskalasi izin tanpa pengganti, serta penggantian karena tentor nonaktif. Satu proses penggantian dikelola pada satu modul, dan perubahan pelaksana hanya disahkan pada IZN-05.

### IZN-01 \| Pengajuan Izin Terencana

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor untuk mengajukan izin tidak mengajar. Sesi adalah unit dasar izin dan penggantian, sedangkan jadwal adalah kumpulan sesi. Izin terencana diajukan paling lambat H-3 dan dapat mencakup seluruh sesi dalam satu jadwal. Izin yang diajukan kurang dari H-3, yaitu H-2, H-1, dan hari-H, diajukan per sesi melalui jalur mendesak pada IZN-02. Satu pengajuan boleh memuat beberapa sesi dan beberapa hari.

Penugasan tidak berubah sebelum Admin memutuskan. Seluruh notifikasi disampaikan melalui web. Setiap sesi yang diajukan membentuk satu Kasus Penggantian yang diproses sampai pengesahan pada IZN-05.

User Story

**IZN-01.1** Sebagai Tentor, saya ingin mengajukan izin terencana untuk satu jadwal atau lebih beserta alasan agar saya dapat tidak mengajar tanpa mengganggu sekolah mitra.

**IZN-01.2** Sebagai Tentor, saya ingin menarik pengajuan izin yang belum diputuskan agar rencana saya dapat berubah.

Acceptance Criteria

AC-IZN-01.1. Tentor memilih satu jadwal atau lebih (izin terencana) dari jadwal miliknya yang berstatus PUBLISHED, mengisi alasan, dan mengajukan izin. Satu pengajuan boleh memuat beberapa hari. Daftar jadwal yang dapat dipilih menampilkan Penugasan Sah tentor pada Pertemuan PUBLISHED yang jam mulainya belum lewat, beserta sekolah, kelompok, tanggal, jam, dan nama tentor lain bila Pertemuan diajar dua tentor.

AC-IZN-01.2. Izin terencana hanya dapat diajukan paling lambat H-3 sebelum sesi, dihitung hari kalender, dengan batas pukul 23.59 WIB pada H-3. Pengajuan setelah batas itu diarahkan ke jalur mendesak pada IZN-02.

AC-IZN-01.3. Pengajuan izin melanjutkan ke pemilihan pengganti pada IZN-03. Izin tidak dapat diajukan atas sesi yang sudah lewat.

AC-IZN-01.4. Status Kasus Penggantian per sesi mengikuti Lampiran B, yaitu Menunggu Pengganti, Menunggu Konfirmasi, Menunggu Admin, Perlu Tindak Lanjut, Dieskalasi, Disetujui, Ditolak, Ditarik, Kedaluwarsa, Dijadwalkan Ulang, dan Dibatalkan. Status Kedaluwarsa diberikan apabila pengganti tidak merespons atau sesi lewat tanpa keputusan.

AC-IZN-01.5. Tentor dapat menarik pengajuan selama belum berstatus Disetujui. Penarikan membatalkan permintaan kepada pengganti dan memberi tahu pengganti. Kasus terkait yang belum disahkan berstatus Ditarik.

AC-IZN-01.6. Selama Admin belum memutuskan, penugasan tidak berubah. Admin wajib memutuskan paling lambat 2 jam sebelum jam mulai sesi. Sistem mengirim pengingat kepada Admin dan memindahkan izin ke antrean prioritas apabila batas itu mendekat.

AC-IZN-01.7. Tentor Pengganti tidak dapat mengajukan izin atas sesi pengganti. Perubahan atas sesi pengganti dilakukan melalui Admin.

AC-IZN-01.8. Pembatalan izin yang sudah Disetujui hanya dapat dilakukan Admin, paling lambat sebelum jam mulai sesi. Penugasan Sah dikembalikan kepada Tentor asli bila Tentor asli ACTIVE pada tanggal Pertemuan, dan pengganti diberi tahu. Bila Tentor asli INACTIVE pada tanggal tersebut, kasus dibuka kembali dengan penyebab NONAKTIF (IZN-06). Honorarium mengikuti Lampiran C.

AC-IZN-01.9. Tentor melihat riwayat dan status seluruh pengajuan izinnya.

AC-IZN-01.10. Satu Penugasan Sah hanya dapat berada pada satu pengajuan aktif. Pengajuan kedua pada Penugasan Sah yang sama ditolak dan sistem menampilkan pengajuan yang sudah ada.

### IZN-02 \| Izin Mendesak

SRS — Kebutuhan Fungsional

Sistem harus menyediakan jalur izin mendesak untuk pengajuan pada H-2, H-1, dan hari-H, diajukan per sesi. Pada hari-H, izin dapat diajukan sampai jam mulai sesi. Notifikasi disampaikan melalui web.

User Story

**IZN-02.1** Sebagai Tentor, saya ingin mengajukan izin mendesak untuk sesi tertentu beserta alasan agar sesi saya dapat segera digantikan.

**IZN-02.2** Sebagai Admin, saya ingin menerima izin mendesak dengan prioritas agar sesi yang terdampak segera ditangani.

Acceptance Criteria

AC-IZN-02.1. Izin mendesak diajukan per sesi untuk pengajuan pada H-2, H-1, dan hari-H. Satu pengajuan boleh memuat beberapa sesi.

AC-IZN-02.2. Alasan wajib diisi. Untuk izin sakit, surat dokter wajib dilampirkan. Untuk alasan lain, bukti bersifat opsional.

AC-IZN-02.3. Pengajuan pada hari-H hanya dapat dilakukan sampai jam mulai sesi. Setelahnya hanya dapat melalui koreksi Admin sesuai IZN-05.

AC-IZN-02.4. Izin mendesak masuk ke antrean prioritas Admin dan notifikasi web ditampilkan secara menonjol. Sistem menampilkan jam layanan Admin (parameter). Di luar jam layanan, Owner dapat memproses izin mendesak. Kasus ditandai Mendadak dan tampil paling atas pada antrean pengesahan (IZN-05) dan Daftar Tindak Lanjut (ADM-20).

AC-IZN-02.5. Perlakuan honorarium mengikuti Lampiran C (B-5 dan B-6).

AC-IZN-02.6. Lampiran izin sakit adalah data kesehatan dan hanya dapat dilihat Admin dan Owner, dan disimpan selama masa simpan pada SET-01.

### IZN-03 \| Pemilihan Tentor Pengganti dan Rekomendasi Calon

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor yang mengajukan izin untuk memilih Tentor Pengganti dari tentor IT aktif yang terdaftar. Tidak ada pencocokan keahlian atau jenjang selain tentor IT aktif karena seluruh sekolah mitra berjenjang SD. Ketersediaan hanya berfungsi sebagai penyaring awal.

User Story

**IZN-03** Sebagai Tentor, saya ingin melihat daftar calon pengganti yang sesuai dan memilih satu atau beberapa di antaranya agar sesi saya terisi.

Acceptance Criteria

AC-IZN-03.1. Daftar calon pengganti terdiri atas tentor IT aktif terdaftar dan dikelompokkan menjadi Tersedia dan Lainnya (aktif dengan slot kosong). Tentor di luar daftar tentor terdaftar tidak dapat dipilih. Klasifikasi Tersedia mengikuti ketersediaan pada ADM-06.

AC-IZN-03.2. Sistem tidak menampilkan calon yang jadwalnya bertumpang tindih dengan sesi yang digantikan. Sistem menampilkan peringatan apabila jeda antara dua sesi calon di sekolah berbeda kurang dari jeda antarsekolah pada SET-01 (nilai awal 30 menit).

AC-IZN-03.3. Daftar diurutkan menurut peringkat rekomendasi, yaitu klasifikasi ketersediaan (Tersedia lebih dulu) kemudian jarak terdekat antara domisili calon dan sekolah sesuai KU-01. Sistem hanya menampilkan nama dan jarak perkiraan, bukan alamat atau data ketersediaan lengkap.

AC-IZN-03.4. Pada izin terencana, permintaan dikirim ke satu calon pada satu waktu. Pada izin mendesak, permintaan dapat dikirim ke beberapa calon sekaligus dan pengganti yang pertama menerima yang dipakai.

AC-IZN-03.5. Apabila ada pengganti yang menerima, kasus berstatus Menunggu Admin. Apabila tidak ada calon atau tidak ada yang menerima, kasus berstatus Perlu Tindak Lanjut sesuai IZN-07. Tentor dapat menandai kondisi tanpa pengganti secara manual.

AC-IZN-03.6. Satu calon dapat menerima permintaan dari beberapa tentor selama tidak bentrok waktu. Sistem menampilkan jarak dan perkiraan uang transport yang akan diterima calon.

AC-IZN-03.7. Calon yang ditampilkan adalah tentor yang lolos pemeriksaan awal pengesahan, yaitu ACTIVE pada tanggal Pertemuan, tidak bentrok jadwal, dan belum ditugaskan pada Pertemuan yang sama. Peringkat rekomendasi setiap calon disimpan pada riwayat pengesahan (IZN-05) dan dipakai pada indikator ketepatan rekomendasi (RPT-01).

### IZN-04 \| Konfirmasi Pengganti

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi calon pengganti untuk menerima atau menolak permintaan penggantian dalam batas waktu tertentu.

User Story

**IZN-04** Sebagai calon Tentor Pengganti, saya ingin melihat rincian sesi yang diminta dan menerima atau menolaknya agar saya hanya mengajar pada sesi yang bisa saya penuhi.

Acceptance Criteria

AC-IZN-04.1. Calon pengganti menerima notifikasi web yang memuat sekolah, tanggal, jam, dan perkiraan uang transport.

AC-IZN-04.2. Batas waktu respons adalah 24 jam untuk izin terencana dan 1 jam untuk izin mendesak, sebagai parameter. Setelah batas terlewati, permintaan berstatus Kedaluwarsa dan sistem melanjutkan ke calon berikutnya atau ke Perlu Tindak Lanjut.

AC-IZN-04.3. Apabila beberapa tentor meminta calon yang sama pada waktu bentrok, permintaan yang pertama diterima dipakai dan permintaan lain batal otomatis.

AC-IZN-04.4. Pengganti yang membatalkan sebelum Admin menyetujui mengembalikan izin ke Tentor pemohon. Pembatalan sesudah disetujui hanya dapat dilakukan Admin dengan alasan tertulis.

AC-IZN-04.5. Honorarium selain perkiraan uang transport tidak ditampilkan kepada calon pengganti.

AC-IZN-04.6. Perlakuan bila pengganti yang disetujui tidak hadir mengikuti PAY-04 dan Lampiran C (B-10).

### IZN-05 \| Peninjauan dan Pengesahan Tentor Pengganti

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin untuk meninjau dan mengesahkan pengganti pada Kasus Penggantian, baik yang berasal dari pengajuan izin (IZN-01 dan IZN-02) maupun dari penonaktifan tentor (IZN-06). Fungsi ini adalah satu-satunya tempat pengesahan perubahan pelaksana Pertemuan. Satu kasus mewakili satu Penugasan Sah dengan penyebab IZIN, SAKIT, atau NONAKTIF. Persetujuan tetap dilakukan Admin walaupun seluruh syarat terpenuhi. Admin dapat memilih banyak kasus dari tentor asal yang sama dan memprosesnya dalam satu pengesahan massal, dengan pemeriksaan per kasus.

Status Kasus Penggantian dan Permintaan Kesediaan beserta transisinya mengikuti Lampiran B.

Aktor: Admin; Tentor calon pengganti (merespons Permintaan Kesediaan).

User Story

**IZN-05.1** Sebagai Admin Edukom, saya ingin memeriksa dan mengesahkan pengganti untuk satu atau banyak kasus sekaligus sesuai penyebabnya agar setiap Pertemuan kembali memiliki Penugasan Sah yang dapat ditelusuri.

**IZN-05.2** Sebagai Admin, saya ingin menetapkan pengganti secara langsung apabila diperlukan agar sesi tidak kosong.

Acceptance Criteria

AC-IZN-05.1. Admin melihat setiap kasus beserta Pertemuan, tentor asal, tentor lain bila Pertemuan diajar dua tentor, penyebab, calon, status kasus, dan rekomendasi calon pengganti, serta alasan, bukti, dan calon yang telah menerima. Kasus bertanda Mendadak dan kasus dengan Pertemuan di dalam jendela peringatan pada SET-01 tampil paling atas.

AC-IZN-05.2. Admin dapat menolak izin atau menolak calon. Penolakan izin mengubah status kasus menjadi Ditolak dan Penugasan Sah tetap pada tentor asal. Penolakan calon mengembalikan kasus ke status Perlu Tindak Lanjut. Setiap penolakan wajib memakai alasan dari daftar baku pada SET-02.

AC-IZN-05.3. Sebelum pengesahan, sistem memeriksa bahwa calon ACTIVE pada tanggal Pertemuan, kesediaannya terkonfirmasi untuk tanggal dan jam terbaru, ketersediaannya tidak berklasifikasi Tidak Tersedia, tidak ada bentrok jadwal, jeda antarsekolah terpenuhi, dan calon belum ditugaskan pada Pertemuan yang sama. Bila satu pemeriksaan gagal, pengesahan kasus tersebut ditolak dengan alasannya. Bila tanggal, jam, atau calon berubah, kesediaan sebelumnya tidak berlaku dan wajib dikonfirmasi ulang.

AC-IZN-05.4. Pengesahan massal mengesahkan setiap kasus yang lolos pemeriksaan dan membiarkan kasus yang gagal tetap Menunggu Admin beserta alasannya. Contoh uji: dari 10 kasus dengan 1 bentrok, 9 kasus menjadi Disetujui dan 1 kasus tetap Menunggu Admin.

AC-IZN-05.5. Pengesahan membentuk Penugasan Sah dan laporan baru bagi pengganti, mengakhiri Penugasan Sah tentor asal pada Pertemuan tersebut, menetapkan laporan tentor asal yang belum dikirim menjadi CANCELLED, dan mengirim perubahan pelaksana kepada Modul Penggajian dan memperbarui status kasus. Riwayat menyimpan tentor asal, pengganti, pemeriksa, waktu, dan peringkat rekomendasi calon. Setelah pengesahan, penyimpanan materi, nilai, portofolio, atau laporan oleh tentor asal pada Pertemuan tersebut ditolak. Pertemuan tersebut tampil pada daftar presensi tentor pengganti (PAY-02).

AC-IZN-05.6. Admin dapat menetapkan pengganti secara langsung dengan mencatat kesediaan pengganti (misalnya secara lisan) beserta catatan. Kesediaan pengganti wajib tercatat.

AC-IZN-05.7. Bila pengganti yang sudah disahkan kemudian berhalangan, pengajuannya diproses sebagai kasus baru dengan pengganti tersebut sebagai tentor asal. Penugasan Sah tidak kembali otomatis kepada tentor asal pertama.

AC-IZN-05.8. Admin wajib memilih jenis penggantian Sementara atau Permanen. Penggantian Permanen hanya dapat dipilih bila pengesahan mencakup seluruh Penugasan Sah tentor asal yang tersisa pada Penetapan Program dan kelompok yang sama, dan penggantian Permanen memproses kewajiban dokumen kedua tentor sesuai aturan kewajiban dokumen.

AC-IZN-05.9. Pemrosesan setelah jam mulai sesi hanya dapat dilakukan melalui koreksi Admin dengan alasan tertulis, paling lambat 3 hari setelah sesi, dan honorarium mengikuti keputusan Admin sesuai Lampiran C.

AC-IZN-05.10. Kasus menjadi Dijadwalkan Ulang setelah penjadwalan ulang Pertemuan diterapkan, dan menjadi Dibatalkan bila Pertemuan dibatalkan, pengajuan izin dibatalkan, atau tentor asal kembali ACTIVE pada tanggal Pertemuan. Pertemuan lampau mempertahankan pelaksana yang tercatat, dan penggantian tidak mengalihkan Pertemuan lain di luar kasus yang disahkan.

AC-IZN-05.11. Sistem mencatat pengguna, waktu, keputusan, dan alasan pada setiap peninjauan sesuai KU-05, termasuk peringkat rekomendasi calon pada saat pengesahan.

### IZN-06 \| Penggantian Pertemuan karena Tentor Nonaktif

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin untuk menangani Pertemuan yang terdampak ketika seorang tentor berstatus INACTIVE (ADM-05). Berbeda dengan izin, calon pengganti dipilih Admin dengan bantuan rekomendasi calon pengganti (IZN-03), dan kesediaan calon diminta melalui Permintaan Kesediaan. Pengesahan dilakukan pada IZN-05.

Aktor: Admin; Tentor calon pengganti (merespons Permintaan Kesediaan).

User Story

**IZN-06** Sebagai Admin, saya ingin memilih calon pengganti untuk Pertemuan milik tentor yang nonaktif dan meminta kesediaannya sekaligus untuk banyak Pertemuan agar Pertemuan tersebut tetap terlaksana.

Acceptance Criteria

AC-IZN-06.1. Kasus Penggantian dengan penyebab NONAKTIF dibentuk otomatis oleh AC-ADM-05.7 untuk setiap Pertemuan terdampak dan berstatus Perlu Tindak Lanjut.

AC-IZN-06.2. Untuk penyebab NONAKTIF, Admin memilih satu atau beberapa kasus milik tentor asal yang sama dan mengirim satu Permintaan Kesediaan kepada calon ACTIVE. Setiap kasus dalam permintaan berstatus Menunggu Konfirmasi.

AC-IZN-06.3. Calon menandai setiap Pertemuan yang ia terima atau tolak. Batas respons setiap Pertemuan adalah waktu yang lebih awal antara waktu permintaan ditambah 24 jam dan jam mulai Pertemuan dikurangi 6 jam, sesuai nilai pada SET-01. Pertemuan yang diterima menjadi Diterima dan kasusnya Menunggu Admin. Pertemuan yang ditolak menjadi Ditolak, Pertemuan yang tidak direspons sampai batasnya menjadi Kedaluwarsa, dan kedua kasus tersebut kembali ke Perlu Tindak Lanjut.

AC-IZN-06.4. Kasus berstatus Menunggu Admin disahkan pada IZN-05. Untuk kasus yang kembali Perlu Tindak Lanjut, Admin dapat mengirim Permintaan Kesediaan kepada calon lain.

### IZN-07 \| Eskalasi Izin tanpa Pengganti

SRS — Kebutuhan Fungsional

Sistem harus menyediakan penanganan bagi izin yang tidak memperoleh pengganti. Owner memutuskan pembatalan atau penjadwalan ulang, sedangkan Admin mencatat dan menyampaikannya kepada sekolah mitra.

User Story

**IZN-07.1** Sebagai Admin, saya ingin melihat izin yang tidak memperoleh pengganti beserta tenggatnya agar tindak lanjutnya tidak terlewat.

**IZN-07.2** Sebagai Owner, saya ingin memutuskan pembatalan atau penjadwalan ulang sesi tanpa pengganti agar kepastian diberikan kepada sekolah mitra.

Acceptance Criteria

AC-IZN-07.1. Kasus masuk otomatis ke status Perlu Tindak Lanjut apabila daftar calon kosong atau seluruh calon menolak atau kedaluwarsa. Tentor dapat menandainya manual.

AC-IZN-07.2. Batas eskalasi kasus Perlu Tindak Lanjut adalah H-1 pukul 23.59 WIB untuk izin terencana dan penyebab NONAKTIF, dan 3 jam sebelum jam mulai Pertemuan untuk izin mendesak, sesuai parameter pada SET-01. Kasus yang melewati batas otomatis berstatus Dieskalasi dan diteruskan kepada Owner, dan kasus yang masuk setelah batas langsung Dieskalasi. Admin dapat meneruskan lebih awal dengan mencatat hasil koordinasi.

AC-IZN-07.3. Owner memutuskan hasil: Pengganti Ditetapkan (kasus menjadi Disetujui), Dijadwalkan Ulang, atau Dibatalkan. Admin mencatat keputusan dan menyampaikannya kepada sekolah mitra di luar sistem.

AC-IZN-07.4. Setelah keputusan dicatat, status kasus menjadi Disetujui, Dijadwalkan Ulang, atau Dibatalkan sesuai hasil yang dipilih.

AC-IZN-07.5. Pembatalan memakai alasan Dibatalkan Edukom dan tidak ada pihak yang dibayar untuk sesi tersebut. Penjadwalan ulang dilakukan pada ADM-09, dengan sesi asal tidak dibayar dan sesi baru dibayar apabila berstatus Valid.

AC-IZN-07.6. Sistem tidak mengelola penalti atau kewajiban kepada sekolah mitra.

### IZN-08 \| Riwayat dan Rekap Izin

SRS — Kebutuhan Fungsional

Sistem harus menyediakan riwayat dan rekap izin serta penggantian sebagai satu-satunya sumber angka izin dan penggantian untuk PAY-05. Seluruh angka dihitung per sesi.

User Story

**IZN-08.1** Sebagai Tentor, saya ingin melihat riwayat izin dan penggantian saya agar saya mengetahui catatan saya.

**IZN-08.2** Sebagai Admin dan Owner, saya ingin melihat rekap izin dan penggantian seluruh tentor agar saya dapat memantau frekuensinya.

Acceptance Criteria

AC-IZN-08.1. Rekap menghitung jumlah izin, jumlah sesi yang menggantikan, dan jumlah sesi yang digantikan, semuanya per sesi.

AC-IZN-08.2. Tentor melihat riwayat izin dan penggantian miliknya. Admin dan Owner melihat rekap seluruh tentor dengan filter periode, tentor, dan status.

AC-IZN-08.3. Owner menetapkan ambang frekuensi izin per periode sebagai parameter. Pelampauan ambang hanya menghasilkan penanda dan tidak menghasilkan sanksi.

AC-IZN-08.4. Rekap dapat diekspor dalam format XLSX dan PDF sesuai KU-08.

## 3.4 Modul Presensi dan Penggajian Tentor IT (PAY)

Modul ini mengatur presensi berbasis lokasi, koreksi dan sanggahan, validasi, penutupan periode, perhitungan, persetujuan, slip, dan pembayaran honorarium tentor. Data master tentor, sekolah, dan jadwal mengacu pada Modul Administrasi, sedangkan parameter kebijakan mengacu pada Modul Pengaturan Sistem.

### PAY-01 \| Pengelolaan Komponen dan Tarif Honorarium

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Owner untuk menetapkan dan memelihara komponen honorarium, tarif, dan aturan bonus tentor IT. Fungsi ini hanya menyimpan ketentuan tersebut. Perhitungan honorarium dilakukan pada PAY-06. Parameter kebijakan lain, seperti parameter presensi dan izin, dikelola pada SET-01. Data master tentor, sekolah mitra, jadwal, radius dan koordinat sekolah, serta domisili tentor mengacu pada Modul Administrasi dan tidak dikelola pada fungsi ini.

Sistem menyediakan empat komponen awal, yaitu uang kehadiran, uang transportasi, honor mengajar, dan uang bonus. Owner dapat menambah komponen baru apabila di kemudian hari terdapat kebijakan honorarium baru. Setiap komponen memiliki basis perhitungan, yaitu satuan yang dikalikan dengan tarif. Basis yang tersedia adalah per sesi, per kunjungan sekolah, per sekolah per periode, dan tetap per periode.

Komponen dan tarif tidak dihapus. Perubahan dilakukan dengan merevisi tarif, yang menghasilkan versi baru dengan tanggal mulai berlaku, atau dengan menonaktifkan komponen. Dengan cara ini periode penggajian yang telah ditutup tidak berubah.

Nilai awal mengikuti kebijakan Edukom saat ini dan berlaku seragam untuk semua tentor dan semua sekolah mitra (seluruhnya jenjang SD):

| **Komponen**      | **Basis perhitungan**                                                                                 | **Nilai awal**                                    |
|-------------------|-------------------------------------------------------------------------------------------------------|---------------------------------------------------|
| Uang kehadiran    | Per sesi yang berstatus Valid                                                                         | Rp10.000                                          |
| Uang transportasi | Per sekolah yang dikunjungi (satu kali per sekolah per hari kunjungan)                                | Jarak ≤ 10 km: Rp10.000; jarak \> 10 km: Rp15.000 |
| Honor mengajar    | Per sesi mengajar (70 menit) yang berstatus Valid                                                     | Rp10.000                                          |
| Uang bonus        | Per sekolah per periode, apabila status kelengkapan administrasi tentor pada sekolah tersebut Lengkap | Rp20.000                                          |

Batas jarak dan tarif transportasi dapat diubah Owner. Bonus tidak memiliki kondisi lain selain status kelengkapan administrasi yang ditetapkan pada AC-ADM-12.10. Bonus tidak bergantung pada jumlah kehadiran.

Hanya Owner yang dapat menambah, merevisi, dan menonaktifkan komponen dan tarif. Admin hanya dapat melihat komponen, tarif, dan riwayat perubahannya sebagai pengendalian. Owner sama dengan Pimpinan dan hanya terdapat satu akun Owner.

User Story

**PAY-01.1** Sebagai Owner, saya ingin menetapkan dan memelihara komponen honorarium, tarif, dan aturan bonus tentor, termasuk menambah komponen baru bila ada kebijakan baru, agar perhitungan honorarium pada PAY-06 memakai ketentuan yang seragam, berversi, terdokumentasi, dan tidak bergantung pada rumus di spreadsheet.

**PAY-01.2** Sebagai Admin, saya ingin melihat komponen dan tarif honorarium beserta riwayat perubahannya, tanpa dapat mengubahnya, agar saya dapat mengontrol dasar perhitungan honorarium.

Acceptance Criteria

AC-PAY-01.1. Sistem menampilkan daftar komponen honorarium beserta basis perhitungan, tarif yang berlaku, tanggal mulai berlaku, dan status (Aktif atau Nonaktif). Empat komponen awal sudah tersedia dengan nilai awal sesuai tabel di atas.

AC-PAY-01.2. Owner dapat menambah komponen baru dengan mengisi nama, basis perhitungan yang dipilih dari daftar (per sesi, per kunjungan sekolah, per sekolah per periode, atau tetap per periode), tarif, dan tanggal mulai berlaku.

AC-PAY-01.3. Owner merevisi tarif dengan membuat versi baru yang memiliki tanggal mulai berlaku. Versi sebelumnya berakhir otomatis sehari sebelum tanggal mulai versi baru dan tetap tersimpan.

AC-PAY-01.4. Tanggal mulai berlaku tidak boleh berada pada periode penggajian yang sudah ditutup, sehingga hasil perhitungan periode tertutup tidak berubah.

AC-PAY-01.5. Sistem tidak menyediakan fungsi hapus untuk komponen maupun tarif. Owner dapat menonaktifkan komponen. Komponen nonaktif tidak dipakai pada perhitungan setelah tanggal nonaktif, sedangkan riwayatnya tetap tersimpan.

AC-PAY-01.6. Tarif uang transportasi ditetapkan per tingkat jarak antara domisili tentor dan sekolah mitra, dengan jarak berupa jarak rute jalan. Tiap tingkat memiliki batas jarak atas yang termasuk dalam tingkat itu. Nilai awal: jarak ≤ 10 km Rp10.000, jarak \> 10 km Rp15.000.

AC-PAY-01.7. Owner dapat mengubah batas jarak dan tarif setiap tingkat. Sistem menolak tingkat jarak yang tumpang tindih atau menyisakan celah.

AC-PAY-01.8. Basis perhitungan uang transportasi adalah per sekolah yang dikunjungi: satu kali per sekolah per hari kunjungan, berapa pun jumlah sesi pada sekolah tersebut.

AC-PAY-01.9. Tarif uang kehadiran dan honor mengajar (nilai awal masing-masing Rp10.000 per sesi Valid) berlaku seragam untuk semua tentor dan semua sekolah mitra, tanpa pembedaan per tentor, sekolah, atau jenjang.

AC-PAY-01.10. Aturan bonus memuat nama bonus dan nilai bonus per sekolah (nilai awal Rp20.000). Syarat pemberian bonus hanya status kelengkapan administrasi Lengkap yang ditetapkan pada AC-ADM-12.10. Sistem tidak menyediakan pengaturan kondisi lain. Nominal bonus hanya dikelola pada fungsi ini.

AC-PAY-01.11. Sistem memvalidasi bahwa tarif berupa angka tidak negatif dan batas jarak berupa bilangan positif. Sistem menolak dua tarif aktif untuk komponen yang sama (atau tingkat jarak yang sama) yang masa berlakunya tumpang tindih, dan menampilkan data yang bertentangan.

AC-PAY-01.12. Sistem mencatat pengguna, waktu, nilai sebelum, dan nilai sesudah pada setiap perubahan. Owner dan Admin dapat melihat riwayat tersebut, dan riwayat tidak dapat diubah. Riwayat disimpan paling sedikit 6 bulan.

AC-PAY-01.13. Hanya Owner yang dapat menambah, merevisi, dan menonaktifkan komponen dan tarif. Admin hanya dapat melihat. Peran lain tidak memiliki akses pada fungsi ini.

### PAY-02 \| Pencatatan Presensi Berbasis Lokasi (Check-In dan Check-Out)

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor atau Tentor Pengganti untuk melakukan presensi masuk dan presensi pulang per sesi melalui aplikasi web pada smartphone dengan memanfaatkan geolocation dan validasi geofencing terhadap titik koordinat sekolah mitra, sebagai pengganti lembar presensi fisik dan formulir Google Form, dengan mengacu pada jadwal mengajar pada Modul Administrasi.

Unit presensi adalah sesi (70 menit). Jadwal yang memuat lebih dari satu sesi menghasilkan satu presensi untuk setiap sesi. Waktu presensi diambil dari server dalam zona waktu WIB. Modul ini hanya mencatat dan menandai presensi. Penentuan status Valid dilakukan pada PAY-04 dan perhitungan honorarium pada PAY-06. Durasi antara presensi masuk dan pulang tidak memengaruhi honorarium. Koordinat perangkat hanya dibaca saat tombol presensi ditekan, tanpa pelacakan berkelanjutan. Sistem tidak mendukung presensi tanpa koneksi karena waktu diambil dari server.

User Story

**PAY-02.1** Sebagai Tentor, saya ingin melakukan presensi masuk langsung dari smartphone saat berada di sekolah mitra agar kehadiran saya tercatat otomatis di kantor tanpa lembar presensi fisik dan formulir terpisah.

**PAY-02.2** Sebagai Tentor, saya ingin melakukan presensi pulang, termasuk melanjutkan ke sesi berikutnya di sekolah yang sama dengan satu tombol, agar pencatatan sesi berurutan tidak memakan waktu.

**PAY-02.3** Sebagai Tentor Pengganti, saya ingin melakukan presensi pada sesi pengganti yang telah disetujui agar kehadiran saya tercatat atas nama saya.

**PAY-02.4** Sebagai Admin, saya ingin memantau presensi harian beserta penanda keterlambatan dan presensi yang belum check-out agar saya dapat memvalidasinya pada PAY-04.

Acceptance Criteria

AC-PAY-02.1. Tentor dapat melihat daftar sesi mengajarnya pada hari berjalan, termasuk sesi pengganti yang telah disetujui atas namanya, dan memilih sesi yang akan dipresensi.

AC-PAY-02.2. Sistem membaca koordinat perangkat secara real time setelah Tentor memberikan izin akses lokasi. Apabila izin ditolak, lokasi tidak aktif, atau sinyal tidak tersedia, sistem menampilkan panduan dan mengarahkan Tentor ke pengajuan koreksi pada PAY-03.

AC-PAY-02.3. Sistem mencocokkan koordinat perangkat dengan titik koordinat dan radius sekolah mitra pada Modul Administrasi (nilai awal radius 150 meter) sesuai KU-02. Presensi diterima apabila jarak ke titik sekolah tidak melebihi radius dan akurasi lokasi tidak melebihi 50 meter. Apabila di luar radius, presensi ditolak dengan menampilkan jarak ke sekolah. Apabila akurasi melebihi 50 meter, presensi ditolak dengan pesan agar Tentor mengulang pembacaan lokasi.

AC-PAY-02.4. Presensi masuk hanya dapat dilakukan mulai 15 menit sebelum jam mulai sesi sampai jam selesai sesi. Di luar rentang itu presensi ditolak dengan pesan yang menyebutkan rentang waktu yang berlaku.

AC-PAY-02.5. Sistem mengambil waktu presensi dari server sehingga waktu tidak dapat diubah oleh Tentor.

AC-PAY-02.6. Sistem hanya mengizinkan presensi untuk sesi milik Tentor yang berstatus PUBLISHED (termasuk sesi hasil penjadwalan ulang yang telah diterbitkan), atau sesi pengganti yang telah disetujui, dan mencegah presensi ganda untuk tentor, sesi, dan tanggal yang sama. Sesi berstatus Dibatalkan Sekolah, Libur, Dibatalkan Edukom, atau Dijadwalkan Ulang pada ADM-09 tidak dapat dipresensi.

AC-PAY-02.7. Presensi masuk yang dilakukan setelah jam mulai sesi namun tidak lebih dari 30 menit diberi penanda Terlambat dan tetap diproses normal. Presensi masuk yang dilakukan lebih dari 30 menit setelah jam mulai sesi tetap tercatat, diberi penanda Terlambat Melebihi Toleransi, dan berstatus Perlu Klarifikasi pada PAY-04.

AC-PAY-02.8. Tentor wajib melakukan presensi pulang melalui mekanisme geofencing yang sama. Presensi pulang hanya dapat dilakukan setelah presensi masuk, pada hari yang sama, dan mulai 15 menit sebelum jam selesai sesi.

AC-PAY-02.9. Untuk sesi berurutan di sekolah yang sama, sistem menyediakan tombol “Pulang dan Lanjut Sesi Berikutnya”. Satu kali penekanan melakukan presensi pulang sesi berjalan dan presensi masuk sesi berikutnya dengan satu pembacaan lokasi. Tombol hanya aktif apabila rentang waktu presensi pulang sesi berjalan dan presensi masuk sesi berikutnya sama-sama terpenuhi. Setiap sesi tetap memiliki catatan presensi sendiri.

AC-PAY-02.10. Sistem menandai sesi yang sudah memiliki presensi masuk tetapi belum memiliki presensi pulang sampai akhir hari sebagai Belum Check-Out, serta mengirim pengingat melalui notifikasi web kepada Tentor pada jam selesai sesi dan pukul 20.00 WIB. Sesi Belum Check-Out tanpa koreksi yang disetujui tidak dihitung.

AC-PAY-02.11. Sistem mencatat setiap percobaan presensi, baik berhasil maupun gagal, beserta waktu server, koordinat, akurasi, jarak ke sekolah, identitas perangkat (jenis perangkat dan peramban), hasil, dan alasan penolakan. Catatan percobaan disimpan 6 bulan dan dapat dilihat Admin saat memvalidasi atau memeriksa koreksi.

AC-PAY-02.12. Data presensi tersimpan otomatis di server tanpa lembar presensi fisik maupun Google Form, berstatus awal Menunggu Validasi. Riwayat presensi Tentor menampilkan tanggal, sekolah, sesi, jam masuk, jam pulang, status, penanda, dan alasan penolakan untuk 6 bulan terakhir. Identitas perangkat tidak ditampilkan kepada Tentor.

AC-PAY-02.13. Status ketidakhadiran karena izin tidak dipilih langsung oleh Tentor pada modul ini, tetapi bersumber dari pengajuan izin yang diproses pada modul IZN. Sesi tanpa presensi dan tanpa izin ditandai Tidak Hadir pada PAY-04.

AC-PAY-02.14. Presensi susulan atau perbaikan karena kendala teknis hanya dapat dilakukan melalui pengajuan koreksi pada PAY-03 dan tidak langsung mengubah data presensi.

AC-PAY-02.15. Admin dapat melihat daftar presensi harian dengan filter tanggal, sekolah, tentor, status, dan penanda, serta dapat melihat catatan percobaan presensi pada setiap sesi.

### PAY-03 \| Pengajuan Koreksi Presensi dan Sanggahan Honorarium

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Tentor untuk mengajukan koreksi apabila presensi pada suatu sesi tidak dapat dilakukan atau gagal tercatat, serta sanggahan atas honorarium setelah slip terbit atau periode ditutup, dan bagi Admin dan Owner untuk menanggapinya. Koreksi mengacu pada sesi, karena apabila presensi gagal total maka data presensi tidak ada. Keputusan koreksi dieksekusi pada PAY-04.

Koreksi Presensi diajukan sebelum periode ditutup. Setelah periode ditutup, keberatan atas honorarium diajukan sebagai Sanggahan Honorarium. Keduanya tidak mengubah waktu server maupun koordinat presensi asli dan tidak membuka kembali periode yang telah disetujui Owner. Selisih menjadi penyesuaian pada periode berjalan.

User Story

**PAY-03.1** Sebagai Tentor, saya ingin mengajukan koreksi presensi untuk satu atau beberapa sesi pada hari yang sama, beserta alasan dan bukti pendukung, agar sesi yang saya ajar tetap dihitung apabila presensi gagal karena kendala teknis.

**PAY-03.2** Sebagai Tentor, saya ingin memantau status, menarik, dan melengkapi pengajuan koreksi saya agar saya mengetahui perkembangannya.

**PAY-03.3** Sebagai Admin, saya ingin meninjau pengajuan koreksi beserta bukti dan catatan percobaan presensi, lalu menerima atau menolaknya dengan catatan, agar keputusan dapat dipertanggungjawabkan.

**PAY-03.4** Sebagai Tentor, saya ingin mengajukan sanggahan atas honorarium, termasuk atas jarak dan tarif, agar kekeliruan dapat diperbaiki.

**PAY-03.5** Sebagai Admin, saya ingin menanggapi sanggahan dan mengajukan penyesuaian kepada Owner agar penyelesaiannya tercatat.

**PAY-03.6** Sebagai Owner, saya ingin memutuskan penyesuaian honorarium yang bernilai tambah atau kurang agar perubahan nilai terkontrol.

Acceptance Criteria

Ketentuan Umum

AC-PAY-03.1. Koreksi Presensi dan Sanggahan Honorarium memakai alur pengajuan yang sama. Status pengajuan adalah Diajukan, Perlu Informasi Tambahan, Diterima, Ditolak, dan Ditarik, dan khusus Sanggahan Honorarium ditambah Diproses dan Selesai. Transisi status mengikuti Lampiran B.

AC-PAY-03.2. Sistem mencatat pengguna, waktu, dan tanggapan atau perubahan pada setiap pengajuan dan keputusan, dan catatan tersebut tidak dapat diubah sesuai KU-05.

Koreksi Presensi

AC-PAY-03.3. Pengajuan koreksi mengacu pada sesi. Satu pengajuan boleh memuat beberapa sesi pada hari yang sama, dan satu sesi hanya boleh memiliki satu pengajuan aktif.

AC-PAY-03.4. Jenis koreksi dipilih dari daftar: Lupa Check-Out, GPS atau Sinyal Gagal, Presensi Ditolak Sistem, Perangkat Bermasalah, dan Lainnya. Alasan berupa teks wajib diisi.

AC-PAY-03.5. Tentor dapat melampirkan bukti berupa berkas JPG, PNG, atau PDF dengan ukuran maksimal 5 MB per berkas dan maksimal 5 berkas per pengajuan. Berkas disimpan pada object storage di VPS Edukom dengan masa simpan 6 bulan.

AC-PAY-03.6. Pengajuan hanya dapat dibuat paling lambat 60 hari kalender setelah tanggal sesi dan hanya selama periode sesi tersebut belum ditutup. Pengajuan atas periode yang sudah ditutup dialihkan ke jenis Sanggahan Honorarium pada fungsi ini. Sanggahan atas penandaan Dibatalkan Sekolah juga diajukan melalui jenis Koreksi Presensi selama periode belum ditutup.

AC-PAY-03.7. Saat meninjau, Admin melihat data presensi pada sesi tersebut, catatan percobaan presensi (termasuk yang gagal), bukti, dan penanda Wajib Lembar Fisik apabila sekolah menetapkannya pada Modul Administrasi.

AC-PAY-03.8. Admin memutuskan Diterima atau Ditolak dengan catatan. Keputusan Diterima membuat sesi berstatus Valid dengan catatan Dikoreksi. Keputusan Ditolak membuat sesi berstatus Tidak Valid. Keputusan diproses pada PAY-04.

AC-PAY-03.9. Pada koreksi jenis Lupa Check-Out yang Diterima, Admin mengisi jam pulang koreksi. Jam pulang koreksi disimpan terpisah dan ditandai Dikoreksi. Waktu presensi masuk, waktu server, dan koordinat asli tidak diubah.

AC-PAY-03.10. Lembar presensi fisik hanya berfungsi sebagai arsip dan bukti pendukung, bukan syarat status Valid. Sekolah yang masih mewajibkan lembar fisik ditandai pada Modul Administrasi.

AC-PAY-03.11. Status pengajuan adalah Diajukan, Perlu Informasi Tambahan, Diterima, Ditolak, dan Ditarik. Tentor dapat menarik pengajuan selama berstatus Diajukan. Setelah Admin meminta informasi tambahan, Tentor dapat mengunggah ulang maksimal 3 kali dalam 3 hari. Apabila batas itu terlewati, pengajuan berstatus Ditolak dengan catatan “melewati batas unggah ulang”.

AC-PAY-03.12. Sistem mengirim notifikasi web kepada Tentor pada setiap perubahan status pengajuan dan kepada Admin pada setiap pengajuan baru.

AC-PAY-03.13. Pengajuan yang belum diputuskan menghalangi penutupan periode pada PAY-05.

Sanggahan Honorarium

AC-PAY-03.14. Tentor dapat mengajukan sanggahan paling lambat 14 hari kalender setelah slip terbit, dengan alasan dan bukti pendukung.

AC-PAY-03.15. Sanggahan dapat diajukan atas jumlah sesi, tarif, jarak, bonus, dan penyesuaian, termasuk atas honorarium yang sudah dibayar.

AC-PAY-03.16. Admin menanggapi paling lambat 3 hari kerja. Status sanggahan adalah Diajukan, Perlu Informasi Tambahan, Diproses, Diterima, Ditolak, Ditarik, dan Selesai.

AC-PAY-03.17. Tentor dapat menarik sanggahan selama belum diputuskan dan dapat diminta melengkapi informasi melalui status Perlu Informasi Tambahan.

AC-PAY-03.18. Sanggahan yang Diterima menghasilkan penyesuaian. Penyesuaian positif dibayarkan pada periode berjalan. Penyesuaian negatif (kelebihan bayar) dipotong pada periode berikutnya dengan persetujuan Owner.

AC-PAY-03.19. Admin mengajukan penyesuaian kepada Owner. Owner menyetujui atau menolak dengan alasan, dan Admin serta Tentor menerima notifikasi web atas keputusan itu.

AC-PAY-03.20. Periode yang sudah disetujui Owner tidak dibuka kembali. Slip direvisi atau slip penyesuaian diterbitkan pada periode berjalan.

AC-PAY-03.21. Honorarium yang dihitung untuk tentor yang tidak hadir diperlakukan sebagai cacat sistem dan dilaporkan sebagai defect, bukan sebagai kasus yang diakomodasi.

### PAY-04 \| Validasi dan Pencocokan Presensi

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin untuk memvalidasi presensi per sesi dengan mencocokkannya terhadap jadwal, izin, dan penggantian, sehingga hanya sesi berstatus Valid yang dihitung pada PAY-06.

Status validasi sesi adalah Menunggu Validasi, Valid, Perlu Klarifikasi, dan Tidak Valid. Anomali dicatat sebagai penanda, bukan sebagai status, yaitu Terlambat, Terlambat Melebihi Toleransi, Belum Check-Out, Tidak Sesuai Jadwal, Tidak Hadir, Dibatalkan Sekolah, Pengganti, dan Dikoreksi. Satu sesi memiliki satu status dan dapat memiliki beberapa penanda.

User Story

**PAY-04.1** Sebagai Admin, saya ingin memvalidasi presensi per sesi, dengan bantuan validasi otomatis untuk kasus yang sesuai, agar saya hanya menangani kasus yang bermasalah.

**PAY-04.2** Sebagai Tentor, saya ingin mengisi alasan atas sesi yang membutuhkan klarifikasi agar sesi saya dapat dinilai dengan benar.

**PAY-04.3** Sebagai Admin, saya ingin memproses presensi dalam jumlah banyak dengan filter dan aksi massal agar validasi akhir bulan tidak memakan waktu lama.

Acceptance Criteria

AC-PAY-04.1. Sistem menampilkan presensi per sesi beserta status, penanda, jadwal, tentor, sekolah, jam masuk, jam pulang, dan catatan percobaan presensi.

AC-PAY-04.2. Sistem mencocokkan setiap presensi dengan jadwal dan izin. Presensi yang tidak memiliki sesi terjadwal atau dilakukan oleh tentor yang bukan penugasan maupun pengganti yang disetujui pada sesi tersebut diberi penanda Tidak Sesuai Jadwal.

AC-PAY-04.3. Sesi berstatus Valid otomatis apabila presensi pulang berhasil, terlambat tidak lebih dari 30 menit, sesuai jadwal, dan tidak terdapat konflik dengan izin. Sesi Tentor Pengganti tidak divalidasi otomatis dan diputuskan Admin.

AC-PAY-04.4. Sesi dengan penanda Terlambat Melebihi Toleransi berstatus Perlu Klarifikasi. Tentor mengisi alasan pada sistem, lalu Admin menetapkan Valid atau Tidak Valid dengan catatan.

AC-PAY-04.5. Sistem mengirim pengingat Perlu Klarifikasi kepada Tentor dan Admin 3 hari sebelum cut-off. Apabila Tentor tidak menjawab, Admin memutuskan sesi tersebut dengan alasan tertulis.

AC-PAY-04.6. Setiap hari pukul 23.59 WIB sistem menandai Tidak Hadir pada sesi hari itu yang tidak memiliki presensi dan tidak memiliki izin berstatus Disetujui atau menunggu keputusan. Honor sesi Tidak Hadir adalah Rp0 tanpa sanksi atau potongan.

AC-PAY-04.7. Sesi yang memiliki izin berstatus menunggu keputusan pada hari-H diberi penanda Izin Menunggu Keputusan dan ditahan sampai cut-off. Admin wajib memutuskannya sebelum periode ditutup.

AC-PAY-04.8. Presensi dengan penanda Tidak Sesuai Jadwal tidak dibayar kecuali Admin menyetujuinya dengan alasan tertulis.

AC-PAY-04.9. Apabila izin sudah disetujui tetapi Tentor asli tetap melakukan presensi, sesi diberi penanda Tidak Sesuai Jadwal dan diputuskan Admin.

AC-PAY-04.10. Admin hanya dapat mengubah status dan catatan. Admin tidak mengubah jam masuk, jam pulang, maupun koordinat presensi. Setiap perubahan status wajib disertai catatan.

AC-PAY-04.11. Apabila sesi yang sudah berstatus Valid kemudian ditandai Dibatalkan Sekolah pada ADM-09, sesi berubah menjadi Dibatalkan dan tidak dihitung. Riwayat status sebelumnya tetap tersimpan.

AC-PAY-04.12. Sistem menyediakan filter anomali, aksi massal “Valid Semua yang Sesuai”, dan penguncian per baris sehingga dua pengguna tidak memvalidasi baris yang sama bersamaan.

AC-PAY-04.13. Sistem mencatat pengguna, waktu, status sebelum, status sesudah, dan catatan pada setiap perubahan status. Riwayat tidak dapat diubah.

AC-PAY-04.14. Hanya sesi berstatus Valid yang diteruskan ke PAY-05 dan PAY-06.

AC-PAY-04.15. Saat memvalidasi, Admin melihat hasil laporan Pertemuan dari ADM-17 sebagai informasi pembanding. Sesi berstatus Valid yang laporannya TIDAK_TERLAKSANA ditandai Perlu Ditinjau pada Daftar Tindak Lanjut tanpa mengubah status Valid.

### PAY-05 \| Rekap Presensi dan Penutupan Periode

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin untuk melihat rekap presensi per tentor secara langsung, menutup periode penggajian, dan membuka kembali periode sebelum disetujui Owner.

Periode penggajian adalah satu bulan kalender. Cut-off adalah hari terakhir bulan tersebut pukul 23.59 WIB. Sesi masuk ke periode sesuai tanggal sesi. Hanya satu periode yang berstatus Terbuka pada satu waktu.

User Story

**PAY-05.1** Sebagai Admin, saya ingin melihat rekap presensi per tentor secara langsung agar saya dapat memantau kelengkapan validasi sepanjang bulan.

**PAY-05.2** Sebagai Admin, saya ingin menutup periode setelah semua data selesai diputuskan agar perhitungan honorarium memakai data yang final.

**PAY-05.3** Sebagai Admin, saya ingin membuka kembali periode yang belum disetujui Owner agar kekeliruan dapat diperbaiki sebelum persetujuan.

Acceptance Criteria

AC-PAY-05.1. Periode berupa bulan kalender dengan cut-off hari terakhir pukul 23.59 WIB. Sistem hanya mengizinkan satu periode berstatus Terbuka.

AC-PAY-05.2. Sistem menampilkan rekap langsung per tentor, yaitu jumlah sesi terjadwal, sesi Valid, sesi Tidak Valid, sesi Tidak Hadir, sesi Dibatalkan, dan sesi yang belum diputuskan. “Jumlah sesi” berarti sesi terjadwal, sedangkan “sesi Valid” berarti sesi yang dihitung honorarium. Angka izin dan penggantian bersumber hanya dari IZN-08.

AC-PAY-05.3. Rekap dapat difilter berdasarkan tentor, sekolah, dan status. Sistem tidak menyediakan filter wilayah.

AC-PAY-05.4. Sistem menolak penutupan periode apabila masih terdapat sesi berstatus Perlu Klarifikasi, sesi dengan penanda Izin Menunggu Keputusan, atau pengajuan koreksi yang belum diputuskan. Sesi Belum Check-Out tanpa koreksi yang disetujui otomatis berstatus Tidak Valid saat periode ditutup, dengan penanda dan catatan otomatis.

AC-PAY-05.5. Admin menutup periode dengan tombol Tutup Periode. Sistem mengirim pengingat kepada Admin saat cut-off tiba. Setelah ditutup, data presensi periode tersebut tidak dapat diubah dan rekap disimpan sebagai salinan tetap.

AC-PAY-05.6. Admin dapat membuka kembali periode berstatus Ditutup atau Ditolak hanya sebelum Owner menyetujui, dengan alasan tertulis yang tercatat. Setelah Owner menyetujui, periode tidak dapat dibuka kembali, dan selisih diselesaikan sebagai penyesuaian pada periode berjalan melalui PAY-03.

AC-PAY-05.7. Tentor berstatus nonaktif tetap tampil pada rekap apabila memiliki sesi berstatus Valid pada periode tersebut.

AC-PAY-05.8. Rekap dapat diekspor dalam format XLSX dan PDF.

AC-PAY-05.9. Sistem mencatat pengguna dan waktu setiap penutupan dan pembukaan kembali periode, dan catatan tersebut tidak dapat diubah.

### PAY-06 \| Perhitungan Honorarium

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin untuk menghitung honorarium setiap tentor pada periode yang telah ditutup, secara otomatis berdasarkan sesi berstatus Valid dan seluruh komponen honorarium yang aktif pada PAY-01.

Rumus mengikuti basis tiap komponen. Uang kehadiran dan honor mengajar sama dengan jumlah sesi Valid dikalikan tarif. Uang transportasi sama dengan jumlah pasangan sekolah dan hari yang memiliki paling sedikit satu sesi Valid, dikalikan tarif tingkat jarak. Uang bonus sama dengan jumlah sekolah yang diampu dan berstatus Lengkap sesuai AC-ADM-12.10, dikalikan nilai bonus. Seluruh tarif mengikuti tanggal sesi. PPh 21, BPJS, dan potongan lain berada di luar lingkup versi ini.

User Story

**PAY-06.1** Sebagai Admin, saya ingin sistem menghitung honorarium seluruh tentor secara otomatis agar tidak ada lagi perhitungan manual di spreadsheet.

**PAY-06.2** Sebagai Admin, saya ingin menambahkan penyesuaian manual dengan alasan agar kasus khusus tetap tercatat dan terkontrol.

**PAY-06.3** Sebagai Admin, saya ingin melihat rincian per komponen dan peringatan nilai tidak lazim agar saya dapat memeriksa hasil sebelum diajukan ke Owner.

Acceptance Criteria

AC-PAY-06.1. Perhitungan dapat dijalankan hanya untuk periode berstatus Ditutup dan memakai seluruh komponen honorarium yang aktif pada PAY-01, dengan tarif sesuai tanggal sesi.

AC-PAY-06.2. Hanya sesi berstatus Valid yang dihitung.

AC-PAY-06.3. Uang kehadiran dan honor mengajar dihitung sebagai jumlah sesi Valid dikalikan tarif masing-masing komponen.

AC-PAY-06.4. Uang transportasi dihitung sekali untuk setiap pasangan sekolah dan hari yang memiliki paling sedikit satu sesi Valid, dikalikan tarif tingkat jarak. Apabila tentor mengunjungi dua sekolah dalam satu hari, transportasi dihitung terpisah untuk masing-masing sekolah.

AC-PAY-06.5. Jarak adalah jarak rute jalan dari domisili tentor yang berlaku pada tanggal sesi ke titik koordinat sekolah, dibulatkan satu desimal dalam kilometer sesuai KU-01. Untuk Tentor Pengganti dipakai domisili Tentor Pengganti. Apabila jarak rute tidak dapat diperoleh, perhitungan pasangan tersebut diberi penanda Jarak Belum Tersedia dan tidak dapat difinalkan sampai Admin mengisi jarak dengan alasan tertulis.

AC-PAY-06.6. Uang bonus dihitung untuk setiap sekolah yang diampu tentor pada periode tersebut dengan status kelengkapan Lengkap sesuai AC-ADM-12.10. Sekolah yang diampu adalah sekolah pada penugasan jadwal tentor dalam periode. Bonus tidak bergantung pada jumlah kehadiran. Tentor Pengganti tidak mendapat bonus dari sekolah yang bukan penugasannya.

AC-PAY-06.7. Komponen yang ditambahkan Owner dihitung otomatis sesuai basisnya, yaitu per sesi Valid, per kunjungan sekolah, per sekolah per periode, atau tetap per periode.

AC-PAY-06.8. Perlakuan honorarium pada setiap kondisi (hadir, terlambat, izin, pengganti, pembatalan, dan penjadwalan ulang) mengikuti Lampiran C.

AC-PAY-06.9. Nominal dibulatkan ke rupiah penuh tanpa desimal.

AC-PAY-06.10. Admin dapat menambah penyesuaian manual pada tentor tertentu dengan alasan wajib. Total honorarium tidak boleh bernilai negatif. Penyesuaian tampil pada tampilan Owner dan pada slip.

AC-PAY-06.11. Sistem menampilkan peringatan apabila total honorarium tentor bernilai nol atau berselisih lebih dari 30 persen dari periode sebelumnya. Peringatan hanya bersifat informasi dan tidak memblokir pengajuan.

AC-PAY-06.12. Admin dapat menghitung ulang selama periode belum diajukan ke Owner. Apabila status Menunggu Persetujuan, Admin harus menarik pengajuan terlebih dahulu. Setelah Disetujui, perhitungan tidak dapat diulang dan perubahan dilakukan melalui PAY-03.

AC-PAY-06.13. Sistem menyimpan rincian hasil per tentor, per komponen, per sekolah, dan per sesi beserta tarif dan jarak yang dipakai, sehingga setiap angka dapat ditelusuri.

### PAY-07 \| Persetujuan Owner dan Penerbitan Slip Honorarium

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin untuk mengajukan hasil perhitungan honorarium satu periode kepada Owner, dan bagi Owner untuk menyetujui atau menolaknya. Owner hanya menyetujui atau menolak. Perubahan nilai dilakukan Admin melalui perhitungan ulang atau penyesuaian. Notifikasi disampaikan melalui web.

Sistem harus menyediakan slip honorarium per tentor per periode yang terbit setelah persetujuan Owner dan dapat dibuka serta diunduh oleh Tentor dan Admin. Rincian slip mengikuti seluruh komponen yang aktif pada periode itu, sehingga komponen baru yang ditambahkan Owner ikut tampil.

User Story

**PAY-07.1** Sebagai Admin, saya ingin mengajukan hasil perhitungan honorarium kepada Owner dan dapat menariknya sebelum diputuskan agar kekeliruan dapat diperbaiki.

**PAY-07.2** Sebagai Owner, saya ingin melihat ringkasan dan rincian honorarium beserta peringatan, lalu menyetujui atau menolaknya, agar pembayaran hanya dilakukan atas nilai yang telah saya setujui.

**PAY-07.3** Sebagai Tentor, saya ingin melihat dan mengunduh slip honorarium saya agar saya mengetahui rincian penghasilan setiap periode.

**PAY-07.4** Sebagai Admin, saya ingin melihat status slip dan apakah slip sudah dibuka tentor agar saya dapat memantau penyampaiannya.

Acceptance Criteria

Persetujuan Owner

AC-PAY-07.1. Admin dapat mengajukan periode yang telah dihitung kepada Owner. Status periode menjadi Menunggu Persetujuan dan Owner menerima notifikasi web.

AC-PAY-07.2. Owner melihat ringkasan total honorarium, rincian per tentor, penelusuran sampai ke presensi, penyesuaian manual, dan peringatan nilai tidak lazim dari PAY-06.

AC-PAY-07.3. Owner dapat menyetujui atau menolak. Penolakan wajib disertai alasan dan mengembalikan periode ke status Ditutup untuk diperbaiki Admin. Owner tidak dapat mengubah nilai.

AC-PAY-07.4. Owner dapat memutuskan per tentor. Apabila hanya sebagian tentor disetujui, status periode menjadi Disetujui Sebagian dan tentor yang belum disetujui tetap menunggu keputusan.

AC-PAY-07.5. Admin dapat menarik kembali pengajuan selama belum diputuskan Owner. Setelah ditarik, status periode kembali Ditutup.

AC-PAY-07.6. Sistem mengirim pengingat kepada Owner apabila pengajuan belum diputuskan lebih dari 2 hari. Tidak ada delegasi persetujuan kepada pihak lain.

AC-PAY-07.7. Owner dapat membatalkan persetujuan hanya apabila belum ada pembayaran yang tercatat pada tentor tersebut. Slip yang terbit atas persetujuan itu ditarik.

AC-PAY-07.8. Slip terbit otomatis setelah periode atau tentor disetujui, tanpa menunggu pembayaran.

AC-PAY-07.9. Sistem mencatat pengguna, waktu, keputusan, dan alasan pada setiap pengajuan, persetujuan, penolakan, penarikan, dan pembatalan, dan catatan tersebut tidak dapat diubah.

Slip Honorarium

AC-PAY-07.10. Nomor slip berformat SLIP/tahun/bulan/nomor urut tiga digit, misalnya SLIP/2026/11/001. Slip revisi memakai nomor yang sama dengan akhiran -R1, -R2, dan seterusnya.

AC-PAY-07.11. Slip memuat identitas tentor, periode, rincian setiap komponen aktif (jumlah satuan, tarif, dan nilai), penyesuaian beserta alasannya, dan total honorarium. Logo, tanda tangan, dan tata letak mengikuti contoh slip yang disediakan Edukom.

AC-PAY-07.12. Tentor hanya dapat melihat dan mengunduh slip miliknya. Tentor berstatus nonaktif tetap dapat mengunduh slip lamanya.

AC-PAY-07.13. Apabila slip direvisi setelah terbit, Tentor menerima notifikasi web. Versi sebelumnya tetap dapat dilihat sebagai riwayat dengan penanda Direvisi.

AC-PAY-07.14. Sistem mencatat waktu slip dibuka dan diunduh oleh Tentor, dan Admin melihatnya sebagai status Sudah Dibuka.

AC-PAY-07.15. Slip disimpan dan dapat diakses selama 6 bulan sejak terbit.

AC-PAY-07.16. Slip dapat diekspor dalam format PDF.

### PAY-08 \| Pencatatan Pembayaran Honorarium

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin untuk mencatat pembayaran honorarium yang telah disetujui, beserta bukti, dan menyediakan data pembayaran untuk diekspor sebagai bahan pencatatan keuangan di luar sistem ini. Pencatatan pembayaran dilakukan Admin, sedangkan persetujuan dilakukan Owner sehingga pemisahan tugas terjaga.

User Story

**PAY-08.1** Sebagai Admin, saya ingin mencatat pembayaran honorarium per tentor, termasuk pencatatan massal untuk transfer, agar status pembayaran selalu terkini.

**PAY-08.2** Sebagai Tentor, saya ingin melihat status pembayaran honorarium saya, dan dapat mengonfirmasi penerimaan bila saya mau, agar saya mengetahui kapan honorarium dibayarkan.

Acceptance Criteria

AC-PAY-08.1. Sistem hanya mengizinkan pencatatan pembayaran untuk honorarium yang berstatus Disetujui.

AC-PAY-08.2. Status pembayaran adalah Belum Dibayar, Dibayar Sebagian, Dibayar, dan Tertunda. Sistem menyimpan banyak catatan pembayaran per tentor per periode.

AC-PAY-08.3. Total pembayaran tidak boleh melebihi nilai yang disetujui. Pembayaran yang kurang dari nilai yang disetujui membuat status Dibayar Sebagian.

AC-PAY-08.4. Setiap catatan pembayaran memuat tanggal, nominal, metode (tunai atau transfer), dan bukti yang diunggah. Nomor rekening tentor diambil dari profil tentor pada ADM-05.

AC-PAY-08.5. Sistem menyediakan pencatatan massal untuk pembayaran transfer.

AC-PAY-08.6. Status Tertunda diberikan otomatis setelah lewat tanggal rencana pembayaran dan belum Dibayar, dan dapat diubah Admin dengan alasan.

AC-PAY-08.7. Konfirmasi penerimaan oleh Tentor bersifat opsional dan tidak memengaruhi status Dibayar.

AC-PAY-08.8. Selisih honorarium hasil sanggahan dibayarkan bersama honorarium periode berjalan sebagai penyesuaian.

AC-PAY-08.9. Data pembayaran berstatus Dibayar dapat diekspor sesuai KU-08. Integrasi dengan modul Keuangan berada di luar ruang lingkup versi ini. Koreksi setelah status menjadi Dibayar dilakukan melalui pembatalan pembayaran yang tercatat beserta alasan.

AC-PAY-08.10. Sistem mencatat pengguna, waktu, dan perubahan pada setiap catatan pembayaran, dan catatan tersebut tidak dapat diubah. Bukti pembayaran disimpan 6 bulan.

## 3.5 Modul Manajemen Aset dan Ekspedisi (AST)

Modul ini mengatur pengadaan, inventaris dengan QR Code, distribusi perangkat oleh Kurir (ekspedisi), pelaporan kendala, servis, dan status kesiapan perangkat. Data sekolah mitra dan Pertemuan mengacu pada Modul Administrasi dan tidak dikelola ulang pada modul ini.

### AST-01 \| Pengajuan Kebutuhan Pengadaan Aset

SRS — Kebutuhan Fungsional

Sistem harus menyediakan mekanisme bagi Admin untuk mengajukan permohonan pengadaan perangkat atau aksesoris baru ketika stok menipis, tanpa hak memutuskan unit spesifik yang dibeli. Keputusan Owner didefinisikan sepenuhnya di AST-02.

User Story

**AST-01** Sebagai Admin, saya ingin mengajukan permohonan pengadaan barang baru melalui sistem agar Owner dapat meninjau kebutuhan operasional dan mengambil keputusan pembelian aset.

Acceptance Criteria

AC-AST-01.1. Admin dapat membuat dan mengirim Pengajuan Pengadaan secara digital. Setelah dikirim, status menjadi Diajukan dan nomor pengajuan unik dibuat otomatis.

AC-AST-01.2. Sistem meneruskan pengajuan ke dasbor Owner dan mengirim notifikasi web kepada Owner. Pengajuan tampil pada daftar "Menunggu Keputusan".

AC-AST-01.3. Sistem menyediakan pengaturan ambang batas stok minimum perangkat (jumlah unit berstatus Tersedia) dan menampilkan peringatan kepada Admin ketika stok berada di bawah ambang tersebut.

AC-AST-01.4. Formulir memuat: tanggal pengajuan (otomatis), pengaju (otomatis), dan satu hingga 10 Item Kebutuhan, masing-masing dengan Jenis Perangkat (dropdown master data, tidak boleh dobel dalam satu pengajuan), jumlah (bilangan bulat 1 sampai 999), dan alasan atau kondisi stok (20 sampai 1000 karakter). Lampiran bersifat opsional: maksimal 5 file, masing-masing maksimal 5 MB, format PDF, JPG, atau PNG.

AC-AST-01.5. Formulir tidak menyediakan isian terstruktur untuk merek, tipe, atau spesifikasi final. Admin boleh menuliskan kebutuhan fungsional pada kolom alasan, dan petunjuk di bawah kolom menegaskan bahwa pemilihan produk adalah kewenangan Owner (AST-02).

AC-AST-01.6. Status yang tersedia untuk Admin: Diajukan, Disetujui, Ditolak, Dibatalkan, sesuai Lampiran B. Admin pembuat dapat membatalkan pengajuan Diajukan dengan alasan wajib (10 sampai 500 karakter) dan dapat mengedit pengajuan Diajukan selama belum diputuskan; setiap suntingan dicatat dan Owner diberi notifikasi. Pengajuan Ditolak tidak diedit ulang; Admin membuat pengajuan baru dengan tombol Duplikat ke Pengajuan Baru.

AC-AST-01.7. Saat Admin memilih Jenis Perangkat, sistem memeriksa pengajuan Diajukan dari Admin mana pun yang memuat jenis sama dan menampilkan peringatan non-blokir berisi nomor, pengaju, tanggal, jumlah, dan tautan. Admin tetap dapat melanjutkan.

AC-AST-01.8. Sistem menyimpan riwayat pembuatan, suntingan (nilai sebelum dan sesudah), pembatalan, dan keputusan Owner, masing-masing dengan pengguna dan waktu (WIB), yang tidak dapat diubah atau dihapus. Admin pembuat menerima notifikasi saat Owner memutuskan.

AC-AST-01.9. Daftar pengajuan dapat difilter berdasarkan status, jenis perangkat, pengaju, dan rentang tanggal.

AC-AST-01.10. Pengajuan Diajukan yang belum diputuskan lebih dari 3 hari kerja memicu notifikasi pengingat kepada Owner satu kali per hari kerja sampai diputuskan atau dibatalkan.

### AST-02 \| Otorisasi dan Persetujuan Pengadaan Aset

SRS — Kebutuhan Fungsional

Sistem harus memberikan kewenangan kepada Owner untuk menyetujui, menolak, dan menentukan spesifikasi pengadaan perangkat baru. Admin dapat melihat hasil keputusan tetapi tidak dapat mengambil atau mengubahnya.

User Story

**AST-02** Sebagai Owner, saya ingin menerima notifikasi pengajuan dan mengotorisasi pengadaan perangkat baru agar saya memiliki kendali terhadap spesifikasi dan pencatatan estimasi anggaran pembelian aset.

Acceptance Criteria

AC-AST-02.1. Owner dapat menerima dan meninjau notifikasi pengajuan barang dari Admin.

AC-AST-02.2. Keputusan persetujuan dan rincian spesifikasi pengadaan hanya dapat diputuskan dari akun Owner.

AC-AST-02.3. Owner dapat memberikan keputusan Disetujui atau Ditolak atas setiap pengajuan, dan alasan wajib diisi apabila ditolak.

AC-AST-02.4. Pada keputusan Disetujui, Owner menetapkan spesifikasi perangkat, jumlah yang disetujui, serta dapat mencatat estimasi anggaran pembelian.

AC-AST-02.5. Sistem mengirim notifikasi keputusan kepada Admin dan menyimpan identitas pemberi keputusan, waktu keputusan, status, dan catatan.

AC-AST-02.6. Pengajuan yang telah diputuskan tidak dapat diubah, dan pembatalan keputusan hanya dapat dilakukan Owner dengan alasan yang tercatat.

AC-AST-02.7. Pengajuan Disetujui menjadi acuan pendataan unit di AST-03, termasuk kuota: jumlah unit yang dikaitkan tidak boleh melebihi jumlah disetujui per Item Kebutuhan, dan progres penerimaan (Belum Diterima, Diterima Sebagian, Diterima Lengkap) tampil di detail pengajuan.

AC-AST-02.8. Owner dan Admin dapat melihat daftar pengajuan dengan filter status dan progres penerimaan; pengajuan Disetujui yang belum Diterima Lengkap setelah 30 hari sejak persetujuan ditandai "Perlu Ditindaklanjuti" di dasbor Admin.

### AST-03 \| Manajemen Data Master Inventaris Aset dan QR Code

SRS — Kebutuhan Fungsional

Sistem harus mendaftarkan setiap aset fisik ke basis data terpusat, mencegah duplikasi nomor seri, menghubungkan lokasi penempatan ke master sekolah mitra (ADM-01), dan menyediakan pemindaian QR Code untuk melihat profil singkat unit di lapangan. Sistem juga membuat QR Code unik secara otomatis untuk setiap unit yang terdaftar dan menyediakan pencetakan stiker fisik untuk pelacakan di lapangan.

User Story

**AST-03.1** Sebagai Admin, saya ingin mendaftarkan dan mengelola data perangkat operasional agar informasi setiap unit terekam akurat, tidak ganda, dan profil singkatnya dapat dilihat dengan memindai QR Code.

**AST-03.2** Sebagai Admin, saya ingin sistem menghasilkan QR Code secara otomatis dan menyediakan opsi mencetaknya menjadi stiker agar setiap perangkat memiliki identitas pemindaian yang siap dipakai di lapangan.

Acceptance Criteria

AC-AST-03.1. Admin dapat mendaftarkan unit satu per satu, atau melalui impor massal (file Excel atau CSV dengan templat dari sistem) untuk data awal. Hasil impor menampilkan baris berhasil dan gagal beserta alasannya, dan baris gagal tidak membatalkan baris lain.

AC-AST-03.2. Data setiap unit memuat jenis aset (misalnya laptop atau aksesoris), merek, tipe, nomor seri, tanggal perolehan, kondisi, status, dan lokasi penempatan, dengan nomor seri wajib diisi dan unik.

AC-AST-03.3. Validasi nomor seri dilakukan setelah normalisasi (menghapus spasi di awal dan akhir, tidak membedakan huruf besar dan kecil) dan mencakup unit berstatus apa pun, termasuk Nonaktif. Jika duplikat, sistem menampilkan unit yang sudah memakai nomor tersebut.

AC-AST-03.4. Lokasi terhubung ke master sekolah mitra dan Kantor Edukom, dengan nilai bawaan Kantor Edukom. Aturan konsistensi status dan lokasi mengikuti Lampiran B (Aset).

AC-AST-03.5. Admin dapat mengaitkan unit baru dengan Item Kebutuhan pada pengajuan Disetujui. Sistem membatasi jumlah unit terkait sesuai kuota jumlah disetujui (AC-AST-02.7) dan menampilkan sisa kuota. Pengaitan bersifat opsional untuk unit yang sudah ada sebelum sistem dipakai.

AC-AST-03.6. Status operasional aset yang digunakan sistem adalah Tersedia, Terdistribusi, Rusak, Perbaikan, Hilang, dan Nonaktif.

AC-AST-03.7. Admin dapat melihat daftar aset, mencari dan menyaring berdasarkan jenis, status, dan lokasi, memperbarui data aset, serta menonaktifkan aset yang tidak digunakan lagi tanpa menghapus riwayatnya.

AC-AST-03.8. Sistem mencatat pengguna dan waktu setiap penambahan dan perubahan data aset pada jejak audit.

AC-AST-03.9. Pemindaian QR Code melalui menu pencarian/inventaris oleh pengguna yang berwenang (Admin, Kurir, Tentor, dan Owner) akan menampilkan profil singkat unit (identitas, status, lokasi, kendala aktif) sebagai pengganti catatan kertas.

AC-AST-03.10. Sistem otomatis membuat QR Code unik untuk setiap unit yang berhasil didaftarkan. Isi QR berupa token acak yang tidak dapat ditebak, bukan data aset mentah dan bukan nomor urut, sehingga pemindai di luar sistem tidak memperoleh informasi apa pun. Pemindaian hanya bermakna bagi pengguna yang sudah login dan berwenang.

AC-AST-03.11. Setiap stiker memuat QR Code dan Kode Aset terbaca manusia (dan nama jenis perangkat bila ruang cukup), sehingga unit tetap dapat diidentifikasi jika QR tidak terbaca. Aplikasi pemindai (Kurir, Tentor IT, Admin) menyediakan input manual Kode Aset sebagai cadangan jika QR rusak atau kamera bermasalah. Input manual tercatat pada riwayat sebagai "pemindaian manual" dan, pada penugasan, tetap mensyaratkan foto yang lolos geofence.

AC-AST-03.12. Admin dapat mencetak stiker QR Code per unit secara satu per satu (individual).

AC-AST-03.13. Admin dapat mencetak stiker QR Code secara massal sekaligus (batch print) yang disesuaikan dengan tata letak kertas stiker.

AC-AST-03.14. Admin dapat mencetak ulang (re-print) apabila stiker rusak atau hilang tanpa mengubah identitas unik unit aslinya.

### AST-04 \| Penugasan Distribusi Perangkat Terpusat

SRS — Kebutuhan Fungsional

Sistem harus memfasilitasi penjadwalan penugasan Kurir secara terstruktur dengan merujuk Pertemuan PUBLISHED, mengizinkan pemilihan unit spesifik berdasarkan Jenis Kegiatan, dan memblokir unit berstatus tidak valid.

User Story

**AST-04** Sebagai Admin, saya ingin membuat instruksi penugasan Kurir secara digital yang terikat dengan Pertemuan PUBLISHED agar jadwal pemakaian unit tidak bentrok, unit berstatus tidak valid otomatis terkunci, dan instruksi pengantaran serta penjemputan terpisah jelas.

Acceptance Criteria

AC-AST-04.1. Admin wajib mengaitkan pembuatan penugasan distribusi dengan satu atau beberapa Pertemuan berstatus PUBLISHED pada sekolah tujuan yang ditarik dari Modul Administrasi.

AC-AST-04.2. Sistem membagi penugasan menjadi entitas terpisah berdasarkan Jenis Kegiatan, yaitu: Pengantaran, Penjemputan, atau Pengantaran Unit Cadangan.

AC-AST-04.3. Sistem menerapkan aturan filter pemilihan unit berdasarkan Jenis Kegiatan: jika jenis "Pengantaran" atau "Pengantaran Unit Cadangan", sistem hanya mengizinkan pemilihan unit berstatus "Tersedia". Jika jenis "Penjemputan", sistem hanya mengizinkan pemilihan unit berstatus "Terdistribusi" atau "Rusak" yang lokasinya berada di sekolah tujuan tersebut.

AC-AST-04.4. Unit berstatus Rusak, Perbaikan, atau Nonaktif tidak muncul pada daftar pilihan Pengantaran dan Pengantaran Unit Cadangan. Unit Hilang dan Nonaktif tidak muncul pada penugasan jenis apa pun. Unit yang sudah teralokasi pada penugasan Ditugaskan atau Sedang Berjalan lain tidak muncul pada pilihan baru jika rentang waktunya bertumpang tindih

AC-AST-04.5. Sistem mencegah Admin memilih unit yang sama apabila rentang pemakaiannya bertumpang tindih dengan penugasan lain, baik di sekolah lain maupun sekolah yang sama. Rentang pemakaian unit dihitung dari tanggal pengantaran direncanakan sampai tanggal penjemputan direncanakan, dan jika penjemputan belum direncanakan, sampai akhir Pertemuan PUBLISHED yang dirujuk ditambah 1 hari.

AC-AST-04.6. Setelah penugasan disimpan, sistem mendistribusikan rincian tugas ke akun aplikasi Kurir yang ditunjuk: jenis kegiatan, tanggal dan waktu pelaksanaan, nama sekolah, jumlah unit, dan daftar unit beserta Kode Aset dan QR. Kurir menerima dan melihat tugas; mekanisme penolakan oleh Kurir tidak disediakan, dan Kurir yang berhalangan menghubungi Admin untuk penggantian.

AC-AST-04.7. Sistem hanya mengizinkan penunjukan kurir yang berstatus aktif dan otomatis mengirimkan notifikasi penugasan kepada kurir tersebut.

AC-AST-04.8. Status penugasan: Ditugaskan, Sedang Berjalan, Selesai, Dibatalkan. Sedang Berjalan dicapai otomatis setelah unit pertama berhasil dipindai.

AC-AST-04.9. Selama status Ditugaskan, Admin dapat memperbarui rincian, membatalkan, dan mengganti Kurir dengan alasan tercatat. Selama status Sedang Berjalan, Admin tidak dapat membatalkan penugasan tetapi dapat:

a\. mengganti Kurir (unit yang sudah dipindai tetap tercatat atas Kurir sebelumnya, sisanya diteruskan ke Kurir baru),

b\. mengeluarkan unit yang belum dipindai dengan alasan, atau mengganti unit tersebut dengan unit lain yang memenuhi.

AC-AST-04.10. Admin dapat membuat penugasan Pengantaran Unit Cadangan langsung dari Laporan Kendala berstatus Dikonfirmasi, dengan sekolah tujuan dan keterkaitan laporan terisi otomatis. Admin memilih unit cadangan yang berstatus Tersedia. Satu laporan dapat dikaitkan dengan lebih dari satu penugasan cadangan, dan keterkaitan ini tampil di profil laporan dan profil unit.

AC-AST-04.11. Jika unit yang rusak di sekolah akan dijemput, Admin dapat membuat penugasan Penjemputan dari Laporan Kendala yang sama. Sistem menyarankan unit rusak tersebut sebagai pilihan awal.

### AST-05 \| Serah Terima Perangkat Berbasis Geofencing (Pengantaran dan Penjemputan)

SRS — Kebutuhan Fungsional

Sistem harus mengakomodasi konfirmasi serah terima perangkat dengan mewajibkan Kurir memindai QR Code setiap unit dan melampirkan foto yang lokasinya divalidasi geofencing, baik saat pengantaran dan setup di sekolah mitra maupun saat penjemputan kembali perangkat.

User Story

**AST-05.1** Sebagai Kurir, saya ingin memindai QR Code perangkat dan mengunggah foto setup yang tervalidasi geofencing saat tiba di sekolah mitra agar status unit menjadi Terdistribusi dan tercatat otomatis.

**AST-05.2** Sebagai Kurir, saya ingin memindai ulang QR Code perangkat dan mengunggah foto kondisi unit sebelum dibereskan saat menjemput di sekolah mitra agar sistem memastikan pertanggungjawaban fisik unit dan memulihkan statusnya menjadi Tersedia.

Acceptance Criteria

AC-AST-05.1. Validasi lokasi foto mengikuti KU-02 terhadap geofence sekolah tujuan, dengan koordinat dibaca saat foto diambil. Jika koordinat di luar geofence, sistem menolak foto sebagai bukti, menampilkan jarak ke lokasi sekolah, mencatat percobaan (kurir, unit, koordinat, jarak, waktu), dan status unit tidak berubah. Unit dianggap berhasil dipindai hanya jika pindai dan foto keduanya lolos validasi.

AC-AST-05.2. Sistem menyimpan riwayat setiap pemindaian pengantaran dan penjemputan (unit, kurir, jenis kegiatan, waktu server, waktu perangkat, koordinat, jarak ke sekolah, hasil validasi, foto, penerima, serta penanda manual, disahkan Admin, atau Tidak Ditemukan) sebagai riwayat pergerakan unit. Riwayat tidak dapat diubah atau dihapus.

Pengantaran dan Pengantaran Unit Cadangan

AC-AST-05.3. Kurir wajib memindai QR Code satu per satu pada setiap unit yang diserahkan di lokasi setup, hanya dari penugasan Pengantaran atau Pengantaran Unit Cadangan berstatus Ditugaskan atau Sedang Berjalan yang ditugaskan kepadanya.

AC-AST-05.4. Sistem membandingkan unit yang dipindai dengan daftar unit penugasan. Unit di luar daftar atau unit yang statusnya tidak lagi Tersedia setelah penugasan dibuat otomatis ditolak, dengan pesan alasan spesifik, dan penolakan dicatat serta diberitahukan ke Admin.

AC-AST-05.5. Kurir mengunggah satu hingga dua foto hasil setup seluruh unit sebagai bukti penyelesaian (satu hingga tiga foto per unit). Foto diambil langsung dari kamera aplikasi.

AC-AST-05.6. Pindai dan foto yang lolos validasi mengubah unit dari Tersedia menjadi Terdistribusi dan lokasinya ke sekolah tujuan, secara otomatis. Perubahan ini juga mengurangi alokasi unit pada Stok Efektif.

AC-AST-05.7. Penugasan Pengantaran menjadi Selesai setelah seluruh unit pada daftar berhasil dipindai. Unit yang ditolak sesuai AC-AST-05.4 atau tidak dapat diserahkan dikeluarkan atau diganti Admin sesuai AC-AST-04.9 agar penugasan dapat diselesaikan. Admin menerima notifikasi saat penugasan Selesai.

Penjemputan

AC-AST-05.8. Kurir wajib memindai QR Code satu per satu pada setiap unit saat penjemputan, hanya dari penugasan Penjemputan miliknya berstatus Ditugaskan atau Sedang Berjalan.

AC-AST-05.9. Sistem memvalidasi kelengkapan dengan mencocokkan jumlah dan identitas unit yang dijemput terhadap daftar unit pada instruksi penugasan penjemputan; sistem akan memberikan peringatan visual jika terdapat unit pada daftar yang belum dipindai.

AC-AST-05.10. Kurir mengunggah foto kondisi fisik unit di sekolah mitra sebelum dibereskan ke dalam tas/boks.

AC-AST-05.11. Pindai dan foto yang lolos validasi mengubah unit dari Terdistribusi menjadi Tersedia dan lokasinya ke Kantor Edukom, secara otomatis. Unit berstatus Rusak atau Perbaikan yang dipindai saat penjemputan tidak mengubah statusnya; hanya lokasinya berubah ke Kantor Edukom setelah pindai dan foto lolos validasi. Dengan demikian unit tersebut dapat dikerjakan Teknisi.

AC-AST-05.12. Jika Kurir menemukan masalah pada unit yang dijemput, ia memilih Laporkan Kendala langsung pada layar penjemputan unit tersebut. Sistem membuka formulir AST-06 dengan unit dan sekolah terisi otomatis, dan alurnya identik dengan AST-06. Untuk unit yang dilaporkan bermasalah jenis "Unit tidak berfungsi":

a\. status unit menjadi Rusak (bukan Tersedia),

b\. pindai dan foto penjemputan tetap dihitung berhasil, dan lokasi unit menjadi Kantor Edukom,

c\. laporan masuk ke alur verifikasi AST-07.

Untuk jenis "Kendala non-kerusakan", status unit mengikuti AC-AST-05.11.

AC-AST-05.13. Jika unit tidak ditemukan, Kurir memilih Tidak Ditemukan pada unit tersebut dan mengisi alasan (wajib) serta foto lokasi pencarian (opsional). Unit dihitung "selesai ditangani" pada penugasan, sehingga Kurir tidak tertahan di lokasi, dan Admin menerima notifikasi untuk menindaklanjuti. Penugasan Penjemputan menjadi Selesai setelah setiap unit pada daftar berstatus berhasil dipindai atau dilaporkan Tidak Ditemukan. Admin kemudian mengonfirmasi unit tersebut sebagai Hilang dengan alasan tercatat; hingga dikonfirmasi, status unit tidak berubah.

### AST-06 \| Pelaporan Kendala Perangkat via QR Code

SRS — Kebutuhan Fungsional

Sistem harus memfasilitasi pelaporan kendala dari lapangan melalui pemindaian QR Code agar detail kendala tercatat segera dan, untuk kendala berjenis kerusakan, status unit otomatis dibekukan menjadi Rusak.

User Story

**AST-06** Sebagai Tentor IT atau Kurir (dan Admin), saya ingin melaporkan gangguan dengan memindai QR Code perangkat bermasalah dan mengunggah foto bukti agar detail kendala segera tercatat dan, jika unit tidak berfungsi, unit terkunci dari penugasan.

Acceptance Criteria

AC-AST-06.1. Pemindaian QR Code atau input manual Kode Aset pada menu Pelaporan Kendala oleh Tentor IT, Kurir, atau Admin otomatis membuka formulir laporan untuk unit tersebut.

AC-AST-06.2. Formulir laporan memuat otomatis identitas unit, pelapor, waktu, dan sekolah lokasi, serta kategori kendala yang dikonfigurasi Admin.

AC-AST-06.3. Pelapor memasukkan deskripsi kendala tambahan dan wajib melampirkan foto fisik unit yang bermasalah.

AC-AST-06.4. Segera setelah laporan jenis "Unit tidak berfungsi" dikirim, status unit menjadi Rusak dan unit otomatis terblokir dari penugasan Pengantaran dan Pengantaran Unit Cadangan (sinkron dengan AC-AST-04.4). Status sebelumnya disimpan. Laporan jenis "Kendala non-kerusakan" tidak mengubah status unit.

AC-AST-06.5. Laporan diteruskan sebagai notifikasi real-time kepada semua Admin aktif. Jika pelapor offline, aplikasi menyimpan laporan dan foto dalam antrean dan mengirimnya saat tersambung; waktu laporan tercatat sebagai waktu pelaporan di perangkat dan waktu diterima server.

### AST-07 \| Verifikasi Laporan Kendala Perangkat dan Tindak Lanjut

SRS — Kebutuhan Fungsional

Sistem harus menyediakan dasbor bagi Admin untuk memverifikasi laporan kendala, mengubah status unit ke tahap perbaikan, dan menindaklanjutinya dengan penugasan Pengantaran Unit Cadangan atau Penjemputan.

User Story

**AST-07** Sebagai Admin, saya ingin memverifikasi laporan kendala yang masuk dan menugaskan pengantaran unit cadangan agar kegiatan belajar tidak terhambat dan unit bermasalah dapat diperbaiki.

Acceptance Criteria

AC-AST-07.1. Admin memverifikasi laporan kerusakan dari lapangan di dasbor terpusat yang dapat disaring berdasarkan status, sekolah, dan tanggal.

AC-AST-07.2. Admin dapat menolak laporan yang tidak valid dengan alasan wajib. Penolakan mengembalikan status unit ke status sebelumnya sesuai Lampiran B (Aset), hanya jika status unit saat ini masih Rusak akibat laporan tersebut. Jika status unit sudah berubah, penolakan dicatat tanpa mengubah unit. Pelapor diberi notifikasi.

AC-AST-07.3. Jika Admin mengonfirmasi laporan jenis "Unit tidak berfungsi", status unit berubah dari Rusak menjadi Perbaikan dan Tiket Servis dibuat otomatis (AST-08) dengan status Dibuka. Jika unit masih berlokasi di sekolah, tiket menampilkan penanda "Menunggu unit dijemput" dan sistem menawarkan tombol Buat Penjemputan (AC-AST-04.11). Laporan "Kendala non-kerusakan" yang dikonfirmasi tidak membuat tiket, dan Admin menutupnya dengan catatan tindak lanjut. Admin menindaklanjuti laporan Dikonfirmasi dengan penugasan Pengantaran Unit Cadangan atau Penjemputan sebagaimana diatur pada AC-AST-04.10 dan AC-AST-04.11.

AC-AST-07.4. Status laporan: Dilaporkan, Dikonfirmasi, Ditolak, Selesai. Laporan otomatis menjadi Selesai ketika Tiket Servis terhubung berstatus Selesai atau Tidak Dapat Diperbaiki (setelah dikonfirmasi). Laporan non-kerusakan menjadi Selesai ketika ditutup Admin.

AC-AST-07.5. Laporan berstatus Dilaporkan yang belum diverifikasi lebih dari 2 hari kerja memicu notifikasi pengingat kepada Admin dan tampil sebagai prioritas di dasbor.

AC-AST-07.6. Detail laporan menampilkan seluruh keterkaitan: penugasan unit cadangan, penugasan penjemputan, tiket servis, laporan tambahan, dan riwayat status.

### AST-08 \| Pencatatan Riwayat Penanganan (Ticketing Servis)

SRS — Kebutuhan Fungsional

Sistem harus menyediakan rekam jejak pemeliharaan sehingga perbaikan dicatat langsung dalam sistem dan riwayatnya melekat pada identitas unit selamanya.

User Story

**AST-08** Sebagai Teknisi, saya ingin mendokumentasikan tindakan perbaikan ke dalam sistem agar riwayat servis unit tersimpan permanen dan status operasional unit dapat dipulihkan.

Acceptance Criteria

AC-AST-08.1. Tiket Servis dibuat otomatis berstatus Dibuka ketika Admin mengonfirmasi laporan (AC-AST-07.3), dengan referensi ke laporan dan unit. Satu unit hanya memiliki satu tiket aktif pada satu waktu.

AC-AST-08.2. Tiket mencatat: tindakan perbaikan, suku cadang (nama dan jumlah, biaya opsional), total biaya (opsional), nama Teknisi, tanggal tiket dibuat, tanggal unit diterima (otomatis ketika lokasi unit menjadi Kantor Edukom), tanggal mulai, tanggal selesai, dan durasi penanganan yang dihitung otomatis dari tanggal diterima sampai tanggal selesai. Tiket tidak dapat berstatus Diproses selama unit belum berlokasi di Kantor Edukom.

AC-AST-08.3. Status tiket: Dibuka, Diproses, Selesai, Menunggu Konfirmasi Admin, Tidak Dapat Diperbaiki. Teknisi memindahkan Dibuka ke Diproses dan Diproses ke Selesai atau Menunggu Konfirmasi Admin. Tiket Selesai tidak dapat dibuka kembali; masalah baru pada unit yang sama dilaporkan sebagai Laporan Kendala baru.

AC-AST-08.4. Jika Teknisi menyelesaikan tiket (Selesai), sistem otomatis memulihkan status unit menjadi Tersedia (lokasi Kantor Edukom) dan menandai Laporan Kendala terkait Selesai. Penyelesaian ditolak sistem jika lokasi unit bukan Kantor Edukom. Admin menerima notifikasi bahwa unit siap dipakai. \[Asumsi: tidak ada pemeriksaan akhir oleh Admin sebelum Tersedia.\]

AC-AST-08.5. Jika tiket berstatus "Tidak Dapat Diperbaiki" (setelah dikonfirmasi Admin), sistem secara otomatis mengubah status unit secara permanen menjadi "Nonaktif", dan status Laporan Kerusakan terkait menjadi "Selesai".

AC-AST-08.6. Riwayat servis tersimpan permanen pada profil unit, tidak dapat dihapus, dan tetap dapat ditelusuri meskipun Teknisi berganti.

AC-AST-08.7. Admin, Owner, dan Teknisi dapat melihat daftar tiket (filter status, Teknisi, tanggal, unit) dan riwayat servis per unit. Setiap perubahan data tiket dicatat pada jejak audit (pengguna, waktu, nilai sebelum dan sesudah). Biaya hanya terlihat oleh Admin dan Owner.

### AST-09 \| Penyediaan Status Kesiapan Perangkat dan Ekspedisi bagi Modul Administrasi

SRS — Kebutuhan Fungsional

Sistem harus menyediakan indikator kesiapan perangkat dan kegiatan ekspedisi berdasarkan penugasan yang terikat pada Pertemuan PUBLISHED agar kesiapan operasional dapat dipantau.

User Story

**AST-09** Sebagai Admin, saya ingin sistem menyediakan status kesiapan perangkat yang ditarik dari data penugasan Pertemuan PUBLISHED agar kebutuhan perangkat yang belum terpenuhi dapat ditindaklanjuti sebelum pembelajaran dimulai.

Acceptance Criteria

AC-AST-09.1. Kesiapan dihitung per Pertemuan PUBLISHED. Target = jumlah unit pada penugasan Pengantaran yang tertaut Pertemuan tersebut, dikurangi unit yang dikeluarkan Admin (AC-AST-04.9). Jika sebuah sekolah memiliki beberapa Pertemuan, setiap Pertemuan dihitung terpisah dari penugasan yang tertaut kepadanya.

AC-AST-09.2. Sistem menyajikan status kesiapan secara otomatis dengan kriteria:

a\. Belum Siap: Jika jumlah unit berstatus "Terdistribusi" di sekolah tujuan = 0.

b\. Sebagian Siap: Jika jumlah unit berstatus "Terdistribusi" \> 0, tetapi masih kurang dari total target unit pada penugasan.

c\. Siap: Jika jumlah unit berstatus "Terdistribusi" sudah memenuhi/sama dengan total target unit penugasan.

AC-AST-09.3. Status kesiapan, nilai terhitung (unit Terdistribusi dan target), dan waktu pembaruan disediakan hanya-baca untuk Modul Administrasi (ADM-10) melalui antarmuka yang disepakati, tanpa mengubah status jadwal PUBLISHED. Data diperbarui paling lambat 1 menit setelah perubahan.

AC-AST-09.4. Ketika Modul Administrasi mengubah jadwal yang tertaut penugasan, sistem AST menerima notifikasi perubahan dan menampilkannya kepada Admin dan Kurir terkait sebagai informasi pada penugasan, tanpa mengubah penugasan yang sedang berjalan. Admin memutuskan apakah penugasan disesuaikan.

AC-AST-09.5. Status kesiapan diperbarui otomatis dari data pemindaian dan status penugasan. Admin dapat memasukkan koreksi manual dengan alasan wajib; koreksi disimpan terpisah dan ditampilkan berdampingan dengan nilai otomatis (tidak menimpanya). Koreksi berlaku hingga data otomatis berubah, lalu dinyatakan kedaluwarsa dan Admin diberi notifikasi.

## 3.6 Modul Pelaporan dan Dashboard (RPT)

Modul ini menghimpun dashboard, pencarian, dan ekspor laporan lintas modul dengan definisi indikator dan aturan ekspor yang sama (KU-08). Rekap yang melekat pada proses tertentu, yaitu rekap presensi pada PAY-05, rekap izin pada IZN-08, dan rekap administrasi pribadi tentor pada ADM-19, tetap berada pada modul asalnya.

### RPT-01 \| Dashboard Monitoring Administrasi Pembelajaran bagi Owner

SRS — Kebutuhan Fungsional

Sistem harus menyediakan dashboard bagi Owner untuk melihat ringkasan sekolah, siswa, kelompok, Penugasan Sah, Pertemuan, materi rencana, laporan, kesiapan, kelengkapan dokumen, dan ketepatan rekomendasi calon pengganti berdasarkan periode, sekolah, program, kelompok, dan tentor. Dashboard hanya dapat dilihat dan menjadi sumber definisi indikator yang juga dipakai pada ekspor laporan.

Aktor: Owner.

User Story

**RPT-01** Sebagai Owner, saya ingin membandingkan Pertemuan terjadwal, laporan terkirim, laporan terlaksana, laporan terverifikasi, kesiapan, dan kelengkapan dokumen dengan definisi yang pasti agar saya mengetahui pekerjaan yang memerlukan tindak lanjut.

Acceptance Criteria

AC-RPT-01.1. Seluruh indikator mengikuti filter yang dipilih, dan dashboard menampilkan waktu pengambilan data.

AC-RPT-01.2. Dashboard menampilkan jumlah Pertemuan dan jumlah laporan secara terpisah, karena Pertemuan yang diajar dua tentor memiliki dua laporan. Jumlah Pertemuan menghitung Pertemuan PUBLISHED pada periode, dengan Pertemuan yang dijadwalkan ulang dihitung satu kali pada tanggal terbarunya, dan Pertemuan CANCELLED tidak dihitung. Laporan Terjadwal menghitung satu laporan untuk setiap tentor pada Pertemuan tersebut. Terkirim menghitung laporan yang pernah berhasil dikirim, dan Terverifikasi menghitung laporan yang versi terbarunya VERIFIED.

AC-RPT-01.3. Terlaksana dan Tidak Terlaksana menghitung laporan terkirim menurut hasil pelaksanaannya, sehingga jumlah keduanya sama dengan Terkirim. Terlambat menghitung laporan yang bertanda Terlambat.

AC-RPT-01.4. Contoh uji: satu Pertemuan diajar dua tentor dan satu Pertemuan diajar satu tentor ditampilkan sebagai 2 Pertemuan dan 3 laporan terjadwal. Bila hanya satu tentor mengirim laporan, laporan itu dikembalikan, dikirim ulang, lalu diverifikasi, dashboard menampilkan 1 terkirim dan 1 terverifikasi.

AC-RPT-01.5. Jumlah siswa dihitung per Identitas Siswa unik, dan keikutsertaan pada beberapa kelompok tidak menggandakan jumlah individu.

AC-RPT-01.6. Materi rencana terisi, realisasi Pertemuan, kesiapan, dan kelengkapan dokumen masing-masing memiliki indikator sendiri. Indikator ketepatan rekomendasi menampilkan persentase pengganti yang disahkan dari tiga peringkat teratas rekomendasi. Owner tidak dapat mengubah data melalui dashboard.

### RPT-02 \| Dashboard Pemantauan dan Rekapitulasi Aset bagi Owner

SRS — Kebutuhan Fungsional

Sistem harus memproses dan menampilkan rekapitulasi data inventaris dalam dasbor visual mendekati real-time tanpa mewajibkan Admin menginput ulang data (zero redundant entry).

User Story

**RPT-02** Sebagai Owner, saya ingin melihat dasbor rekapitulasi persebaran dan kondisi aset operasional agar saya dapat mengevaluasi kesehatan inventaris secara cepat dan akurat.

Acceptance Criteria

AC-RPT-02.1. Dasbor menampilkan: total aset terdata, jumlah per status kondisi terkini, dan persebaran per lokasi (Kantor Edukom dan setiap sekolah mitra). Definisi angka: Total aset aktif = seluruh unit selain Nonaktif; unit Nonaktif dan Hilang ditampilkan terpisah. Persebaran per sekolah dihitung dari lokasi unit apa pun statusnya (Terdistribusi, Rusak, atau Perbaikan yang masih di sekolah).

AC-RPT-02.2. Dasbor diperbarui otomatis berdasarkan pemindaian Kurir, laporan lapangan, dan tiket servis tanpa input manual terpisah. Target keterbaruan: maksimal 1 menit (asumsi) setelah perubahan data, dan dasbor menampilkan waktu pembaruan terakhir.

AC-RPT-02.3. Tersedia fitur penyaringan (filter) data yang memungkinkan Owner menelusuri riwayat pergerakan spesifik dari suatu unit inventaris.

AC-RPT-02.4. Dasbor menampilkan rekap berdasarkan status (Tersedia, Terdistribusi, Rusak, Perbaikan, Hilang, Nonaktif), jenis aset, dan sekolah mitra, serta:

a\. jumlah Laporan Kendala yang belum selesai (status Dilaporkan atau Dikonfirmasi),

b\. jumlah Tiket Servis yang belum selesai (status Dibuka, Diproses, atau Menunggu Konfirmasi Admin).

AC-RPT-02.5. Dasbor menampilkan ringkasan pengadaan: pengajuan menunggu keputusan, pengajuan Disetujui yang belum Diterima Lengkap, dan total estimasi anggaran pengajuan Disetujui (hanya Owner yang melihat angka anggaran).

AC-RPT-02.6. Riwayat pergerakan unit memuat pemindaian pengantaran dan penjemputan, penugasan, kurir, waktu, sekolah, hasil validasi geofence (termasuk penolakan), laporan kendala, serta riwayat servis unit.

AC-RPT-02.7. Owner hanya memiliki akses lihat pada dasbor dan tidak otomatis memperoleh hak mengubah data aset (selaras dengan AC-RPT-01.6).

AC-RPT-02.8. Rekap dan riwayat pergerakan dapat diekspor dalam format XLSX dan CSV, dan ringkasan dasbor dalam format PDF. Ekspor mengikuti filter yang sedang aktif dan mencatat pengguna dan waktu ekspor.

### RPT-03 \| Pencarian dan Ekspor Laporan Administrasi

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Admin Edukom untuk mencari, menyaring, dan mengekspor laporan peserta, jadwal, realisasi, dan kelengkapan tentor berdasarkan periode, sekolah, kelas atau kelompok, tentor, dan status, dalam format XLSX atau CSV. Setiap jenis ekspor memiliki satuan baris dan kolom tetap berikut.

1\. Ekspor Peserta: satu baris per Keikutsertaan Siswa, dengan kolom sekolah, tahun ajaran, kelas, kelompok, nama siswa, NIS, NISN, dan identitas internal.

2\. Ekspor Jadwal: satu baris per Penugasan Sah, dengan kolom id_pertemuan, sekolah, program, kelompok, tentor, tanggal, jam mulai, jam selesai, status, penerbit, dan waktu terbit.

3\. Ekspor Realisasi: satu baris per laporan tentor pada versi terbaru, dengan kolom sekolah, kelompok, id_pertemuan, tentor pemilik laporan, hasil pelaksanaan, status, penanda Terlambat, pengirim, waktu kirim, pemeriksa, waktu verifikasi, dan jumlah hadir.

4\. Ekspor Kelengkapan Tentor: satu baris per kewajiban dokumen, dengan kolom tentor, jenis dokumen, periode, cakupan, tenggat, status versi terbaru, waktu unggah pertama, dan status keterlambatan.

Aktor: Admin Edukom.

User Story

**RPT-03** Sebagai Admin Edukom, saya ingin menyaring dan mengekspor laporan rinci dengan definisi yang sama seperti dashboard agar data yang saya berikan sesuai sekolah, periode, tentor, dan status yang diminta.

Acceptance Criteria

AC-RPT-03.1. Hasil mengikuti gabungan seluruh filter yang dipilih, dan hasil tanpa data menampilkan keterangan Hasil Kosong.

AC-RPT-03.2. Filter periode memakai tanggal Pertemuan untuk data kegiatan dan periode kewajiban untuk data dokumen, sedangkan tanggal pengiriman tersedia sebagai filter tersendiri.

AC-RPT-03.3. Ekspor memakai filter dan definisi indikator yang sama dengan dashboard, mengikuti keadaan data saat tombol Ekspor ditekan, dan mencantumkan waktu pengambilan data beserta filter yang dipakai.

AC-RPT-03.4. Setiap baris memuat status sehingga data yang belum diperiksa dapat dibedakan dari data terverifikasi. Kolom jumlah hadir hanya menghitung siswa berstatus HADIR.

AC-RPT-03.5. Ekspor sampai batas pada SET-01, dengan nilai awal 10.000 baris, diunduh langsung. Ekspor di atas batas tersebut diproses di latar belakang, dan Admin menerima notifikasi berisi tautan unduh setelah selesai.

AC-RPT-03.6. Ekspor hanya memuat data dalam kewenangan pengguna, dan NIS serta NISN disimpan sebagai teks pada berkas ekspor.

## 3.7 Modul Pengaturan Sistem (SET)

Modul ini menyimpan parameter kebijakan dan daftar rujukan yang dipakai bersama oleh seluruh modul, sehingga nilai kebijakan tidak tersebar pada masing-masing fungsi.

### SET-01 \| Pengelolaan Parameter Kebijakan Sistem

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas bagi Owner untuk menetapkan dan memelihara parameter kebijakan yang dipakai oleh seluruh modul, seperti durasi sesi, toleransi presensi, batas waktu pengajuan dan keputusan, ambang peringatan, batas ekspor, dan masa simpan data. Daftar parameter beserta nilai awalnya tercantum pada Lampiran D. Komponen honorarium dan tarif dikelola pada PAY-01, sedangkan daftar rujukan dikelola pada SET-02.

Aktor: Owner; Admin (melihat).

User Story

**SET-01.1** Sebagai Owner, saya ingin mengubah parameter kebijakan sistem dengan riwayat versi agar aturan operasional dapat disesuaikan tanpa mengubah program dan hasil periode yang sudah ditutup tidak berubah.

**SET-01.2** Sebagai Admin, saya ingin melihat parameter dan riwayat perubahannya tanpa dapat mengubahnya agar saya dapat mengontrol dasar aturan operasional.

Acceptance Criteria

AC-SET-01.1. Sistem menyimpan seluruh parameter pada Lampiran D sebagai parameter yang dapat diubah Owner, antara lain durasi satu sesi (70 menit), toleransi keterlambatan presensi (30 menit), saat presensi masuk dibuka (15 menit sebelum jam mulai sesi sampai jam selesai sesi), saat presensi pulang dibuka (15 menit sebelum jam selesai sesi), dan akurasi lokasi maksimal (50 meter).

AC-SET-01.2. Setiap parameter memiliki versi dan tanggal mulai berlaku. Perubahan hanya berlaku sejak tanggal mulai berlaku dan tidak mengubah hasil periode penggajian yang sudah ditutup.

AC-SET-01.3. Sistem tidak menyimpan parameter toleransi durasi minimal karena durasi antara presensi masuk dan pulang tidak memengaruhi honorarium.

AC-SET-01.4. Sistem memvalidasi bahwa parameter waktu dan jarak berupa bilangan bulat positif dan menolak dua versi parameter yang sama dengan masa berlaku yang tumpang tindih.

AC-SET-01.5. Parameter yang belum diisi Owner, yaitu ambang frekuensi izin, jam layanan Admin, dan jendela peringatan, belum aktif sampai diisi. Fungsi yang bergantung pada parameter tersebut menampilkan keterangan Belum Dikonfigurasi dan tidak diblokir.

AC-SET-01.6. Radius sekolah dikelola per sekolah pada ADM-01. Nilai radius awal untuk sekolah baru diambil dari parameter pada fungsi ini.

AC-SET-01.7. Sistem mencatat pengguna, waktu, nilai sebelum, dan nilai sesudah pada setiap perubahan sesuai KU-05. Owner dan Admin dapat melihat riwayat tersebut. Riwayat disimpan paling sedikit 6 bulan.

AC-SET-01.8. Hanya Owner yang dapat menambah, mengubah, dan menonaktifkan parameter. Admin hanya dapat melihat. Peran lain tidak memiliki akses pada fungsi ini.

### SET-02 \| Pengelolaan Daftar Rujukan

SRS — Kebutuhan Fungsional

Sistem harus menyediakan fasilitas pengelolaan daftar rujukan yang dipakai sebagai pilihan baku pada berbagai fungsi, yaitu daftar alasan penolakan izin dan calon pengganti (IZN-05), kategori kendala perangkat (AST-06), dan Jenis Perangkat (AST-01 dan AST-03).

Aktor: Owner; Admin.

User Story

**SET-02.1** Sebagai Owner, saya ingin menyusun daftar alasan penolakan izin agar penolakan memakai alasan yang baku.

**SET-02.2** Sebagai Admin, saya ingin mengelola kategori kendala perangkat dan Jenis Perangkat agar pelaporan dan pengadaan memakai pilihan yang seragam.

Acceptance Criteria

AC-SET-02.1. Daftar alasan baku penolakan izin disusun dan diubah oleh Owner. Admin hanya memilih alasan dari daftar tersebut saat menolak izin atau calon pengganti.

AC-SET-02.2. Kategori kendala perangkat dan Jenis Perangkat dikelola oleh Admin. Setiap butir memiliki nama dan status ACTIVE atau INACTIVE.

AC-SET-02.3. Butir daftar yang sudah dipakai tidak dapat dihapus dan hanya dapat dinonaktifkan. Butir nonaktif tidak muncul pada pilihan baru, dan data lama tetap menampilkan butir tersebut.

AC-SET-02.4. Jenis dokumen administrasi, checklist, dan aturan berkas dikelola Admin pada ADM-12 dan tidak dikelola pada fungsi ini.

AC-SET-02.5. Sistem mencatat pengguna, waktu, dan perubahan pada setiap daftar rujukan sesuai KU-05.

# BAB IV KEBUTUHAN NON-FUNGSIONAL (REKAYASA ARSITEKTURAL)

Mendampingi spesifikasi kebutuhan fungsional, aspek rekayasa non-fungsional memastikan infrastruktur kode memenuhi landasan skalabilitas masa depan, resistensi penetrasi digital, kecepatan respons algoritmik, serta ketangguhan mitigasi anomali sistemik.

## 4.1 Performa (PRF)

|        |          |                                                                                                   |                                                                    |                                                                        |                                         |                                     |
|--------|----------|---------------------------------------------------------------------------------------------------|--------------------------------------------------------------------|------------------------------------------------------------------------|-----------------------------------------|-------------------------------------|
| ID     | Kategori | Deskripsi Kebutuhan                                                                               | Metrik dan Target                                                  | Kondisi Pengujian                                                      | Metode Verifikasi                       | Status                              |
| PRF-01 | Performa | Waktu muat halaman presensi (FR: PAY-02, ADM-13)                                                  | p95 ≤ 3 detik muat awal; p95 ≤ 1,5 detik navigasi berikutnya (SPA) | Ponsel Android kelas menengah, Chrome, 4G, cache dingin, 30 kali ulang | Lighthouse atau WebPageTest, hitung p95 | Usulan Analis — Menunggu Konfirmasi |
| PRF-02 | Performa | Waktu muat halaman data berat: dashboard, rekap, daftar aset (FR: RPT-01, RPT-03, AST-06, PAY-05) | p95 ≤ 5 detik pada volume data penuh (N_S, N_U)                    | Desktop, LAN kantor, data uji volume penuh                             | Lighthouse dan log waktu API            | Usulan Analis — Menunggu Konfirmasi |

|        |          |                                                                                                                                                 |                                                                                                                                                        |                                                                 |                                       |                                                |
|--------|----------|-------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------|---------------------------------------|------------------------------------------------|
| PRF-03 | Performa | Respons API baca (FR: seluruh modul)                                                                                                            | p95 ≤ 2 detik, p99 ≤ 4 detik                                                                                                                           | Beban normal = 50% N_C; basis data berisi data uji volume penuh | k6 atau JMeter, laporan persentil     | Usulan Analis — Menunggu Konfirmasi            |
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

|        |          |                                                                                                                                                                 |                                                                                                                                                                            |                                                                   |                                                      |                                                                  |
|--------|----------|-----------------------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------|------------------------------------------------------|------------------------------------------------------------------|
| ID     | Kategori | Deskripsi Kebutuhan                                                                                                                                             | Metrik dan Target                                                                                                                                                          | Kondisi Pengujian                                                 | Metode Verifikasi                                    | Status                                                           |
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

|        |           |                                                                                                          |                                                                                                                                     |                                           |                                              |                                                               |
|--------|-----------|----------------------------------------------------------------------------------------------------------|-------------------------------------------------------------------------------------------------------------------------------------|-------------------------------------------|----------------------------------------------|---------------------------------------------------------------|
| ID     | Kategori  | Deskripsi Kebutuhan                                                                                      | Metrik dan Target                                                                                                                   | Kondisi Pengujian                         | Metode Verifikasi                            | Status                                                        |
| REL-01 | Keandalan | Ketersediaan layanan. "Tanpa downtime" pada satu VPS tidak terukur (K9), sehingga diganti target numerik | Uptime ≥ 99,5% per bulan (± 3,6 jam downtime maksimum per bulan); jam kritis (H_KRITIS) diprioritaskan                              | Pemantauan 30 hari berjalan               | Monitoring uptime eksternal, laporan bulanan | Keputusan Diperlukan (Q3)                                     |
| REL-02 | Keandalan | Pemeliharaan terjadwal                                                                                   | Dilakukan di luar H_KRITIS; pemberitahuan ≥ 24 jam sebelumnya                                                                       | Simulasi rilis                            | Tinjauan jadwal rilis                        | Usulan Analis — Menunggu Konfirmasi                           |
| REL-03 | Keandalan | Konsistensi transaksi dan pengendalian konkurensi (FR: ADM-11, AST-03, PAY-02, IZN-05, AST-04)           | 0 jadwal bentrok pada publikasi bersamaan; 0 alokasi unit ganda; 0 presensi ganda; transaksi ACID                                   | Dua sesi paralel melakukan aksi sama      | Uji konkurensi otomatis                      | Ditetapkan SRS (perilaku)                                     |
| REL-04 | Keandalan | Penanganan kegagalan jaringan dan perangkat lapangan (FR: PAY-02, PAY-03, AST-04)                        | Permintaan kirim ulang bersifat idempoten (tidak membuat data ganda); pesan galat jelas; jalur alternatif lewat koreksi (PAY-03)    | Putus koneksi saat kirim lalu kirim ulang | Uji dengan simulasi jaringan buruk           | Usulan Analis — Menunggu Konfirmasi (Q14: perlu mode luring?) |
| REL-05 | Keandalan | Kegagalan layanan eksternal Google Maps (FR: PAY-06, ADM-05, PAY-02)                                     | Presensi tetap berjalan jika jarak rute gagal dihitung; nilai jarak terakhir yang tersimpan dipakai dan ditandai                    | Blokir akses Google API                   | Uji kegagalan layanan                        | Usulan Analis — Menunggu Konfirmasi (K4, Q6)                  |
| REL-06 | Keandalan | Status integrasi gagal tidak diasumsikan siap (FR: ADM-17, ADM-18)                                       | Status "tidak diketahui" ditampilkan, bukan "siap"                                                                                  | Matikan sumber status kesiapan            | Uji fungsional                               | Ditetapkan SRS                                                |
| REL-07 | Keandalan | Pencegahan kehilangan data saat penyimpanan                                                              | Konfirmasi sukses hanya setelah data tersimpan permanen; unggahan berkas atomik dengan data terkait                                 | Matikan server di tengah transaksi        | Uji kegagalan terkendali                     | Usulan Analis — Menunggu Konfirmasi                           |
| REL-08 | Keandalan | Pemulihan otomatis status aset (FR: AST-05)                                                              | Status unit kembali Tersedia otomatis saat tiket Selesai; Tidak Dapat Diperbaiki menjadi Nonaktif setelah konfirmasi Admin (§4.3.2) | Tutup tiket dengan tiap status            | Uji transisi                                 | Ditetapkan SRS                                                |

## 4.4 Kapasitas dan Skalabilitas (CAP)

|        |           |                                                         |                                                                                                                                                     |                                               |                                           |                                                 |
|--------|-----------|---------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------------------------|-----------------------------------------------|-------------------------------------------|-------------------------------------------------|
| ID     | Kategori  | Deskripsi Kebutuhan                                     | Metrik dan Target                                                                                                                                   | Kondisi Pengujian                             | Metode Verifikasi                         | Status                                          |
| CAP-01 | Kapasitas | Pengguna bersamaan pada puncak presensi (FR: PAY-02)    | Mendukung N_C check-in serentak dalam 5 menit dengan 37 lokasi geofence berbeda; beban uji = 2 × N_C; 0 presensi hilang atau ganda                  | Skrip beban dengan koordinat 37 sekolah       | k6 atau JMeter, hitung transaksi          | Keputusan Diperlukan (Q2)                       |
| CAP-02 | Kapasitas | Pengguna terdaftar dan sesi aktif (FR: seluruh modul)   | Mendukung N_T + N_A + N_K + N_Tk + N_O akun; uji 2 × jumlah sesi aktif                                                                              | Beban campuran semua peran                    | Uji beban campuran                        | Keputusan Diperlukan (Q1)                       |
| CAP-03 | Kapasitas | Volume data (FR: ADM-03, PAY-02, AST-04, audit)         | PRF-01 s.d. PRF-13 tetap terpenuhi pada volume proyeksi 3 tahun (N_S, N_U, N_J × hari ajar × tahun)                                                 | Basis data diisi data sintetis volume 3 tahun | Uji performa pada data volume penuh       | Keputusan Diperlukan (Q1)                       |
| CAP-04 | Kapasitas | Penyimpanan berkas (FR: ADM-13, PAY-03, AST-04, AST-05) | Kuota dihitung dari unggahan per bulan × ukuran rata-rata × 36 bulan; peringatan saat pemakaian ≥ 80%                                               | Proyeksi penyimpanan                          | Perhitungan kapasitas dan pemantauan disk | Keputusan Diperlukan (Q13)                      |
| CAP-05 | Kapasitas | Utilisasi sumber daya pada beban puncak                 | CPU dan RAM rata-rata ≤ 70% pada beban uji puncak; spesifikasi minimum VPS ditetapkan setelah uji (SRS: ≥ 4 core CPU dan SSD, RAM kosong)           | Beban CAP-01 selama 30 menit                  | Monitoring sumber daya selama uji         | Ditetapkan SRS (4 core, SSD); angka lain usulan |
| CAP-06 | Kapasitas | Skalabilitas dan perilaku saat kelebihan beban          | Dapat ditingkatkan dengan menaikkan sumber daya VPS tanpa ubah kode; saat kelebihan beban sistem merespons lambat atau antre, bukan kehilangan data | Beban 3 × N_C                                 | Uji stres                                 | Usulan Analis — Menunggu Konfirmasi             |

## 4.5 Integritas dan Audit Data (INT)

|        |            |                                                                                                           |                                                                                                                                                   |                                                              |                                          |                                                                      |
|--------|------------|-----------------------------------------------------------------------------------------------------------|---------------------------------------------------------------------------------------------------------------------------------------------------|--------------------------------------------------------------|------------------------------------------|----------------------------------------------------------------------|
| ID     | Kategori   | Deskripsi Kebutuhan                                                                                       | Metrik dan Target                                                                                                                                 | Kondisi Pengujian                                            | Metode Verifikasi                        | Status                                                               |
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

|        |          |                                              |                                                                                         |                                                              |                                   |                                     |
|--------|----------|----------------------------------------------|-----------------------------------------------------------------------------------------|--------------------------------------------------------------|-----------------------------------|-------------------------------------|
| ID     | Kategori | Deskripsi Kebutuhan                          | Metrik dan Target                                                                       | Kondisi Pengujian                                            | Metode Verifikasi                 | Status                              |
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

|        |                |                                                                                                                |                                                                                                                                   |                                                                  |                                   |                                                          |
|--------|----------------|----------------------------------------------------------------------------------------------------------------|-----------------------------------------------------------------------------------------------------------------------------------|------------------------------------------------------------------|-----------------------------------|----------------------------------------------------------|
| ID     | Kategori       | Deskripsi Kebutuhan                                                                                            | Metrik dan Target                                                                                                                 | Kondisi Pengujian                                                | Metode Verifikasi                 | Status                                                   |
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

|        |              |                                                                                                        |                                                                                                                                                |                                                          |                                  |                                                |
|--------|--------------|--------------------------------------------------------------------------------------------------------|------------------------------------------------------------------------------------------------------------------------------------------------|----------------------------------------------------------|----------------------------------|------------------------------------------------|
| ID     | Kategori     | Deskripsi Kebutuhan                                                                                    | Metrik dan Target                                                                                                                              | Kondisi Pengujian                                        | Metode Verifikasi                | Status                                         |
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
