<?php

namespace App\Livewire\Landing;

use Livewire\Component;

class Alumni extends Component
{
    public function render()
    {
        // Famous Minecraft alumni data
        $alumni = [
            [
                'name' => 'Mumbo Jumbo',
                'achievement' => 'Master Redstone & Otomatisasi',
                'graduation_year' => 'Angkatan 2019',
                'study_program' => 'S1 Teknik Redstone',
                'quote' => 'Berhasil membangun pintu piston 12x12 pertama di dunia Overworld dan sistem sortir barang otomatis berkapasitas 10 juta item.',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=300&auto=format&fit=crop',
                'skin_preview' => 'https://namemc.com/head/Mumbo.png', // We can use NameMC head rendering style or custom name
                'tiktok_url' => 'https://www.tiktok.com/@mumbojumbo_official',
            ],
            [
                'name' => 'Grian',
                'achievement' => 'Arsitek Megastruktur & Kastil',
                'graduation_year' => 'Angkatan 2020',
                'study_program' => 'S1 Arsitektur Blok & Struktur',
                'quote' => 'Perancang utama megastruktur Kastil Hermitcraft dan pakar dekorasi fasad bangunan voxel tingkat tinggi.',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=300&auto=format&fit=crop',
                'skin_preview' => 'https://namemc.com/head/Grian.png',
                'tiktok_url' => 'https://www.tiktok.com/@grian',
            ],
            [
                'name' => 'Dream',
                'achievement' => 'Pakar Survival & Parkour Manhunt',
                'graduation_year' => 'Angkatan 2021',
                'study_program' => 'S1 Eksplorasi Netherite & Tambang',
                'quote' => 'Memegang rekor melarikan diri (manhunt) di Nether dan pelopor taktik lompatan parkour blok tak terbatas.',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop',
                'skin_preview' => 'https://namemc.com/head/Dream.png',
                'tiktok_url' => 'https://www.tiktok.com/@dream',
            ],
            [
                'name' => 'CaptainSparklez',
                'achievement' => 'Komposer Ikonik Lagu Mojang',
                'graduation_year' => 'Angkatan 2017',
                'study_program' => 'S1 Seni & Musik Mojang (Kehormatan)',
                'quote' => 'Komposer lagu legendaris "Revenge" dan "Fallen Kingdom" yang menginspirasi jutaan petualang di Overworld.',
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=300&auto=format&fit=crop',
                'skin_preview' => 'https://namemc.com/head/CaptainSparklez.png',
                'tiktok_url' => 'https://www.tiktok.com/@captainsparklez',
            ],
        ];

        return view('livewire.landing.alumni', [
            'alumni' => $alumni,
        ]);
    }
}
