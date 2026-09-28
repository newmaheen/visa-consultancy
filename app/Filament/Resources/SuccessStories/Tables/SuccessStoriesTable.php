<?php

namespace App\Filament\Resources\SuccessStories\Tables;

use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;

class SuccessStoriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('client_photo')
                    ->label('Client')
                    ->disk('public')
                    ->circular(),

                ImageColumn::make('visa_copy')
                    ->label('Visa Proof')
                    ->disk('public')
                    ->square(),

                TextColumn::make('client_name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('destination_country')
                    ->label('Country')
                    ->badge()
                    ->color('success'),

                TextColumn::make('visa_type')
                    ->label('Visa Category')
                    ->searchable(),

                ToggleColumn::make('is_active')
                    ->label('Active'),

                TextColumn::make('priority')
                    ->label('Priority')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}