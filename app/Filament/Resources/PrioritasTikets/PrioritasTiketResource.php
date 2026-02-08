<?php

namespace App\Filament\Resources\PrioritasTikets;

use App\Filament\Resources\PrioritasTikets\Pages\CreatePrioritasTiket;
use App\Filament\Resources\PrioritasTikets\Pages\EditPrioritasTiket;
use App\Filament\Resources\PrioritasTikets\Pages\ListPrioritasTikets;
use App\Filament\Resources\PrioritasTikets\Schemas\PrioritasTiketForm;
use App\Filament\Resources\PrioritasTikets\Tables\PrioritasTiketsTable;
use App\Models\PrioritasTiket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;

class PrioritasTiketResource extends Resource
{
    protected static ?string $model = PrioritasTiket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            TextInput::make('nama_prioritas_tiket')
                ->label('Nama Prioritas Tiket')
                ->required()
                ->maxLength(255),
            TextInput::make('level_prioritas')
                ->required(),
            TextInput::make('warna')
                ->label('Warna')
                ->required(),
            TextInput::make('keterangan')
                ->label('Keterangan')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return PrioritasTiketsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPrioritasTikets::route('/'),
            // 'create' => CreatePrioritasTiket::route('/create'),
            // 'edit' => EditPrioritasTiket::route('/{record}/edit'),
        ];
    }
}
