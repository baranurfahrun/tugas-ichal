<?php

namespace App\Filament\Widgets;

use App\Models\PengajuanKelahiran;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestPengajuan extends BaseWidget
{
    protected static ?int $sort = 2; // Biar muncul di bawah kartu statistik
    
    protected int | string | array $columnSpan = 'full'; // Biar tabelnya lebar penuh
    
    protected static ?string $heading = 'Pengajuan Kelahiran Terbaru';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                PengajuanKelahiran::query()->latest()->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('nama_bayi')
                    ->label('Nama Anak'),
                Tables\Columns\TextColumn::make('tgl_lahir')
                    ->label('Tanggal Lahir')
                    ->date(),
                Tables\Columns\TextColumn::make('nama_ibu')
                    ->label('Orang Tua (Ibu)'),
                Tables\Columns\TextColumn::make('faskes.nama_faskes')
                    ->label('Rumah Sakit / Faskes')
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pengajuan_dikirim' => 'Pengajuan Dikirim',
                        'revisi_faskes' => 'Revisi Faskes',
                        'diproses_siak' => 'Diproses SIAK',
                        'selesai_tte' => 'Upload Akta Lahir',
                        'diserahkan' => 'Diserahkan',
                        'selesai' => 'Selesai',
                        default => $state,
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pengajuan_dikirim' => 'gray',
                        'revisi_faskes' => 'warning',
                        'diproses_siak' => 'info',
                        'selesai_tte' => 'success',
                        'diserahkan' => 'success',
                        'selesai' => 'success',
                        default => 'gray',
                    }),
            ])
            ->actions([
                \Filament\Actions\Action::make('detail')
                    ->url(fn (PengajuanKelahiran $record): string => "/admin/pengajuan-kelahirans/{$record->id}/edit")
                    ->button()
                    ->label('Detail'),
            ]);
    }
}
