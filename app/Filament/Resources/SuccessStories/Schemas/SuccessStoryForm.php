<?php

namespace App\Filament\Resources\SuccessStories\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Toggle;

class SuccessStoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(2)->schema([
                    TextInput::make('client_name')
                        ->label('Client Name')
                        ->required()
                        ->placeholder('e.g. Tanvir Ahmed'),

                    TextInput::make('destination_country')
                        ->label('Destination Country')
                        ->required()
                        ->placeholder('e.g. Portugal'),

                    TextInput::make('visa_type')
                        ->label('Visa Type / Category')
                        ->required()
                        ->placeholder('e.g. D1 Job Seeker Visa'),

                    DatePicker::make('approval_date')
                        ->label('Approval Date')
                        ->default(now()),

                    FileUpload::make('client_photo')
                        ->label('Client Photo')
                        ->image()
                        ->disk('public')
                        ->directory('success-stories/clients')
                        ->visibility('public'),

                    FileUpload::make('visa_copy')
                        ->label('Visa Proof / Sticker Image')
                        ->image()
                        ->disk('public')
                        ->directory('success-stories/visas')
                        ->visibility('public'),

                    TextInput::make('priority')
                        ->label('Display Priority')
                        ->numeric()
                        ->default(1),

                    Toggle::make('is_featured')
                        ->label('Featured Story')
                        ->default(true),

                    Toggle::make('is_active')
                        ->label('Active Status')
                        ->default(true),
                ]),

                Textarea::make('story')
                    ->label('Client Experience / Story')
                    ->rows(3)
                    ->placeholder('A short quote or feedback from the client...')
                    ->columnSpanFull(),
            ]);
    }
}