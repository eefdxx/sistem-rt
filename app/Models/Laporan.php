<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laporan extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'laporan';

    protected $fillable = [
        'warga_id',
        'kategori_laporan_id',
        'judul',
        'deskripsi',
        'lokasi',
        'prioritas',
        'status',
        'tanggal_laporan',
        'ditinjau_oleh',
        'tanggal_ditinjau',
        'lampiran',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_laporan' => 'datetime',
            'tanggal_ditinjau' => 'datetime',
        ];
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriLaporan::class, 'kategori_laporan_id');
    }

    public function peninjau()
    {
        return $this->belongsTo(User::class, 'ditinjau_oleh');
    }

    public function tanggapan()
    {
        return $this->hasMany(TanggapanLaporan::class);
    }
}