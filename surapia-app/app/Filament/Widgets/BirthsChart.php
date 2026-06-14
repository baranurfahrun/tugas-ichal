<?php

namespace App\Filament\Widgets;

use App\Models\PengajuanKelahiran;
use Filament\Widgets\ChartWidget;

class BirthsChart extends ChartWidget
{
    protected ?string $heading = 'Grafik Kelahiran Bulanan';

    protected function getData(): array
    {
        $currentYear = date('Y');
        
        // Mengambil semua data pengajuan kelahiran di tahun berjalan
        $births = PengajuanKelahiran::whereYear('tgl_lahir', $currentYear)->get();

        // Mengisi array data 12 bulan dengan nilai awal 0
        $data = array_fill(0, 12, 0);
        foreach ($births as $birth) {
            if ($birth->tgl_lahir) {
                $month = (int) date('n', strtotime($birth->tgl_lahir));
                $data[$month - 1]++;
            }
        }

        return [
            'datasets' => [
                [
                    'label' => "Kelahiran {$currentYear}",
                    'data' => $data,
                    'fill' => true,
                    'borderColor' => '#ec407a',
                    'backgroundColor' => 'rgba(236, 64, 122, 0.1)',
                    'tension' => 0.4,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
