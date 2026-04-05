<?php

namespace App\Filament\Resources\PrioritasTikets\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class PrioritasTiketsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_prioritas_tiket')
                    ->label('Nama Prioritas Tiket')
                    ->searchable(),
                TextColumn::make('departemen.nama_departemen')
                    ->label('Departemen')
                    ->searchable(),
                TextColumn::make('keterangan')
                    ->searchable()
                    ->default('-'),
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
