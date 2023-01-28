<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'midwife']);
        Role::create(['name' => 'patient']);

        $user = User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('admin');

        $user = User::create([
            'name' => 'Test Midwife',
            'email' => 'midwife@gmail.com',
            'password' => bcrypt('password'),
        ]);

        $user->assignRole('midwife');
    }
}
