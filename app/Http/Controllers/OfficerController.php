<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index()
    {
        $officers = Officer::all();
        $collectionPoints = CollectionPoint::all();
        return view('officers.index', compact('officers', 'collectionPoints'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'area' => 'required',
            'gender' => 'required|in:male,female',
            'schedule_days' => 'required'
        ]);

        Officer::create($validated);
        return redirect()->route('officers.index')->with('success', 'Officer added successfully');
    }

    public function show(Officer $officer)
    {
        return response()->json($officer);
    }

    public function update(Request $request, Officer $officer)
    {
        $validated = $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'area' => 'required',
            'gender' => 'required|in:male,female',
            'schedule_days' => 'required'
        ]);

        $officer->update($validated);
        return redirect()->route('officers.index')->with('success', 'Officer updated successfully');
    }
}
