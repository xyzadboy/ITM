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

    public static function configure(Table $table): Table 
    {
        // return TicketsTable::configure($table);
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
                TextColumn::make('kategori_tiket.nama_kategori_tiket')
                    ->label('Kategori Tiket')
                    ->sortable(),
                TextColumn::make('agent.nama')
                    ->label('Agent')
                    ->sortable(),
              
                TextColumn::make('deskripsi'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'open'=> 'gray',
                        'in progress' => 'warning',
                        'resolved' => 'success',
                        'rejected' => 'danger',
                    })
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
