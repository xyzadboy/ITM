<?php

namespace App\Filament\Resources\Departemens\RelationManagers;

use App\Filament\Resources\PrioritasTikets\PrioritasTiketResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class TicketPrioritiesRelationManager extends RelationManager
{
    protected static string $relationship = 'prioritastiket';

    protected static ?string $relatedResource = PrioritasTiketResource::class;


    public function table(Table $table): Table
    {
        return $table
            ->headerActions([
                CreateAction::make()
                ,
            ]);
    }
}
