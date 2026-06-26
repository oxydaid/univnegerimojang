<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\EditProfile as BaseEditProfile;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class EditProfile extends BaseEditProfile
{
    protected function getProfile(): ?Model
    {
        $user = $this->getUser();
        if ($user->student) {
            return $user->student;
        }
        if ($user->lecturer) {
            return $user->lecturer;
        }
        if ($user->staff) {
            return $user->staff;
        }

        return null;
    }

    public function form(Schema $schema): Schema
    {
        $components = [
            $this->getNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
            $this->getCurrentPasswordFormComponent(),
        ];

        $profile = $this->getProfile();
        if ($profile) {
            $components[] = TextInput::make('phone')
                ->label('No. Telepon / Radio')
                ->maxLength(50);

            $components[] = Textarea::make('address')
                ->label('Alamat')
                ->maxLength(65535);

            $components[] = TextInput::make('tiktok')
                ->label('URL TikTok')
                ->url()
                ->maxLength(255);

            $components[] = FileUpload::make('photo')
                ->label('Foto Profil')
                ->image()
                ->disk('public')
                ->directory('profiles')
                ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                ->maxSize(2048)
                ->nullable();

            $components[] = FileUpload::make('skin')
                ->label('Skin Minecraft (.png)')
                ->image()
                ->disk('public')
                ->directory('skins')
                ->getUploadedFileNameForStorageUsing(fn ($file) => time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension())
                ->maxSize(2048)
                ->nullable();

            $components[] = Placeholder::make('skin_3d_preview')
                ->label('Render Skin 3D')
                ->content(function () use ($profile) {
                    $url = $profile->skin ? asset('storage/'.$profile->skin) : '';

                    return view('filament.components.skin-3d-preview', ['skinUrl' => $url]);
                });
        }

        return $schema->components($components);
    }

    protected function getPasswordFormComponent(): Component
    {
        return parent::getPasswordFormComponent()
            ->revealable(true);
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return parent::getPasswordConfirmationFormComponent()
            ->revealable(true);
    }

    protected function getCurrentPasswordFormComponent(): Component
    {
        return parent::getCurrentPasswordFormComponent()
            ->revealable(true);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $profile = $this->getProfile();
        if ($profile) {
            $data['phone'] = $profile->phone;
            $data['address'] = $profile->address;
            $data['tiktok'] = $profile->tiktok;
            $data['photo'] = $profile->photo;
            $data['skin'] = $profile->skin;
        }

        return $data;
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $profile = $this->getProfile();
        if ($profile) {
            $profileData = Arr::only($data, ['phone', 'address', 'photo', 'tiktok', 'skin']);

            if (array_key_exists('photo', $profileData) && $profileData['photo'] !== $profile->photo) {
                if (method_exists($profile, 'deleteOldPhoto')) {
                    $profile->deleteOldPhoto();
                }
            }
            if (array_key_exists('skin', $profileData) && $profileData['skin'] !== $profile->skin) {
                if (method_exists($profile, 'deleteOldSkin')) {
                    $profile->deleteOldSkin();
                }
            }

            $profile->update($profileData);
        }

        $record->update(Arr::except($data, ['phone', 'address', 'photo', 'tiktok', 'skin']));

        return $record;
    }
}
