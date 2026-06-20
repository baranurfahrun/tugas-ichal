<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaskesResource\Pages;
use App\Models\Faskes;
use Filament\Schemas\Components as Layout;
use Filament\Forms\Components as Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class FaskesResource extends Resource
{
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isDisdukcapil();
    }
    protected static ?string $model = Faskes::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-building-office';
    
    protected static ?string $navigationLabel = 'Manajemen Faskes';

    protected static string | \UnitEnum | null $navigationGroup = 'Pengaturan';

    protected static ?int $navigationSort = 6;

    protected static ?string $pluralModelLabel = 'Daftar Faskes';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Layout\Section::make('Data Faskes')
                    ->schema([
                        Forms\TextInput::make('nama_faskes')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('kode_faskes')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Select::make('tipe')
                            ->options([
                                'RS' => 'Rumah Sakit',
                                'Puskesmas' => 'Puskesmas',
                                'Klinik' => 'Klinik',
                            ])
                            ->required(),
                        Forms\Textarea::make('alamat')
                            ->required()
                            ->columnSpanFull(),
                    ])->columns(2),

                Layout\Section::make('Akun Login Faskes')
                    ->schema([
                        Forms\Repeater::make('users')
                            ->relationship()
                            ->schema([
                                Forms\TextInput::make('name')
                                    ->label('Nama Pengguna')
                                    ->required(),
                                Forms\TextInput::make('email')
                                    ->label('Email / Username')
                                    ->email()
                                    ->required()
                                    ->unique(\App\Models\User::class, 'email', ignoreRecord: true),
                                Forms\TextInput::make('password')
                                    ->password()
                                    ->dehydrateStateUsing(fn ($state) => \Illuminate\Support\Facades\Hash::make($state))
                                    ->dehydrated(fn ($state) => filled($state))
                                    ->required(fn (string $context): bool => $context === 'create')
                                    ->label('Password (Isi jika ingin mengubah/membuat)'),
                                Forms\Hidden::make('role')->default('petugas_faskes'),
                            ])
                            ->itemLabel(fn (array $state): ?string => $state['name'] ?? null)
                            ->addActionLabel('Tambah Akun Login')
                            ->columns(2),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_faskes')->searchable()->sortable(),
                Tables\Columns\TextColumn::make('kode_faskes')->searchable(),
                Tables\Columns\TextColumn::make('tipe')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'RS' => 'primary',
                        'Puskesmas' => 'success',
                        'Klinik' => 'warning',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('tipe')
                    ->options([
                        'RS' => 'Rumah Sakit',
                        'Puskesmas' => 'Puskesmas',
                        'Klinik' => 'Klinik',
                    ]),
            ])
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
            'index' => Pages\ListFaskes::route('/'),
            'create' => Pages\CreateFaskes::route('/create'),
            'edit' => Pages\EditFaskes::route('/{record}/edit'),
        ];
    }
}
