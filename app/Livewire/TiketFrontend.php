<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Tickets;
use App\Models\KategoriTiket;
use Illuminate\Support\Str;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Auth;

class TiketFrontend extends Component
{
    public $kategori_tiket_id;
    public $deskripsi;

    protected $rules = [
        'kategori_tiket_id' => 'required',
        'deskripsi' => 'required|min:5',
    ];

    protected $listeners = [
        'ticketUpdated' => '$refresh',
    ];

 
    public function submit()
{
    $this->validate([
        'kategori_tiket_id' => 'required',
        'deskripsi' => 'required',
    ]);

    // ambil departemen dari kategori tiket
    $kategori = KategoriTiket::find($this->kategori_tiket_id);

    // cari agent yang FREE
    $agent = Pegawai::whereHas('departemen', function ($q) use ($kategori) {
            $q->where('id', $kategori->departemen_id);
        })
        ->whereNotIn('id', function ($q) {
            $q->select('agent_id')
              ->from('tickets')
              ->where('status', 'in progress')
              ->whereNotNull('agent_id');
        })
        ->first(); // ambil 1 agent saja
    Tickets::create([
        'nomor_tiket' => 'TKT-' . Str::upper(Str::random(8)),
        'pelapor_id' => Auth::id(),
        'kategori_tiket_id' => $this->kategori_tiket_id,
        'agent_id' => $agent?->id, // 🔥 otomatis
        'deskripsi' => $this->deskripsi,
        'status' => $agent ? 'in progress' : 'open',
    ]);

    $this->reset(['kategori_tiket_id', 'deskripsi']);

    session()->flash('success', 'Tiket berhasil dikirim');
}


    public function render()
    {
        return view('livewire.tiket-frontend', [
            'kategoriTiket' => KategoriTiket::all(),
            'tikets' => Tickets::with(['kategori_tiket', 'agent'])
                ->latest()
                ->get(),
        ]);
    }
}
