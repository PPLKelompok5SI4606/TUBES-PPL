<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteCollection extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount_kg',
        'collection_point_id',
        'collection_date',
    ];

    protected $casts = [
        'collection_date' => 'date',
    ];

    public function collectionPoint()
    {
        return $this->belongsTo(CollectionPoint::class);
    }
}