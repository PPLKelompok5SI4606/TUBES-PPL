<?php

namespace Database\Seeders;

use App\Models\WasteCollection;
use App\Models\CollectionPoint;
use Illuminate\Database\Seeder;

class WasteCollectionSeeder extends Seeder
{
    public function run(): void
    {
        // Get collection points
        $tpsCiroyom = CollectionPoint::where('name', 'TPS Ciroyom')->first();
        $tpsBalubur = CollectionPoint::where('name', 'TPS Balubur')->first();
        
        WasteCollection::create([
            'amount_kg' => 50.25,
            'location' => 'TPS Ciroyom',
            'type' => 'TPS',
            'status' => 'pending',
            'collection_date' => '2025-04-01',
        ]);

        WasteCollection::create([
            'amount_kg' => 75.50,
            'location' => 'TPS Ciroyom',
            'type' => 'TPS',
            'status' => 'in_progress',
            'collection_date' => '2025-04-02',
        ]);

        WasteCollection::create([
            'amount_kg' => 30.75,
            'location' => 'TPS Balubur',
            'type' => 'TPS',
            'status' => 'resolved',
            'collection_date' => '2025-04-01',
        ]);
    }
}