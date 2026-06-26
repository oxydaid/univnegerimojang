<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
    public function formatPhotoName($file): string
    {
        return 'students/'.time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension();
    }

    public function deleteOldPhoto(): void
    {
        if ($this->photo && Storage::disk('public')->exists($this->photo)) {
            Storage::disk('public')->delete($this->photo);
        }
    }

    public function formatSkinName($file): string
    {
        return 'student-skins/'.time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension();
    }

    public function deleteOldSkin(): void
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
            return asset('storage/'.$this->photo);
        }

        return asset('images/steve.webp');
    }
}
