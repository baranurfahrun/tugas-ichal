<?php

namespace App\Filament\Resources\AkunDukcapils\Pages;

use App\Filament\Resources\AkunDukcapils\AkunDukcapilResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageAkunDukcapils extends ManageRecords
{
    protected static string $resource = AkunDukcapilResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->mutateFormDataUsing(function (array $data): array {
                    $data['role'] = 'admin_disdukcapil';
                    return $data;
                }),
        ];
    }
}
