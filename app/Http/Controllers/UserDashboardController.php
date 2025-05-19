<?php

namespace App\Http\Controllers;

use App\Models\WasteRecord;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserDashboardController extends Controller
{
    /**
     * Display the user's waste data dashboard.
     */
    public function index()
    {
        $userId = Auth::id();

        // Ambil semua data waste user
        $records = WasteRecord::where('user_id', $userId)->get();

        // Hitung total berat keseluruhan
        $totalWaste = $records->sum('weight');

        // Hitung total per kategori dan format dalam bentuk yang diharapkan view
        $wasteByCategory = [];
        foreach ($records->groupBy('category') as $category => $items) {
            $wasteByCategory[] = (object) [
                'category' => $category,
                'total_weight' => $items->sum('weight')
            ];
        }

        // Ambil catatan terbaru untuk ditampilkan di tabel
        $recentRecords = WasteRecord::where('user_id', $userId)
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();
            
        // Persiapkan data untuk grafik bulanan (6 bulan terakhir)
        $sixMonthsAgo = Carbon::now()->subMonths(5)->startOfMonth();
        $monthlyData = WasteRecord::where('user_id', $userId)
            ->where('date', '>=', $sixMonthsAgo)
            ->select(
                DB::raw('YEAR(date) as year'), 
                DB::raw('MONTH(date) as month'), 
                DB::raw('SUM(weight) as total_weight')
            )
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();
            
        $chartLabels = [];
        $chartData = [];
        
        // Generate labels for the last 6 months
        for ($i = 0; $i < 6; $i++) {
            $date = Carbon::now()->subMonths(5 - $i)->startOfMonth();
            $monthYear = $date->format('M Y');
            $chartLabels[] = $monthYear;
            
            // Find if we have data for this month
            $found = false;
            foreach ($monthlyData as $data) {
                if ($data->year == $date->year && $data->month == $date->month) {
                    $chartData[] = $data->total_weight;
                    $found = true;
                    break;
                }
            }
            
            // If no data found for this month, add 0
            if (!$found) {
                $chartData[] = 0;
            }
        }
        
        // Persiapkan data untuk grafik mingguan (4 minggu terakhir)
        $fourWeeksAgo = Carbon::now()->subWeeks(3)->startOfWeek();
        $weeklyData = WasteRecord::where('user_id', $userId)
            ->where('date', '>=', $fourWeeksAgo)
            ->select(
                DB::raw('YEARWEEK(date, 1) as yearweek'),
                'category', 
                DB::raw('SUM(weight) as total_weight')
            )
            ->groupBy('yearweek', 'category')
            ->orderBy('yearweek')
            ->get();
            
        $weeklyChartData = [
            'labels' => [],
            'organik' => [],
            'anorganik' => [],
            'b3' => []
        ];
        
        // Generate labels for the last 4 weeks
        for ($i = 0; $i < 4; $i++) {
            $weekStart = Carbon::now()->subWeeks(3 - $i)->startOfWeek();
            $weekEnd = (clone $weekStart)->endOfWeek();
            $weekLabel = $weekStart->format('d M') . ' - ' . $weekEnd->format('d M');
            $weeklyChartData['labels'][] = $weekLabel;
            
            $yearWeek = $weekStart->format('oW');
            
            // Initialize with zeros
            $weeklyChartData['organik'][] = 0;
            $weeklyChartData['anorganik'][] = 0;
            $weeklyChartData['b3'][] = 0;
            
            // Find if we have data for this week
            foreach ($weeklyData as $data) {
                if ($data->yearweek == $yearWeek) {
                    $category = strtolower($data->category);
                    if (in_array($category, ['organik', 'anorganik', 'b3'])) {
                        $weeklyChartData[$category][$i] = $data->total_weight;
                    }
                }
            }
        }

        return view('dashboard-user.index', [
            'totalWaste' => $totalWaste,
            'wasteByCategory' => $wasteByCategory,
            'recentRecords' => $recentRecords,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
            'weeklyChartData' => $weeklyChartData
        ]);
    }
}