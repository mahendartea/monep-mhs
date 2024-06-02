<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $admin = User::factory()->create(
            [
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => bcrypt('password123')
            ],
        );

        $pimpinan = User::factory()->create(
            [
                'name' => 'pimpinan',
                'email' => 'pimpinan@example.com',
                'password' => bcrypt('password123')
            ]
        );

        $pegawai = User::factory()->create(
            [
                'name' => 'pegawai',
                'email' => 'pegawai@example.com',
                'password' => bcrypt('password123')
            ]
        );

        \Spatie\Permission\Models\Role::create(['name' => 'admin']);
        \Spatie\Permission\Models\Role::create(['name' => 'pimpinan']);
        \Spatie\Permission\Models\Role::create(['name' => 'pegawai']);

        $admin->assignRole('admin');
        $pimpinan->assignRole('pimpinan');
        $pegawai->assignRole('pegawai');
    }
}
