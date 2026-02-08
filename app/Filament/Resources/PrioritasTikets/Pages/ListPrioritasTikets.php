<?php

namespace App\Filament\Resources\PrioritasTikets\Pages;

use App\Filament\Resources\PrioritasTikets\PrioritasTiketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPrioritasTikets extends ListRecords
{
    protected static string $resource = PrioritasTiketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
