<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class KegiatanFoto extends Model
{
    use SoftDeletes;

    protected $table = 'kegiatan_fotos';
    protected $fillable = [
        'id_kegiatan',
        'foto',
    ];
    protected $hidden = [];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class, 'id_kegiatan', 'id');
    }
}
