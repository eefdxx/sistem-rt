<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keluarga extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'keluarga';

    protected $fillable = [
        'no_kk',
        'alamat',
        'rt',
        'rw',
        'kode_pos',
        'kepala_keluarga_id',
    ];

    public function warga()
    {
        return $this->hasMany(Warga::class);
    }

    public function kepalaKeluarga()
    {
        return $this->belongsTo(Warga::class, 'kepala_keluarga_id');
    }
}