<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use App\Models\WasteReport;
use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        // Total Pickup Requests
        $userPickupRequests = \App\Models\PickupRequest::where('user_id', $userId)->count();

        // Completed Pickups
        $completedPickups = \App\Models\PickupRequest::where('user_id', $userId)->where('status', 'completed')->count();

        // Pending Pickups
        $pendingPickups = \App\Models\PickupRequest::where('user_id', $userId)->where('status', 'pending')->count();

        // Rejected Pickups
        $rejectedPickups = \App\Models\PickupRequest::where('user_id', $userId)->where('status', 'rejected')->count();

        // Data untuk grafik per bulan
        $months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'
        ];

        $userPendingData = [];
        $userCompletedData = [];
        $userRejectedData = [];

        foreach (range(1, 12) as $month) {
            $userPendingData[] = \App\Models\PickupRequest::where('user_id', $userId)
                ->where('status', 'pending')
                ->whereMonth('created_at', $month)
                ->count();

            $userCompletedData[] = \App\Models\PickupRequest::where('user_id', $userId)
                ->where('status', 'completed')
                ->whereMonth('created_at', $month)
                ->count();

            $userRejectedData[] = \App\Models\PickupRequest::where('user_id', $userId)
                ->where('status', 'rejected')
                ->whereMonth('created_at', $month)
                ->count();
        }

        return view('dashboard-user.index', compact(
            'userPickupRequests',
            'completedPickups',
            'pendingPickups',
            'rejectedPickups',
            'months',
            'userPendingData',
            'userCompletedData',
            'userRejectedData'
        ));
    }
}
