<?php

namespace App\Filament\Resources\Pegawais;

use App\Filament\Resources\Pegawais\Pages\CreatePegawai;
use App\Filament\Resources\Pegawais\Pages\EditPegawai;
use App\Filament\Resources\Pegawais\Pages\ListPegawais;
use App\Filament\Resources\Pegawais\Schemas\PegawaiForm;
use App\Filament\Resources\Pegawais\Tables\PegawaisTable;
use App\Models\Pegawai;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\Hash;


class PegawaiResource extends Resource
{
    protected static ?string $model = Pegawai::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Pegawai';

    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            TextInput::make('nama')
            ->label('Nama Pegawai')
            ->required(),
            TextInput::make('jabatan')
            ->label('Jabatan')
            ->required(),
            Select::make('departemen_id')
            ->label('Departemen')
            ->relationship('departemen', 'nama_departemen')
            ->required(),
            TextInput::make('email')
            ->label('Email')
            ->email()
            ->required(),
            TextInput::make('username')
            ->label('Username'),
            TextInput::make('password')
                ->password()
                ->dehydrated(fn ($state) => filled($state))
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->required(fn ($context) => $context === 'create')
                    ])
;    }

    public static function table(Table $table): Table
    {
        return PegawaisTable::configure($table);
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
            'index' => ListPegawais::route('/'),
            'create' => CreatePegawai::route('/create'),
            // 'edit' => EditPegawai::route('/{record}/edit'),
        ];
    }
}
