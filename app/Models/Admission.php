<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Guarded(['id'])]
class Admission extends Model
{
    protected function casts(): array
    {
        return [
            'documents' => 'array',
            'test_score' => 'integer',
        ];
    }

    /**
     * Get the department chosen by the applicant.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the URL of a specific document uploaded in the JSON column.
     */
    public function getDocumentUrl(string $key): ?string
    {
        $docs = $this->documents ?? [];
        if (! isset($docs[$key]) || ! $docs[$key]) {
            return null;
        }

        // If it starts with http, it is a external link or direct link
        if (str_starts_with($docs[$key], 'http')) {
            return $docs[$key];
        }

        return asset('storage/'.$docs[$key]);
    }
}
