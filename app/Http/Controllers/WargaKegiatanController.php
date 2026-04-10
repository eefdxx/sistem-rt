<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;

class WargaKegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::with('pembuat')
            ->whereIn('status', ['mendatang', 'berlangsung'])
            ->orderBy('tanggal_mulai', 'asc')
            ->paginate(10);

        return view('warga.kegiatan.index', compact('kegiatan'));
    }

    public function show(Kegiatan $kegiatan)
    {
        return view('warga.kegiatan.show', compact('kegiatan'));
    }
}
