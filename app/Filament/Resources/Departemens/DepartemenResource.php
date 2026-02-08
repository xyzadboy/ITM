<?php

namespace App\Filament\Resources\Departemens;

use App\Filament\Resources\Departemens\Pages\CreateDepartemen;
use App\Filament\Resources\Departemens\Pages\EditDepartemen;
use App\Filament\Resources\Departemens\Pages\ListDepartemens;
use App\Filament\Resources\Departemens\Schemas\DepartemenForm;
use App\Filament\Resources\Departemens\Tables\DepartemensTable;
use App\Models\Departemen;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;


class DepartemenResource extends Resource
{
    protected static ?string $model = Departemen::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'departemen';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
        
            TextInput::make('nama_departemen')
                ->label('Nama Departemen')
                ->required()
                ->maxLength(255),
            TextInput::make('kode_departemen')
                ->label('Kode Departemen'),
            TextInput::make('keterangan')
                ->label('Keterangan')
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return DepartemensTable::configure($table);
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
            'index' => ListDepartemens::route('/'),
            // 'create' => CreateDepartemen::route('/create'),
        ];
    }
}
