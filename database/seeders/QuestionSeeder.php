<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $questions = [
            [
                'question_text' => 'Berapa banyak blok Obsidian yang dibutuhkan untuk membangun portal Nether ukuran standar (paling minimal)?',
                'option_a' => '8 blok',
                'option_b' => '10 blok',
                'option_c' => '12 blok',
                'option_d' => '14 blok',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Bahan makanan apa yang digunakan untuk menjinakkan serigala liar (Wolf) agar menjadi peliharaan?',
                'option_a' => 'Raw Mutton',
                'option_b' => 'Wheat',
                'option_c' => 'Bone',
                'option_d' => 'Rotten Flesh',
                'correct_answer' => 'C',
            ],
            [
                'question_text' => 'Di koordinat ketinggian (Y-level) berapakah bijih Netherite / Ancient Debris paling optimal ditemukan di dimensi Nether?',
                'option_a' => 'Y = 11',
                'option_b' => 'Y = 15',
                'option_c' => 'Y = 64',
                'option_d' => 'Y = -58',
                'correct_answer' => 'B',
            ],
            [
                'question_text' => 'Blok manakah di bawah ini yang sepenuhnya tahan terhadap ledakan Creeper dan TNT (Blast Resistant)?',
                'option_a' => 'Obsidian',
                'option_b' => 'Cobblestone',
                'option_c' => 'Deepslate Tile',
                'option_d' => 'Iron Block',
                'correct_answer' => 'A',
            ],
            [
                'question_text' => 'Item apa yang harus dilemparkan oleh pemain untuk melakukan teleportasi cepat secara instan di dunia Minecraft?',
                'option_a' => 'Chorus Fruit',
                'option_b' => 'Eye of Ender',
                'option_c' => 'Firework Rocket',
                'option_d' => 'Ender Pearl',
                'correct_answer' => 'D',
            ],
        ];

        foreach ($questions as $q) {
            Question::updateOrCreate(
                ['question_text' => $q['question_text']],
                $q
            );
        }
    }
}
