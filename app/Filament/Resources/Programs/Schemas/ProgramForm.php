<?php

namespace App\Filament\Resources\Programs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProgramForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')->required()->maxLength(255),
                TextInput::make('slug')->required()->unique(ignoreRecord: true)->maxLength(255),
                TextInput::make('badge')->maxLength(32),
                Select::make('tone')
                    ->options([
                        'mint' => 'Mint',
                        'lavender' => 'Lavender',
                        'sky' => 'Sky',
                        'peach' => 'Peach',
                    ])
                    ->required(),
                TextInput::make('weeks')->numeric()->required()->minValue(1)->maxValue(52),
                Select::make('level')
                    ->options([
                        'Beginner' => 'Beginner',
                        'Intermediate' => 'Intermediate',
                        'Advanced' => 'Advanced',
                    ])
                    ->required(),
                TextInput::make('focus')->required()->maxLength(64),
                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('programs')
                    ->visibility('public')
                    ->imageEditor()
                    ->helperText('Or keep a relative public path from seed data.'),
                TextInput::make('sort')->numeric()->default(0),
                DateTimePicker::make('published_at'),
            ]);
    }
}
