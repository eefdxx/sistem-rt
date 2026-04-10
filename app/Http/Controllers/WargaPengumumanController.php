<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class WargaPengumumanController extends Controller
{
    public function index()
    {
        $pengumumans = Pengumuman::where('status', 'publish')
            ->latest()
            ->paginate(6);

        return view('warga.pengumuman.index', compact('pengumumans'));
    }

    public function show(Pengumuman $pengumuman)
    {
        if ($pengumuman->status !== 'publish') {
            abort(404);
        }

        return view('warga.pengumuman.show', compact('pengumuman'));
    }
}
