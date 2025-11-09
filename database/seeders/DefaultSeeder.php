<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['Admin', 'User'];
        foreach ($roles as $role) {
            Role::create([
                'name' => $role,
                'guard_name' => 'web',
            ]);
        }

        // Create or get the admin user
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('12345678'),
        ]);

        // Assign the Admin role if not already assigned
        if (! $user->hasRole('Admin')) {
            $user->assignRole('Admin');
        }

    }
}
