<?php

namespace App\Filament\Widgets;

use App\Models\Product;
use App\Models\Program;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Video;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ContentStatsOverview extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        return [
            Stat::make('Videos', Video::count())
                ->description(Video::whereNotNull('published_at')->count().' published')
                ->descriptionIcon(Heroicon::OutlinedPlay)
                ->icon(Heroicon::OutlinedPlay),
            Stat::make('Products', Product::count())
                ->description('in the store catalog')
                ->icon(Heroicon::OutlinedShoppingBag),
            Stat::make('Programs', Program::count())
                ->description('training programs')
                ->icon(Heroicon::OutlinedClipboardDocumentList),
            Stat::make('Recipes', Recipe::count())
                ->description('in the recipes index')
                ->icon(Heroicon::OutlinedCake),
            Stat::make('Users', User::count())
                ->description('registered accounts')
                ->icon(Heroicon::OutlinedUsers),
        ];
    }
}
