# 🏡 Sistem Informasi Manajemen RT (Sistem RT)

Selamat datang di repositori **Sistem RT**! 🚀  
Aplikasi ini dirancang khusus untuk mempermudah pengurus Rukun Tetangga (RT) dalam mengelola data warga, administrasi, keuangan (iuran), hingga pelaporan lingkungan secara digital dan terstruktur.

> **Pendekatan Development:** Saat ini, fokus utama tim adalah menyelesaikan **Backend & Logika (Backend-First)**. Tampilan antarmuka (Frontend) saat ini berfungsi dengan baik, namun akan dipoles menjadi lebih cantik dan dinamis setelah seluruh logika backend selesai.

---

## 🌟 Progres Kita Saat Ini (Update Terbaru!)

Project ini sedang berjalan dengan lancar! Buat teman-teman yang baru bergabung, berikut adalah status progres yang sudah berhasil kita capai:

### ✅ FITUR YANG SUDAH SELESAI (Bisa Langsung Dites!)
1. **Sistem Login & Keamanan Dasar:** Otentikasi menggunakan template Laravel standard.
2. **Dashboard Admin:** Menampilkan statistik total warga, total keluarga, dan laporan dengan angka real-time.
3. **Manajemen Keluarga:**
   - ➕ Tambah, 📝 Edit, 👁️ Detail, dan 🗑️ Hapus Data Keluarga (KK, Alamat, RT/RW, Kode Pos).
   - 🛡️ Validasi input anti-error (RT, RW, Kode Pos, Nomor KK sudah divalidasi ketat hanya menerima angka).
4. **Manajemen Warga:**
   - ➕ Tambah, 📝 Edit, 👁️ Detail, dan 🗑️ Hapus Data Warga.
   - 🔗 Canggih: Menghubungkan secara otomatis data Kepala Keluarga di tabel `Keluarga` dan tabel `Warga`.

### 🚧 SEDANG DALAM PENGERJAAN / BERIKUTNYA (To-Do List)
Teman-teman yang mau berkontribusi, bisa langsung ambil bagian fitur-fitur ini:
- [ ] **Modul Iuran & Pembayaran:** Mencatat iuran bulanan warga, kas RT, rekap otomatis.
- [ ] **Modul Kegiatan:** Menjadwalkan rapat RT, kerja bakti, dsb.
- [ ] **Modul Pelaporan Warga:** Fasilitas untuk warga melaporkan fasilitas rusak, keamanan, dll.
- [ ] **Dashboard Khusus Warga:** Halaman untuk warga melihat tagihan iuran dan pengumuman.
- [ ] **Pengumuman & Surat Pengantar:** Generator surat pengantar RT otomatis.

---

## 🛠️ Persyaratan Sistem (Prerequisites)

Sebelum mulai menjalankan project ini dari *Nol*, pastikan teman-teman sudah menginstal *tools* wajib berikut di laptop/komputer:

1. **XAMPP / Laragon** (Pastikan PHP minimal versi 8.2 & MySQL nyala)
2. **Composer** (Untuk menginstall dependencies/library backend PHP)
3. **Node.js & NPM** (Untuk mengolah tampilan frontend / Tailwind CSS)
4. **Git** (Untuk menarik dan mengirim perubahan kode)
5. **Code Editor / IDE**, sangat disarankan menggunakan **Visual Studio Code (VSCode)**.

---

## 🚀 Panduan Panduan Menjalankan Project dari 0 (Setup Awal)

Buat teman-teman yang baru pertama kali *clone* project ini, ikuti langkah ini pelan-pelan secara berurutan. Di setting cukup **sekali** saja di awal:

### 1. Clone Project
Buka Terminal/Command Prompt (CMD) di folder tujuan (misal di dalam folder `htdocs`), lalu ketik:
```bash
git clone https://github.com/[URL_REPO_KITA]/sistem-rt.git
cd sistem-rt
```

### 2. Install Library Backend & Frontend
Jalankan dua perintah ini berurutan untuk mendownload semua *library* bawaan framework:
```bash
composer install
npm install
```

### 3. Konfigurasi Environment (Database)
Laravel butuh file konfigurasi bawaan. *Copy* file `.env`.
```bash
cp .env.example .env
```
Lalu **Buka file `.env`** dan ubah konfigurasi database-nya (biasanya baris ke-22):
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_rt   <-- (Pastikan teman-teman buat database kosong bernama 'sistem_rt' di phpMyAdmin dulu ya!)
DB_USERNAME=root
DB_PASSWORD=            <-- (Kosongkan bila menggunakan XAMPP standar)
```

### 4. Setup Key & Database
Jika database sudah dibuat di phpMyAdmin, mari kita tanam (migrate) tabel-tabelnya ke database dan generate app key:
```bash
php artisan key:generate
php artisan migrate
```
*(Opsional: Jika nanti kita sudah punya `RoleSeeder` atau data dummy, teman-teman bisa jalankan `php artisan db:seed`)*

### 5. Jalankan Aplikasi! 🎉
Kita butuh menghidupkan **2 terminal/CMD tersendiri**. 

**Terminal 1 (Menjalankan server PHP/Backend):**
```bash
php artisan serve
```

**Terminal 2 (Menjalankan server Frontend/Tailwind agar tampilan tidak hancur):**
Buka terminal baru di folder yang sama, lalu jalankan:
```bash
npm run dev
```

Buka Browser dan ketik URL:
👉 **`http://localhost:8000`**

---

## 📚 Struktur Kode (Cheat Sheet Buat Lanjutin)

Biar gak bingung nyari file, ini contekan folder yang paling sering dibongkar pas kita ngoding:

- 🗄️ **Database (Tabel & Kolom):** Cek di folder `database/migrations/`
- 🧠 **Logika Data Backend:** Cek folder `app/Http/Controllers/` (Cth: `KeluargaController.php`)
- 🎨 **Tampilan Web (HTML/Blade):** Cek folder `resources/views/` (Disusun rapi per entitas misal `admin/keluarga`)
- 🚦 **Jalur / URL (Routing):** Cek file `routes/web.php`
- ✅ **Validasi Form Anti Error:** Cek file `app/Http/Requests/`

---

## 🤝 Cara Berkontribusi (Aturan Main)

Supaya kerja sama tim enak dan kode gak bentrok:
1. Usahakan **Pull** dulu sebelum mulai ngoding: `git pull origin main`
2. Jangan asal merubah kode migrasi (`database/migrations`) yang *sudah di-push* ke public. Kalau ada yang mau diedit, buat file migrasi baru (alter table).
3. Beritahu teman di grup kalau mau mengerjakan suatu fitur agar tidak kerja *double*