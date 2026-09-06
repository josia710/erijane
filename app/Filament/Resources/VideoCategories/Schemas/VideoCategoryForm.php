<?php

namespace App\Filament\Resources\VideoCategories\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VideoCategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')->required()->maxLength(64),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(64),
                TextInput::make('sort')->numeric()->default(0),
            ]);
    }
}
