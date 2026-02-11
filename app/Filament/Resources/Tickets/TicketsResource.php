<?php

namespace App\Filament\Resources\Tickets;

use App\Filament\Resources\Tickets\Pages\CreateTickets;
use App\Filament\Resources\Tickets\Pages\EditTickets;
use App\Filament\Resources\Tickets\Pages\ListTickets;
use App\Filament\Resources\Tickets\Schemas\TicketsForm;
use App\Filament\Resources\Tickets\Tables\TicketsTable;
use App\Models\Tickets;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use App\Models\Pegawai;

class TicketsResource extends Resource
{
    protected static ?string $model = Tickets::class;

    protected static string|BackedEnum|null $navigationIcon = 'ionicon-ticket-outline';

    protected static ?string $recordTitleAttribute = 'Prioritas Tiket';
    


    public static function form(Schema $schema): Schema
    {
        return $schema
        ->components([
            Select::make('pegawai_id')
                ->label('Pelapor')
                ->required()
                ->relationship('pegawai', 'nama'),
            Select::make('prioritas_tiket_id')
                ->label('Kategori Tiket')
                ->required()
                ->relationship('prioritas_tiket', 'nama_prioritas_tiket'),
        
            Select::make('agent_id')
                ->label('Agent')
                ->relationship(
                        name: 'agent',
                        titleAttribute: 'nama',
                        modifyQueryUsing: function ($query, $record, $get) {

                            $kategoriId = $get('prioritas_tiket_id'); // ✅ FIX

                            // filter agent berdasarkan departemen kategori
                            if ($kategoriId) {
                                $query->whereHas('departemen', function ($q) use ($kategoriId) {
                                    $q->whereIn('id', function ($sub) use ($kategoriId) {
                                        $sub->select('departemen_id')
                                            ->from('prioritas_tiket')
                                            ->where('id', $kategoriId);
                                    });
                                });
                            }

                            // exclude agent yang sedang in progress
                            $query->whereNotIn('id', function ($q) use ($record) {
                                $q->select('agent_id')
                                    ->from('tickets')
                                    ->where('status', 'in progress')
                                    ->whereNotNull('agent_id')
                                    ->when(
                                        $record?->agent_id,
                                        fn ($q) => $q->where('agent_id', '!=', $record->agent_id)
                                    );
                            });
                        }
                    )
                ->required(),
            TextInput::make('deskripsi')
                ->label('Deskripsi')
                ->required(),
            Select::make('status')
                ->label('Status')
                ->options([
                    'waiting for response' => 'Waiting for Response',
                    'in progress' => 'In Progress',
                    'resolved' => 'Resolved',
                ]),
            TextInput::make('estimasi_waktu')
                ->label('Estimasi Waktu (dalam menit)')
                ->numeric(),
            TextInput::make('keterangan')
                ->label('Keterangan'),
        ]);
    }

    public static function table(Table $table): Table
    {
        return TicketsTable::configure($table);
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
            'index' => ListTickets::route('/'),
            // 'create' => CreateTickets::route('/create'),
            // 'edit' => EditTickets::route('/{record}/edit'),
        ];
    }
}
