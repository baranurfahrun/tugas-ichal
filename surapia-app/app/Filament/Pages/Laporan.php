<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class Laporan extends Page
{
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->isDisdukcapil();
    }
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-document-chart-bar';

    protected static string | \UnitEnum | null $navigationGroup = 'Laporan & Statistik';

    protected static ?int $navigationSort = 5;

    protected string $view = 'filament.pages.laporan';

    protected static ?string $title = 'Laporan Statistik';
    
    protected static ?string $navigationLabel = 'Laporan';
}
