<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Departemen;
use App\Models\Tickets;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Pegawai extends Authenticatable
{
    protected $table = 'pegawai';

   
    protected $hidden = ['password'];

    protected $fillable = [
        'nama',
        'jabatan',
        'departemen_id',
        'email',
        'username',
        'password',
    ];

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }
    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'pegawai_id');
    }
    public function arsip()
    {
        return $this->hasMany(Arsip::class, 'pegawai_id');
    }
}
