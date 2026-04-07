<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisIuran extends Model
{
    use HasFactory;

    protected $table = 'jenis_iuran';

    protected $fillable = [
        'nama_iuran',
        'deskripsi',
        'nominal_default',
        'periode',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'nominal_default' => 'decimal:2',
            'is_active' => 'boolean',
        ];
    }

    public function tagihanIuran()
    {
        return $this->hasMany(TagihanIuran::class);
    }
}