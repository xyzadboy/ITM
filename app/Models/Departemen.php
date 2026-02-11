<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;
use App\Models\KategoriTiket;
use App\Models\Pegawai;

class Departemen extends Model
{
    protected $table = 'departemen';

    protected $fillable = [
        'nama_departemen',
        'kode_departemen',
        'keterangan',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class, 'department_id');
    }
    public function kategoritiket(): HasMany
    {
        return $this->hasMany(KategoriTiket::class, 'departemen_id');

    }
    public function pegawai(): HasMany
    {
        return $this->hasMany(Pegawai::class, 'departemen_id');

    }
    // public function priortastiket(): HasMany
    // {
    //     return $this->hasMany(PrioritasTiket::class, 'departemen_id');

    // }
        public function prioritastiket()
    {
        return $this->hasMany(\App\Models\PrioritasTiket::class);
    }
}
