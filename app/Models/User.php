<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'role',
        'email',
        'password',
        'jenis_kelamin',
        'no_telepon',
        'alamat',
        'tanggal_lahir',
        'domisili',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'tanggal_lahir' => 'date',
        ];
    }

    public function pickupRequests()
    {
        return $this->hasMany(PickupRequest::class);
    }

    public function adminPickupRequests()
    {
        return $this->hasMany(PickupRequest::class, 'admin_id');
    }

    public function wasteRecords()
    {
        return $this->hasMany(WasteRecord::class);
    }
}
