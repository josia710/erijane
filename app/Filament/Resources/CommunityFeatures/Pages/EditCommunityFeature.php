<?php

namespace App\Filament\Resources\CommunityFeatures\Pages;

use App\Filament\Resources\CommunityFeatures\CommunityFeatureResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Resources\Pages\EditRecord;

class EditCommunityFeature extends EditRecord
{
    protected static string $resource = CommunityFeatureResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(),
            RestoreAction::make(),
        ];
    }
}
