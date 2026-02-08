<?php

namespace App\Filament\Auth;

use Filament\Auth\Pages\Register;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomRegist extends Register
{
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('username')
                    ->required()
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->minLength(8),
                TextInput::make('password_confirmation')
                    ->label('Confirm Password')
                    ->password()
                    ->required()
                    ->same('password'),
                // $this->getNameFormComponent(),
                // $this->getEmailFormComponent(),
                // $this->getPasswordFormComponent(),
                // $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}