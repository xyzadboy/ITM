<?php

namespace App\Filament\Resources\KategoriTikets;

use App\Filament\Resources\KategoriTikets\Pages\CreateKategoriTiket;
use App\Filament\Resources\KategoriTikets\Pages\EditKategoriTiket;
use App\Filament\Resources\KategoriTikets\Pages\ListKategoriTikets;
use App\Filament\Resources\KategoriTikets\Schemas\KategoriTiketForm;
use App\Filament\Resources\KategoriTikets\Tables\KategoriTiketsTable;
use App\Models\KategoriTiket;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;

class KategoriTiketResource extends Resource
{
    protected static ?string $model = KategoriTiket::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            TextInput::make('nama_kategori_tiket')
                ->label('Nama Kategori Tiket')
                ->required()
                ->maxLength(255),
            TextInput::make('bobot_kategori')
                ->label('Bobot Kategori')
                ->numeric()
                ->required(),
            Select::make('departemen_id')
                ->label('Departemen')
                ->required()
                ->relationship('departemen', 'nama_departemen'),
            TextInput::make('keterangan')
                ->label('Keterangan')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return KategoriTiketsTable::configure($table);
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
            'index' => ListKategoriTikets::route('/'),
            // 'create' => CreateKategoriTiket::route('/create'),
            // 'edit' => EditKategoriTiket::route('/{record}/edit'),
        ];
    }
}
