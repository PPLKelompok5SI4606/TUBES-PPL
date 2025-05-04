<?php

namespace App\Http\Controllers;

use App\Models\TpsTpa;
use Illuminate\Http\Request;

class TpsTpaController extends Controller
{
    public function index()
    {
        $tpsTpa = TpsTpa::all();
        return view('tps-tpa.index', compact('tpsTpa'));
    }

    public function create()
    {
        return view('tps-tpa.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:TPS,TPA',
            'kapasitas_total' => 'required|numeric|min:0',
            'kapasitas_terisi' => 'required|numeric|min:0|lte:kapasitas_total',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string|max:255'
        ]);

        TpsTpa::create($validated);

        return redirect()->route('tps-tpa.index')
            ->with('success', 'Data TPS/TPA berhasil ditambahkan');
    }

    public function edit(TpsTpa $tpsTpa)
    {
        return view('tps-tpa.edit', compact('tpsTpa'));
    }

    public function update(Request $request, TpsTpa $tpsTpa)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'tipe' => 'required|in:TPS,TPA',
            'kapasitas_total' => 'required|numeric|min:0',
            'kapasitas_terisi' => 'required|numeric|min:0|lte:kapasitas_total',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|string|max:255'
        ]);

        $tpsTpa->update($validated);

        return redirect()->route('tps-tpa.index')
            ->with('success', 'Data TPS/TPA berhasil diperbarui');
    }

    public function destroy(TpsTpa $tpsTpa)
    {
        $tpsTpa->delete();
        return redirect()->route('tps-tpa.index')
            ->with('success', 'Data TPS/TPA berhasil dihapus');
    }
} 