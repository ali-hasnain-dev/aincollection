<?php

namespace App\Filament\Widgets;

use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class UserChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'User Chart';

    public ?string $filter = '';

    public static ?int $sort = 2;

    protected static ?string $pollingInterval = '30s';

    protected function getFilters(): ?array
    {
        return [
            'thisMonth' => 'This Month',
            'today' => 'Today',
            'thisWeek' => 'This week',
            'lastWeek' => 'Last week',
            'lastMonth' => 'Last month',
            'thisYear' => 'This year',
            'lastYear' => 'Last year',
        ];
    }

    protected function getData(): array
    {

        if ($this->filter == 'thisMonth' || $this->filter == '') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->startOfMonth(),
                    end: now()->endOfMonth(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'today') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->startOfDay(),
                    end: now()->endOfDay(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'thisWeek') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->startOfWeek(),
                    end: now()->endOfWeek(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'lastWeek') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->subWeek(1)->startOfWeek(),
                    end: now()->subWeek(1)->endOfWeek(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'thisMonth') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->startOfMonth(),
                    end: now()->endOfMonth(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'lastMonth') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->subMonth(1)->startOfMonth(),
                    end: now()->subMonth(1)->endOfMonth(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'thisYear') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->count();
        } elseif ($this->filter == 'lastYear') {
            $data = Trend::query(User::role('user'))
                ->between(
                    start: now()->subYear(1)->startOfYear(),
                    end: now()->subYear(1)->endOfYear(),
                )
                ->perMonth()
                ->count();
        }

        return [
            'datasets' => [
                [
                    'label' => 'Users',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
