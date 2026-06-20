<?php

namespace App\Filament\Resources\FaskesResource\Pages;

use App\Filament\Resources\FaskesResource;
use Filament\Resources\Pages\EditRecord;

class EditFaskes extends EditRecord
{
    protected static string $resource = FaskesResource::class;

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\DeleteAction::make(),
        ];
    }
}
