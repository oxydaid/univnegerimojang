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
     * Get the avatar URL.
     */
    public function getAvatarUrl(): string
    {
        if ($this->photo) {
            return asset($this->photo);
        }

        return asset('images/steve.webp');
    }
}
