<?php

use App\Models\Tickets;

if (! function_exists('generateNomorTiket')) {
    function generateNomorTiket(): string
    {
        $tanggal = now()->format('Ymd');

        $last = Tickets::whereDate('created_at', today())
            ->orderByDesc('id')
            ->first();

        $urut = $last
            ? str_pad(((int) substr($last->nomor_tiket, -4)) + 1, 4, '0', STR_PAD_LEFT)
            : '0001';

        return "TKT-{$tanggal}-{$urut}";
    }
}
