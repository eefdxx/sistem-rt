<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pengumuman extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'pengumuman';

    protected $fillable = [
        'judul',
        'slug',
        'isi',
        'kategori',
        'status',
        'tanggal_publish',
        'tanggal_berakhir',
        'dibuat_oleh',
        'lampiran',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_publish' => 'datetime',
            'tanggal_berakhir' => 'datetime',
        ];
    }

    public function pembuat()
    {
        return $this->belongsTo(User::class, 'dibuat_oleh');
    }
}