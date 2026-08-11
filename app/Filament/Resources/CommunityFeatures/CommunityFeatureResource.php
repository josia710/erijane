<?php

namespace App\Filament\Resources\CommunityFeatures;

use App\Filament\Resources\CommunityFeatures\Pages\CreateCommunityFeature;
use App\Filament\Resources\CommunityFeatures\Pages\EditCommunityFeature;
use App\Filament\Resources\CommunityFeatures\Pages\ListCommunityFeatures;
use App\Filament\Resources\CommunityFeatures\Schemas\CommunityFeatureForm;
use App\Filament\Resources\CommunityFeatures\Tables\CommunityFeaturesTable;
use App\Models\CommunityFeature;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CommunityFeatureResource extends Resource
{
    protected static ?string $model = CommunityFeature::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUserGroup;

    protected static string|\UnitEnum|null $navigationGroup = 'Site';

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return CommunityFeatureForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CommunityFeaturesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCommunityFeatures::route('/'),
            'create' => CreateCommunityFeature::route('/create'),
            'edit' => EditCommunityFeature::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
