<?php

namespace App\Filament\Resources\PageSections\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PageSectionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('page')->badge()->sortable(),
                TextColumn::make('section_key')->searchable(),
                TextColumn::make('title')->searchable()->limit(40),
                TextColumn::make('sort')->sortable(),
                TextColumn::make('published_at')->dateTime()->sortable(),
            ])
            ->defaultSort('sort')
            ->filters([
                SelectFilter::make('page')->options([
                    'home' => 'Home',
                    'about' => 'About',
                    'community' => 'Community',
                ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ]);
    }
}
