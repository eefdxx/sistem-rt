<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class WargaKegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::whereIn('status', ['mendatang', 'berjalan'])
            ->latest()
            ->paginate(6);

        return view('warga.kegiatan.index', compact('kegiatans'));
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('warga.kegiatan.show', compact('kegiatan'));
    }
}
