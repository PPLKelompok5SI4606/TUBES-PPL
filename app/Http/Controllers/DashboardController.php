<?php


namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TpsTpa;
use App\Models\PickupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Count user types
        $userCount = User::where('role', 'user')->count();
        $adminCount = User::where('role', 'admin')->count();
        $pengelolaCount = User::where('role', 'pengelola')->count();
        
        // Calculate TPS capacity
        $tpsData = TpsTpa::where('tipe', 'TPS')->get();
        $tpsCapacityTotal = $tpsData->sum('kapasitas_total');
        $tpsCapacityUsed = $tpsData->sum('kapasitas_terisi');
        $tpsCapacityAvailable = $tpsCapacityTotal - $tpsCapacityUsed;
        
        // Calculate TPA capacity
        $tpaData = TpsTpa::where('tipe', 'TPA')->get();
        $tpaCapacityTotal = $tpaData->sum('kapasitas_total');
        $tpaCapacityUsed = $tpaData->sum('kapasitas_terisi');
        $tpaCapacityAvailable = $tpaCapacityTotal - $tpaCapacityUsed;
        
        // Calculate daily waste input and processed
        $today = Carbon::today();
        // Get pickup waste data for today
        $pickupWasteInput = PickupRequest::whereDate('created_at', $today)
            ->where('status', 'completed')
            ->sum(DB::raw('jumlah_sampah * 0.1')); // Assuming each bag is 0.1 m³
        
        // Get waste report data for today
        $reportWasteInput = \App\Models\WasteCollection::whereDate('collection_date', $today)
            ->sum(DB::raw('amount_kg / 350')); // Convert kg to m³
        
        // Combine both sources
        $dailyWasteInput = $pickupWasteInput + $reportWasteInput;
        
        $dailyWasteProcessed = $dailyWasteInput * 0.8; // Assuming 80% of waste is processed daily
        
        // Get data for daily chart (last 7 days)
        $lastWeek = Carbon::today()->subDays(6);
        $dailyDates = [];
        $dailyInputData = [];
        $dailyProcessedData = [];   
        
        for ($i = 0; $i < 7; $i++) {
            $date = Carbon::parse($lastWeek)->addDays($i);
            $dailyDates[] = $date->format('M d');

            // Get pickup waste data
            $pickupInput = PickupRequest::whereDate('created_at', $date)
                ->where('status', 'completed')
                ->sum(DB::raw('jumlah_sampah * 0.1'));

            // Get waste report data
            $reportInput = \App\Models\WasteCollection::whereDate('collection_date', $date)
                ->sum(DB::raw('amount_kg / 350')); // Convert kg to m³

            // Combine both sources
            $totalInput = $pickupInput + $reportInput;
        
            $dailyInputData[] = $totalInput;
            $dailyProcessedData[] = $totalInput * 0.8; // Assuming 80% processing rate
        }
            
        return view('dashboard.index', compact(
            'userCount', 
            'adminCount', 
            'pengelolaCount',
            'tpsCapacityUsed',
            'tpsCapacityAvailable',
            'tpaCapacityUsed',
            'tpaCapacityAvailable',
            'dailyWasteInput',
            'dailyWasteProcessed',
            'dailyDates',
            'dailyInputData',
            'dailyProcessedData'
        ));
    }

    public function userDashboard()
    {
        return view('dashboard.user');
    }
}