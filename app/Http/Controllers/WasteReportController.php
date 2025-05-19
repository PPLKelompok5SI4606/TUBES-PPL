<?php

namespace App\Http\Controllers;

use App\Models\DelayReport;
use App\Models\WasteReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
            'status' => 'required|in:pending,in_progress,resolved',
            'location' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg|max:2048',
            'latitude' => 'sometimes|nullable|numeric',
            'longitude' => 'sometimes|nullable|numeric',
            'dispatch_date' => 'nullable|date',
            'completion_date' => 'nullable|date'
        ]);

        // Handle status and dates update
        if ($request->has('status')) {
            $updateData = ['status' => $request->status];
            
            // Clear dates when status is pending
            if ($request->status === 'pending') {
                $updateData['dispatch_date'] = null;
                $updateData['completion_date'] = null;
            }
            // Set dispatch date for in_progress if provided
            elseif ($request->status === 'in_progress') {
                if ($request->has('dispatch_date')) {
                    $updateData['dispatch_date'] = $request->dispatch_date;
                }
                $updateData['completion_date'] = null;
            }
            // Set completion date for resolved if provided
            elseif ($request->status === 'resolved') {
                if ($request->has('completion_date')) {
                    $updateData['completion_date'] = $request->completion_date;
                }
                // Keep existing dispatch_date
            }
            
            $wasteReport->update($updateData);
            return back()->with('success', 'Data berhasil diperbarui!');
        }

        // Handle only date updates without status change
        if ($request->has('dispatch_date') || $request->has('completion_date')) {
            $updateData = [];
            
            if ($request->has('dispatch_date') && $wasteReport->status !== 'pending') {
                $updateData['dispatch_date'] = $request->dispatch_date;
            }
            
            if ($request->has('completion_date') && $wasteReport->status === 'resolved') {
                $updateData['completion_date'] = $request->completion_date;
            }
            
            if (!empty($updateData)) {
                $wasteReport->update($updateData);
                return back()->with('success', 'Tanggal berhasil diperbarui!');
            }
        }

        // Handle other updates (location, description, etc.)
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

        // Hapus status dari data yang akan diupdate
        unset($validated['status']);

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

    public function updateWithCollection(Request $request, $wasteReportId)
    {
        $validated = $request->validate([
            'location' => 'required|string',
            'total_waste' => 'required|numeric',
            'type' => 'required|string',
            'status' => 'required|string|in:pending,in_progress,resolved',
        ]);

        // Find the waste report
        $wasteReport = WasteReport::findOrFail($wasteReportId);

        // 1. Update the waste report status
        $wasteReport->update([
            'status' => $validated['status']
        ]);

        $tpsTpa = \App\Models\TpsTpa::where('nama', $validated['location'])->first();

        if ($tpsTpa) {
            $wasteInCubicMeters = $validated['total_waste'] / 350; // Convert kg to m³
            $newFilledCapacity = $tpsTpa->kapasitas_terisi + $wasteInCubicMeters;
            $tpsTpa->kapasitas_terisi = $tpsTpa->kapasitas_terisi + $wasteInCubicMeters;
            if ($newFilledCapacity > $tpsTpa->kapasitas_total) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot update: The specified amount would exceed the total capacity of this TPS/TPA.'
                ], 422);
        }
            $tpsTpa->save();
        }
        // 2. Find or create the collection point
        $collectionPoint = \App\Models\CollectionPoint::firstOrCreate(
            ['name' => $validated['location'], 'type' => $validated['type']],
            [
                'name' => $validated['location'],
                'type' => $validated['type'],
                'lat' => 0, // Default values
                'lng' => 0, // Default values
                'description' => 'Auto-created from waste report'
            ]
        );

        // 3. Create the waste collection record
        $wasteCollection = new \App\Models\WasteCollection([
            'amount_kg' => $validated['total_waste'],
            'collection_point_id' => $collectionPoint->id,
            'location' => $validated['location'],
            'type' => $validated['type'],
            'status' => $validated['status'],  // Add the status from the form
            'collection_date' => now(),
        ]);
        $wasteCollection->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated and collection recorded successfully'
        ]);
        
    }

    public function laporan()
    {
        $wasteReports = WasteReport::with('user')->latest()->get();
        $tpsPoints = \App\Models\TpsTpa::all();
        return view('Report_sampah.LapSampah', compact('wasteReports', 'tpsPoints'));
    }

    public function laporanUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required',
        ]);

        $report = WasteReport::where('id', $id)->first();

        if (!$report) {
            return redirect()->route('laporan')
                ->with('error', 'Laporan tidak ditemukan!');
        }

        WasteReport::where('id', $id)->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('laporan')
            ->with('success', 'Status laporan berhasil diperbarui!');
    }

    public function laporanReportDelay()
    {
        $reports = DelayReport::orderBy('created_at', 'desc')
            ->paginate(10);

        return view('Report_sampah.LapSampahDelay', compact('reports'));
    }

    public function laporanReportDelayUpdate(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,resolved',
        ]);

        $report = DelayReport::where('id', $id)->first();

        if (!$report) {
            return redirect()->route('laporan.report-delay')
                ->with('error', 'Laporan tidak ditemukan!');
        }

        DelayReport::where('id', $id)->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('laporan.report-delay')
            ->with('success', 'Status laporan berhasil diperbarui!');
    }
}