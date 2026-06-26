<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    /**
     * The phone number of the profile.
     */
    public string $phone = '';

    /**
     * The address of the profile.
     */
    public string $address = '';

    /**
     * The position of the staff member (if applicable).
     */
    public string $position = '';

    /**
     * The TikTok username (if student).
     */
    public string $tiktok = '';

    /**
     * Uploaded photo file.
     */
    public $photo;

    /**
     * Uploaded skin file.
     */
    public $skin;

    /**
     * The current password for validation.
     */
    public string $current_password = '';

    /**
     * The new password.
     */
    public string $new_password = '';

    /**
     * The confirmation of the new password.
     */
    public string $new_password_confirmation = '';

    /**
     * Mount the component and load user data.
     */
    public function mount(): void
    {
        $user = auth()->user();
        if ($user) {
            if ($user->student) {
                $this->phone = $user->student->phone ?? '';
                $this->address = $user->student->address ?? '';
                $this->tiktok = $user->student->tiktok ?? '';
            } elseif ($user->lecturer) {
                $this->phone = $user->lecturer->phone ?? '';
                $this->address = $user->lecturer->address ?? '';
            } elseif ($user->staff) {
                $this->phone = $user->staff->phone ?? '';
                $this->address = $user->staff->address ?? '';
                $this->position = $user->staff->position ?? '';
            }
        }
    }

    /**
     * Save the editable profile details.
     */
    public function saveProfile(): void
    {
        $user = auth()->user();
        if (! $user) {
            return;
        }

        $rules = [
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'tiktok' => ['nullable', 'string', 'max:50'],
        ];

        if ($this->photo) {
            $rules['photo'] = ['image', 'min:800', 'max:2048'];
        }

        if ($this->skin) {
            $rules['skin'] = ['image', 'min:800', 'max:2048'];
        }

        $this->validate($rules);

        $profile = null;
        if ($user->student) {
            $profile = $user->student;
        } elseif ($user->lecturer) {
            $profile = $user->lecturer;
        } elseif ($user->staff) {
            $profile = $user->staff;
        }

        if ($profile) {
            $updateData = [
                'phone' => $this->phone,
                'address' => $this->address,
            ];

            if ($user->student) {
                $updateData['tiktok'] = $this->tiktok;
            }

            if ($this->photo) {
                if (method_exists($profile, 'deleteOldPhoto')) {
                    $profile->deleteOldPhoto();
                }
                if (method_exists($profile, 'formatPhotoName')) {
                    $fileName = $profile->formatPhotoName($this->photo);
                    $this->photo->storeAs('', $fileName, 'public');
                    $updateData['photo'] = $fileName;
                } else {
                    $updateData['photo'] = $this->photo->store('profiles', 'public');
                }
            }

            if ($this->skin) {
                if (method_exists($profile, 'deleteOldSkin')) {
                    $profile->deleteOldSkin();
                }
                if (method_exists($profile, 'formatSkinName')) {
                    $fileName = $profile->formatSkinName($this->skin);
                    $this->skin->storeAs('', $fileName, 'public');
                    $updateData['skin'] = $fileName;
                } else {
                    $updateData['skin'] = $this->skin->store('skins', 'public');
                }
            }

            $profile->update($updateData);
        }

        session()->flash('profile_success', 'Profil berhasil diperbarui!');
    }

    /**
     * Change the authenticated user's password.
     */
    public function changePassword(): void
    {
        $user = auth()->user();
        if (! $user) {
            return;
        }

        $this->validate([
            'current_password' => ['required', 'current_password'],
            'new_password' => ['required', 'confirmed', Password::min(8)],
        ], [
            'current_password.current_password' => 'Password saat ini tidak cocok dengan data kami.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password baru minimal harus 8 karakter.',
        ]);

        $user->update([
            'password' => Hash::make($this->new_password),
        ]);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);

        session()->flash('password_success', 'Password berhasil diubah!');
    }

    /**
     * Render the component view.
     */
    public function render(): View
    {
        return view('livewire.dashboard.profile', [
            'user' => auth()->user(),
        ]);
    }
}
