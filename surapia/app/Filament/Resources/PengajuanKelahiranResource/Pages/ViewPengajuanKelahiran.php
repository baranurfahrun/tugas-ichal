<?php

namespace App\Filament\Resources\PengajuanKelahiranResource\Pages;

use App\Filament\Resources\PengajuanKelahiranResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPengajuanKelahiran extends ViewRecord
{
    protected static string $resource = PengajuanKelahiranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('download_berkas')
                ->label('Download Berkas')
                ->icon('heroicon-o-arrow-down-tray')
                ->color('success')
                ->visible(fn () => auth()->user()->isDisdukcapil())
                ->url(fn () => route('download.berkas', $this->record->id))
                ->openUrlInNewTab(),
            EditAction::make()
                ->visible(fn ($record) => PengajuanKelahiranResource::canEdit($record)),
        ];
    }
}
