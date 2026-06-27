<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Guarded(['id'])]
class PartnerSchool extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($school) {
            if (empty($school->slug)) {
                $school->slug = Str::slug($school->name);
            }
        });

        static::updating(function ($school) {
            if ($school->isDirty('name') && empty($school->slug)) {
                $school->slug = Str::slug($school->name);
            }
        });

        static::deleting(function ($school) {
            $school->deleteOldLogo();
        });
    }

    public function formatLogoName($file): string
    {
        return 'schools/'.time().'_'.str()->random(5).'.'.$file->getClientOriginalExtension();
    }

    public function deleteOldLogo(): void
    {
        if ($this->logo && Storage::disk('public')->exists($this->logo)) {
            Storage::disk('public')->delete($this->logo);
        }
    }

    public function getLogoUrl(): string
    {
        if ($this->logo) {
            return asset('storage/'.$this->logo);
        }

        return asset('images/steve.webp');
    }
}
