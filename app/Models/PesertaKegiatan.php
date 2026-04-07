<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesertaKegiatan extends Model
{
    use HasFactory;

    protected $table = 'peserta_kegiatan';

    protected $fillable = [
        'kegiatan_id',
        'warga_id',
        'status_kehadiran',
        'catatan',
    ];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function warga()
    {
        return $this->belongsTo(Warga::class);
    }
}