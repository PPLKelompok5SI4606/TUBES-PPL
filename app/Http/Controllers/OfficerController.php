<?php

namespace App\Http\Controllers;

use App\Models\Officer;
use App\Models\TpsTpa;
use Illuminate\Http\Request;

class OfficerController extends Controller
{
    public function index()
    {
        $officers = Officer::all();
        $collectionPoints = TpsTpa::all();
        return view('Officers.Index', compact('officers', 'collectionPoints'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'area' => 'required|string',
            'schedule_days' => 'required|string',
            'phone' => 'required|string',
            'gender' => 'required|in:male,female',
            'address' => 'required|string',
            'email' => 'required|email|unique:officers'
        ]);

        Officer::create($validated);

        return redirect()->route('officers.index')
            ->with('success', 'Petugas berhasil ditambahkan!');
    }

    public function show(Officer $officer)
    {
        return response()->json($officer);
    }
}