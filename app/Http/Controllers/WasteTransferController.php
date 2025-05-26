<?php

namespace App\Http\Controllers;

use App\Models\TpsTpa;
use App\Models\WasteTransfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class WasteTransferController extends Controller
{
    public function index()
    {
        // Get TPS (source) locations
        $tpsLocations = TpsTpa::where('tipe', 'TPS')
            ->where('kapasitas_terisi', '>', 0)
            ->get();
            
        // Get TPA (destination) locations with available capacity
        $tpaLocations = TpsTpa::where('tipe', 'TPA')
            ->whereRaw('kapasitas_total > kapasitas_terisi')
            ->get();
            
        // Get all transfer history for display in the table
        $transferHistory = WasteTransfer::with(['tpsSource', 'tpaDestination'])
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        
        // Get today's transfer total for the stats display
        $todayTransfers = WasteTransfer::whereDate('transfer_date', Carbon::today())
            ->sum('waste_amount');
        
        // Count of transfers made today
        $todayTransferCount = WasteTransfer::whereDate('transfer_date', Carbon::today())
            ->count();
            
        return view('pemindahan_sampah.index', compact(
            'tpsLocations', 
            'tpaLocations', 
            'transferHistory',
            'todayTransfers',
            'todayTransferCount'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tps_id' => 'required|exists:tps_tpa,id',
            'tpa_id' => 'required|exists:tps_tpa,id',
            'waste_amount' => 'required|numeric|min:0.1',
            'waste_type' => 'required|string',
            'transfer_date' => 'required|date',
        ]);

        try {
            DB::beginTransaction();
            
            // Get TPS and TPA
            $tpsSource = TpsTpa::findOrFail($validated['tps_id']);
            $tpaDestination = TpsTpa::findOrFail($validated['tpa_id']);
            
            // Verify TPS is actually a TPS and TPA is a TPA
            if ($tpsSource->tipe !== 'TPS') {
                return back()->withErrors(['tps_id' => 'Lokasi sumber harus bertipe TPS']);
            }
            
            if ($tpaDestination->tipe !== 'TPA') {
                return back()->withErrors(['tpa_id' => 'Lokasi tujuan harus bertipe TPA']);
            }
            
            $amount = $validated['waste_amount'];
            
            // Check if TPS has enough waste in m3
            if ($tpsSource->kapasitas_terisi < $amount) {
                return back()->withErrors(['waste_amount' => "Jumlah sampah di TPS tidak mencukupi (tersedia: {$tpsSource->kapasitas_terisi} m³)"]);
            }
            
            // Check if TPA has enough capacity in m3
            $tpaAvailableCapacity = $tpaDestination->kapasitas_total - $tpaDestination->kapasitas_terisi;
            if ($tpaAvailableCapacity < $amount) {
                return back()->withErrors(['waste_amount' => "Kapasitas TPA tidak mencukupi (tersedia: {$tpaAvailableCapacity} m³)"]);
            }
            
            // Create transfer record
            $transfer = WasteTransfer::create([
                'tps_id' => $validated['tps_id'],
                'tpa_id' => $validated['tpa_id'],
                'waste_amount' => $amount,
                'waste_type' => $validated['waste_type'],
                'transfer_date' => $validated['transfer_date'],
                'status' => 'Selesai',
            ]);
            
            // Update capacities in m3
            $tpsSource->kapasitas_terisi -= $amount;
            $tpsSource->save();
            
            $tpaDestination->kapasitas_terisi += $amount;
            $tpaDestination->save();
            
            DB::commit();
            
            return redirect()->route('waste-transfer.index')
                ->with('success', "✅ Transfer berhasil dicatat! {$amount} m³ sampah {$validated['waste_type']} dari {$tpsSource->nama} ke {$tpaDestination->nama}");
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()]);
        }
    }
}