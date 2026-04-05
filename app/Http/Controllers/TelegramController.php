<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Tickets;

class TelegramController extends Controller
{
    public function handle(Request $request)
    {
        $data = $request->all();

        // =========================
        // 1️⃣ SIMPAN CHAT ID AGENT
        // =========================
        if (isset($data['message'])) {

            $chatId = $data['message']['chat']['id'];
            $username = $data['message']['from']['username'] ?? null;

            if ($username) {
                $pegawai = Pegawai::where('username', $username)->first();

                if ($pegawai) {
                    $pegawai->telegram_chat_id = $chatId;
                    $pegawai->save();
                }
            }
        }

        // =========================
        // 2️⃣ HANDLE TOMBOL RESOLVE
        // =========================
        if (isset($data['callback_query'])) {

            $callbackData = $data['callback_query']['data'];

            if (str_contains($callbackData, 'resolve_')) {

                $ticketId = str_replace('resolve_', '', $callbackData);

                $ticket = Tickets::find($ticketId);

                if ($ticket) {
                    $ticket->status = 'resolved';
                    $ticket->save();
                }
            }
        }

        return response()->json(['status' => 'ok']);
    }
}