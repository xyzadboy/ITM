<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Resources\Tickets\TicketsResource;
use Filament\Actions\DeleteAction;
use Livewire\Livewire;
use Filament\Resources\Pages\EditRecord;

class EditTickets extends EditRecord
{
    protected static string $resource = TicketsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
   protected function afterSave(): void
{
    logger('AFTER SAVE DIPANGGIL');
    Livewire::dispatch('ticketUpdated');
}

}
