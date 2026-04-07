<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKeluargaRequest;
use App\Http\Requests\UpdateKeluargaRequest;
use App\Models\Keluarga;
use App\Models\Warga;

class KeluargaController extends Controller
{
    public function index()
    {
        $keluargas = Keluarga::with(['kepalaKeluarga'])
            ->latest()
            ->paginate(10);

        return view('admin.keluarga.index', compact('keluargas'));
    }

    public function create()
    {
        $wargas = Warga::orderBy('nama_lengkap')->get();

        return view('admin.keluarga.create', compact('wargas'));
    }

    public function store(StoreKeluargaRequest $request)
    {
        Keluarga::create($request->validated());

        return redirect()
            ->route('admin.keluarga.index')
            ->with('success', 'Data keluarga berhasil ditambahkan.');
    }

    public function show(Keluarga $keluarga)
    {
        return view('admin.keluarga.show', compact('keluarga'));
    }

    public function edit(Keluarga $keluarga)
    {
        $wargas = Warga::orderBy('nama_lengkap')->get();

        return view('admin.keluarga.edit', compact('keluarga', 'wargas'));
    }

    public function update(UpdateKeluargaRequest $request, Keluarga $keluarga)
    {
        $keluarga->update($request->validated());

        return redirect()
            ->route('admin.keluarga.index')
            ->with('success', 'Data keluarga berhasil diperbarui.');
    }

    public function destroy(Keluarga $keluarga)
    {
        $keluarga->delete();

        return redirect()
            ->route('admin.keluarga.index')
            ->with('success', 'Data keluarga berhasil dihapus.');
    }
}