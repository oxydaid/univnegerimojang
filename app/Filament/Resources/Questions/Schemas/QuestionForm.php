<?php

namespace App\Filament\Resources\Questions\Schemas;

use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class QuestionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Ujian Trivia Soal')
                    ->description('Tuliskan detail soal ujian trivia dan kunci jawaban di bawah ini.')
                    ->schema([
                        Textarea::make('question_text')
                            ->label('Pertanyaan / Soal')
                            ->required()
                            ->rows(3)
                            ->placeholder('e.g., Berapa banyak obsidian untuk membuat portal Nether?')
                            ->columnSpanFull(),

                        TextInput::make('option_a')
                            ->label('Pilihan A')
                            ->required()
                            ->placeholder('e.g., 8 blok'),

                        TextInput::make('option_b')
                            ->label('Pilihan B')
                            ->required()
                            ->placeholder('e.g., 10 blok'),

                        TextInput::make('option_c')
                            ->label('Pilihan C')
                            ->required()
                            ->placeholder('e.g., 12 blok'),

                        TextInput::make('option_d')
                            ->label('Pilihan D')
                            ->required()
                            ->placeholder('e.g., 14 blok'),

                        Radio::make('correct_answer')
                            ->label('Kunci Jawaban Benar')
                            ->options([
                                'A' => 'Pilihan A',
                                'B' => 'Pilihan B',
                                'C' => 'Pilihan C',
                                'D' => 'Pilihan D',
                            ])
                            ->required()
                            ->inline()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }
}
