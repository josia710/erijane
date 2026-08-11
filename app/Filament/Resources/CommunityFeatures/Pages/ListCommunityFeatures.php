<?php

namespace App\Filament\Resources\CommunityFeatures\Pages;

use App\Filament\Resources\CommunityFeatures\CommunityFeatureResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCommunityFeatures extends ListRecords
{
    protected static string $resource = CommunityFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
