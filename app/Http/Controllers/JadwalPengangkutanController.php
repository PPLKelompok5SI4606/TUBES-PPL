<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\JadwalPengangkutan;
use Illuminate\Http\Request;

class JadwalPengangkutanController extends Controller
{
    public function index()
    {
        $jadwals = JadwalPengangkutan::latest()->paginate(10);
        return view('admin.jadwal-pengangkutan.index', compact('jadwals'));

    }

    public function create()
    {
        $jadwal = new JadwalPengangkutan();
        return view('admin.jadwal-pengangkutan.create', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'no_kontak' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required',
        ]);

        JadwalPengangkutan::create($request->all());
        return redirect()->route('jadwal-pengangkutan.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit(JadwalPengangkutan $jadwalPengangkutan)
    {
        return view('admin.jadwal-pengangkutan.edit', compact('jadwalPengangkutan'));
    }

    public function update(Request $request, JadwalPengangkutan $jadwal)
    {
        $request->validate([
            'nama_petugas' => 'required',
            'no_kontak' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'lokasi' => 'required',
        ]);

        $jadwal->update($request->all());
        return redirect()->route('jadwal-pengangkutan.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy(JadwalPengangkutan $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal-pengangkutan.index')->with('success', 'Jadwal berhasil dihapus.');
    }
}
