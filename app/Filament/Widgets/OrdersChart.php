<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Order;


class OrdersChart extends ChartWidget
{
    use HasWidgetShield;

    protected static ?string $heading = 'Order Chart';

    public ?string $filter = '';

    public static ?int $sort = 3;

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
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->startOfMonth(),
                    end: now()->endOfMonth(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'today') {
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->startOfDay(),
                    end: now()->endOfDay(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'thisWeek') {
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->startOfWeek(),
                    end: now()->endOfWeek(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'lastWeek') {
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->subWeek(1)->startOfWeek(),
                    end: now()->subWeek(1)->endOfWeek(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'thisMonth') {
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->startOfMonth(),
                    end: now()->endOfMonth(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'lastMonth') {
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->subMonth(1)->startOfMonth(),
                    end: now()->subMonth(1)->endOfMonth(),
                )
                ->perDay()
                ->count();
        } elseif ($this->filter == 'thisYear') {
            $data = Trend::model(Order::class)
                ->between(
                    start: now()->startOfYear(),
                    end: now()->endOfYear(),
                )
                ->perMonth()
                ->count();
        } elseif ($this->filter == 'lastYear') {
            $data = Trend::model(Order::class)
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
                    'label' => 'Orders',
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
