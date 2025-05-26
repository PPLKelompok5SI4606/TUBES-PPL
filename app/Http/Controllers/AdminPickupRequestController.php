<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use App\Models\TpsTpa;  // Use TpsTpa model instead of CollectionPoint
use Illuminate\Http\Request;

class AdminPickupRequestController extends Controller
{
    public function index()
    {
        $pickupRequests = PickupRequest::with('user', 'tpsTpa')
            ->latest()
            ->paginate(10);
        
        return view('admin.pickup-requests.index', compact('pickupRequests'));
    }

    public function show(PickupRequest $pickupRequest)
    {
        // Get all TPS and TPA locations with capacity info
        $tpsTpaLocations = TpsTpa::orderBy('nama')->get();
        
        return view('admin.pickup-requests.show', compact('pickupRequest', 'tpsTpaLocations'));
    }

    public function update(Request $request, PickupRequest $pickupRequest)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected,completed',
            'admin_notes' => 'nullable|string',
            'tps_tpa_id' => 'nullable|exists:tps_tpa,id',  // Use tps_tpa table
            'waste_volume' => 'nullable|numeric|min:0',
        ]);
        
        $oldStatus = $pickupRequest->status;
        $newStatus = $validated['status'];
        
        // Only calculate capacity when status changes to completed
        if ($newStatus === 'completed' && $oldStatus !== 'completed') {
            // Check if TPS/TPA is selected
            if (!empty($validated['tps_tpa_id'])) {
                $tpsTpa = TpsTpa::findOrFail($validated['tps_tpa_id']);
                
                // Convert bags to cubic meters (m³) - assuming 1 bag = 0.1 m³
                $wasteVolume = floatval($validated['waste_volume']) * 0.1;
                
                // Update TPS/TPA capacity
               $newCapacity = $tpsTpa->kapasitas_terisi + $wasteVolume;
                
                // Check if TPS/TPA has enough capacity
                if ($newCapacity > $tpsTpa->kapasitas_total) {
                    return back()->with('error', 'This facility does not have enough capacity for this waste volume.');
               }
                
                // Update TPS/TPA capacity
                $tpsTpa->kapasitas_terisi = $newCapacity;
                $tpsTpa->save();
                
                // Save TPS/TPA ID to pickup request
                $pickupRequest->tps_tpa_id = $validated['tps_tpa_id'];
                
                // Update the waste volume in cubic meters
                $pickupRequest->waste_volume_m3 = $wasteVolume;
            } else {
                // If completing without TPS/TPA, show error
                return back()->with('error', 'Please select a TPS/TPA facility before marking as completed.');
            }
        }
        
        // Update pickup request
        $pickupRequest->status = $validated['status'];
        $pickupRequest->admin_notes = $validated['admin_notes'];
        $pickupRequest->jumlah_sampah = $validated['waste_volume'] ?? $pickupRequest->jumlah_sampah;
        $pickupRequest->save();
        
        return redirect()->route('admin.pickup-requests')
            ->with('success', 'Pickup request updated successfully.');
    }
}