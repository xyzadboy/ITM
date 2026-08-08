<?php

namespace App\Livewire;

use Livewire\Component;
use carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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

    // Ambil prioritas tiket
    $prioritas = PrioritasTiket::find($this->prioritas_tiket_id);

    // Ambil agent yang sedang busy
    $busyAgentIds = Tickets::where('status', 'in progress')
        ->whereNotNull('agent_id')
        ->pluck('agent_id');

    // Cari agent yang available berdasarkan departemen & beban kerja hari ini
    $agent = Pegawai::query()
        ->where('pegawai.departemen_id', $prioritas->departemen_id)
        ->whereNotIn('pegawai.id', $busyAgentIds)
        ->leftJoin('arsip', function ($join) {
            $join->on('pegawai.id', '=', 'arsip.agent_id')
                ->whereDate('arsip.created_at', \Carbon\Carbon::today());
        })
        ->select(
            'pegawai.*',
            \DB::raw('COUNT(arsip.id) as total_arsip_hari_ini')
        )
        ->groupBy('pegawai.id')
        ->orderBy('total_arsip_hari_ini', 'asc')
        ->orderBy('pegawai.id', 'asc')
        ->first();

    // Buat tiket
    $ticket = Tickets::create([
        'nomor_tiket' => 'TKT-' . \Illuminate\Support\Str::upper(\Illuminate\Support\Str::random(8)),
        'pelapor_id' => \Illuminate\Support\Facades\Auth::id(),
        'prioritas_tiket_id' => $this->prioritas_tiket_id,
        'agent_id' => $agent?->id,
        'deskripsi' => $this->deskripsi,
        'status' => $agent ? 'in progress' : 'open',
    ]);

    // ===============================
    // 🔔 KIRIM NOTIFIKASI TELEGRAM
    // ===============================
    if ($agent && $agent->telegram_chat_id) {

        Http::post(
            "https://api.telegram.org/bot" . env('TELEGRAM_BOT_TOKEN') . "/sendMessage",
            [
                'chat_id' => $agent->telegram_chat_id,
                'text' => "🎫 TIKET BARU\n\n"
                    . "Nomor: {$ticket->nomor_tiket}\n"
                    . "Kategori: {$ticket->prioritas_tiket_id}\n\n"
                    . "Deskripsi:\n{$ticket->deskripsi}",
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            [
                                'text' => '✅ Resolve',
                                'callback_data' => 'resolve_' . $ticket->id
                            ]
                        ]
                    ]
                ])
            ]
        );
    }
    // ===============================
// 🔔 KIRIM NOTIFIKASI TELEGRAM KE GRUP
// ===============================
$groupChatId = config('services.telegram.group_chat_id');
$botToken = config('services.telegram.bot_token');

if ($groupChatId && $botToken) {

    $response = Http::post(
        "https://api.telegram.org/bot{$botToken}/sendMessage",
        [
            'chat_id' => $groupChatId,
            'text' => "🎫 TIKET BARU\n\n"
                . "Nomor: {$ticket->nomor_tiket}\n"
                . "Prioritas: {$prioritas->nama}\n"
                . "Agent: " . ($agent->nama ?? 'Belum ada agent') . "\n\n"
                . "Deskripsi:\n{$ticket->deskripsi}",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [
                            'text' => '✅ Resolve',
                            'callback_data' => 'resolve_' . $ticket->id
                        ]
                    ]
                ]
            ])
        ]
    );

    \Illuminate\Support\Facades\Log::info('Telegram response', $response->json() ?? []);
} else {
    \Illuminate\Support\Facades\Log::warning('Telegram config kosong', [
        'group_chat_id' => $groupChatId,
        'bot_token_set' => (bool) $botToken,
    ]);
}

    // Reset form
    $this->reset(['prioritas_tiket_id', 'deskripsi']);

    session()->flash('success', 'Tiket berhasil dikirim');
}


    public function render()
    {
        return view('livewire.tiket-frontend', [
            'kategoriTiket' => PrioritasTiket::all(),
            'tikets' => Tickets::with(['prioritas_tiket', 'agent'])
                ->latest()
                ->get(),
        ]);
    }
}
