<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Guarded(['id'])]
class Staff extends Model
{
    /**
     * Get the user that owns the staff.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Format the photo file name.
     */
    public function formatPhotoName(mixed $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($this->nip.'-'.$this->user->name);

        return 'staff/'.$slug.'.'.$extension;
    }

    /**
     * Delete the old photo if it exists.
     */
    public function deleteOldPhoto(): void
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            Storage::disk('public')->delete($this->photo);
        }
    }

    /**
     * Format the skin file name.
     */
    public function formatSkinName(mixed $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($this->nip.'-'.$this->user->name);

        return 'staff-skins/'.$slug.'.'.$extension;
    }

    /**
     * Delete the old skin if it exists.
     */
    public function deleteOldSkin(): void
    {
        if ($this->skin && Storage::disk('public')->exists($this->skin)) {
            Storage::disk('public')->delete($this->skin);
        }
    }

    /**
     * Get the avatar URL (either uploaded photo or Mineatar face based on name).
     */
    public function getAvatarUrl(): string
    {
        if ($this->photo) {
            return asset('storage/'.$this->photo);
        }

        $name = strtolower($this->user->name ?? '');
        $mcUsername = 'Steve';

        if (str_contains($name, 'steve')) {
            $mcUsername = 'Steve';
        } elseif (str_contains($name, 'alex')) {
            $mcUsername = 'Alex';
        } elseif (str_contains($name, 'mumbo') || str_contains($name, 'jumbo')) {
            $mcUsername = 'MumboJumbo';
        } elseif (str_contains($name, 'roslin') || str_contains($name, 'gertrude')) {
            $mcUsername = 'Alex';
        } elseif (str_contains($name, 'piglin')) {
            $mcUsername = 'Piglin';
        } elseif (str_contains($name, 'enderman')) {
            $mcUsername = 'Enderman';
        } elseif (str_contains($name, 'villager')) {
            $mcUsername = 'Villager';
        } elseif (str_contains($name, 'dream')) {
            $mcUsername = 'Dream';
        } elseif (str_contains($name, 'grian')) {
            $mcUsername = 'Grian';
        } elseif (str_contains($name, 'george')) {
            $mcUsername = 'GeorgeNotFound';
        }

        return "https://api.mineatar.io/face/{$mcUsername}?scale=8";
    }
}
