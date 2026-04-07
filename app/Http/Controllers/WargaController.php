<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWargaRequest;
use App\Http\Requests\UpdateWargaRequest;
use App\Models\Keluarga;
use App\Models\User;
use App\Models\Warga;

class WargaController extends Controller
{
    public function index()
    {
        $wargas = Warga::with(['keluarga', 'user'])
            ->latest()
            ->paginate(10);

        return view('admin.warga.index', compact('wargas'));
    }

    public function create()
    {
        $keluargas = Keluarga::orderBy('no_kk')->get();
        $users = User::orderBy('name')->get();

        return view('admin.warga.create', compact('keluargas', 'users'));
    }

    public function store(StoreWargaRequest $request)
    {
        $warga = Warga::create($request->validated());

        if ($request->status_keluarga === 'kepala_keluarga') {
            Keluarga::where('id', $request->keluarga_id)
                ->update(['kepala_keluarga_id' => $warga->id]);
        }

        return redirect()
            ->route('admin.warga.index')
            ->with('success', 'Data warga berhasil ditambahkan.');
    }

    public function show(Warga $warga)
    {
        $warga->load(['keluarga', 'user']);

        return view('admin.warga.show', compact('warga'));
    }

    public function edit(Warga $warga)
    {
        $keluargas = Keluarga::orderBy('no_kk')->get();
        $users = User::orderBy('name')->get();

        return view('admin.warga.edit', compact('warga', 'keluargas', 'users'));
    }

    public function update(UpdateWargaRequest $request, Warga $warga)
    {
        $warga->update($request->validated());

        if ($request->status_keluarga === 'kepala_keluarga') {
            Keluarga::where('id', $request->keluarga_id)
                ->update(['kepala_keluarga_id' => $warga->id]);
        } elseif ($warga->keluarga && $warga->keluarga->kepala_keluarga_id == $warga->id) {
            Keluarga::where('id', $request->keluarga_id)
                ->update(['kepala_keluarga_id' => null]);
        }

        return redirect()
            ->route('admin.warga.index')
            ->with('success', 'Data warga berhasil diperbarui.');
    }

    public function destroy(Warga $warga)
    {
        if ($warga->keluarga && $warga->keluarga->kepala_keluarga_id == $warga->id) {
            $warga->keluarga->update(['kepala_keluarga_id' => null]);
        }

        $warga->delete();

        return redirect()
            ->route('admin.warga.index')
            ->with('success', 'Data warga berhasil dihapus.');
    }
}