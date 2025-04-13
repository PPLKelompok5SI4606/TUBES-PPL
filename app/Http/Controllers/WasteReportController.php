<?php

namespace App\Http\Controllers;

use App\Models\WasteReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WasteReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = WasteReport::with('user')->latest()->get();
        return view('waste-reports.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('waste-reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('waste-reports', 'public');
        }

        $report = WasteReport::create([
            'user_id' => auth()->id(),
            'location' => $validated['location'],
            'description' => $validated['description'],
            'image_path' => $imagePath,
            'latitude' => $request->has('latitude') ? $validated['latitude'] : null,
            'longitude' => $request->has('longitude') ? $validated['longitude'] : null,
            'status' => 'pending'
        ]);

        return redirect()->route('waste-reports.index')
            ->with('success', 'Laporan sampah berhasil dikirim!');
    }

    /**
     * Display the specified resource.
     */
    public function show(WasteReport $wasteReport)
    {
        return view('waste-reports.show', compact('wasteReport'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WasteReport $wasteReport)
    {
        return view('waste-reports.edit', compact('wasteReport'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WasteReport $wasteReport)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status' => 'required|in:pending,in_progress,resolved',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        if ($request->hasFile('image')) {
            if ($wasteReport->image_path) {
                Storage::disk('public')->delete($wasteReport->image_path);
            }
            $imagePath = $request->file('image')->store('waste-reports', 'public');
            $validated['image_path'] = $imagePath;
        }

        // Pastikan latitude dan longitude ada dalam data yang akan diupdate
        if (!$request->has('latitude')) {
            $validated['latitude'] = null;
        }
        if (!$request->has('longitude')) {
            $validated['longitude'] = null;
        }

        $wasteReport->update($validated);

        return redirect()->route('waste-reports.index')
            ->with('success', 'Laporan sampah berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WasteReport $wasteReport)
    {
        if ($wasteReport->image_path) {
            Storage::disk('public')->delete($wasteReport->image_path);
        }
        
        $wasteReport->delete();

        return redirect()->route('waste-reports.index')
            ->with('success', 'Laporan sampah berhasil dihapus!');
    }
}
