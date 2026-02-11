<?php

namespace App\Livewire;

use Livewire\Component;
use carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Departemen;
use App\Models\Tickets;
use App\Models\PrioritasTiket;
use App\Models\KategoriTiket;
use App\Models\Pegawai;
use App\Models\Arsip;


class TiketFrontend extends Component
{
    // public $prioritas_tiket_id;
    public $prioritas_tiket_id;
    public $prioritastiket = [];
    public $PrioritasTiket=[];
    public $deskripsi;
    public $departemen;
    public $departemen_id;
   

    protected $rules = [
        'prioritas_tiket_id' => 'required',
        'deskripsi' => 'required|min:5',
    ];

    public function updatedDepartemenId($value)
    {
        $this->prioritas_tiket_id = null;
        $this->prioritastiket = PrioritasTiket::where('departemen_id', $value)->get();

    }

    public function mount()
    {
        $this->departemen = Departemen::all();
        // $this->PrioritasTiket = collect(); // kosong dulu
        $this->prioritastiket = collect();

    }

    protected $listeners = [
        'ticketUpdated' => '$refresh',
    ];

 
    public function submit()
{
    $this->validate([
        'prioritas_tiket_id' => 'required',
        'deskripsi' => 'required',
    ]);

    // ambil departemen dari kategori tiket
    $prioritas = PrioritasTiket::find($this->prioritas_tiket_id);

    $busyAgentIds = Tickets::where('status', 'in progress')
        ->whereNotNull('agent_id')
        ->pluck('agent_id');
    // cari agent yang FREE
    $today = Carbon::today();

    $agent = Pegawai::query()
        ->where('pegawai.departemen_id', $prioritas->departemen_id)

        ->whereNotIn('pegawai.id', $busyAgentIds) // hanya agent available
        ->leftJoin('arsip', function ($join) {
            $join->on('pegawai.id', '=', 'arsip.agent_id')
                ->whereDate('arsip.created_at', Carbon::today());
        })
        ->select(
            'pegawai.*',
            \DB::raw('COUNT(arsip.id) as total_arsip_hari_ini')
        )
        ->groupBy('pegawai.id')
        ->orderBy('total_arsip_hari_ini', 'asc') // paling sedikit dulu
        ->orderBy('pegawai.id', 'asc') // biar stabil
        ->first();
    
    // $agent = Pegawai::whereHas('departemen', function ($q) use ($prioritas) {
    //         $q->where('id', $prioritas->departemen_id);
    //     })
    //     ->whereNotIn('id', function ($q) {
    //         $q->select('agent_id')
    //           ->from('tickets')
    //           ->where('status', 'in progress')
    //           ->whereNotNull('agent_id');
    //     })
    //     ->first(); // ambil 1 agent saja
    Tickets::create([
        'nomor_tiket' => 'TKT-' . Str::upper(Str::random(8)),
        'pelapor_id' => Auth::id(),
        'prioritas_tiket_id' => $this->prioritas_tiket_id,
        'agent_id' => $agent?->id, // 🔥 otomatis
        'deskripsi' => $this->deskripsi,
        'status' => $agent ? 'in progress' : 'open',
    ]);

    $this->reset(['prioritas_tiket_id', 'deskripsi']);

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
