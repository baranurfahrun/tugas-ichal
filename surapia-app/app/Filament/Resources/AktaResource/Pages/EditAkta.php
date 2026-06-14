<?php

namespace App\Filament\Resources\AktaResource\Pages;

use App\Filament\Resources\AktaResource;
use \Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAkta extends EditRecord
{
    protected static string $resource = AktaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
