<?php
namespace App\Filament\Auth;


use Filament\Auth\Pages\Login;
use Filament\Forms\Components\TextInput;

class CustomLogin extends Login
{
    protected function getEmailFormComponent(): TextInput
    {
        return TextInput::make('email')
            ->label('Username')
            ->required()
            ->autofocus();
    }
      protected function getCredentialsFromFormData(array $data): array
    {
        $login = $data['email'];

        return filter_var($login, FILTER_VALIDATE_EMAIL)
            ? ['email' => $login, 'password' => $data['password']]
            : ['username' => $login, 'password' => $data['password']];
    }
//     protected function getCredentialsFromFormData(array $data): array
// {
//     dd('CUSTOM LOGIN DIPANGGIL', $data);

//     return [
//         'username' => $data['email'],
//         'password' => $data['password'],
//     ];
// }

    
}

