<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function warga()
    {
        return $this->hasOne(Warga::class);
    }

    public function pengumuman()
    {
        return $this->hasMany(Pengumuman::class, 'dibuat_oleh');
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class, 'dibuat_oleh');
    }

    public function tagihanDibuat()
    {
        return $this->hasMany(TagihanIuran::class, 'dibuat_oleh');
    }

    public function laporanDitinjau()
    {
        return $this->hasMany(Laporan::class, 'ditinjau_oleh');
    }

    public function tanggapanLaporan()
    {
        return $this->hasMany(TanggapanLaporan::class);
    }

    public function notifikasi()
    {
        return $this->hasMany(Notifikasi::class);
    }

    public function activityLogs()
    {
        return $this->hasMany(ActivityLog::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class, 'uploaded_by');
    }

    public function pembayaranDiverifikasi()
    {
        return $this->hasMany(PembayaranIuran::class, 'diverifikasi_oleh');
    }
}