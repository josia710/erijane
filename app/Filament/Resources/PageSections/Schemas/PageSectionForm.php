<?php

namespace App\Filament\Resources\PageSections\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PageSectionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('page')
                    ->options([
                        'home' => 'Home',
                        'about' => 'About',
                        'community' => 'Community',
                    ])
                    ->required(),
                TextInput::make('section_key')->required()->maxLength(64),
                TextInput::make('title')->maxLength(255),
                Textarea::make('body')->rows(6),
                Textarea::make('meta')
                    ->rows(8)
                    ->formatStateUsing(fn ($state) => is_string($state)
                        ? $state
                        : ($state === null ? '' : json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES)))
                    ->dehydrateStateUsing(function (?string $state) {
                        if ($state === null || trim($state) === '') {
                            return null;
                        }

                        $decoded = json_decode($state, true);

                        if (json_last_error() !== JSON_ERROR_NONE) {
                            throw \Illuminate\Validation\ValidationException::withMessages([
                                'meta' => 'Meta must be valid JSON.',
                            ]);
                        }

                        return $decoded;
                    })
                    ->helperText('Optional JSON (e.g. values items).'),
                TextInput::make('sort')->numeric()->default(0),
                DateTimePicker::make('published_at'),
            ]);
    }
}
