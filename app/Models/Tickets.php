<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\KategoriTiket;
use App\Models\PrioritasTiket;
use App\Models\User;
use App\Models\Pegawai;

class Tickets extends Model
{
    protected $table = 'tickets';

    protected $fillable = [
        'nomor_tiket',
        'pelapor_id',
        'kategori_tiket_id',
        'prioritas_tiket_id',
        'agent_id',
        'deskripsi',
        'status',
        'estimasi_waktu',
        'keterangan',
    ];

    protected static function booted()
    {
        static::creating(function ($ticket) {
            if (empty($ticket->nomor_tiket)) {
                $ticket->nomor_tiket = self::generateNomorTiket();
            }
        });
    }

    public static function generateNomorTiket()
    {
        $prefix = 'TKT';
        $datePart = date('Ymd');
        $randomPart = strtoupper(substr(bin2hex(random_bytes(3)), 0, 6));
        return "{$prefix}-{$datePart}-{$randomPart}";
    }

    public function kategori_tiket()
    {
        return $this->belongsTo(KategoriTiket::class, 'kategori_tiket_id');
    }
    public function prioritas_tiket()
    {
        return $this->belongsTo(PrioritasTiket::class, 'prioritas_tiket_id');
    }
    public function agent()
    {
        return $this->belongsTo(Pegawai::class, 'agent_id');  
    }
    public function pegawai()
    {
        return $this->belongsTo(Pegawai::class, 'pelapor_id');  
    }
    public function pelapor()
    {
        return $this->belongsTo(Pegawai::class, 'pelapor_id');
    }
    public function arsip()
    {
        return $this->hasMany(Arsip::class, 'ticket_id');
    }
}