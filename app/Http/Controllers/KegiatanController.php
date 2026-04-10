<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKegiatanRequest;
use App\Http\Requests\UpdateKegiatanRequest;
use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::with('pembuat')
            ->orderBy('tanggal_mulai', 'desc')
            ->paginate(10);

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function create()
    {
        return view('admin.kegiatan.create');
    }

    public function store(StoreKegiatanRequest $request)
    {
        $validated = $request->validated();
        $validated['dibuat_oleh'] = auth()->id();

        Kegiatan::create($validated);

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    public function show(Kegiatan $kegiatan)
    {
        // Load the count of participants if the relationship was implemented completely
        $kegiatan->loadCount('peserta');
        return view('admin.kegiatan.show', compact('kegiatan'));
    }

    public function edit(Kegiatan $kegiatan)
    {
        return view('admin.kegiatan.edit', compact('kegiatan'));
    }

    public function update(UpdateKegiatanRequest $request, Kegiatan $kegiatan)
    {
        $kegiatan->update($request->validated());

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        $kegiatan->delete();

        return redirect()
            ->route('admin.kegiatan.index')
            ->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
