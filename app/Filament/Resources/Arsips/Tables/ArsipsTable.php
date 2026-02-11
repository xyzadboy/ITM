<?php

namespace App\Filament\Resources\Arsips\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ArsipsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                textcolumn::make('no_tiket')
                    ->label('Nomor Tiket')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('prioritas_tiket.nama_prioritas_tiket')
                    ->label('Kategori Tiket')
                    ->sortable(),
                TextColumn::make('agent.nama')
                    ->label('Agent')
                    ->sortable(),
                TextColumn::make('deskripsi'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'resolved' => 'success',   
                    })
                    ->sortable()
                    ->searchable(),
                    TextColumn::make('deskripsi')
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
