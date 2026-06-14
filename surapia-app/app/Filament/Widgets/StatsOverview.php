<?php

namespace App\Filament\Widgets;

use App\Models\PengajuanKelahiran;
use App\Models\Akta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Pengajuan', PengajuanKelahiran::count())
                ->description('Semua data yang masuk')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('info'),
            Stat::make('Menunggu Validasi', PengajuanKelahiran::where('status', 'pengajuan_dikirim')->count())
                ->description('Butuh segera diproses')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),
            Stat::make('Selesai Terbit', Akta::count())
                ->description('Akta sudah diterbitkan')
                ->descriptionIcon('heroicon-m-check-badge')
                ->color('success'),
            Stat::make('Sedang Diproses', PengajuanKelahiran::where('status', 'diproses_siak')->count())
                ->description('Tahap verifikasi data')
                ->descriptionIcon('heroicon-m-arrow-path')
                ->color('primary'),
        ];
    }
}
