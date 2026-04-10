# 🏡 Sistem Informasi Manajemen RT (Sistem RT) - Edisi Premium 🚀

Selamat datang di repositori **Sistem RT**! Aplikasi ini telah bertransformasi menjadi platform manajemen lingkungan Rukun Tetangga (RT) yang modern, elegan, dan fungsional. 

Dibuat dengan **Laravel 12** dan **Tailwind CSS**, sistem ini menawarkan pengalaman pengguna (UX) setara dengan aplikasi SaaS profesional.

---

## 🌟 Dashboard Preview (Highlight)
- **Admin Panel**: Dashboard analitik yang menampilkan statistik kependudukan, agenda aktif, dan ringkasan kas RT dalam satu layar.
- **Warga Portal**: Pusat informasi warga untuk melihat pengumuman terbaru, jadwal gotong royong, dan memantau kewajiban iuran secara transparan.

---

## 🚀 Fitur yang Sudah Selesai (Ready to Use)

### 1. 🔐 Autentikasi & Multi-Role
- Sistem login terintegrasi menggunakan **Laravel Breeze**.
- Pembatasan akses ketat berdasarkan peran (**Admin** vs **Warga**) menggunakan middleware khusus.
- Pengalihan dashboard otomatis cerdas berdasarkan hak akses pengguna.

### 2. 👥 Manajemen Kependudukan (Master Data)
- **Modul Keluarga**: Pengelolaan data Kartu Keluarga (KK) dengan validasi data yang presisi.
- **Modul Warga**: Data detail personal warga yang terhubung otomatis dengan basis data keluarga.
- **Relasi Kepala Keluarga**: Sistem pintar yang memetakan Kepala Keluarga secara otomatis di tabel kependudukan.

### 3. 📢 Komunikasi & Koordinasi
- **Papan Pengumuman**: Admin dapat menerbitkan pengumuman (Draft/Publish). Warga mendapatkan ringkasan pengumuman terbaru di halaman utama.
- **Agenda Kegiatan**: Penjadwalan aktivitas lingkungan (Rapat, Kerja Bakti) lengkap dengan detail lokasi, waktu, dan status kegiatan mendasar.

### 4. 💰 Pengelolaan Keuangan (Iuran)
- **Master Jenis Iuran**: Fleksibilitas menentukan kategori iuran (Wajib, Sukarela, dll).
- **Sistem Penagihan**: Pembuatan tagihan per warga secara massal atau individu.
- **Konfirmasi Pembayaran**: Pencatatan pembayaran tunai/manual oleh bendahara dengan status *real-time* (Belum lunas, Proses, Lunas).

### 5. 📊 Audit & Laporan (Statistik)
- **Visualisasi Data**: Rekapitulasi jumlah warga per gender, total keluarga, dan kesehatan keuangan RT.
- **Dashboard Analitik**: Grafik mental yang memudahkan pengurus melihat "siapa yang belum bayar" dan "berapa saldo kas masuk".

### 6. ✨ UI/UX Revamp (Premium Look)
- Berbasis **Tailwind CSS** dengan estetika *Glassmorphism* dan *Soft Shadows*.
- Responsif di berbagai perangkat (Mobile & Desktop).
- Interaksi UI yang halus dan tipografi modern (*Inter* & *Outfit* fonts).

---

## 🏗️ Struktur Sistem (Technical Info)

- **Backend Logic**: Semua logika dashboard dikelola terpusat di `DashboardController.php` untuk performa navigasi yang cepat.
- **Routing**: Jalur URL yang rapi (`/admin` dan `/warga`) dengan proteksi middleware berlapis.
- **Database Architecture**: Perancangan skema DB yang ternormalisasi untuk menjamin integritas data (Foreign Key & Soft Deletes).

---

## 🚧 Agenda Masa Depan (To-Do / Roadmap)
- [ ] **Payment Gateway Integration**: Automasi pembayaran via Midtrans/Xendit (e-Wallet, VA).
- [ ] **Laporan Ekspor**: Fitur download laporan bulanan dalam format PDF atau Excel.
- [ ] **Sistem Notifikasi**: Pengiriman pengumuman via WhatsApp API atau Email secara otomatis.
- [ ] **Profil Mandiri Warga**: Fitur bagi warga untuk mengedit foto profil dan data kontak sendiri.
- [ ] **Environment Report**: Modul pelaporan kerusakan fasilitas umum atau gangguan keamanan.

---

## 🛠️ Panduan Menjalankan Project

1. **Clone & Install**:
   ```bash
   git clone [URL_REPO_ANDA]
   composer install
   npm install
   ```

2. **Setup Env**:
   - Salin `.env.example` ke `.env`
   - Sesuaikan `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`.

3. **Database Migration & Seed**:
   ```bash
   php artisan key:generate
   php artisan migrate
   php artisan db:seed --class=RoleSeeder
   php artisan db:seed --class=AdminUserSeeder
   php artisan db:seed --class=DemoWargaSeeder
   ```

4. **Run Application**:
   - Jalankan `php artisan serve` di satu jendela terminal.
   - Jalankan `npm run dev` di jendela terminal lainnya.

---

## 👤 Akun Percobaan (Demo)
| Role | Email | Password |
| :--- | :--- | :--- |
| **Admin** | `admin@gmail.com` | `admin12345` |
| **Warga** | `warga@gmail.com` | `warga12345` |

---

&copy; 2026 **Sistem Manajemen RT**. Dibangun dengan penuh semangat untuk kemajuan lingkungan! 🇮🇩