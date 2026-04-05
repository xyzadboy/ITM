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
use Filament\Forms\Components\Select;

class PrioritasTiketResource extends Resource
{
    protected static ?string $model = PrioritasTiket::class;
    
    // protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            TextInput::make('nama_prioritas_tiket')
                ->label('Nama Prioritas Tiket')
                ->required()
                ->maxLength(255),

            TextInput::make('keterangan')
                ->label('Keterangan')
                ->maxLength(255),
            Select::make('departemen_id')
                ->label('Departemen')
                ->required()
                ->relationship('departemen', 'nama_departemen'),
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
