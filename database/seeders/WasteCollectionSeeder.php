<?php

namespace Database\Seeders;

use App\Models\WasteCollection;
use Illuminate\Database\Seeder;

class WasteCollectionSeeder extends Seeder
{
    public function run(): void
    {
        WasteCollection::create([
            'amount_kg' => 50.25,
            'location' => 'Residential Area A',
            'collection_date' => '2025-04-01',
        ]);

        WasteCollection::create([
            'amount_kg' => 75.50,
            'location' => 'Residential Area A',
            'collection_date' => '2025-04-02',
        ]);

        WasteCollection::create([
            'amount_kg' => 30.75,
            'location' => 'Residential Area B',
            'collection_date' => '2025-04-01',
        ]);
    }
}