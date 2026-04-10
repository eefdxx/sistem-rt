<?php

namespace App\Http\Controllers;

use App\Models\JenisIuran;
use Illuminate\Http\Request;

class JenisIuranController extends Controller
{
    public function index()
    {
        $jenisIurans = JenisIuran::latest()->paginate(10);
        return view('admin.jenis-iuran.index', compact('jenisIurans'));
    }

    public function create()
    {
        return view('admin.jenis-iuran.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_iuran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nominal_default' => 'required|numeric|min:0',
            'periode' => 'required|in:bulanan,tahunan,insidental',
            'is_active' => 'boolean',
        ]);

        JenisIuran::create($validated);

        return redirect()->route('admin.jenis-iuran.index')->with('success', 'Jenis Iuran berhasil ditambahkan.');
    }

    public function edit(JenisIuran $jenis_iuran)
    {
        return view('admin.jenis-iuran.edit', compact('jenis_iuran'));
    }

    public function update(Request $request, JenisIuran $jenis_iuran)
    {
        $validated = $request->validate([
            'nama_iuran' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'nominal_default' => 'required|numeric|min:0',
            'periode' => 'required|in:bulanan,tahunan,insidental',
            'is_active' => 'boolean',
        ]);

        $jenis_iuran->update($validated);

        return redirect()->route('admin.jenis-iuran.index')->with('success', 'Jenis Iuran berhasil diperbarui.');
    }

    public function destroy(JenisIuran $jenis_iuran)
    {
        $jenis_iuran->delete();
        return redirect()->route('admin.jenis-iuran.index')->with('success', 'Jenis Iuran berhasil dihapus.');
    }
}
