<?php

namespace App\Observers;

use App\Models\Tickets;
use App\Models\Arsip;
use Illuminate\Support\Facades\DB;



class TicketObserver
{
    /**
     * Handle the Tickets "created" event.
     */
    public function created(Tickets $tickets): void
    {
        //
    }

    /**
     * Handle the Tickets "updated" event.
     */
    public function updated(Tickets $ticket): void
    {
        // cek status berubah ke resolved
        if ($ticket->wasChanged('status') && $ticket->status === 'resolved') {

            DB::transaction(function () use ($ticket) {

                Arsip::create([
                    'ticket_id' => $ticket->id,
                    'no_tiket' => $ticket->nomor_tiket,
                    'pelapor_id' => $ticket->pelapor_id,
                    'agent_id' => $ticket->agent_id,
                    'kategori_tiket_id' => $ticket->kategori_tiket_id,
                    'deskripsi' => $ticket->deskripsi,
                    'resolved_at' => now(),
                ]);

                $ticket->delete(); // hapus dari tickets
            });
        }
    }

    /**
     * Handle the Tickets "deleted" event.
     */
    public function deleted(Tickets $tickets): void
    {
        //
    }

    /**
     * Handle the Tickets "restored" event.
     */
    public function restored(Tickets $tickets): void
    {
        //
    }

    /**
     * Handle the Tickets "force deleted" event.
     */
    public function forceDeleted(Tickets $tickets): void
    {
        //
    }
}
