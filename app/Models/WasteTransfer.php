<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteTransfer extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tps_id',
        'tpa_id',
        'waste_amount', 
        'waste_type',
        'transfer_date',
        'status',
    ];
    
    protected $casts = [
        'transfer_date' => 'datetime',
        'waste_amount' => 'float'  
    ];
    
    public function tpsSource()
    {
        return $this->belongsTo(TpsTpa::class, 'tps_id');
    }
    
    public function tpaDestination()
    {
        return $this->belongsTo(TpsTpa::class, 'tpa_id');
    }
}