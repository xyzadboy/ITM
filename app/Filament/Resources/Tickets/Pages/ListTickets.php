<?php

namespace App\Filament\Resources\Tickets\Pages;

use App\Filament\Resources\Tickets\TicketsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTickets extends ListRecords
{
    protected static string $resource = TicketsResource::class;
    protected static ?string $recordTitleAttribute = 'Prioritas Tiket';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
