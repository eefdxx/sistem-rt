<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class WargaPengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::with('pembuat')
            ->where('status', 'publish')
            ->latest('tanggal_publish')
            ->paginate(10);

        return view('warga.pengumuman.index', compact('pengumuman'));
    }

    public function show(Pengumuman $pengumuman)
    {
        if ($pengumuman->status !== 'publish') {
            abort(404);
        }
        
        return view('warga.pengumuman.show', compact('pengumuman'));
    }
}
