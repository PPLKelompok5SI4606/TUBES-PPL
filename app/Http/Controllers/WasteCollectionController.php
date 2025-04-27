<?php

namespace App\Http\Controllers;

use App\Models\WasteCollection;
use Illuminate\Http\Request;

class WasteCollectionController extends Controller
{
    public function index()
    {
        // Get summary: total waste per location
        $summary = WasteCollection::select('location')
            ->selectRaw('SUM(amount_kg) as total_waste')
            ->groupBy('location')
            ->get();

        return view('waste_collections.index', compact('summary'));
    }
}