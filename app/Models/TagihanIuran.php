<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagihanIuran extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tagihan_iuran';

    protected $fillable = [
        'warga_id',
        'jenis_iuran_id',
        'periode_bulan',
        'periode_tahun',
        'nominal_tagihan',
        'jatuh_tempo',
        'status_pembayaran',
        'keterangan',
        'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'nominal_tagihan' => 'decimal:2',
            'jatuh_tempo'     => 'date',
        ];
    }

    // -------------------------------------------------------------------
    // Accessors: mapping kolom DB ke alias yang ramah untuk dipakai di view
    // -------------------------------------------------------------------

    /** Alias: nominal_tagihan */
    public function getNominalAttribute(): float
    {
        return (float) $this->nominal_tagihan;
    }

    /** Alias: status_pembayaran */
    public function getStatusAttribute(): string
    {
        return $this->status_pembayaran ?? 'belum_bayar';
    }

    /** Nama bulan Indonesia berdasarkan periode_bulan */
    public function getBulanAttribute(): string
    {
        if (!$this->periode_bulan) return '-';
        $bulan = [
            1  => 'Jan', 2 => 'Feb', 3 => 'Mar',  4 => 'Apr',
            5  => 'Mei', 6 => 'Jun', 7 => 'Jul',  8 => 'Agu',
            9  => 'Sep', 10 => 'Okt', 11 => 'Nov', 12 => 'Des',
        ];
        return $bulan[(int) $this->periode_bulan] ?? '-';
    }

    /** Alias: periode_tahun */
    public function getTahunAttribute(): ?int
    {
        return $this->periode_tahun;
    }

    // -------------------------------------------------------------------
    // Relationships
    // -------------------------------------------------------------------

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function jenisIuran()
    {
        return $this->belongsTo(JenisIuran::class, 'jenis_iuran_id');
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }

    public function pembayaran()
    {
        return $this->hasMany(PembayaranIuran::class, 'tagihan_iuran_id');
    }
}
