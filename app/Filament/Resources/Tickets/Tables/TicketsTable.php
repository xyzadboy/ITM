<?php

namespace App\Filament\Resources\Tickets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\SelectColumn;

class TicketsTable
{


    protected $listeners = [
    'TicketChanged' => '$refresh',
    ];

    public static function configure(Table $table): Table 
    {
        return $table
            ->poll('3s')
            ->columns([
                TextColumn::make('nomor_tiket')
                    ->label('Nomor Tiket')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('pelapor.nama')
                    ->label('Pelapor')
                    ->sortable(),
                TextColumn::make('prioritas_tiket.nama_prioritas_tiket')
                    ->label('Perihal')
                    ->sortable(),
                TextColumn::make('prioritas_tiket.level_prioritas')
                    ->label('Level Prioritas')
                    ->sortable(),
                TextColumn::make('agent.nama')
                    ->label('Agent')
                    ->sortable(),
              
                TextColumn::make('deskripsi'),
                TextColumn::make('status')
                    ->badge()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('deskripsi'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
