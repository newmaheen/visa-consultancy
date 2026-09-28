<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('thumbnail_image')
                    ->label('Service Image / Thumbnail')
                    ->image()
                    ->disk('public')
                    ->directory('services')
                    ->required()
                    ->columnSpanFull(),

                TextInput::make('title')
                    ->label('Service Title')
                    ->placeholder('e.g. Student Visa Solutions')
                    ->required(),

                TextInput::make('badge_tag')
                    ->label('Badge Tag')
                    ->placeholder('e.g. Admissions Open / Express Processing'),

                Textarea::make('short_description')
                    ->label('Short Description / Highlights')
                    ->rows(3)
                    ->columnSpanFull(),

                TextInput::make('cta_btn_text')
                    ->label('Button Text')
                    ->default('Contact Now')
                    ->required(),

                TextInput::make('order_priority')
                    ->label('Sort Order')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('Is Active (Show on landing page)')
                    ->default(true),
            ]);
    }
}