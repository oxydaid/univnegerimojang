<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Guarded(['id'])]
class Lecturer extends Model
{
    /**
     * Get the user that owns the lecturer.
     *
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the department that owns the lecturer.
     *
     * @return BelongsTo<Department, $this>
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the schedules for the lecturer.
     *
     * @return HasMany<Schedule, $this>
     */
    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }

    /**
     * Format the photo file name.
     */
    public function formatPhotoName(mixed $file): string
    {
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($this->nip.'-'.$this->user->name);

        return 'lecturers/'.$slug.'.'.$extension;
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

        return 'lecturer-skins/'.$slug.'.'.$extension;
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
