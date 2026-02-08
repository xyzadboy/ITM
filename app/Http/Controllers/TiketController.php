<?php
namespace App\Http\Controllers;

use App\Models\Tickets;
use App\Models\KategoriTiket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TiketController extends Controller
{
    public function form(Request $request)
    {
         $tikets = Tickets::with('kategori_tiket')
            ->latest()
            ->get();
        $kategoriTiket = KategoriTiket::all();

        if ($request->isMethod('post')) {

            $request->validate([
                'kategori_tiket_id' => 'required|exists:kategori_tiket,id',
                'deskripsi' => 'required|string',
            ]);

            Tickets::create([
                'nomor_tiket' => 'TKT-' . now()->format('Ymd') . '-' . Str::upper(Str::random(5)),
                'pelapor_id' => Auth::guard('pegawai')->id(), // 🔥 otomatis dari login
                'kategori_tiket_id' => $request->kategori_tiket_id,
                'deskripsi' => $request->deskripsi,
                'status' => 'waiting for response',
            ]);

            return redirect()
                ->route('tiket.form')
                ->with('success', 'Tiket berhasil dikirim');
        }

        return view('form', compact('kategoriTiket','tikets'));
    }

}
