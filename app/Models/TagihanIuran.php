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
        'nominal',
        'jatuh_tempo',
        'status',
        'keterangan',
        'dibuat_oleh',
    ];

    protected function casts(): array
    {
        return [
            'nominal' => 'decimal:2',
            'jatuh_tempo' => 'date',
        ];
    }

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