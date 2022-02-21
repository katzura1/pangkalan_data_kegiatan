<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kegiatan extends Model
{
    use SoftDeletes;

    protected $table = 'kegiatans';
    protected $fillable = [
        'nama_kegiatan',
        'tanggal_kegiatan',
        'lokasi_kegiatan',
        'pelaksana_kegiatan',
        'nama_pimpinan',
        'pendamping',
        'id_user',
    ];

    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
