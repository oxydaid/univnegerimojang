<?php

namespace Database\Seeders;

use App\Models\AcademicYear;
use App\Models\AppSetting;
use App\Models\Building;
use App\Models\Course;
use App\Models\Department;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\Room;
use App\Models\Schedule;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure roles and permissions are seeded first
        if (Role::count() === 0) {
            $this->call(RolesAndPermissionsSeeder::class);
        }

        // 1. Seed App Settings (Minecraft Branding)
        AppSetting::updateOrCreate(
            ['id' => 1],
            [
                'app_name' => 'Universitas Negeri Mojang (UNEMO)',
                'app_description' => 'Pusat pendidikan perguruan tinggi terbaik. Cetak keahlian otomatisasi piston, rekayasa pertambangan Netherite, dan rancang bangun megastruktur.',
                'meta_title_default' => 'UNEMO - Universitas Negeri Mojang | Kampus Terbesar Overworld',
                'meta_description_default' => 'Pendaftaran Mahasiswa Baru Universitas Negeri Mojang (UNEMO) telah dibuka! Pelajari rekayasa Redstone, teknik arsitektur blok, pertambangan Netherite, dan rekayasa konstruksi bersama pakar terbaik.',
                'meta_keywords' => 'unemo, universitas negeri mojang, minecraft, redstone, pertambangan nether, konstruksi, crafting, steve, alex',
                'og_title' => 'Universitas Negeri Mojang (UNEMO)',
                'og_description' => 'Membangun peradaban Overworld dengan kecerdasan Redstone dan rekayasa Konstruksi.',
                'favicon' => null,
                'logo' => null,
                'default_share_image' => null,
                'ga4_measurement_id' => 'G-UNEMO123',
                'primary_color' => '#1b4332', // Emerald Green khas Minecraft
                'secondary_color' => '#0284c7', // Diamond Blue khas Minecraft
                'facebook_url' => 'https://facebook.com/unemo.official',
                'email' => 'kontak@unemo.ac.id',
                'instagram_url' => 'https://instagram.com/unemo.official',
                'twitter_url' => 'https://twitter.com/unemo_official',
                'github_url' => 'https://github.com/unemo-studios',
                'tiktok_url' => 'https://tiktok.com/@unemo.official',
                'whatsapp_number' => '6281234567890',
                'discord_url' => 'https://discord.gg/unemo-overworld',
            ]
        );

        // 2. Seed Minecraft-Themed Faculties and Departments
        // Faculty of Redstone & Computing
        $frrk = Faculty::updateOrCreate(
            ['code' => 'FRRK'],
            [
                'name' => 'Fakultas Rekayasa Redstone & Komputasi',
                'slug' => 'fakultas-rekayasa-redstone-dan-komputasi',
            ]
        );
        $deptRedstone = Department::updateOrCreate(
            ['code' => 'TRED'],
            [
                'faculty_id' => $frrk->id,
                'name' => 'S1 Teknik Redstone',
                'slug' => 's1-teknik-redstone',
            ]
        );
        $deptArch = Department::updateOrCreate(
            ['code' => 'ABST'],
            [
                'faculty_id' => $frrk->id,
                'name' => 'S1 Arsitektur Blok & Struktur',
                'slug' => 's1-arsitektur-blok-dan-struktur',
            ]
        );

        // Faculty of Construction & Decoration
        $fsrm = Faculty::updateOrCreate(
            ['code' => 'FKDP'],
            [
                'name' => 'Fakultas Konstruksi, Dekorasi & Pertamanan',
                'slug' => 'fakultas-konstruksi-dekorasi-dan-pertamanan',
            ]
        );
        $deptBrewing = Department::updateOrCreate(
            ['code' => 'KONS'],
            [
                'faculty_id' => $fsrm->id,
                'name' => 'S1 Teknik Konstruksi & Bangunan',
                'slug' => 's1-teknik-konstruksi-dan-bangunan',
            ]
        );
        $deptEnchant = Department::updateOrCreate(
            ['code' => 'PTMN'],
            [
                'faculty_id' => $fsrm->id,
                'name' => 'S1 Desain Eksterior & Pertamanan',
                'slug' => 's1-desain-eksterior-dan-pertamanan',
            ]
        );

        // Faculty of Nether Mining & Geology
        $fpgn = Faculty::updateOrCreate(
            ['code' => 'FPGN'],
            [
                'name' => 'Fakultas Pertambangan & Geologi Nether',
                'slug' => 'fakultas-pertambangan-dan-geologi-nether',
            ]
        );
        $deptMining = Department::updateOrCreate(
            ['code' => 'MINE'],
            [
                'faculty_id' => $fpgn->id,
                'name' => 'S1 Eksplorasi Netherite & Tambang',
                'slug' => 's1-eksplorasi-netherite-dan-tambang',
            ]
        );
        $deptDim = Department::updateOrCreate(
            ['code' => 'EDIM'],
            [
                'faculty_id' => $fpgn->id,
                'name' => 'S1 Studi Dimensi Nether & The End',
                'slug' => 's1-studi-dimensi-nether-dan-the-end',
            ]
        );

        // Faculty of Agriculture & Husbandry
        $fppm = Faculty::updateOrCreate(
            ['code' => 'FPPM'],
            [
                'name' => 'Fakultas Pertanian & Peternakan Mojang',
                'slug' => 'fakultas-pertanian-dan-peternakan-mojang',
            ]
        );
        $deptAgri = Department::updateOrCreate(
            ['code' => 'AGRI'],
            [
                'faculty_id' => $fppm->id,
                'name' => 'S1 Teknik Pertanian Otomatis',
                'slug' => 's1-teknik-pertanian-otomatis',
            ]
        );
        $deptHusbandry = Department::updateOrCreate(
            ['code' => 'HUSB'],
            [
                'faculty_id' => $fppm->id,
                'name' => 'S1 Peternakan Villager & Domba',
                'slug' => 's1-peternakan-villager-dan-domba',
            ]
        );

        // 3. Seed Buildings & Rooms
        $rektorat = Building::updateOrCreate(
            ['code' => 'RS'],
            ['name' => 'Gedung Rektorat Steve']
        );
        $labRed = Building::updateOrCreate(
            ['code' => 'LR'],
            ['name' => 'Laboratorium Redstone Mumbo']
        );
        $towerSihir = Building::updateOrCreate(
            ['code' => 'GKP'],
            ['name' => 'Gedung Konstruksi & Peleburan']
        );
        $library = Building::updateOrCreate(
            ['code' => 'PS'],
            ['name' => 'Perpustakaan Stronghold']
        );

        // Rooms
        $roomRektor = Room::updateOrCreate(
            ['code' => 'RS-101'],
            [
                'building_id' => $rektorat->id,
                'name' => 'Ruang Kerja Rektor Steve',
                'capacity' => 10,
            ]
        );
        $roomAula = Room::updateOrCreate(
            ['code' => 'RS-MAIN'],
            [
                'building_id' => $rektorat->id,
                'name' => 'Aula Utama Overworld',
                'capacity' => 200,
            ]
        );
        $roomPiston = Room::updateOrCreate(
            ['code' => 'LR-PISTON'],
            [
                'building_id' => $labRed->id,
                'name' => 'Lab Rekayasa Piston & Repeater',
                'capacity' => 40,
            ]
        );
        $roomBrew = Room::updateOrCreate(
            ['code' => 'GKP-MELT'],
            [
                'building_id' => $towerSihir->id,
                'name' => 'Laboratorium Peleburan & Pemadatan Blok',
                'capacity' => 30,
            ]
        );
        $roomEnch = Room::updateOrCreate(
            ['code' => 'GKP-CRAFT'],
            [
                'building_id' => $towerSihir->id,
                'name' => 'Ruang Perakitan & Crafting Peralatan',
                'capacity' => 15,
            ]
        );
        $roomLibrary = Room::updateOrCreate(
            ['code' => 'PS-READ'],
            [
                'building_id' => $library->id,
                'name' => 'Ruang Baca Peta Stronghold',
                'capacity' => 80,
            ]
        );

        // 4. Seed Academic Year
        $ay = AcademicYear::updateOrCreate(
            ['name' => 'Tahun Akademik 2026/2027'],
            ['is_active' => true]
        );

        // 5. Seed Courses
        $courseRedstone = Course::updateOrCreate(
            ['code' => 'RED-101'],
            [
                'department_id' => $deptRedstone->id,
                'name' => 'Pengantar Logika Redstone & Piston Gate',
                'credits' => 3,
            ]
        );
        $courseArch = Course::updateOrCreate(
            ['code' => 'BLK-201'],
            [
                'department_id' => $deptArch->id,
                'name' => 'Konstruksi Piston Door 3x3 & Megastruktur',
                'credits' => 4,
            ]
        );
        $courseBrewing = Course::updateOrCreate(
            ['code' => 'KNS-301'],
            [
                'department_id' => $deptBrewing->id,
                'name' => 'Teknik Peleburan & Pemadatan Blok (Furnace Tech)',
                'credits' => 3,
            ]
        );
        $courseSafety = Course::updateOrCreate(
            ['code' => 'PTM-101'],
            [
                'department_id' => $deptEnchant->id,
                'name' => 'Desain Tata Ruang Hijau & Pertamanan Overworld',
                'credits' => 2,
            ]
        );
        $courseNether = Course::updateOrCreate(
            ['code' => 'NET-202'],
            [
                'department_id' => $deptMining->id,
                'name' => 'Eksplorasi Netherite Efektif di Koordinat Y=15',
                'credits' => 3,
            ]
        );
        $courseDragon = Course::updateOrCreate(
            ['code' => 'END-402'],
            [
                'department_id' => $deptDim->id,
                'name' => 'Studi Perilaku Ender Dragon & Pelestarian Spesies',
                'credits' => 4,
            ]
        );

        // 6. Seed Staff (Rektor & Wakil Rektor)
        $staffData = [
            [
                'name' => 'Prof. Dr. Steve Creeperson, M.Red.',
                'email' => 'rektor@unemo.ac.id',
                'nip' => '196803121994031002',
                'position' => 'Rektor',
                'phone' => '081234567894',
                'address' => 'Gedung Rektorat Steve Lt. 2, Overworld',
                'tiktok' => 'https://www.tiktok.com/@steve_unemo',
            ],
            [
                'name' => 'Dr. Alex Blockbuilder, M.Arch.',
                'email' => 'warek1@unemo.ac.id',
                'nip' => '197204152000032001',
                'position' => 'Wakil Rektor I Bidang Akademik',
                'phone' => '081234567895',
                'address' => 'Gedung Rektorat Steve Lt. 2, Overworld',
                'tiktok' => 'https://www.tiktok.com/@alex_builder',
            ],
            [
                'name' => 'H. Ahmad Villager, S.E., M.B.A.',
                'email' => 'warek2@unemo.ac.id',
                'nip' => '197509202005011003',
                'position' => 'Wakil Rektor II Bidang Keuangan',
                'phone' => '081234567896',
                'address' => 'Gedung Rektorat Steve Lt. 2, Overworld',
                'tiktok' => 'https://www.tiktok.com/@ahmad_villager_trader',
            ],
        ];

        foreach ($staffData as $item) {
            $user = User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            // Assign Super Admin or Academic Staff
            if ($item['position'] === 'Rektor') {
                $role = Role::findByName('Super Admin');
                if ($role) {
                    $user->assignRole($role);
                }
            } else {
                $role = Role::findByName('Academic Staff');
                if ($role) {
                    $user->assignRole($role);
                }
            }

            Staff::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'nip' => $item['nip'],
                    'position' => $item['position'],
                    'phone' => $item['phone'],
                    'address' => $item['address'],
                    'tiktok' => $item['tiktok'],
                    'skin' => null, // Placeholder skin
                ]
            );
        }

        // 7. Seed Lecturers
        $lecturersData = [
            [
                'name' => 'Prof. Mumbo Jumbo, Ph.D.',
                'email' => 'mumbo@unemo.ac.id',
                'nip' => '198001012005011001',
                'department_id' => $deptRedstone->id,
                'phone' => '081234567801',
                'address' => 'Menara Piston No. 9, Overworld',
                'tiktok' => 'https://www.tiktok.com/@mumbojumbo_official',
            ],
            [
                'name' => 'Ibu Roslin Builder, M.Sc.',
                'email' => 'roslin@unemo.ac.id',
                'nip' => '197805122008022001',
                'department_id' => $deptBrewing->id,
                'phone' => '081234567802',
                'address' => 'Perumahan Dosen Sektor Kayu, Overworld',
                'tiktok' => 'https://www.tiktok.com/@roslin_builder',
            ],
            [
                'name' => 'Prof. Piglin Golddigger, D.Eng.',
                'email' => 'piglin@unemo.ac.id',
                'nip' => '198210152011011003',
                'department_id' => $deptMining->id,
                'phone' => '081234567803',
                'address' => 'Benteng Bastion Sektor C, Dimensi Nether',
                'tiktok' => 'https://www.tiktok.com/@piglin_gold',
            ],
            [
                'name' => 'Dr. Enderman Teleporti, M.Si.',
                'email' => 'enderman@unemo.ac.id',
                'nip' => '198802222015031004',
                'department_id' => $deptDim->id,
                'phone' => '081234567804',
                'address' => 'Pulau Utama The End, Koordinat 0, 80, 0',
                'tiktok' => 'https://www.tiktok.com/@enderman_teleport',
            ],
        ];

        foreach ($lecturersData as $item) {
            $user = User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            $role = Role::findByName('Lecturer');
            if ($role) {
                $user->assignRole($role);
            }

            $lecturer = Lecturer::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'department_id' => $item['department_id'],
                    'nip' => $item['nip'],
                    'phone' => $item['phone'],
                    'address' => $item['address'],
                    'tiktok' => $item['tiktok'],
                    'skin' => null,
                ]
            );

            // Create schedules for each lecturer
            if ($item['nip'] === '198001012005011001') {
                // Mumbo Jumbo teaches Redstone 101
                Schedule::updateOrCreate([
                    'academic_year_id' => $ay->id,
                    'course_id' => $courseRedstone->id,
                    'lecturer_id' => $lecturer->id,
                    'room_id' => $roomPiston->id,
                ], [
                    'day_of_week' => 'Senin',
                    'start_time' => '08:00:00',
                    'end_time' => '10:30:00',
                ]);
            } elseif ($item['nip'] === '197805122008022001') {
                // Roslin Builder teaches Construction
                Schedule::updateOrCreate([
                    'academic_year_id' => $ay->id,
                    'course_id' => $courseBrewing->id,
                    'lecturer_id' => $lecturer->id,
                    'room_id' => $roomBrew->id,
                ], [
                    'day_of_week' => 'Rabu',
                    'start_time' => '10:00:00',
                    'end_time' => '12:30:00',
                ]);
            } elseif ($item['nip'] === '198210152011011003') {
                // Piglin teaches Netherite exploration
                Schedule::updateOrCreate([
                    'academic_year_id' => $ay->id,
                    'course_id' => $courseNether->id,
                    'lecturer_id' => $lecturer->id,
                    'room_id' => $roomRektor->id, // Special lab
                ], [
                    'day_of_week' => 'Selasa',
                    'start_time' => '13:00:00',
                    'end_time' => '15:30:00',
                ]);
            }
        }

        // 8. Seed Students (Minecraft famous figures)
        $studentsData = [
            [
                'name' => 'Dream Speedrunner',
                'email' => 'dream@unemo.ac.id',
                'nim' => '2026010002',
                'department_id' => $deptRedstone->id,
                'phone' => '081234567902',
                'address' => 'Rumah Hutan Overworld, Koordinat X: 500, Z: -1200',
                'tiktok' => 'https://www.tiktok.com/@dream',
            ],
            [
                'name' => 'Grian Builder',
                'email' => 'grian@unemo.ac.id',
                'nim' => '2026010003',
                'department_id' => $deptArch->id,
                'phone' => '081234567903',
                'address' => 'Kastil Megah Hermitcraft Sektor Utara',
                'tiktok' => 'https://www.tiktok.com/@grian',
            ],
            [
                'name' => 'GeorgeNotFound Colorblind',
                'email' => 'george@unemo.ac.id',
                'nim' => '2026010004',
                'department_id' => $deptEnchant->id,
                'phone' => '081234567904',
                'address' => 'Asrama UNEMO Gedung C',
                'tiktok' => 'https://www.tiktok.com/@georgenotfound',
            ],
            [
                'name' => 'Sapnap Netherman',
                'email' => 'sapnap@unemo.ac.id',
                'nim' => '2026010005',
                'department_id' => $deptMining->id,
                'phone' => '081234567905',
                'address' => 'Asrama UNEMO Gedung B',
                'tiktok' => 'https://www.tiktok.com/@sapnap',
            ],
        ];

        foreach ($studentsData as $item) {
            $user = User::updateOrCreate(
                ['email' => $item['email']],
                [
                    'name' => $item['name'],
                    'password' => Hash::make('password'),
                    'email_verified_at' => now(),
                ]
            );

            $role = Role::findByName('Student');
            if ($role) {
                $user->assignRole($role);
            }

            Student::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'department_id' => $item['department_id'],
                    'nim' => $item['nim'],
                    'phone' => $item['phone'],
                    'address' => $item['address'],
                    'tiktok' => $item['tiktok'],
                    'skin' => null,
                ]
            );
        }
    }
}
