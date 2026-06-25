<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Faculty;
use App\Models\Lecturer;
use App\Models\Staff;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // 1. Define resources
        $resources = [
            'faculties',
            'departments',
            'courses',
            'academic-years',
            'buildings',
            'rooms',
            'lecturers',
            'staff',
            'students',
            'schedules',
            'users',
            'roles',
            'permissions',
        ];

        // 2. Create permissions
        $permissions = [];
        foreach ($resources as $resource) {
            foreach (['view-any', 'view', 'create', 'update', 'delete'] as $action) {
                $permissionName = "{$action} {$resource}";
                $permissions[] = Permission::findOrCreate($permissionName);
            }
        }

        // Additional permissions
        $permissions[] = Permission::findOrCreate('view-any app-settings');
        $permissions[] = Permission::findOrCreate('view app-settings');
        $permissions[] = Permission::findOrCreate('update app-settings');
        $permissions[] = Permission::findOrCreate('access admin-panel');

        // 3. Create Roles & Assign Permissions

        // Super Admin Role
        $superAdminRole = Role::findOrCreate('Super Admin');
        // Super Admin has all permissions implicitly via Gate::before, but we can assign them too
        $superAdminRole->givePermissionTo(Permission::all());

        // Academic Staff Role
        $academicStaffRole = Role::findOrCreate('Academic Staff');
        $academicStaffPermissions = [
            'access admin-panel',
            'view-any faculties', 'view faculties', 'create faculties', 'update faculties', 'delete faculties',
            'view-any departments', 'view departments', 'create departments', 'update departments', 'delete departments',
            'view-any courses', 'view courses', 'create courses', 'update courses', 'delete courses',
            'view-any academic-years', 'view academic-years', 'create academic-years', 'update academic-years', 'delete academic-years',
            'view-any buildings', 'view buildings', 'create buildings', 'update buildings', 'delete buildings',
            'view-any rooms', 'view rooms', 'create rooms', 'update rooms', 'delete rooms',
            'view-any lecturers', 'view lecturers', 'create lecturers', 'update lecturers', 'delete lecturers',
            'view-any staff', 'view staff', 'create staff', 'update staff', 'delete staff',
            'view-any students', 'view students', 'create students', 'update students', 'delete students',
            'view-any schedules', 'view schedules', 'create schedules', 'update schedules', 'delete schedules',
        ];
        foreach ($academicStaffPermissions as $perm) {
            $academicStaffRole->givePermissionTo($perm);
        }

        // Lecturer Role
        $lecturerRole = Role::findOrCreate('Lecturer');
        $lecturerRole->givePermissionTo([
            'access admin-panel',
            'view-any schedules', 'view schedules',
            'view lecturers',
        ]);

        // Student Role
        $studentRole = Role::findOrCreate('Student');
        $studentRole->givePermissionTo([
            'access admin-panel',
            'view-any schedules', 'view schedules',
            'view students',
        ]);

        // 4. Create Default Users

        // Ensure we have a default department for lecturer/student profiles
        $department = Department::first();
        if (! $department) {
            // If department doesn't exist, we will create one
            $faculty = Faculty::create([
                'name' => 'Fakultas Teknologi Informasi',
                'slug' => 'fakultas-teknologi-informasi',
                'code' => 'FTI',
            ]);
            $department = Department::create([
                'faculty_id' => $faculty->id,
                'name' => 'Teknik Informatika',
                'slug' => 'teknik-informatika',
                'code' => 'TI',
            ]);
        }

        // Super Admin User
        $superAdminUser = User::updateOrCreate(
            ['email' => 'admin@unemo.ac.id'],
            [
                'name' => 'Super Admin UNEMO',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $superAdminUser->assignRole($superAdminRole);

        // Academic Staff User
        $staffUser = User::updateOrCreate(
            ['email' => 'staff@unemo.ac.id'],
            [
                'name' => 'Staff Akademik UNEMO',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $staffUser->assignRole($academicStaffRole);
        Staff::updateOrCreate(
            ['user_id' => $staffUser->id],
            [
                'nip' => '198501012010121001',
                'position' => 'Admin Akademik',
                'phone' => '081234567891',
                'address' => 'Kampus UNEMO Gedung A',
            ]
        );

        // Lecturer User
        $lecturerUser = User::updateOrCreate(
            ['email' => 'dosen@unemo.ac.id'],
            [
                'name' => 'Dosen UNEMO',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $lecturerUser->assignRole($lecturerRole);
        Lecturer::updateOrCreate(
            ['user_id' => $lecturerUser->id],
            [
                'department_id' => $department->id,
                'nip' => '197502022000031002',
                'phone' => '081234567892',
                'address' => 'Jl. Dosen No. 12',
            ]
        );

        // Student User
        $studentUser = User::updateOrCreate(
            ['email' => 'mahasiswa@unemo.ac.id'],
            [
                'name' => 'Mahasiswa UNEMO',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );
        $studentUser->assignRole($studentRole);
        Student::updateOrCreate(
            ['user_id' => $studentUser->id],
            [
                'department_id' => $department->id,
                'nim' => '2026010001',
                'phone' => '081234567893',
                'address' => 'Asrama Mahasiswa UNEMO',
                'gpa' => 3.85,
                'credit_hours' => 84,
                'current_semester' => 4,
                'achievements' => [
                    'Juara 1 Lomba Piston Kompresor Redstone Nasional 2025',
                    'Pemenang Hackathon Minecraft Voxel Art 2026',
                    'Sertifikasi Ahli Penjinak Creeper Level 2',
                ],
            ]
        );

        // Also assign Super Admin role to user ID 1 (e.g. active testing user 'Aghata') if they exist
        $user1 = User::find(1);
        if ($user1) {
            $user1->assignRole($superAdminRole);
        }
    }
}
