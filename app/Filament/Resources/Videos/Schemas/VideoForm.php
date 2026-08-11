<?php

namespace App\Filament\Resources\Videos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class VideoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('date_label')->label('Date label')->maxLength(64),
                TextInput::make('duration')->maxLength(32),
                TextInput::make('category')->maxLength(64),
                TextInput::make('external_url')->url()->maxLength(255),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('videos')
                    ->visibility('public')
                    ->imageEditor(),
                TextInput::make('sort')->numeric()->default(0),
                DateTimePicker::make('published_at'),
            ]);
    }
}
