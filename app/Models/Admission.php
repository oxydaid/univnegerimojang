<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Hash;

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

    protected static function booted(): void
    {
        static::updated(function (Admission $admission) {
            if ($admission->status === 'accepted' && $admission->getOriginal('status') !== 'accepted') {
                $admission->createStudentAccount();
            }
        });
    }

    /**
     * Get the department chosen by the applicant.
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * Get the academic year associated with the admission.
     */
    public function academicYear(): BelongsTo
    {
        return $this->belongsTo(AcademicYear::class);
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

    /**
     * Auto create student account (User + Student profile).
     */
    public function createStudentAccount(): void
    {
        // 1. Create or retrieve User
        $user = User::where('email', $this->email)->first();
        if (! $user) {
            $user = User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make('pendaftaran123'),
            ]);
            $user->assignRole('Student');
        } else {
            // Ensure student role is assigned
            if (! $user->hasRole('Student')) {
                $user->assignRole('Student');
            }
        }

        // 2. Create Student profile if not exists
        if (! $user->student) {
            $year = date('Y');
            $deptCode = str_pad($this->department_id, 2, '0', STR_PAD_LEFT);
            $latestStudent = Student::where('nim', 'like', $year.$deptCode.'%')->orderBy('nim', 'desc')->first();
            $counter = $latestStudent ? intval(substr($latestStudent->nim, -4)) + 1 : 1;
            $nim = $year.$deptCode.str_pad($counter, 4, '0', STR_PAD_LEFT);

            $skinPath = $this->documents['skin'] ?? null;

            Student::create([
                'user_id' => $user->id,
                'department_id' => $this->department_id,
                'nim' => $nim,
                'phone' => $this->phone,
                'address' => null,
                'photo' => null,
                'tiktok' => null,
                'skin' => $skinPath,
                'gpa' => 0.00,
                'achievements' => [],
                'credit_hours' => 0,
                'current_semester' => 1,
            ]);
        }
    }
}
