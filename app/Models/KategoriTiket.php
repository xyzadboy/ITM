<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Departemen;
use App\Models\Tickets;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KategoriTiket extends Model
{
    protected $table = 'kategori_tiket';

    protected $fillable = [
        'nama_kategori_tiket',
        'departemen_id',
        'keterangan',
    ];
    public function departemen(): BelongsTo
    {
        return $this->belongsTo(Departemen::class, 'departemen_id');
    }
    public function tickets()
    {
        return $this->hasMany(Tickets::class, 'kategori_tiket_id');
    }
    public function arsip()
    {
        return $this->hasMany(Arsip::class, 'kategori_tiket_id');
    }
}
