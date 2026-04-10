-- SQL untuk sinkronisasi skema database Sistem RT (April 2026)
-- Jalankan file ini jika Anda mendapatkan Error 500 pada modul Laporan atau Jenis Iuran

-- 1. Perbaikan Tabel Tagihan Iuran
ALTER TABLE tagihan_iuran CHANGE nominal nominal_tagihan DECIMAL(15,2);
ALTER TABLE tagihan_iuran CHANGE status status_pembayaran VARCHAR(255) DEFAULT 'belum_bayar';

-- 2. Perbaikan Enum pada Status Pembayaran (opsional jika menggunakan varchar)
-- Secara otomatis kolom status_pembayaran sekarang mendukung 'belum_bayar', 'lunas', 'proses', 'batal'

-- 3. Perbaikan Enum pada Pembayaran Iuran
-- Memastikan status_verifikasi mendukung 'disetujui'
ALTER TABLE pembayaran_iuran MODIFY COLUMN status_verifikasi ENUM('menunggu', 'disetujui', 'ditolak') DEFAULT 'menunggu';
