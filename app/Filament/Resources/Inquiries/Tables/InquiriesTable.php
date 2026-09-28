<?php

namespace App\Filament\Resources\Inquiries\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InquiriesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('created_at')
                    ->label('Received Date')
                    ->dateTime('d M, Y h:i A')
                    ->sortable(),

                TextColumn::make('name')
                    ->label('Client Name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable(),

                TextColumn::make('destination_country')
                    ->label('Country')
                    ->badge(),

                TextColumn::make('service_type')
                    ->label('Visa Type'),

                SelectColumn::make('status')
                    ->label('Status')
                    ->options([
                        'New' => 'New',
                        'Contacted' => 'Contacted',
                        'In Review' => 'In Review',
                        'Converted' => 'Converted',
                        'Rejected' => 'Rejected',
                    ]),
            ])
            ->defaultSort('id', 'desc')
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