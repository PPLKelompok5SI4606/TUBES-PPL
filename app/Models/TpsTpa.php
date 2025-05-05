<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TpsTpa extends Model
{
    use HasFactory;

    protected $table = 'tps_tpa';
    protected $fillable = [
        'nama',
        'tipe', // 'TPS' atau 'TPA'
        'kapasitas_total',
        'kapasitas_terisi',
        'lokasi',
        'lat',
        'lng',
        'status',
        'description'
    ];
    
    protected $appends = ['persentase_terisi'];

    public function getPersentaseTerisiAttribute()
    {
        if ($this->kapasitas_total > 0) {
            return ($this->kapasitas_terisi / $this->kapasitas_total) * 100;
        }
        return 0;
    }
}