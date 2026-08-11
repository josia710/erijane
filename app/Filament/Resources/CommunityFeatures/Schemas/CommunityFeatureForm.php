<?php

namespace App\Filament\Resources\CommunityFeatures\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CommunityFeatureForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255),
                Textarea::make('body')->rows(3),
                TextInput::make('sort')->numeric()->default(0),
                DateTimePicker::make('published_at'),
            ]);
    }
}
