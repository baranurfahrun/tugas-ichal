<?php

namespace App\Filament\Resources\PengajuanKelahiranResource\Pages;

use App\Filament\Resources\PengajuanKelahiranResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPengajuanKelahirans extends ListRecords
{
    protected static string $resource = PengajuanKelahiranResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Tombol New dihapus
        ];
    }
}
