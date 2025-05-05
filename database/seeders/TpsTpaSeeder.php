<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TpsTpa;

class TpsTpaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sites = [
            [
                'nama' => 'TPA Sarimukti',
                'tipe' => 'TPA',
                'kapasitas_total' => 10000.00,
                'kapasitas_terisi' => 6500.00,
                'lokasi' => 'Kec. Cimenyan, Bandung',
                'lat' => -6.800530132887372,
                'lng' => 107.34960880337408,
                'status' => 'Aktif',
                'description' => 'Regional final waste disposal site serving Bandung'
            ],
            [
                'nama' => 'TPA Jelekong',
                'tipe' => 'TPA',
                'kapasitas_total' => 8000.00,
                'kapasitas_terisi' => 4200.00,
                'lokasi' => 'Jelekong, Bandung Selatan',
                'lat' => -6.9715,
                'lng' => 107.5941,
                'status' => 'Aktif',
                'description' => 'Final waste disposal site in south Bandung area'
            ],
            [
                'nama' => 'TPS Ciroyom',
                'tipe' => 'TPS',
                'kapasitas_total' => 500.00,
                'kapasitas_terisi' => 350.00,
                'lokasi' => 'Ciroyom, Bandung',
                'lat' => -6.9139,
                'lng' => 107.5918,
                'status' => 'Aktif',
                'description' => 'Temporary waste collection point in Ciroyom'
            ],
            [
                'nama' => 'TPS Balubur',
                'tipe' => 'TPS',
                'kapasitas_total' => 450.00,
                'kapasitas_terisi' => 280.00,
                'lokasi' => 'Balubur, Bandung Tengah',
                'lat' => -6.9025,
                'lng' => 107.6086,
                'status' => 'Aktif',
                'description' => 'Temporary waste collection near city center'
            ],
            [
                'nama' => 'TPS Cicadas',
                'tipe' => 'TPS',
                'kapasitas_total' => 520.00,
                'kapasitas_terisi' => 320.00,
                'lokasi' => 'Cicadas, Bandung Timur',
                'lat' => -6.9099,
                'lng' => 107.6422,
                'status' => 'Aktif',
                'description' => 'Temporary waste collection in eastern Bandung'
            ],
            [
                'nama' => 'TPS Soekarno-Hatta',
                'tipe' => 'TPS',
                'kapasitas_total' => 700.00,
                'kapasitas_terisi' => 450.00,
                'lokasi' => 'Jl. Soekarno-Hatta, Bandung',
                'lat' => -6.9385,
                'lng' => 107.6548,
                'status' => 'Aktif',
                'description' => 'Waste collection point along Soekarno-Hatta corridor'
            ],
            [
                'nama' => 'TPS Cibeunying',
                'tipe' => 'TPS',
                'kapasitas_total' => 480.00,
                'kapasitas_terisi' => 280.00,
                'lokasi' => 'Cibeunying, Bandung',
                'lat' => -6.8988,
                'lng' => 107.6295,
                'status' => 'Aktif',
                'description' => 'Serves the Cibeunying district area'
            ],
            [
                'nama' => 'TPS Cijerah',
                'tipe' => 'TPS',
                'kapasitas_total' => 420.00,
                'kapasitas_terisi' => 220.00,
                'lokasi' => 'Cijerah, Bandung Barat',
                'lat' => -6.9342,
                'lng' => 107.5654,
                'status' => 'Aktif',
                'description' => 'Collection point in western Bandung'
            ],
            [
                'nama' => 'TPS Cibiru',
                'tipe' => 'TPS',
                'kapasitas_total' => 380.00,
                'kapasitas_terisi' => 260.00,
                'lokasi' => 'Cibiru, Bandung Timur',
                'lat' => -6.9391,
                'lng' => 107.7102,
                'status' => 'Aktif',
                'description' => 'Serves the eastern outskirts of Bandung'
            ],
            [
                'nama' => 'TPS Gedebage',
                'tipe' => 'TPS',
                'kapasitas_total' => 600.00,
                'kapasitas_terisi' => 420.00,
                'lokasi' => 'Gedebage, Bandung Tenggara',
                'lat' => -6.9417,
                'lng' => 107.6867,
                'status' => 'Aktif',
                'description' => 'Major transfer station in southeastern Bandung'
            ],
            [
                'nama' => 'TPS Leuwigajah',
                'tipe' => 'TPS',
                'kapasitas_total' => 550.00,
                'kapasitas_terisi' => 380.00,
                'lokasi' => 'Leuwigajah, Bandung',
                'lat' => -6.9047,
                'lng' => 107.5436,
                'status' => 'Aktif',
                'description' => 'Collection point serving western industrial area'
            ],
            [
                'nama' => 'TPS Pasir Impun',
                'tipe' => 'TPS',
                'kapasitas_total' => 400.00,
                'kapasitas_terisi' => 230.00,
                'lokasi' => 'Pasir Impun, Bandung Utara',
                'lat' => -6.8902,
                'lng' => 107.6587,
                'status' => 'Aktif',
                'description' => 'Serves the northeastern residential areas'
            ],
            [
                'nama' => 'TPS 3R Antapani',
                'tipe' => 'TPS',
                'kapasitas_total' => 480.00,
                'kapasitas_terisi' => 320.00,
                'lokasi' => 'Antapani, Bandung',
                'lat' => -6.9159655091214525,
                'lng' => 107.66553367449237,
                'status' => 'Aktif',
                'description' => 'TPS 3R in Antapani area, focusing on waste reduction and recycling'
            ],
            [
                'nama' => 'TPS Babakan Sari',
                'tipe' => 'TPS',
                'kapasitas_total' => 430.00,
                'kapasitas_terisi' => 290.00,
                'lokasi' => 'Babakan Sari, Bandung',
                'lat' => -6.9221548792371745,
                'lng' => 107.64945220762513,
                'status' => 'Aktif',
                'description' => 'TPS in Babakan Sari, a temporary waste collection point'
            ],
            [
                'nama' => 'TPS Terpadu Babakan Sari',
                'tipe' => 'TPS',
                'kapasitas_total' => 520.00,
                'kapasitas_terisi' => 310.00,
                'lokasi' => 'Terpadu Babakan Sari, Bandung',
                'lat' => -6.9210472192059855,
                'lng' => 107.6501173985231,
                'status' => 'Aktif',
                'description' => 'Integrated TPS in Babakan Sari, focusing on waste management'
            ]
        ];

        foreach ($sites as $site) {
            TpsTpa::create($site);
        }
    }
}