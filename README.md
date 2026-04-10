# 🏡 Sistem Informasi Manajemen RT (Sistem RT) - Edisi Premium 🚀

Selamat datang di repositori **Sistem RT**! Aplikasi ini telah bertransformasi menjadi platform manajemen lingkungan Rukun Tetangga (RT) yang modern, elegan, dan fungsional. 

Dibuat dengan **Laravel 12** dan **Tailwind CSS**, sistem ini menawarkan pengalaman pengguna (UX) setara dengan aplikasi SaaS profesional. Project ini telah melalui fase restorasi dan optimasi besar-besaran untuk mencapai standar kualitas tinggi.

---

## 🛠️ Update Restorasi & UI/UX Terbaru (April 2026)
Sebagai bagian dari pembaruan besar, berikut adalah pencapaian teknis dan visual yang telah diimplementasikan:

### 1. 🔐 Portal Autentikasi Modern (Elite Onboarding)
- **Premium Login & Register**: Perombakan total halaman masuk dan daftar dengan layout *split-screen* yang mewah.
- **Visual Kustom**: Integrasi ilustrasi 3D kustom (dikelola secara lokal di `public/assets/images`) untuk memberikan identitas visual yang kuat.
- **Tipografi Outfit**: Penggunaan font **Outfit** untuk memberikan kesan modern, bersih, dan profesional.

### 2. 👥 Manajemen Kependudukan & Performa
- **Optimasi Query**: Implementasi *targeted field selection* dan *eager loading* pada modul **Warga** dan **Keluarga** untuk memastikan kecepatan akses meskipun data berjumlah besar.
- **Revamp Table & Form**: Seluruh komponen tabel dan formulir kependudukan telah didesain ulang dengan gaya *Premium SaaS* (Soft shadows, Glassmorphism).

### 3. 📢 Restorasi Modul Utama (Back from the Void)
Sistem telah memulihkan fungsionalitas penuh yang sebelumnya hilang akibat konflik merge:
- **Modul Pengumuman**: Pengelolaan diseminasi berita (RT-wide) dengan status Draft/Publish.
- **Modul Kegiatan**: Penjadwalan agenda warga, rapat, dan gotong royong terintegrasi.
- **Modul Keuangan (Iuran)**: Manajemen tagihan iuran bulanan dan pelacakan status pembayaran warga.

### 4. 📊 Audit & Laporan
- **Dashboard Eksekutif**: Ringkasan statistik kependudukan dan kesehatan kas RT yang tersaji secara visual dan intuitif.

---

## 🚀 Fitur Utama
- **Multi-Role Access**: Pemisahan otoritas yang ketat antara Admin RT dan Warga.
- **Mobile Responsive**: Akses lancar melalui smartphone, tablet, maupun desktop.
- **Performance Focused**: Kode yang dioptimalkan untuk respons cepat.

---

## 🏗️ Technical Stack
- **Framework**: Laravel 12
- **Styling**: Tailwind CSS
- **Design Methodology**: Glassmorphism, Sophisticated Gradients, Modern Typography.

---

## 🛠️ Panduan Instalasi Cepat
1. Clone repositori ini.
2. Jalankan `composer install` & `npm install`.
3. Setup `.env` (Database & App Key).
4. Jalankan migrasi: `php artisan migrate`.
5. Jalankan seeders: `php artisan db:seed`.
6. Akses aplikasi: `php artisan serve` & `npm run dev`.

---

## 📜 Riwayat Pengembangan (Development History)
Perjalanan transformasi Sistem RT dari sebuah prototipe sederhana hingga menjadi platform premium yang fungsional:

### 🕒 Tahap 1: Inisiasi & Prototipe (5 April 2026)
- **Kick-off**: Inisiasi struktur dasar Laravel dan boilerplate sistem informasi.
- **Konsep Awal**: Pembuatan modul Kependudukan dasar dan simulasi dasbor warga dalam Bahasa Indonesia.
- **Role-based Access**: Implementasi awal sistem peran (Admin vs Warga) untuk memisahkan wewenang akses.

### 🕒 Tahap 2: Penguatan Basis Data & Validasi (7 April 2026)
- **Normalisasi DB**: Pemetaan relasi yang lebih presisi antara tabel Warga dan Keluarga.
- **Relasi Kepala Keluarga**: Pengembangan logika otomatis untuk menentukan kepala keluarga dalam database.
- **Dashboard Warga**: Perbaikan error pada view dashboard dan penyempurnaan alur login.

### 🕒 Tahap 3: Restorasi & Optimasi Masal (10 April 2026)
- **Resolusi Konflik**: Penanganan konflik merge besar yang sempat menghilangkan beberapa kontroler inti.
- **Restorasi Modul**: Membangun kembali modul Pengumuman, Kegiatan, Iuran, dan Laporan yang hilang akibat konflik.
- **Optimasi Performa**: Refactoring query database untuk menangani load data yang lambat (Targeted field selection & Eager Loading).
- **Maintenance**: Perbaikan warning pada rute sistem dan pengorganisasian kode yang lebih bersih.

### 🕒 Tahap 4: Premium UI/UX Transformation (10 April 2026 - Sekarang)
- **Elite Auth Portal**: Redesain total halaman Login dan Register dengan estetika *Premium SaaS* dan ilustrasi 3D kustom.
- **Modern Look & Feel**: Implementasi bahasa desain modern (Glassmorphism, Outfit font, Sophisticated Gradients) ke seluruh modul aplikasi.
- **Asset Portability**: Migrasi seluruh aset visual ke direktori publik lokal untuk menjamin kemandirian sistem tanpa ketergantungan file eksternal.

---

&copy; 2026 **Sistem Manajemen Lingkungan Digital**. Dibangun untuk masa depan komunitas yang lebih baik. 🇮🇩