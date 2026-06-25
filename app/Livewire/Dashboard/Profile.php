<?php

namespace App\Livewire\Dashboard;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class Profile extends Component
{
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

        $this->validate([
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:500'],
            'tiktok' => ['nullable', 'string', 'max:50'],
        ]);

        if ($user->student) {
            $user->student->update([
                'phone' => $this->phone,
                'address' => $this->address,
                'tiktok' => $this->tiktok,
            ]);
        } elseif ($user->lecturer) {
            $user->lecturer->update([
                'phone' => $this->phone,
                'address' => $this->address,
            ]);
        } elseif ($user->staff) {
            $user->staff->update([
                'phone' => $this->phone,
                'address' => $this->address,
            ]);
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
