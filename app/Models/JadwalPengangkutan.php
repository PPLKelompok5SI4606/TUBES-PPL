<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JadwalPengangkutan extends Model
{
        protected $fillable = [
        'nama_petugas',
        'no_kontak',
        'tanggal',
        'waktu',
        'lokasi',
        'keterangan',
    ];
}
