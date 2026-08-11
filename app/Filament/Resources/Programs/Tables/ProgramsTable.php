<?php

namespace App\Filament\Resources\Programs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class ProgramsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->height(40)
                    ->checkFileExistence(false)
                    ->getStateUsing(fn ($record) => \App\Support\Media::url($record->image)),
                TextColumn::make('title')->searchable()->sortable(),
                TextColumn::make('slug')->toggleable(),
                TextColumn::make('level')->badge(),
                TextColumn::make('focus'),
                TextColumn::make('weeks'),
                TextColumn::make('published_at')->dateTime()->sortable(),
                TextColumn::make('sort')->sortable(),
            ])
            ->defaultSort('sort')
            ->filters([
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
