<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AktaResource\Pages;
use App\Models\Akta;
use Filament\Schemas\Components as Layout;
use Filament\Forms\Components as Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AktaResource extends Resource
{
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isDisdukcapil();
    }
    protected static ?string $model = Akta::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationLabel = 'Daftar Akta Kelahiran';

    protected static string | \UnitEnum | null $navigationGroup = 'Manajemen Kependudukan';

    protected static ?int $navigationSort = 3;

    protected static ?string $pluralModelLabel = 'Daftar Akta Terbit';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Layout\Section::make()
                    ->components([
                        Forms\DatePicker::make('filter_tanggal')
                            ->label('Filter Tanggal Pengajuan')
                            ->live()
                            ->dehydrated(false),
                        Forms\Select::make('pengajuan_kelahiran_id')
                            ->relationship(
                                name: 'pengajuanKelahiran', 
                                titleAttribute: 'nama_bayi',
                                modifyQueryUsing: fn (\Illuminate\Database\Eloquent\Builder $query, $get) => 
                                    $get('filter_tanggal') ? $query->whereDate('created_at', $get('filter_tanggal')) : $query
                            )
                            ->required()
                            ->searchable()
                            ->preload(),
                        Forms\TextInput::make('no_akta')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\DatePicker::make('tgl_terbit')
                            ->required(),
                    ])->columns(2)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('no_akta')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('pengajuanKelahiran.nama_bayi')->label('Nama Bayi')->searchable(),
                Tables\Columns\TextColumn::make('tgl_terbit')->date()->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\DatePicker::make('created_from')
                            ->label('Tanggal Awal')
                            ->default(now()->toDateString()),
                        Forms\DatePicker::make('created_until')
                            ->label('Tanggal Akhir')
                            ->default(now()->toDateString()),
                    ])
                    ->query(function (\Illuminate\Database\Eloquent\Builder $query, array $data): \Illuminate\Database\Eloquent\Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (\Illuminate\Database\Eloquent\Builder $query, $date): \Illuminate\Database\Eloquent\Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    })
                    ->indicateUsing(function (array $data): array {
                        $indicators = [];
                        if ($data['created_from'] ?? null) {
                            $indicators[] = \Filament\Tables\Filters\Indicator::make('Dari: ' . \Carbon\Carbon::parse($data['created_from'])->format('d M Y'))
                                ->removeField('created_from');
                        }
                        if ($data['created_until'] ?? null) {
                            $indicators[] = \Filament\Tables\Filters\Indicator::make('Sampai: ' . \Carbon\Carbon::parse($data['created_until'])->format('d M Y'))
                                ->removeField('created_until');
                        }
                        return $indicators;
                    }),
            ], layout: \Filament\Tables\Enums\FiltersLayout::AboveContent)
            ->actions([
                \Filament\Actions\EditAction::make(),
            ])
            ->bulkActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAktas::route('/'),
            'create' => Pages\CreateAkta::route('/create'),
            'edit' => Pages\EditAkta::route('/{record}/edit'),
        ];
    }
}
