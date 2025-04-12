<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PickupRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect()->route('pickup.request-page');
    }

    public function requestPage()
    {
        return view('pickups.request-page');
    }

    public function create()
    {
        return view('pickups.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'pickup_time' => 'nullable|date|after:now',
        ]);

        $pickupRequest = new PickupRequest();
        $pickupRequest->user_id = auth()->id();
        $pickupRequest->address = $validated['address'];
        $pickupRequest->description = $validated['description'];
        $pickupRequest->pickup_time = $validated['pickup_time'];
        $pickupRequest->status = 'pending';
        $pickupRequest->save();

        return redirect()->route('home')
            ->with('success', 'Permintaan pickup berhasil dibuat! Anda dapat melihat status permintaan di halaman History.');
    }

    public function show(PickupRequest $pickupRequest)
    {
        $this->authorize('view', $pickupRequest);
        return view('pickups.show', compact('pickupRequest'));
    }

    public function history()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }
        
        $pickupRequests = auth()->user()->pickupRequests()->latest()->paginate(10);
        return view('pickups.history', compact('pickupRequests'));
    }
} 