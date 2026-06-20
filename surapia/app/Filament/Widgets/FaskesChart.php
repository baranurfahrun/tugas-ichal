<?php

namespace App\Filament\Widgets;

use App\Models\Faskes;
use Filament\Widgets\ChartWidget;

class FaskesChart extends ChartWidget
{
    protected ?string $heading = 'Kelahiran per Faskes';

    protected function getData(): array
    {
        $faskesData = Faskes::withCount('pengajuanKelahirans')->get();

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Kelahiran',
                    'data' => $faskesData->pluck('pengajuan_kelahirans_count')->toArray(),
                    'backgroundColor' => '#66bb6a',
                    'borderColor' => '#43a047',
                ],
            ],
            'labels' => $faskesData->pluck('nama_faskes')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
