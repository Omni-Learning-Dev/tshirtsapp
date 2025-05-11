<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\ProductImage;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ProductStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('Total products in the catalog')
                ->descriptionIcon('heroicon-m-shopping-bag')
                ->color('success'),

            Stat::make('Average Price', '$' . number_format(Product::avg('price') ?? 0, 2))
                ->description('Average product price')
                ->descriptionIcon('heroicon-m-currency-dollar')
                ->color('warning'),

            Stat::make('Product Images', ProductImage::count())
                ->description('Total product images uploaded')
                ->descriptionIcon('heroicon-m-photo')
                ->color('danger'),
        ];
    }
}
