<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PengajuanKelahiranResource\Pages;
use App\Models\PengajuanKelahiran;
use Filament\Schemas\Components as Layout;
use Filament\Forms\Components as Forms;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class PengajuanKelahiranResource extends Resource
{
    protected static ?string $model = PengajuanKelahiran::class;

    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    protected static ?string $navigationLabel = 'Data Kelahiran';
    
    protected static string | \UnitEnum | null $navigationGroup = 'Manajemen Kependudukan';

    protected static ?int $navigationSort = 2;

    protected static ?string $pluralModelLabel = 'Daftar Kelahiran';

    // Status yang masih boleh diedit/dihapus oleh Faskes
    private static array $editableStatuses = ['pengajuan_dikirim', 'revisi_faskes', 'draft'];

    public static function canEdit(Model $record): bool
    {
        $user = auth()->user();
        
        // Disdukcapil hanya bisa melihat, tidak bisa mengedit
        if ($user->isDisdukcapil()) {
            return false;
        }

        // Faskes HANYA bisa edit jika status masih pengajuan_dikirim, revisi_faskes atau draft
        return in_array($record->status, static::$editableStatuses);
    }

    public static function canDelete(Model $record): bool
    {
        $user = auth()->user();
        // Disdukcapil selalu bisa hapus
        if ($user->isDisdukcapil()) {
            return true;
        }
        // Faskes hanya bisa hapus jika status masih pengajuan_dikirim atau draft
        return in_array($record->status, ['pengajuan_dikirim', 'draft']);
    }

    public static function canDeleteAny(): bool
    {
        // Hanya Disdukcapil yang boleh bulk delete
        return auth()->user()->isDisdukcapil();
    }

    public static function getNavigationItems(): array
    {
        return [
            \Filament\Navigation\NavigationItem::make(static::getNavigationLabel())
                ->group(static::getNavigationGroup())
                ->icon(static::getNavigationIcon())
                ->isActiveWhen(fn () => request()->routeIs('filament.admin.resources.pengajuan-kelahirans.index') || request()->routeIs('filament.admin.resources.pengajuan-kelahirans.edit'))
                ->sort(static::getNavigationSort())
                ->url(static::getNavigationUrl()),
        ];
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Forms\Hidden::make('faskes_id')
                    ->default(fn () => auth()->user()->faskes_id),
                Forms\Hidden::make('user_id')
                    ->default(fn () => auth()->id()),

                Layout\Section::make('👶 Data Kelahiran Bayi')
                    ->components([
                        Forms\TextInput::make('nama_bayi')
                            ->label('Nama Lengkap Bayi')
                            ->placeholder('Nama Lengkap Bayi')
                            ->required()
                            ->maxLength(255),

                        Forms\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'L' => 'Laki-laki',
                                'P' => 'Perempuan',
                            ])
                            ->required(),
                        Forms\Select::make('tempat_dilahirkan')
                            ->label('Tempat Dilahirkan')
                            ->options([
                                'RS' => 'RS/RSUD',
                                'Puskesmas' => 'Puskesmas',
                                'Klinik' => 'Klinik',
                                'Rumah' => 'Rumah',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),

                        Forms\TextInput::make('tempat_lahir')
                            ->label('Tempat Kelahiran')
                            ->placeholder('Kota/Kabupaten tempat lahir')
                            ->required()
                            ->maxLength(255),
                        Forms\DatePicker::make('tgl_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),

                        Forms\TimePicker::make('jam_lahir')
                            ->label('Pukul/Jam')
                            ->required(),
                        Forms\Select::make('jenis_kelahiran')
                            ->label('Jenis Kelahiran')
                            ->options([
                                'Tunggal' => 'Tunggal',
                                'Kembar 2' => 'Kembar 2',
                                'Kembar 3' => 'Kembar 3',
                                'Kembar 4' => 'Kembar 4',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),

                        Forms\TextInput::make('kelahiran_ke')
                            ->label('Kelahiran Ke')
                            ->numeric()
                            ->placeholder('Anak ke-')
                            ->required(),
                        Forms\Select::make('penolong_kelahiran')
                            ->label('Penolong Kelahiran')
                            ->options([
                                'Dokter' => 'Dokter',
                                'Bidan' => 'Bidan/Perawat',
                                'Dukun' => 'Dukun Beranak',
                                'Lainnya' => 'Lainnya',
                            ])
                            ->required(),

                        Forms\TextInput::make('berat_bayi')
                            ->label('Berat Bayi')
                            ->numeric()
                            ->suffix('gram')
                            ->required(),
                        Forms\TextInput::make('panjang_bayi')
                            ->label('Panjang Bayi')
                            ->numeric()
                            ->suffix('Cm')
                            ->required(),
                        Forms\TextInput::make('agama')
                            ->label('Agama')
                            ->datalist([
                                'Islam',
                                'Kristen',
                                'Katholik',
                                'Hindu',
                                'Buddha',
                                'Khonghucu',
                            ])
                            ->placeholder('Pilih atau ketik manual')
                            ->required()
                            ->maxLength(255),

                        Forms\TextInput::make('no_kk')
                            ->label('No. Kartu Keluarga')
                            ->length(16)
                            ->required(),
                        Forms\TextInput::make('nama_kepala_keluarga')
                            ->label('Nama Kepala Keluarga')
                            ->required()
                            ->maxLength(255),

                        Forms\TextInput::make('provinsi')
                            ->label('Provinsi')
                            ->default('Sulawesi Selatan')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('kabupaten')
                            ->label('Kabupaten/Kota')
                            ->default('Tana Toraja')
                            ->required()
                            ->maxLength(255),

                        Forms\TextInput::make('kecamatan')
                            ->label('Kecamatan')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('kelurahan')
                            ->label('Desa/Kelurahan')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('rt')
                            ->label('RT')
                            ->numeric()
                            ->maxLength(10),
                        Forms\TextInput::make('rw')
                            ->label('RW')
                            ->numeric()
                            ->maxLength(10),
                    ])->columns(2),

                Layout\Section::make('👨‍👩‍👧 Data Orang Tua & Saksi')
                    ->components([
                        Forms\TextInput::make('nama_ibu')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('nik_ibu')
                            ->required()
                            ->length(16),
                        Forms\TextInput::make('nama_ayah')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('nik_ayah')
                            ->required()
                            ->length(16),
                        Forms\TextInput::make('nama_saksi_1')
                            ->label('Nama Saksi 1')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('nik_saksi_1')
                            ->label('NIK Saksi 1')
                            ->required()
                            ->length(16),
                        Forms\TextInput::make('nama_saksi_2')
                            ->label('Nama Saksi 2')
                            ->required()
                            ->maxLength(255),
                        Forms\TextInput::make('nik_saksi_2')
                            ->label('NIK Saksi 2')
                            ->required()
                            ->length(16),
                    ])->columns(2),

                Layout\Section::make('📄 Berkas & Status')
                    ->components([
                        Forms\FileUpload::make('file_ktp')
                            ->label('Scan KTP Orang Tua (PDF/Gambar)')
                            ->directory('kelahiran-files')
                            ->multiple()
                            ->maxFiles(2)
                            ->openable()
                            ->downloadable(),
                        Forms\FileUpload::make('file_kk')
                            ->label('Scan Kartu Keluarga (PDF/Gambar)')
                            ->directory('kelahiran-files')
                            ->openable()
                            ->downloadable(),
                        Forms\FileUpload::make('file_ket_lahir')
                            ->label('Surat Keterangan Lahir (Scan PDF/Gambar)')
                            ->directory('kelahiran-files')
                            ->openable()
                            ->downloadable(),
                        Forms\FileUpload::make('file_buku_nikah')
                            ->label('Akta Perkawinan / Buku Nikah (Scan PDF/Gambar)')
                            ->directory('kelahiran-files')
                            ->openable()
                            ->downloadable(),
                        Forms\FileUpload::make('file_akta_lahir')
                            ->label('Akta Lahir (SIAK)')
                            ->directory('akta-lahir-files')
                            ->openable()
                            ->downloadable()
                            ->columnSpanFull()
                            ->visible(fn (?Model $record): bool => !empty($record?->file_akta_lahir)),
                        Forms\Placeholder::make('status_info')
                            ->label('Status Saat Ini')
                            ->content(fn (?Model $record): string => match ($record?->status) {
                                'draft' => 'Draft (Berkas Belum Lengkap)',
                                'pengajuan_dikirim' => 'Pengajuan Dikirim',
                                'revisi_faskes' => 'Revisi (Dari Disdukcapil)',
                                'diproses_siak' => 'Diproses SIAK',
                                'selesai_tte' => 'Upload Akta Lahir',
                                'diserahkan' => 'Dokumen Diserahkan',
                                'selesai' => 'Selesai',
                                default => $record?->status ?? '-',
                            }),
                        Forms\Placeholder::make('keterangan_status_info')
                            ->label('Catatan / Keterangan')
                            ->content(fn (?Model $record): string => $record?->keterangan_status ?: '-')
                            ->visible(fn (?Model $record): bool => !empty($record?->keterangan_status))
                            ->columnSpanFull(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_bayi')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('faskes.nama_faskes')
                    ->badge()
                    ->sortable(),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'draft' => 'Draft',
                        'pengajuan_dikirim' => 'Pengajuan Dikirim',
                        'revisi_faskes' => 'Revisi Faskes',
                        'diproses_siak' => 'Diproses SIAK',
                        'selesai_tte' => 'Upload Akta Lahir',
                        'diserahkan' => 'Diserahkan',
                        'selesai' => 'Selesai',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'pengajuan_dikirim' => 'gray',
                        'revisi_faskes' => 'warning',
                        'diproses_siak' => 'info',
                        'selesai_tte' => 'success',
                        'diserahkan' => 'success',
                        'selesai' => 'success',
                        default => 'gray',
                    }),
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
                    ->columnSpan(2)
                    ->columns(2)
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
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'pengajuan_dikirim' => 'Pengajuan Dikirim',
                        'revisi_faskes' => 'Revisi Faskes',
                        'diproses_siak' => 'Diproses SIAK',
                        'selesai_tte' => 'Upload Akta Lahir',
                        'diserahkan' => 'Diserahkan',
                        'selesai' => 'Selesai',
                    ]),
                Tables\Filters\SelectFilter::make('faskes_id')
                    ->relationship('faskes', 'nama_faskes'),
            ], layout: \Filament\Tables\Enums\FiltersLayout::AboveContent)
            ->filtersFormColumns(4)
            ->recordUrl(
                fn (PengajuanKelahiran $record): ?string =>
                    static::canEdit($record)
                        ? static::getUrl('edit', ['record' => $record])
                        : static::getUrl('view', ['record' => $record])
            )
            ->actions([
                \Filament\Actions\ActionGroup::make([
                    \Filament\Actions\ViewAction::make()
                        ->label('Lihat Dokumen'),
                    \Filament\Actions\EditAction::make()
                        ->label('Edit Dokumen')
                        ->visible(fn (PengajuanKelahiran $record) => static::canEdit($record)),
                    \Filament\Actions\Action::make('kirim_ke_disdukcapil')
                        ->label('Kirim ke Disdukcapil')
                        ->icon('heroicon-o-paper-airplane')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (PengajuanKelahiran $record) => $record->status === 'draft' && auth()->user()->isFaskes())
                        ->action(function (PengajuanKelahiran $record) {
                            $missing = [];
                            if (empty($record->file_ktp))       $missing[] = 'Scan KTP Orang Tua';
                            if (empty($record->file_kk))        $missing[] = 'Scan Kartu Keluarga';
                            if (empty($record->file_ket_lahir)) $missing[] = 'Surat Keterangan Lahir';
                            
                            if (count($missing) > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Gagal Mengirim')
                                    ->body('Berkas belum lengkap: ' . implode(', ', $missing))
                                    ->danger()
                                    ->send();
                                return;
                            }
                            
                            $record->update(['status' => 'pengajuan_dikirim']);
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Berhasil')
                                ->body('Pengajuan berhasil dikirim ke Disdukcapil.')
                                ->success()
                                ->send();

                            $disdukcapil = \App\Models\User::where('role', 'admin_disdukcapil')->get();
                            if ($disdukcapil->count() > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Pengajuan Kelahiran Baru')
                                    ->body('Pengajuan baru dari ' . $record->faskes->nama_faskes . ' untuk bayi ' . $record->nama_bayi)
                                    ->info()
                                    ->sendToDatabase($disdukcapil);
                            }
                        }),
                    \Filament\Actions\Action::make('verifikasi')
                        ->label('Verifikasi Valid')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (PengajuanKelahiran $record) => in_array($record->status, ['pengajuan_dikirim', 'revisi_faskes']) && auth()->user()->isDisdukcapil())
                        ->action(function (PengajuanKelahiran $record) {
                            $record->update([
                                'status' => 'diproses_siak',
                                'keterangan_status' => null,
                            ]);

                            $faskesUsers = \App\Models\User::where('faskes_id', $record->faskes_id)->get();
                            if ($faskesUsers->count() > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Berkas Terverifikasi')
                                    ->body('Pengajuan untuk bayi ' . $record->nama_bayi . ' telah divalidasi dan sedang diproses SIAK.')
                                    ->success()
                                    ->sendToDatabase($faskesUsers);
                            }
                        }),
                    \Filament\Actions\Action::make('revisi')
                        ->label('Minta Revisi')
                        ->icon('heroicon-o-exclamation-circle')
                        ->color('warning')
                        ->form([
                            Forms\Textarea::make('keterangan_status')
                                ->label('Catatan Revisi')
                                ->required(),
                        ])
                        ->visible(fn (PengajuanKelahiran $record) => in_array($record->status, ['pengajuan_dikirim', 'revisi_faskes']) && auth()->user()->isDisdukcapil())
                        ->action(function (array $data, PengajuanKelahiran $record) {
                            $record->update([
                                'status' => 'revisi_faskes',
                                'keterangan_status' => $data['keterangan_status'],
                            ]);

                            $faskesUsers = \App\Models\User::where('faskes_id', $record->faskes_id)->get();
                            if ($faskesUsers->count() > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Permintaan Revisi Berkas')
                                    ->body('Ada catatan revisi dari Disdukcapil untuk bayi ' . $record->nama_bayi . ': ' . $data['keterangan_status'])
                                    ->warning()
                                    ->sendToDatabase($faskesUsers);
                            }
                        }),
                    \Filament\Actions\Action::make('ajukan_ulang')
                        ->label('Ajukan Ulang')
                        ->icon('heroicon-o-arrow-path')
                        ->color('primary')
                        ->requiresConfirmation()
                        ->visible(fn (PengajuanKelahiran $record) => $record->status === 'revisi_faskes' && auth()->user()->isFaskes())
                        ->action(function (PengajuanKelahiran $record) {
                            $missing = [];
                            if (empty($record->file_ktp))       $missing[] = 'Scan KTP Orang Tua';
                            if (empty($record->file_kk))        $missing[] = 'Scan Kartu Keluarga';
                            if (empty($record->file_ket_lahir)) $missing[] = 'Surat Keterangan Lahir';
                            
                            if (count($missing) > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Gagal Ajukan Ulang')
                                    ->body('Berkas belum lengkap: ' . implode(', ', $missing))
                                    ->danger()
                                    ->send();
                                return;
                            }
                            
                            $record->update(['status' => 'pengajuan_dikirim']);
                            
                            \Filament\Notifications\Notification::make()
                                ->title('Berhasil')
                                ->body('Pengajuan berhasil diajukan ulang ke Disdukcapil.')
                                ->success()
                                ->send();

                            $disdukcapil = \App\Models\User::where('role', 'admin_disdukcapil')->get();
                            if ($disdukcapil->count() > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Pengajuan Ulang Kelahiran')
                                    ->body('Faskes ' . $record->faskes->nama_faskes . ' telah mengirimkan ulang berkas revisi untuk bayi ' . $record->nama_bayi)
                                    ->info()
                                    ->sendToDatabase($disdukcapil);
                            }
                        }),
                    \Filament\Actions\Action::make('tte_selesai')
                        ->label('Upload Akta Lahir')
                        ->icon('heroicon-o-document-check')
                        ->color('success')
                        ->form([
                            Forms\FileUpload::make('file_akta_lahir')
                                ->label('File Akta Lahir (PDF/JPG)')
                                ->disk('public')
                                ->directory('akta-lahir-files')
                                ->visibility('public')
                                ->acceptedFileTypes(['application/pdf', 'image/jpeg', 'image/png'])
                                ->maxSize(10240)
                                ->required(),
                        ])
                        ->visible(fn (PengajuanKelahiran $record) => in_array($record->status, ['diproses_siak', 'selesai_tte', 'selesai']) && auth()->user()->isDisdukcapil())
                        ->action(function (array $data, PengajuanKelahiran $record) {
                            $record->update([
                                'status' => 'selesai_tte',
                                'file_akta_lahir' => $data['file_akta_lahir'],
                            ]);

                            $faskesUsers = \App\Models\User::where('faskes_id', $record->faskes_id)->get();
                            if ($faskesUsers->count() > 0) {
                                \Filament\Notifications\Notification::make()
                                    ->title('Akta Lahir Selesai')
                                    ->body('Akta Lahir untuk bayi ' . $record->nama_bayi . ' telah diterbitkan. Silakan cetak & serahkan ke ortu.')
                                    ->success()
                                    ->sendToDatabase($faskesUsers);
                            }
                        }),
                    \Filament\Actions\Action::make('serahkan')
                        ->label('Serahkan ke Ortu')
                        ->icon('heroicon-o-hand-raised')
                        ->color('success')
                        ->requiresConfirmation()
                        ->visible(fn (PengajuanKelahiran $record) => $record->status === 'selesai_tte' && auth()->user()->isFaskes())
                        ->action(function (PengajuanKelahiran $record) {
                            $record->update(['status' => 'selesai']);
                        }),
                    \Filament\Actions\Action::make('download_berkas')
                        ->label('Download Berkas')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('success')
                        ->visible(fn (PengajuanKelahiran $record) => auth()->user()->isDisdukcapil())
                        ->url(fn (PengajuanKelahiran $record) => route('download.berkas', $record->id))
                        ->openUrlInNewTab(),
                    \Filament\Actions\Action::make('download_akta')
                        ->label('Download Akta Lahir')
                        ->icon('heroicon-o-arrow-down-tray')
                        ->color('info')
                        ->visible(fn (PengajuanKelahiran $record) => !empty($record->file_akta_lahir))
                        ->url(fn (PengajuanKelahiran $record) => route('download.akta', $record->id))
                        ->openUrlInNewTab(),
                ])
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
            'index' => Pages\ListPengajuanKelahirans::route('/'),
            'create' => Pages\CreatePengajuanKelahiran::route('/create'),
            'view' => Pages\ViewPengajuanKelahiran::route('/{record}'),
            'edit' => Pages\EditPengajuanKelahiran::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): \Illuminate\Database\Eloquent\Builder
    {
        $query = parent::getEloquentQuery();
        
        if (auth()->check()) {
            if (auth()->user()->isFaskes()) {
                return $query->where('faskes_id', auth()->user()->faskes_id);
            } elseif (auth()->user()->isDisdukcapil()) {
                return $query->where('status', '!=', 'draft');
            }
        }
        
        return $query;
    }
}
