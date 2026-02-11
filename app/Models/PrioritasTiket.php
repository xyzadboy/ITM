<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tickets;
use App\Models\Departemen;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrioritasTiket extends Model
{
    protected $table = 'prioritas_tiket';

    protected $fillable = [
        'nama_prioritas_tiket',
        'departemen_id',
        'level_prioritas',
        'keterangan',
    ];

    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'prioritas_tiket_id');
    }   
    
    // public function departemen(): BelongsTo
    // {
    //     return $this->belongsTo(Departemen::class, 'departemen_id');
    // }
        
        public function departemen()
    {
        return $this->belongsTo(\App\Models\Departemen::class);
    }
}