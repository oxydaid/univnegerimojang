<?php

namespace App\Filament\Resources\Schedules\Schemas;

use App\Models\Lecturer;
use App\Models\Schedule;
use Closure;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Schedule Details')
                    ->description('Set up academic schedule times, rooms, courses, and lecturers.')
                    ->schema([
                        Select::make('academic_year_id')
                            ->relationship('academicYear', 'name')
                            ->required()
                            ->placeholder('Select academic year...')
                            ->prefixIcon('heroicon-o-calendar'),
                        Select::make('course_id')
                            ->relationship('course', 'name')
                            ->required()
                            ->placeholder('Select course...')
                            ->prefixIcon('heroicon-o-book-open'),
                        Select::make('lecturer_id')
                            ->placeholder('Select lecturer...')
                            ->prefixIcon('heroicon-o-user')
                            ->options(
                                // Mengambil data dosen beserta relasi user-nya, lalu di-mapping
                                Lecturer::with('user')->get()->mapWithKeys(function ($lecturer) {
                                    return [$lecturer->id => $lecturer->user->name.' ('.$lecturer->nip.')'];
                                })
                            ),
                        Select::make('room_id')
                            ->relationship('room', 'name')
                            ->required()
                            ->placeholder('Select room...')
                            ->prefixIcon('heroicon-o-home'),
                        Select::make('day_of_week')
                            ->options([
                                'Senin' => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu',
                            ])
                            ->required()
                            ->placeholder('Select day...')
                            ->prefixIcon('heroicon-o-clock'),

                        TimePicker::make('start_time')
                            ->required()
                            ->placeholder('HH:MM:SS')
                            ->prefixIcon('heroicon-o-clock'),
                        TimePicker::make('end_time')
                            ->required()
                            ->placeholder('HH:MM:SS')
                            ->prefixIcon('heroicon-o-clock')
                            ->after('start_time')
                            ->rules([
                                fn (Get $get) => function (string $attribute, $value, Closure $fail) use ($get) {
                                    $roomId = $get('room_id');
                                    $lecturerId = $get('lecturer_id');
                                    $day = $get('day_of_week');
                                    $start = $get('start_time');
                                    $academicYearId = $get('academic_year_id');
                                    $scheduleId = $get('id'); // Ambil ID jika sedang edit

                                    // 1. Cek Bentrok Ruangan
                                    $roomConflict = Schedule::where('academic_year_id', $academicYearId)
                                        ->where('room_id', $roomId)
                                        ->where('day_of_week', $day)
                                        ->where('id', '!=', $scheduleId)
                                        ->where(function ($query) use ($start, $value) {
                                            $query->whereBetween('start_time', [$start, $value])
                                                ->orWhereBetween('end_time', [$start, $value])
                                                ->orWhere(function ($q) use ($start, $value) {
                                                    $q->where('start_time', '<=', $start)
                                                        ->where('end_time', '>=', $value);
                                                });
                                        })->exists();

                                    if ($roomConflict) {
                                        $fail('Ruangan ini sudah terpakai pada hari dan jam tersebut!');
                                    }

                                    // 2. Cek Bentrok Dosen
                                    $lecturerConflict = Schedule::where('academic_year_id', $academicYearId)
                                        ->where('lecturer_id', $lecturerId)
                                        ->where('day_of_week', $day)
                                        ->where('id', '!=', $scheduleId)
                                        ->where(function ($query) use ($start, $value) {
                                            // Logic overlap waktu yang sama
                                            $query->whereBetween('start_time', [$start, $value])
                                                ->orWhereBetween('end_time', [$start, $value]);
                                        })->exists();

                                    if ($lecturerConflict) {
                                        $fail('Dosen ini sudah memiliki jadwal mengajar pada waktu tersebut di ruangan lain!');
                                    }
                                },
                            ]),
                    ])->columnSpanFull()->columns(2),
            ]);
    }
}
