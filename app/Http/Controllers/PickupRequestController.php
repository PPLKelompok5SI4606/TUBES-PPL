<?php

namespace App\Http\Controllers;

use App\Models\PickupRequest;
use App\Models\CollectionPoint;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class PickupRequestController extends BaseController
{
    use \Illuminate\Foundation\Auth\Access\AuthorizesRequests;
    use \Illuminate\Foundation\Validation\ValidatesRequests;
    use \Illuminate\Foundation\Bus\DispatchesJobs;

    public function __construct()
    {
        $this->middleware('auth')->except(['requestPage']);
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
        $tpsPoints = CollectionPoint::where('type', 'TPS')->get();
        $tpaPoints = CollectionPoint::where('type', 'TPA')->get();
        return view('pickups.create', compact('tpsPoints', 'tpaPoints'));
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
        $pickupRequest->jenis_sampah = $request->input('jenis_sampah');
        $pickupRequest->jumlah_sampah = $request->input('jumlah_sampah');
        $pickupRequest->pickup_time = $validated['pickup_time'];
        $pickupRequest->status = 'pending';
        $pickupRequest->save();

        return redirect()->route('pickup.show', $pickupRequest)
            ->with('success', 'Pickup request created successfully!');
    }

    public function show(PickupRequest $pickupRequest)
    {
        return view('pickups.show', compact('pickupRequest'));
    }

    public function history()
    {
        $pickupRequests = auth()->user()->pickupRequests()->latest()->paginate(10);
        return view('pickups.history', compact('pickupRequests'));
    }
    public function sampah()
    {
        // Mengambil data jumlah sampah TPS dan TPA berdasarkan bulan
        $jumlahSampahTPSd = PickupRequest::where('jenis_sampah', 'TPS')->count();
        $jumlahSampahTPAd = PickupRequest::where('jenis_sampah', 'TPA')->count();

        $jumlahSampahTPS = PickupRequest::where('jenis_sampah', 'TPS')
            ->selectRaw('COUNT(*) as count, MONTH(pickup_time) as month')
            ->whereNotNull('pickup_time') // Pastikan pickup_time tidak null
            ->groupBy('month')
            ->pluck('count', 'month');

        $jumlahSampahTPA = PickupRequest::where('jenis_sampah', 'TPA')
            ->selectRaw('COUNT(*) as count, MONTH(pickup_time) as month')
            ->whereNotNull('pickup_time') // Pastikan pickup_time tidak null
            ->groupBy('month')
            ->pluck('count', 'month');

        // Menyediakan data untuk bulan (1 - 12)
        $months = range(1, 12);

        // Pastikan bulan yang kosong terisi dengan 0
        $dataTPS = [];
        $dataTPA = [];

        foreach ($months as $month) {
            // Ambil data bulan dari hasil query atau set ke 0 jika tidak ada data
            $dataTPS[] = $jumlahSampahTPS->get($month, 0);
            $dataTPA[] = $jumlahSampahTPA->get($month, 0);
        }

        // Mengirimkan data ke view, termasuk $jumlahSampahTPSd dan $jumlahSampahTPAd
        return view('dashboard.sampah', compact('jumlahSampahTPSd', 'jumlahSampahTPAd', 'jumlahSampahTPS', 'jumlahSampahTPA', 'dataTPS', 'dataTPA', 'months'));
    }
}