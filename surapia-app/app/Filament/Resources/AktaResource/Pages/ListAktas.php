<?php

namespace App\Filament\Resources\AktaResource\Pages;

use App\Filament\Resources\AktaResource;
use \Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAktas extends ListRecords
{
    protected static string $resource = AktaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
