<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrioritasTiket extends Model
{
    protected $table = 'prioritas_tiket';

    protected $fillable = [
        'nama_prioritas_tiket',
        'level_prioritas',
        'warna',
        'keterangan',
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'prioritas_tiket_id');
    }   
    
    public function departemen(): HasMany
    {
        return $this->hasMany(Departemen::class, 'prioritas_tiket_id');
    }
}