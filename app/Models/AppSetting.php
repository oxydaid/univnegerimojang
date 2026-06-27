<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

#[Guarded(['id'])]
class AppSetting extends Model
{
    protected function casts()
    {
        return [
            'is_development' => 'boolean',
            'spmb_open' => 'boolean',
            'graduation_list_published' => 'boolean',
            'show_announcement' => 'boolean',
        ];
    }

    public static function formatFileName($file, $prefix = 'setting')
    {
        $extension = $file->getClientOriginalExtension();
        $slug = Str::slug($prefix.'-'.time());

        return $slug.'.'.$extension;
    }

    // Helper: Hapus file lama
    public function deleteOldFile($column)
    {
        if ($this->{$column} && Storage::disk('public')->exists($this->{$column})) {
            Storage::disk('public')->delete($this->{$column});
        }
    }
}
