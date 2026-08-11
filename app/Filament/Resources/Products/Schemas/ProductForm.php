<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('price')->numeric()->required()->minValue(0)->prefix('$'),
                TextInput::make('category')->required()->maxLength(64)->default('Apparel'),
                Select::make('line')
                    ->options([
                        'women' => 'Women’s',
                        'men' => 'Men’s',
                        'unisex' => 'Unisex',
                    ]),
                Select::make('tone')
                    ->options([
                        'mint' => 'Mint',
                        'lavender' => 'Lavender',
                        'sky' => 'Sky',
                        'peach' => 'Peach',
                    ])
                    ->required(),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->imageEditor(),
                TextInput::make('sort')->numeric()->default(0),
                DateTimePicker::make('published_at'),
            ]);
    }
}
