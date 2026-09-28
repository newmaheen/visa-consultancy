<?php

namespace App\Filament\Resources\TeamMembers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class TeamMemberForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('photo')
                    ->label('Profile Photo')
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->directory('team')
                    ->columnSpanFull(),

                TextInput::make('name')
                    ->label('Full Name')
                    ->placeholder('e.g. Maheen Absar')
                    ->required(),

                TextInput::make('designation')
                    ->label('Designation / Role')
                    ->placeholder('e.g. Senior Immigration Consultant')
                    ->required(),

                TextInput::make('specialization')
                    ->label('Specialization / Region')
                    ->placeholder('e.g. Canada & UK Study Visas'),

                TextInput::make('email')
                    ->label('Official Email')
                    ->email()
                    ->placeholder('e.g. info@globalgateway.com'),

                TextInput::make('phone')
                    ->label('Contact Number')
                    ->tel()
                    ->placeholder('e.g. +880 1700-000000'),

                TextInput::make('linkedin_url')
                    ->label('LinkedIn Profile URL')
                    ->url()
                    ->placeholder('https://linkedin.com/in/...'),

                TextInput::make('order_priority')
                    ->label('Display Order')
                    ->numeric()
                    ->default(0),

                Toggle::make('is_active')
                    ->label('Show on Website')
                    ->default(true),
            ]);
    }
}