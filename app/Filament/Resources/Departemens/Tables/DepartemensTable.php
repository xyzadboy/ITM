<?php

namespace App\Filament\Resources\Departemens\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;


class DepartemensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
            TextColumn::make('nama_departemen')
                ->label('Nama Departemen')
                ->sortable()
                ->searchable(),
            TextColumn::make('kode_departemen')
                ->label('Kode Departemen')
                ->sortable()
                ->searchable(),
            TextColumn::make('keterangan')
                ->sortable()
                ->searchable(),
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
