<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJenisIuranRequest;
use App\Models\JenisIuran;
use Illuminate\Http\Request;

class JenisIuranController extends Controller
{
    public function index()
    {
        $jenis_iuran = JenisIuran::latest()->paginate(10);
        return view('admin.jenis_iuran.index', compact('jenis_iuran'));
    }

    public function create()
    {
        return view('admin.jenis_iuran.create');
    }

    public function store(StoreJenisIuranRequest $request)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        JenisIuran::create($validated);

        return redirect()
            ->route('admin.jenis-iuran.index')
            ->with('success', 'Jenis Iuran berhasil ditambahkan.');
    }

    public function edit(JenisIuran $jenis_iuran)
    {
        return view('admin.jenis_iuran.edit', compact('jenis_iuran'));
    }

    public function update(StoreJenisIuranRequest $request, JenisIuran $jenis_iuran)
    {
        $validated = $request->validated();
        $validated['is_active'] = $request->has('is_active');

        $jenis_iuran->update($validated);

        return redirect()
            ->route('admin.jenis-iuran.index')
            ->with('success', 'Jenis Iuran berhasil diperbarui.');
    }

    public function destroy(JenisIuran $jenis_iuran)
    {
        $jenis_iuran->delete();

        return redirect()
            ->route('admin.jenis-iuran.index')
            ->with('success', 'Jenis Iuran berhasil dihapus.');
    }
}
