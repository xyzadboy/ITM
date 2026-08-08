<?php
namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\Departemen;
use App\Models\PrioritasTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Arsip;

class TiketController extends Controller
{
    public function form(Request $request)
    {
         $tikets = Tickets::with('prioritas_tiket')
            ->latest()
            ->get();
        $prioritasTiket = PrioritasTiket::all();
        $departemen = Departemen::all();

        if ($request->isMethod('post')) {

            $request->validate([
                'prioritas_tiket_id' => 'required|exists:prioritas_tiket,id',
                'deskripsi' => 'required|string',
            ]);

            Tickets::create([
                'nomor_tiket' => 'TKT-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5)),
                'pelapor_id' => Auth::guard('pegawai')->id(), // 🔥 otomatis dari login
                'prioritas_tiket_id' => $request->prioritas_tiket_id,
                'deskripsi' => $request->deskripsi,
                'status' => 'waiting for response',
            ]);

            return redirect()
                ->route('tiket.form')
                ->with('success', 'Tiket berhasil dikirim');
        }

        return view('form', compact('prioritasTiket','tikets'));
    }

}
