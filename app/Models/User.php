<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'username',
        'name',
        'level',
        'password',
        'status',
    ];

    protected $hidden = [];

    public function kegiatan()
    {
        $this->hasMany(Kegiatan::class, 'id_user');
    }
}
