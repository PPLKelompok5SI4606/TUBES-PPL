<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WasteRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date',
        'category',
        'weight',
        'description',
    ];

    protected $casts = [
        'date' => 'date',
        'weight' => 'integer',
    ];

    /**
     * Get the user that owns the waste record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the formatted category name.
     */
    public function getCategoryNameAttribute()
    {
        return [
            'organik' => 'Organik',
            'anorganik' => 'Anorganik',
            'b3' => 'B3 (Bahan Berbahaya dan Beracun)',
        ][$this->category] ?? $this->category;
    }
}