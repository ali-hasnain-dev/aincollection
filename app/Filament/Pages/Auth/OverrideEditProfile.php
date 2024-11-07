<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\EditProfile as BaseEditProfile;

class OverrideEditProfile extends BaseEditProfile
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('username')
                //     ->required()
                //     ->maxLength(255),
                FileUpload::make('user_avatar')
                    ->label('')
                    ->image()
                    ->avatar()
                    ->disk('public')
                    ->directory(asset('web/user/images'))
                    ->imageEditorEmptyFillColor('#000000')
                    ->alignCenter(),
                $this->getNameFormComponent(),
                $this->getEmailFormComponent()->disabled(),
                // $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
