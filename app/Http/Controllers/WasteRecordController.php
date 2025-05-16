<?php

namespace App\Http\Controllers;

use App\Models\WasteRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WasteRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = WasteRecord::where('user_id', Auth::id())
            ->orderBy('date', 'desc');

        // Filter berdasarkan tanggal jika ada
        if ($request->filled('date')) {
            $query->whereDate('date', '=', $request->date);
        }

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $wasteRecords = $query->paginate(10);

        return view('waste-record.index', compact('wasteRecords'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('waste-record.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|in:organik,anorganik,b3',
            'weight' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $validated['user_id'] = Auth::id();

        WasteRecord::create($validated);

        return redirect()->route('waste-record.index')
            ->with('success', 'Data sampah berhasil dicatat!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WasteRecord $wasteRecord)
    {
        if ($wasteRecord->user_id !== Auth::id()) {
            abort(403);
        }

        return view('waste-record.edit', compact('wasteRecord'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WasteRecord $wasteRecord)
    {
        if ($wasteRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'category' => 'required|in:organik,anorganik,b3',
            'weight' => 'required|integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        $wasteRecord->update($validated);

        return redirect()->route('waste-record.index')
            ->with('success', 'Data sampah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WasteRecord $wasteRecord)
    {
        if ($wasteRecord->user_id !== Auth::id()) {
            abort(403);
        }

        $wasteRecord->delete();

        return redirect()->route('waste-record.index')
            ->with('success', 'Data sampah berhasil dihapus!');
    }
}