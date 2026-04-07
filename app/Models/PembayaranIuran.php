<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranIuran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_iuran';

    protected $fillable = [
        'tagihan_iuran_id',
        'warga_id',
        'tanggal_bayar',
        'jumlah_bayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status_verifikasi',
        'diverifikasi_oleh',
        'tanggal_verifikasi',
        'catatan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_bayar' => 'datetime',
            'tanggal_verifikasi' => 'datetime',
            'jumlah_bayar' => 'decimal:2',
        ];
    }

    public function tagihanIuran()
    {
        return $this->belongsTo(TagihanIuran::class, 'tagihan_iuran_id');
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}