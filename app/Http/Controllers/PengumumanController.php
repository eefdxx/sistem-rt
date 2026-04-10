<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;
use App\Models\Pengumuman;
use Illuminate\Support\Str;

class PengumumanController extends Controller
{
    public function index()
    {
        $pengumuman = Pengumuman::with('pembuat')
            ->latest()
            ->paginate(10);

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(StorePengumumanRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['judul']) . '-' . time();
        $validated['dibuat_oleh'] = auth()->id();
        
        if ($validated['status'] === 'publish' && empty($validated['tanggal_publish'])) {
            $validated['tanggal_publish'] = now();
        }

        Pengumuman::create($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(UpdatePengumumanRequest $request, Pengumuman $pengumuman)
    {
        $validated = $request->validated();
        
        // Update slug only if title changed significantly or just keep old logic. 
        // We'll just keep the existing slug unless it's a completely new title, 
        // to be safe let's just keep the old slug for simplicity.
        
        if ($validated['status'] === 'publish' && empty($pengumuman->tanggal_publish)) {
            $validated['tanggal_publish'] = now();
        } elseif ($validated['status'] === 'draft') {
            $validated['tanggal_publish'] = null;
        }

        $pengumuman->update($validated);

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();

        return redirect()
            ->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
