<?php

namespace App\Http\Controllers;

use App\Models\WasteCollection;
use Illuminate\Http\Request;

class WasteCollectionController extends Controller
{
    public function index()
    {
        // Get all waste collection records
        $wasteCollections = WasteCollection::latest()->get();

        return view('waste_collections.index', compact('wasteCollections'));
    }
}