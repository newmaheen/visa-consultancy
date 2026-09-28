<?php

namespace App\Filament\Resources\Inquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class InquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Client Name')
                    ->required(),

                TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->required(),

                TextInput::make('email')
                    ->label('Email Address')
                    ->email(),

                TextInput::make('destination_country')
                    ->label('Target Country'),

                TextInput::make('service_type')
                    ->label('Service / Visa Type'),

                Select::make('status')
                    ->label('Lead Status')
                    ->options([
                        'New' => 'New Lead',
                        'Contacted' => 'Contacted / In Talk',
                        'In Review' => 'Document In Review',
                        'Converted' => 'Visa Process Started',
                        'Rejected' => 'Not Eligible / Rejected',
                    ])
                    ->default('New')
                    ->required(),

                Textarea::make('message')
                    ->label('Client Message')
                    ->columnSpanFull(),

                Textarea::make('admin_notes')
                    ->label('Counselor / Admin Internal Notes')
                    ->placeholder('E.g. Client called on Monday, interested in UK September intake...')
                    ->columnSpanFull(),
            ]);
    }
}