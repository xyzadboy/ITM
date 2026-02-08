<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pegawai;
use App\Models\KategoriTiket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Arsip extends Model
{
    protected $table = 'arsip';

    protected $guarded = ['id'];

    public function agent()
    {
        return $this->belongsTo(Pegawai::class, 'agent_id');
    }

    public function kategoriTiket()
    {
        return $this->belongsTo(KategoriTiket::class, 'kategori_tiket_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Tickets::class, 'ticket_id');
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pelapor_id');
    }
    public function no_tiket()
    {
        return $this->belongsTo(Tickets::class, 'no_tiket', 'nomor_tiket');
    }
}

