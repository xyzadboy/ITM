<?php

namespace App\Filament\Resources\PrioritasTikets\Pages;

use App\Filament\Resources\PrioritasTikets\PrioritasTiketResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPrioritasTiket extends EditRecord
{
    protected static string $resource = PrioritasTiketResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
