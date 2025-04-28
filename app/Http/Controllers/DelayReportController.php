<?php

namespace App\Http\Controllers;

use App\Models\DelayReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DelayReportController extends Controller
{
    public function index()
    {
        $reports = DelayReport::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('delay-reports.index', compact('reports'));
    }

    public function create()
    {
        return view('delay-reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'location' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        DelayReport::create([
            'user_id' => Auth::id(),
            'location' => $validated['location'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('delay-reports.index')
            ->with('success', 'Laporan keterlambatan berhasil dikirim.');
    }

    public function show(DelayReport $delayReport)
    {
        $this->authorize('view', $delayReport);
        return view('delay-reports.show', compact('delayReport'));
    }
} 