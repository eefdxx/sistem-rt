# 🏡 Sistem Informasi Manajemen RT (Sistem RT) - Edisi Premium 🚀

Selamat datang di repositori **Sistem RT**! Aplikasi ini telah bertransformasi menjadi platform manajemen lingkungan Rukun Tetangga (RT) yang modern, elegan, dan fungsional. 

Dibuat dengan **Laravel 12** dan **Tailwind CSS**, sistem ini menawarkan pengalaman pengguna (UX) setara dengan aplikasi SaaS profesional. Project ini telah melalui fase restorasi, optimasi, dan pembersihan total untuk mencapai standar kualitas tinggi.

---

## 🛠️ Update Restorasi & UI/UX Terbaru (April - Mei 2026)
Sebagai bagian dari pembaruan besar, berikut adalah pencapaian teknis dan visual yang telah diimplementasikan:

### 1. 🔐 Portal Autentikasi Modern (Elite Onboarding)
- **Premium Login & Register**: Perombakan total halaman masuk dan daftar dengan layout *split-screen* yang mewah.
- **Visual Kustom**: Integrasi ilustrasi 3D kustom yang dikelola secara lokal di `public/assets/images` untuk menjamin kemandirian aset.
- **Tipografi Outfit**: Penggunaan font **Outfit** untuk memberikan kesan modern, bersih, dan profesional.

### 2. 👥 Manajemen Kependudukan & Performa
- **Optimasi Query**: Implementasi *targeted field selection* dan *eager loading* pada modul **Warga** dan **Keluarga** untuk memastikan kecepatan akses meskipun data berjumlah besar.
- **Revamp Table & Form**: Seluruh komponen tabel dan formulir kependudukan telah didesain ulang dengan gaya *Premium SaaS* (Soft shadows, Glassmorphism).

### 3. 📢 Restorasi Modul Utama (Back from the Void)
Sistem telah memulihkan fungsionalitas penuh yang sebelumnya hilang akibat konflik merge:
- **Modul Pengumuman**: Pengelolaan diseminasi berita (RT-wide) dengan status Draft/Publish.
- **Modul Kegiatan**: Penjadwalan agenda warga, rapat, dan gotong royong terintegrasi.
- **Modul Keuangan (Iuran)**: Manajemen tagihan iuran bulanan dan pelacakan status pembayaran warga.

### 4. 📊 Audit Global & Sinkronisasi DB
- **Dashboard Eksekutif**: Ringkasan statistik kependudukan dan kesehatan kas RT yang tersaji secara visual.
- **Schema Alignment**: Penyesuaian skema database (Tabel Tagihan & Pembayaran) agar selaras dengan kebutuhan pelaporan global. File sinkronisasi tersedia di `database/schema_fix.sql`.

### 5. 💡 Automasi & Penyelesaian Modul (Mei 2026)
- **Master Jenis Iuran**: Implementasi penuh manajemen jenis iuran (*create* & *edit*) untuk kontrol finansial RT yang fleksibel.
- **Generate Tagihan Masal**: Fitur *auto-generate* tagihan bulanan untuk seluruh warga aktif secara instan dengan sistem pencegahan duplikasi tagihan (*anti-double billing*).
- **Bug Fixes Kritis**: Penyelesaian *error* terkait konversi struktur ENUM pada status pembayaran, serta *clean-up* berbagai tombol *placeholder/dummy*.

---

## 🚀 Fitur Utama
- **Multi-Role Access**: Pemisahan otoritas yang ketat antara Admin RT dan Warga.
- **Mobile Responsive**: Akses lancar melalui smartphone, tablet, maupun desktop.
- **Performance Focused**: Kode yang dioptimalkan untuk respons cepat.

---

## 🏗️ Technical Stack
- **Framework**: Laravel 12
- **Styling**: Tailwind CSS / Vite
- **Design Methodology**: Glassmorphism, Sophisticated Gradients, Modern Typography.

---

## 🛠️ Panduan Instalasi & Sinkronisasi
1. Clone repositori ini.
2. Jalankan `composer install` & `npm install`.
3. Setup `.env` (Database & App Key).
4. Jalankan migrasi: `php artisan migrate`.
5. **Sinkronisasi DB (Penting)**: Jika menggunakan database lama, jalankan file `database/schema_fix.sql` melalui phpMyAdmin untuk menghindari Error 500 pada modul Laporan.
6. Jalankan seeders: `php artisan db:seed`.
7. Akses aplikasi: `php artisan serve` & `npm run build`.

---

## 📜 Riwayat Pengembangan (Development History)
Perjalanan transformasi Sistem RT dari prototipe hingga menjadi platform premium:

- **Tahap 1 (5 April)**: Inisiasi prototipe dasar dan simulasi dashboard kependudukan.
- **Tahap 2 (7 April)**: Penajaman relasi Warga-Keluarga dan implementasi Role-based access.
- **Tahap 3 (10 April)**: Restorasi modul finansial & pengumuman setelah konflik merge.
- **Tahap 4 (Awal Mei)**: Transformasi UI ke **Premium SaaS**, Optimasi Database masal, dan Finalisasi Laporan Global.
- **Tahap 5 (Hari Ini)**: Penyelesaian *backend* Modul Iuran (pembayaran mandiri & verifikasi admin), Automasi Generate Tagihan Masal, manajemen Master Jenis Iuran, serta Modul Laporan Masalah Lingkungan (sistem *ticketing* pengaduan warga).

---

&copy; 2026 **Sistem Manajemen Lingkungan Digital**. Dibangun untuk masa depan komunitas yang lebih baik. 🇮🇩