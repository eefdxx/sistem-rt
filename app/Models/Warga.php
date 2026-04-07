<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warga extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'warga';

    protected $fillable = [
        'user_id',
        'keluarga_id',
        'nik',
        'nama_lengkap',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'agama',
        'status_perkawinan',
        'pekerjaan',
        'no_hp',
        'email_pribadi',
        'status_keluarga',
        'status_warga',
        'tanggal_masuk',
        'foto',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'tanggal_masuk' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keluarga()
    {
        return $this->belongsTo(Keluarga::class);
    }

    public function pesertaKegiatan()
    {
        return $this->hasMany(PesertaKegiatan::class);
    }

    public function tagihanIuran()
    {
        return $this->hasMany(TagihanIuran::class);
    }

    public function pembayaranIuran()
    {
        return $this->hasMany(PembayaranIuran::class);
    }

    public function laporan()
    {
        return $this->hasMany(Laporan::class);
    }
}