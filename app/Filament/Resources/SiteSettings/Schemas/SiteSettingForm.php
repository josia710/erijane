<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(64)
                    ->helperText('Known keys: nav, socials, assets'),
                Textarea::make('value')
                    ->rows(16)
                    ->required()
                    ->formatStateUsing(fn ($state) => is_string($state)
                        ? $state
                        : json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES))
                    ->dehydrateStateUsing(function (?string $state) {
                        $decoded = json_decode($state ?? '', true);

                        if (json_last_error() !== JSON_ERROR_NONE) {
                            throw \Illuminate\Validation\ValidationException::withMessages([
                                'value' => 'Value must be valid JSON.',
                            ]);
                        }

                        return $decoded;
                    })
                    ->helperText('JSON array/object. Invalid JSON will not save.'),
            ]);
    }
}
