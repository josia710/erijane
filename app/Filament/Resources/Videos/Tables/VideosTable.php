<?php

namespace App\Filament\Resources\Videos\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class VideosTable
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
                TextColumn::make('category')->badge(),
                TextColumn::make('duration'),
                TextColumn::make('date_label')->label('Date'),
                TextColumn::make('external_url')->label('YouTube')->url(fn ($record) => $record->external_url, true)->openUrlInNewTab()->toggleable(),
                TextColumn::make('published_at')->dateTime()->sortable(),
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
