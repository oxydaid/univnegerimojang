<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Guarded(['id'])]
class Student extends Model
{
    protected function casts(): array
    {
        return [
            'achievements' => 'array',
            'gpa' => 'float',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Helper method sesuai SOP
    public function formatPhotoName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($this->nim.'-'.$this->user->name);

        return 'students/'.$slug.'.'.$extension;
    }

    public function deleteOldPhoto()
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            Storage::disk('public')->delete($this->photo);
        }
    }

    public function formatSkinName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($this->nim.'-'.$this->user->name);

        return 'student-skins/'.$slug.'.'.$extension;
    }

    public function deleteOldSkin()
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
