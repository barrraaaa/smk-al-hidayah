<?php

namespace App\Filament\Pages;

use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\TextSize;
use Illuminate\Support\HtmlString;

class Dashboard extends \Filament\Pages\Dashboard
{
    protected static ?string $title = 'Dashboard PPDB';

    public function getColumns(): int | array
    {
        return 12;
    }

    public function content(Schema $schema): Schema
    {
        $widgets = $this->getWidgets();

        $statsWidgets = $this->filterWidgets($widgets, [
            \App\Filament\Widgets\PPDBStatsOverview::class,
        ]);

        $chartWidgets = $this->filterWidgets($widgets, [
            \App\Filament\Widgets\PPDBPerJurusanChart::class,
            \App\Filament\Widgets\PPDBStatusPieChart::class,
            \App\Filament\Widgets\PPDBTrendChart::class,
        ]);

        $tableWidgets = $this->filterWidgets($widgets, [
            \App\Filament\Widgets\PPDBLatestPendaftarTable::class,
        ]);

        $accountWidgets = $this->filterWidgets($widgets, [
            \Filament\Widgets\AccountWidget::class,
        ]);

        return $schema
            ->components([
                Text::make('Ringkasan PPDB')
                    ->size(TextSize::Large)
                    ->weight(FontWeight::Bold)
                    ->color('gray'),

                Grid::make(12)
                    ->schema(fn (): array => $this->getWidgetsSchemaComponents($statsWidgets)),

                Text::make('Analisis Data')
                    ->size(TextSize::Large)
                    ->weight(FontWeight::Bold)
                    ->color('gray')
                    ->extraAttributes(['class' => 'mt-8']),

                Grid::make(12)
                    ->schema(fn (): array => $this->getWidgetsSchemaComponents($chartWidgets)),

                Grid::make(12)
                    ->schema([
                        Text::make('Pendaftar Terbaru')
                            ->size(TextSize::Large)
                            ->weight(FontWeight::Bold)
                            ->color('gray')
                            ->columnStart(['md' => 1, 'xl' => 1])
                            ->columnSpan(['md' => 6, 'xl' => 8]),

                        Text::make(new HtmlString(
                            '<a href="' . route('admin.export.ppdb.csv') . '"
                                class="inline-flex items-center gap-2 rounded-lg bg-primary-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5M16.5 12L12 16.5m0 0L7.5 12m4.5 4.5V3" />
                                </svg>
                                Export CSV
                            </a>'
                        ))
                            ->columnSpan(['md' => 6, 'xl' => 4])
                            ->extraAttributes(['class' => 'text-right']),
                    ]),

                Grid::make(12)
                    ->schema(fn (): array => $this->getWidgetsSchemaComponents($tableWidgets)),

                Text::make('Akun')
                    ->size(TextSize::Large)
                    ->weight(FontWeight::Bold)
                    ->color('gray')
                    ->extraAttributes(['class' => 'mt-8']),

                Grid::make(12)
                    ->schema(fn (): array => $this->getWidgetsSchemaComponents($accountWidgets)),
            ]);
    }

    private function filterWidgets(array $widgets, array $allowedClasses): array
    {
        return array_values(array_filter($widgets, function ($widget) use ($allowedClasses) {
            $class = is_string($widget) ? $widget : $widget->getWidget();
            return in_array($class, $allowedClasses);
        }));
    }
}
